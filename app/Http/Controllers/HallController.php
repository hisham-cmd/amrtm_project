<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\HallStatus;
use App\Enums\OccasionType;
use App\Models\AgentRefCode;
use App\Models\Hall;
use App\Models\PartnerCategory;
use App\Models\Referral;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HallController extends Controller
{
    public function index(): View
    {
        $halls = Hall::where('status', HallStatus::Active)
            ->with([
                'features',
                'media',
                'busyDates',
                'bookings' => fn($q) => $q->where('status', BookingStatus::Confirmed),
            ])
            ->get();

        // All partners (both simple & account) grouped by category
        $partnersByCategory = PartnerCategory::with(['partners' => fn($q) => $q->where('status', 'active')])
            ->orderBy('name')
            ->get()
            ->filter(fn($cat) => $cat->partners->isNotEmpty())
            ->mapWithKeys(fn($cat) => [
                $cat->name => $cat->partners->map(fn($p) => [
                    'id'          => $p->id,
                    'name'        => $p->company_name,
                    'logo_url'    => $p->logo_url,
                    'description' => $p->description,
                    'phone'       => $p->phone,
                    'whatsapp'    => $p->whatsapp,
                    'profile_url' => $p->type === 'account' ? route('partners.profile', $p->id) : null,
                ])->values(),
            ])
            ->toArray();

        $featureCategories = collect(array_keys($partnersByCategory));

        // جميع التصنيفات بغض النظر عن وجود شركاء فيها
        $categories = PartnerCategory::withCount(['partners' => fn($q) => $q->where('status', 'active')])
            ->orderBy('name')
            ->get()
            ->map(fn($cat) => (object)[
                'name'           => $cat->name,
                'partners_count' => $cat->partners_count,
            ]);

        return view('halls_list', compact('halls', 'featureCategories', 'partnersByCategory', 'categories'));
    }

    public function show(Hall $hall): View
    {
        abort_if($hall->status !== HallStatus::Active, 404);

        $hall->load(['features', 'media', 'seasonalPrices', 'busyDates', 'bookings', 'partners', 'offers']);

        $disabledDates = $this->getDisabledDates($hall);

        $seasonalPricesData = $hall->seasonalPrices->map(fn($s) => [
            'price' => number_format((float) $s->price_per_day, 2) . ' ريال',
            'from'  => $s->start_date->format('Y/m/d'),
            'to'    => $s->end_date->format('Y/m/d'),
        ])->values()->toArray();

        $offersData = $hall->offers
            ->filter(fn($o) => $o->is_active)
            ->map(fn($o) => [
                'title'             => $o->title,
                'discount_type'     => $o->discount_type,
                'discount_value'    => $o->discount_value,
                'description'       => $o->description,
                'included_services' => $o->included_services ?? [],
                'from'              => $o->start_date->format('Y/m/d'),
                'to'                => $o->end_date->format('Y/m/d'),
                'is_active_now'     => $o->isActiveNow(),
            ])->values()->toArray();

        $hallPublicUrl = $this->getHallPublicUrl($hall);
        $hallQrCodeUrl = route('halls.qr', ['hall' => $hall], false);
        $hallQrCodeSvg = $this->renderHallQrCodeSvg($hallPublicUrl);

        // All supervisor-added categories for the marquee chips
        $featureCategories = PartnerCategory::orderBy('name')->pluck('name');

        // Partners grouped by category for the modal popup
        $partnersByCategory = PartnerCategory::with('partners')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(fn($cat) => [
                $cat->name => $cat->partners->map(fn($p) => [
                    'name'     => $p->company_name,
                    'logo_url' => $p->logo_url,
                ])->values(),
            ])
            ->toArray();

        return view('hall_details', compact('hall', 'disabledDates', 'seasonalPricesData', 'offersData', 'hallPublicUrl', 'hallQrCodeUrl', 'hallQrCodeSvg', 'featureCategories', 'partnersByCategory'));
    }

    public function qrCode(Hall $hall): Response
    {
        abort_if($hall->status !== HallStatus::Active, 404);

        return response($this->renderHallQrCodeSvg($this->getHallPublicUrl($hall)), 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'public, max-age=86400',
            'Content-Disposition' => 'inline; filename="hall-'.$hall->id.'-qr.svg"',
        ]);
    }

    public function bookingForm(Hall $hall): View
    {
        abort_if($hall->status !== HallStatus::Active, 404);

        $hall->load(['busyDates', 'bookings']);

        $disabledDates = $this->getDisabledDates($hall);

        return view('booking_confirm', compact('hall', 'disabledDates'));
    }

    public function book(Request $request, Hall $hall): RedirectResponse
    {
        abort_if($hall->status !== HallStatus::Active, 404);

        $occasionValues = implode(',', array_column(OccasionType::cases(), 'value'));
        $paymentMethods = 'mada,visa,mastercard,apple_pay,stc_pay';

        $data = $request->validate([
            'owner_name'    => ['required', 'string', 'max:200'],
            'booking_date'  => ['required', 'date', 'after_or_equal:today'],
            'occasion_type' => ['required', 'in:' . $occasionValues],
            'guests_count'  => ['required', 'integer', 'min:1', 'max:' . $hall->capacity],
            'tables_count'  => ['required', 'integer', 'min:1', 'max:' . $hall->max_tables],
            'notes'         => ['nullable', 'string', 'max:1000'],
            'payment_method'    => ['required', 'in:' . $paymentMethods],
            'payment_contact'   => ['nullable', 'string', 'max:30'],
            'payment_email'     => ['nullable', 'email', 'max:150'],
            'payment_reference' => ['nullable', 'string', 'max:100'],
        ]);

        if (in_array($data['payment_method'], ['mada', 'visa', 'mastercard'], true)) {
            if (blank($data['payment_contact'] ?? null)) {
                return back()->withInput()->withErrors([
                    'payment_contact' => 'أدخل آخر 4 أرقام أو معرف البطاقة المختصر.',
                ]);
            }

            if (blank($data['payment_reference'] ?? null)) {
                return back()->withInput()->withErrors([
                    'payment_reference' => 'أدخل اسم حامل البطاقة.',
                ]);
            }
        }

        if ($data['payment_method'] === 'apple_pay' && blank($data['payment_email'] ?? null)) {
            return back()->withInput()->withErrors([
                'payment_email' => 'أدخل البريد المرتبط بحساب Apple Pay.',
            ]);
        }

        if ($data['payment_method'] === 'stc_pay') {
            if (blank($data['payment_contact'] ?? null)) {
                return back()->withInput()->withErrors([
                    'payment_contact' => 'أدخل رقم الجوال المرتبط بمحفظة stc pay.',
                ]);
            }

            if (blank($data['payment_reference'] ?? null)) {
                return back()->withInput()->withErrors([
                    'payment_reference' => 'أدخل اسم صاحب المحفظة أو وصفًا تعريفيًا لها.',
                ]);
            }
        }

        // Block manually blocked busy dates
        if ($hall->busyDates()->where('busy_date', $data['booking_date'])->exists()) {
            return back()->withInput()->withErrors([
                'booking_date' => 'هذا التاريخ محجوز ولا يمكن الحجز فيه.',
            ]);
        }

        // Block dates that already have a confirmed booking
        if ($hall->bookings()
            ->where('booking_date', $data['booking_date'])
            ->where('status', BookingStatus::Confirmed)
            ->exists()) {
            return back()->withInput()->withErrors([
                'booking_date' => 'هذا التاريخ محجوز مسبقاً.',
            ]);
        }

        $booking = $hall->bookings()->create([
            'user_id'       => Auth::id(),
            'owner_name'    => $data['owner_name'],
            'booking_date'  => $data['booking_date'],
            'occasion_type' => $data['occasion_type'],
            'guests_count'  => $data['guests_count'],
            'tables_count'  => $data['tables_count'],
            'notes'         => $data['notes'] ?? null,
            'status'        => BookingStatus::Pending,
            'total_price'   => (float) $hall->price_per_day,
            'payment_method'    => $data['payment_method'],
            'payment_contact'   => $data['payment_contact'] ?? null,
            'payment_email'     => $data['payment_email'] ?? null,
            'payment_reference' => $data['payment_reference'] ?? null,
            'payment_status'    => 'pending',
        ]);

        // Track referral if a valid referral code is in session
        $refCodeValue = session('referral_code');
        if ($refCodeValue) {
            $agentCode = AgentRefCode::where('code', $refCodeValue)->where('is_active', true)->first();
            if ($agentCode && $agentCode->agent_id !== Auth::id()) {
                Referral::firstOrCreate(
                    ['user_id' => Auth::id(), 'hall_id' => $hall->id],
                    [
                        'agent_id'        => $agentCode->agent_id,
                        'booking_id'      => $booking->id,
                        'ref_code'        => $refCodeValue,
                        'source'          => 'link',
                        'commission_rate' => 10.00,
                        'status'          => 'pending',
                    ]
                );
                session()->forget(['referral_code', 'referral_code_stored_at']);
            }
        }

        return redirect()->route('halls.list')
            ->with('success', 'تم إرسال طلب الحجز مع بيانات الدفع الإلكتروني بنجاح. سيتم مراجعة الطلب والتواصل معك قريباً.');
    }

    private function getDisabledDates(Hall $hall): array
    {
        $busyDates = $hall->busyDates
            ->pluck('busy_date')
            ->map(fn($d) => $d->format('Y-m-d'))
            ->toArray();

        $bookedDates = $hall->bookings
            ->where('status', BookingStatus::Confirmed)
            ->pluck('booking_date')
            ->map(fn($d) => $d->format('Y-m-d'))
            ->toArray();

        return array_values(array_unique(array_merge($busyDates, $bookedDates)));
    }

    private function getHallPublicUrl(Hall $hall): string
    {
        return url()->to(route('halls.show', ['hall' => $hall], false));
    }

    private function renderHallQrCodeSvg(string $content): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400, 10),
            new SvgImageBackEnd()
        );

        return (new Writer($renderer))->writeString($content);
    }

    public function requestForm(): View
    {
        return view('hall_request');
    }

    public function submitRequest(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'            => ['required', 'string', 'max:100'],
            'description'     => ['nullable', 'string'],
            'location'        => ['required', 'string', 'max:200'],
            'city'            => ['required', 'string', 'max:100'],
            'capacity'        => ['required', 'integer', 'min:1'],
            'max_tables'      => ['required', 'integer', 'min:1'],
            'price_per_day'   => ['required', 'numeric', 'min:0'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'profile_photo'   => ['nullable', 'image', 'max:2048'],
            'cover_photo'     => ['nullable', 'image', 'max:2048'],
        ]);

        $data['owner_id'] = Auth::id();
        $data['status']   = HallStatus::Pending;

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('halls/photos', 'public');
        }

        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('halls/covers', 'public');
        }

        Hall::create($data);

        return redirect()->route('halls.list')
            ->with('success', 'تم إرسال طلب إضافة القاعة بنجاح. سيتم مراجعته من قِبل الإدارة والرد عليك قريباً.');
    }
}
