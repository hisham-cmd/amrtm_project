<?php

namespace App\Http\Controllers\Owner;

use App\Enums\HallStatus;
use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\HallBooking;
use App\Models\HallOffer;
use App\Support\PartnerLogoStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private function ownerHall(): ?Hall
    {
        return Auth::user()->halls()->first();
    }

    public function index(): View
    {
        $hall     = $this->ownerHall();
        $bookings = $hall ? $hall->bookings()->latest()->take(5)->get() : collect();
        $stats    = [
            'total_bookings'     => $hall?->bookings()->count() ?? 0,
            'pending_bookings'   => $hall?->bookings()->where('status', 'pending')->count() ?? 0,
            'confirmed_bookings' => $hall?->bookings()->where('status', 'confirmed')->count() ?? 0,
            'busy_dates'         => $hall?->busyDates()->count() ?? 0,
        ];

        return view('owner.dashboard', compact('hall', 'bookings', 'stats'));
    }

    public function hallInfo(): View
    {
        $hall = $this->ownerHall();
        return view('owner.hall-info', compact('hall'));
    }

    public function applicationPending(): View
    {
        $hall = $this->ownerHall();
        return view('owner.application-pending', compact('hall'));
    }

    public function applicationRejected(): View
    {
        $hall = $this->ownerHall();
        return view('owner.application-rejected', compact('hall'));
    }

    public function saveHallInfo(Request $request): RedirectResponse
    {
        $request->validate([
            'name'             => ['required', 'string', 'max:100'],
            'description'      => ['nullable', 'string'],
            'location'         => ['required', 'string', 'max:200'],
            'city'             => ['required', 'string', 'max:100'],
            'capacity'         => ['required', 'integer', 'min:1'],
            'max_tables'       => ['required', 'integer', 'min:1'],
            'price_per_day'    => ['required', 'numeric', 'min:0'],
            'whatsapp_number'  => ['nullable', 'string', 'max:20'],
            'profile_photo'    => ['nullable', 'image', 'max:2048'],
            'cover_photo'      => ['nullable', 'image', 'max:2048'],
        ]);

        $hall = $this->ownerHall() ?? new Hall(['owner_id' => Auth::id(), 'status' => HallStatus::Pending]);

        $data = $request->only([
            'name', 'description', 'location', 'city',
            'capacity', 'max_tables', 'price_per_day', 'whatsapp_number',
        ]);

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('halls/photos', 'public');
        }

        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('halls/covers', 'public');
        }

        if ($hall->exists) {
            $hall->update($data);
        } else {
            $hall->fill($data)->save();
        }

        return back()->with('success', 'تم حفظ معلومات القاعة بنجاح.');
    }

    public function media(): View
    {
        $hall  = $this->ownerHall();
        $media = $hall ? $hall->media : collect();
        return view('owner.media', compact('hall', 'media'));
    }

    public function uploadMedia(Request $request): RedirectResponse
    {
        $request->validate([
            'photos'   => ['required', 'array', 'max:10'],
            'photos.*' => [
                'image',
                'min:200',
                'max:8192',
                'dimensions:min_width=1280,min_height=720',
            ],
        ], [
            'photos.*.min'        => 'حجم الصورة صغير جداً (200 كيلوبايت على الأقل لضمان الجودة).',
            'photos.*.max'        => 'حجم الصورة كبير جداً (الحد الأقصى 8 ميجابايت).',
            'photos.*.dimensions' => 'دقة الصورة منخفضة — يُشترط 1280×720 بكسل على الأقل (HD).',
            'photos.*.image'      => 'يُسمح برفع الصور فقط (JPG, PNG, WEBP).',
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403, 'أنشئ معلومات القاعة أولاً.');

        $existingCount = $hall->media()->count();
        $remaining     = 10 - $existingCount;

        if ($remaining <= 0) {
            return back()->withErrors(['photos' => 'وصلت للحد الأقصى (10 صور). احذف بعض الصور أولاً.']);
        }

        $photos = array_slice($request->file('photos'), 0, $remaining);

        $lastOrder    = $hall->media()->max('sort_order') ?? 0;
        $firstUploaded = null;

        foreach ($photos as $photo) {
            $path = $photo->store('halls/media', 'public');
            $hall->media()->create(['file_path' => $path, 'sort_order' => ++$lastOrder]);
            if ($firstUploaded === null) {
                $firstUploaded = $path;
            }
        }

        // إذا لم تكن للقاعة صورة رئيسية، اجعل أول صورة مرفوعة هي الصورة الرئيسية
        if ($firstUploaded && ! $hall->profile_photo) {
            $hall->update(['profile_photo' => $firstUploaded]);
        }

        return back()->with('success', 'تم رفع الصور بنجاح.');
    }

    public function deleteMedia(int $id): RedirectResponse
    {
        $hall  = $this->ownerHall();
        $media = $hall?->media()->findOrFail($id);
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return back()->with('success', 'تم حذف الصورة.');
    }

    public function features(): View
    {
        $hall     = $this->ownerHall();
        $features = $hall ? $hall->features : collect();
        return view('owner.features', compact('hall', 'features'));
    }

    public function saveFeatures(Request $request): RedirectResponse
    {
        $request->validate([
            'features'        => ['required', 'array'],
            'features.*.name' => ['required', 'string', 'max:100'],
            'features.*.icon' => ['nullable', 'string', 'max:100'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403);

        $hall->features()->delete();

        foreach ($request->input('features') as $feature) {
            $hall->features()->create($feature);
        }

        return back()->with('success', 'تم حفظ مميزات القاعة بنجاح.');
    }

    public function seasonalPrices(): View
    {
        $hall   = $this->ownerHall();
        $prices = $hall ? $hall->seasonalPrices : collect();
        return view('owner.seasonal-prices', compact('hall', 'prices'));
    }

    public function saveSeasonalPrice(Request $request): RedirectResponse
    {
        $request->validate([
            'label'         => ['required', 'string', 'max:100'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date', 'after:start_date'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403);

        $hall->seasonalPrices()->create($request->only('label', 'start_date', 'end_date', 'price_per_day'));

        return back()->with('success', 'تم إضافة السعر الموسمي.');
    }

    public function updateSeasonalPrice(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'label'         => ['required', 'string', 'max:100'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date', 'after:start_date'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403);

        $hall->seasonalPrices()->findOrFail($id)->update(
            $request->only('label', 'start_date', 'end_date', 'price_per_day')
        );

        return back()->with('success', 'تم تحديث السعر الموسمي.');
    }

    public function deleteSeasonalPrice(int $id): RedirectResponse
    {
        $this->ownerHall()?->seasonalPrices()->findOrFail($id)->delete();
        return back()->with('success', 'تم حذف السعر الموسمي.');
    }

    // ── Offers ────────────────────────────────────────────────────────────

    public function offers(): View
    {
        $hall   = $this->ownerHall();
        $offers = $hall ? $hall->offers()->orderByDesc('start_date')->get() : collect();
        return view('owner.offers', compact('hall', 'offers'));
    }

    public function saveOffer(Request $request): RedirectResponse
    {
        $request->validate([
            'title'               => ['required', 'string', 'max:150'],
            'discount_type'       => ['required', 'in:percentage,fixed,none'],
            'discount_value'      => ['nullable', 'numeric', 'min:0'],
            'description'         => ['nullable', 'string', 'max:1000'],
            'included_services'   => ['nullable', 'array'],
            'included_services.*' => ['string', 'max:100'],
            'start_date'          => ['required', 'date'],
            'end_date'            => ['required', 'date', 'after:start_date'],
            'is_active'           => ['nullable', 'boolean'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403);

        $hall->offers()->create([
            'title'             => $request->title,
            'discount_type'     => $request->discount_type,
            'discount_value'    => $request->discount_type !== 'none' ? $request->discount_value : null,
            'description'       => $request->description,
            'included_services' => $request->included_services ?? [],
            'start_date'        => $request->start_date,
            'end_date'          => $request->end_date,
            'is_active'         => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'تم إضافة العرض بنجاح.');
    }

    public function toggleOffer(int $id): RedirectResponse
    {
        $offer = $this->ownerHall()?->offers()->findOrFail($id);
        $offer->update(['is_active' => ! $offer->is_active]);
        return back()->with('success', $offer->is_active ? 'تم تفعيل العرض.' : 'تم إيقاف العرض.');
    }

    public function deleteOffer(int $id): RedirectResponse
    {
        $this->ownerHall()?->offers()->findOrFail($id)->delete();
        return back()->with('success', 'تم حذف العرض.');
    }

    public function busyDates(): View
    {
        $hall  = $this->ownerHall();
        $dates = $hall ? $hall->busyDates()->orderBy('busy_date')->get() : collect();
        return view('owner.busy-dates', compact('hall', 'dates'));
    }

    public function addBusyDate(Request $request): RedirectResponse
    {
        $request->validate([
            'busy_date' => ['required', 'date', 'after_or_equal:today'],
            'reason'    => ['nullable', 'string', 'max:200'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403);

        $hall->busyDates()->firstOrCreate(
            ['busy_date' => $request->busy_date],
            ['reason'    => $request->reason]
        );

        return back()->with('success', 'تم إضافة اليوم المشغول.');
    }

    public function removeBusyDate(int $id): RedirectResponse
    {
        $this->ownerHall()?->busyDates()->findOrFail($id)->delete();
        return back()->with('success', 'تم إزالة اليوم.');
    }

    public function bookings(): View
    {
        $hall     = $this->ownerHall();
        $bookings = $hall ? $hall->bookings()->with('user')->latest()->paginate(15) : collect();
        return view('owner.bookings', compact('hall', 'bookings'));
    }

public function updateBookingStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate(['status' => ['required', 'in:confirmed,cancelled']]);

        $hall    = $this->ownerHall();
        $booking = $hall?->bookings()->findOrFail($id);
        $booking->update(['status' => $request->status]);

        // When confirming a booking, auto-cancel all other pending bookings on the same date
        $cancelledCount = 0;
        if ($request->status === 'confirmed') {
            $cancelledCount = $hall->bookings()
                ->where('id', '!=', $booking->id)
                ->where('booking_date', $booking->booking_date)
                ->where('status', 'pending')
                ->update(['status' => 'cancelled']);
        }

        $message = 'تم تحديث حالة الحجز.';
        if ($cancelledCount > 0) {
            $message .= " وتم إلغاء {$cancelledCount} حجز آخر على نفس التاريخ تلقائياً.";
        }

        return back()->with('success', $message);
    }

    public function documents(): View
    {
        $hall      = $this->ownerHall();
        $documents = $hall ? $hall->verificationDocuments : collect();
        return view('owner.documents', compact('hall', 'documents'));
    }

    public function partners(): View
    {
        $hall     = $this->ownerHall();
        $partners = $hall ? $hall->partners : collect();
        return view('owner.partners', compact('hall', 'partners'));
    }

        public function additionalFeatures(): View
        {
            $hall = $this->ownerHall();
            $additionalFeatures = $hall ? $hall->additionalFeatures : collect();
            return view('owner.additional-features', compact('hall', 'additionalFeatures'));
        }

        public function saveAdditionalFeatures(Request $request): RedirectResponse
        {
            $request->validate([
                'additional_features'        => ['required', 'array'],
                'additional_features.*.name' => ['required', 'string', 'max:100'],
                'additional_features.*.icon' => ['nullable', 'string', 'max:100'],
            ]);

            $hall = $this->ownerHall();
            abort_if(! $hall, 403);

            $hall->additionalFeatures()->delete();

            foreach ($request->input('additional_features') as $feature) {
                $hall->additionalFeatures()->create($feature);
            }

            return back()->with('success', 'تم حفظ المميزات الإضافية بنجاح.');
        }

        public function deleteAdditionalFeature(int $id): RedirectResponse
        {
            $hall = $this->ownerHall();
            $feature = $hall?->additionalFeatures()->findOrFail($id);
            $feature->delete();
            return back()->with('success', 'تم حذف الميزة الإضافية.');
        }

    public function savePartner(Request $request): RedirectResponse
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:150'],
            'logo'         => ['nullable', 'image', 'max:2048'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403, 'أنشئ معلومات القاعة أولاً.');

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = PartnerLogoStorage::storeForOwner($request->file('logo'), Auth::id(), $hall->id);
        }

        $hall->partners()->create([
            'company_name' => $request->company_name,
            'logo_path'    => $logoPath,
        ]);

        return back()->with('success', 'تم إضافة الشريك بنجاح.');
    }

    public function deletePartner(int $id): RedirectResponse
    {
        $partner = $this->ownerHall()?->partners()->findOrFail($id);

        if ($partner->logo_path) {
            PartnerLogoStorage::delete($partner->logo_path);
        }

        $partner->delete();

        return back()->with('success', 'تم حذف الشريك.');
    }

    public function uploadDocument(Request $request): RedirectResponse
    {
        $request->validate([
            'document_type' => ['required', 'string', 'max:100'],
            'file'          => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $hall = $this->ownerHall();
        abort_if(! $hall, 403, 'أنشئ معلومات القاعة أولاً.');

        $path = $request->file('file')->store('halls/documents', 'public');

        $hall->verificationDocuments()->create([
            'owner_id'      => Auth::id(),
            'document_type' => $request->document_type,
            'file_path'     => $path,
        ]);

        return back()->with('success', 'تم رفع الوثيقة. سيتم مراجعتها من قبل الإدارة.');
    }
}
