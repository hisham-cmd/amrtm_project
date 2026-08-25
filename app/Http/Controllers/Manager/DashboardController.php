<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Mail\HallApproved;
use App\Mail\HallRejected;
use App\Models\AgentRefCode;
use App\Models\Hall;
use App\Models\HallBooking;
use App\Models\PartnerCategory;
use App\Models\Referral;
use App\Models\Partner;
use App\Models\User;
use App\Enums\HallStatus;
use App\Enums\UserRole;
use App\Support\PartnerLogoStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_agents'      => User::where('role', UserRole::Agent)->count(),
            'pending_refs'      => Referral::where('status', 'pending')->where('source', 'manual')->count(),
            'confirmed_today'   => Referral::where('status', 'confirmed')->whereDate('confirmed_at', today())->count(),
            'total_commissions' => Referral::whereIn('status', ['confirmed', 'paid'])->sum('commission_amount'),
            'pending_halls'     => Hall::where('status', HallStatus::Pending)->count(),
            'total_halls'       => Hall::count(),
            'total_bookings'    => HallBooking::count(),
        ];

        $pendingManual = Referral::with(['agent', 'user', 'hall'])
            ->where('status', 'pending')
            ->where('source', 'manual')
            ->latest()->take(5)->get();

        $pendingHalls = Hall::with('owner')
            ->where('status', HallStatus::Pending)
            ->latest()->take(5)->get();

        return view('manager.dashboard', compact('stats', 'pendingManual', 'pendingHalls'));
    }

    // ── Referrals ─────────────────────────────────────────────────────────────

    public function referrals(Request $request): View
    {
        $query = Referral::with(['agent', 'user', 'hall', 'confirmedBy']);

        if ($request->filled('status'))  { $query->where('status', $request->status); }
        if ($request->filled('source'))  { $query->where('source', $request->source); }
        if ($request->filled('agent'))   { $query->where('agent_id', $request->agent); }

        $referrals = $query->latest()->paginate(15);
        $agents    = User::where('role', UserRole::Agent)->select('id', 'name')->get();

        return view('manager.referrals', compact('referrals', 'agents'));
    }

    public function decide(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'action' => 'required|in:confirmed,rejected',
            'notes'  => 'nullable|string|max:500',
        ]);

        $referral = Referral::findOrFail($id);

        if ($referral->status !== 'pending') {
            return back()->with('error', 'هذه الإحالة ليست في حالة انتظار.');
        }

        $referral->status       = $request->action;
        $referral->confirmed_by = Auth::id();
        $referral->confirmed_at = now();
        if ($request->notes) { $referral->notes = $request->notes; }

        if ($request->action === 'confirmed' && $referral->booking) {
            $referral->commission_amount = round($referral->booking->total_price * ($referral->commission_rate / 100), 2);
        }

        $referral->save();

        return back()->with('success', $request->action === 'confirmed'
            ? 'تم تأكيد الإحالة وحساب العمولة.' : 'تم رفض الإحالة.');
    }

    // ── Agents ────────────────────────────────────────────────────────────────

    public function agents(): View
    {
        $agents = User::with(['refCode'])
            ->where('role', UserRole::Agent)
            ->withCount('referrals')
            ->paginate(20);

        return view('manager.agents', compact('agents'));
    }

    public function createAgent(): View
    {
        return view('manager.create-agent');
    }

    public function storeAgent(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'phone'    => 'required|string|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $agent = User::create([
            'name'              => $request->name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'role'              => UserRole::Agent,
            'password'          => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        AgentRefCode::generateFor($agent->id);

        return redirect()->route('manager.agents')
            ->with('success', 'تم إنشاء حساب المندوب بنجاح وتم توليد كود الإحالة تلقائياً.');
    }

    // ── Halls ─────────────────────────────────────────────────────────────────

    public function halls(Request $request): View
    {
        $query = Hall::with('owner');

        if ($request->filled('status')) { $query->where('status', $request->status); }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
        }

        $halls = $query->latest()->paginate(20);

        return view('manager.halls', compact('halls'));
    }

    public function hallRequests(): View
    {
        $halls = Hall::with('owner')
            ->where('status', HallStatus::Pending)
            ->latest()->paginate(20);

        return view('manager.hall-requests', compact('halls'));
    }

    public function reviewHallRequest(int $id): View
    {
        $hall = Hall::with(['owner', 'verificationDocuments'])->findOrFail($id);

        return view('manager.review-hall', compact('hall'));
    }

    public function decideHallRequest(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'decision' => 'required|in:active,rejected',
            'note'     => 'nullable|string|max:500',
        ]);

        $hall = Hall::with('owner')->findOrFail($id);
        $hall->update([
            'status'     => $request->decision,
            'admin_note' => $request->decision === 'rejected' ? $request->note : null,
        ]);

        if ($hall->owner?->email) {
            if ($request->decision === 'active') {
                Mail::to($hall->owner->email)->send(new HallApproved($hall));
            } else {
                Mail::to($hall->owner->email)->send(new HallRejected($hall, $request->note));
            }
        }

        return redirect()->route('manager.hall-requests')
            ->with('success', $request->decision === 'active'
                ? 'تمت الموافقة على القاعة وأصبحت نشطة، وتم إشعار المالك بالبريد الإلكتروني.'
                : 'تم رفض طلب القاعة وتم إشعار المالك بالبريد الإلكتروني.');
    }

    public function createHall(): View
    {
        // Managers can register a hall on behalf of an owner
        $owners = User::where('role', UserRole::Owner)->select('id', 'name', 'phone')->orderBy('name')->get();
        return view('manager.create-hall', compact('owners'));
    }

    public function storeHall(Request $request): RedirectResponse
    {
        $request->validate([
            'owner_id'                   => 'required|exists:users,id',
            'name'                       => 'required|string|max:100',
            'description'                => 'nullable|string',
            'location'                   => 'required|string|max:200',
            'city'                       => 'required|string|max:100',
            'capacity'                   => 'required|integer|min:1',
            'max_tables'                 => 'required|integer|min:1',
            'price_per_day'              => 'required|numeric|min:0',
            'whatsapp_number'            => 'nullable|string|max:20',
            'registration_commission_rate' => 'nullable|numeric|min:0|max:100',
            'profile_photo'              => 'nullable|image|max:2048',
            'cover_photo'                => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'owner_id', 'name', 'description', 'location', 'city',
            'capacity', 'max_tables', 'price_per_day', 'whatsapp_number',
            'registration_commission_rate',
        ]);

        $data['registered_by'] = Auth::id();
        $data['status']        = HallStatus::Active; // Manager registers → directly active

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('halls/photos', 'public');
        }
        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('halls/covers', 'public');
        }

        Hall::create($data);

        return redirect()->route('manager.halls')
            ->with('success', 'تم تسجيل القاعة بنجاح وأصبحت نشطة في المنصة.');
    }

    // ── Bookings ──────────────────────────────────────────────────────────────

    public function bookings(Request $request): View
    {
        $query = HallBooking::with(['hall', 'user']);

        if ($request->filled('status')) { $query->where('status', $request->status); }
        if ($request->filled('hall'))   { $query->where('hall_id', $request->hall); }

        $bookings = $query->latest()->paginate(20);
        $halls    = Hall::select('id', 'name')->orderBy('name')->get();

        return view('manager.bookings', compact('bookings', 'halls'));
    }

    // ── Partners & Categories ─────────────────────────────────────────────────

    public function partners(): View
    {
        $categories = PartnerCategory::where('supervisor_id', Auth::id())
            ->withCount('partners')
            ->latest()
            ->get();

        $partners = Partner::where('added_by', Auth::id())
            ->where('type', 'simple')
            ->with('category')
            ->latest()
            ->get();

        return view('manager.partners', compact('categories', 'partners'));
    }

    public function saveCategory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        $exists = PartnerCategory::where('supervisor_id', Auth::id())
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'هذا التصنيف موجود بالفعل.'])->withInput();
        }

        PartnerCategory::create([
            'supervisor_id' => Auth::id(),
            'name'          => $validated['name'],
        ]);

        return back()->with('success', 'تم إضافة التصنيف بنجاح.');
    }

    public function deleteCategory(int $id): RedirectResponse
    {
        $category = PartnerCategory::where('supervisor_id', Auth::id())->findOrFail($id);
        $category->delete();

        return back()->with('success', 'تم حذف التصنيف وجميع شركائه بنجاح.');
    }

    public function savePartner(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id'  => ['required', 'integer', 'exists:partner_categories,id'],
            'company_name' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:20'],
            'whatsapp'     => ['nullable', 'string', 'max:20'],
            'logo'         => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
        ]);

        PartnerCategory::where('supervisor_id', Auth::id())->findOrFail($validated['category_id']);

        $data = [
            'added_by'     => Auth::id(),
            'type'         => 'simple',
            'status'       => 'active',
            'category_id'  => $validated['category_id'],
            'company_name' => $validated['company_name'],
            'description'  => $validated['description'] ?? null,
            'phone'        => $validated['phone'] ?? null,
            'whatsapp'     => $validated['whatsapp'] ?? null,
        ];

        if ($request->hasFile('logo')) {
            $data['logo_path'] = PartnerLogoStorage::storeForSupervisor($request->file('logo'), Auth::id());
        }

        Partner::create($data);

        return back()->with('success', 'تم إضافة الشريك بنجاح.');
    }

    public function deletePartner(int $id): RedirectResponse
    {
        $partner = Partner::where('added_by', Auth::id())
            ->where('type', 'simple')
            ->findOrFail($id);

        if ($partner->logo_path) {
            PartnerLogoStorage::delete($partner->logo_path);
        }

        $partner->delete();

        return back()->with('success', 'تم حذف الشريك بنجاح.');
    }
}
