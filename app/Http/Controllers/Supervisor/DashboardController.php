<?php

namespace App\Http\Controllers\Supervisor;

use App\Enums\DocumentStatus;
use App\Enums\HallStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\AgentRefCode;
use App\Models\Hall;
use App\Models\HallBooking;
use App\Models\HallVerificationDocument;
use App\Models\Order;
use App\Models\Referral;
use App\Models\PartnerCategory;
use App\Models\Partner;
use App\Support\PartnerLogoStorage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Mail\HallApproved;
use App\Mail\HallRejected;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Supervisor Dashboard Controller
 *
 * Handles all operations available to the Supervisor role, including:
 *   - Dashboard overview & statistics
 *   - User management (list, create, update, delete)
 *   - Referral review & commission calculation
 *   - Financial reporting (revenue, commissions, booking trends)
 *   - Hall management (list, status updates, approve/reject)
 *   - Booking oversight
 *   - Verification document approvals
 */
class DashboardController extends Controller
{
    // =========================================================================
    // DASHBOARD
    // =========================================================================

    /**
     * Show the main supervisor dashboard.
     *
     * Provides high-level platform statistics and a list of the most
     * recently registered users.
     */
    public function index(): View
    {
        $stats = [
            'total_users'      => User::count(),
            'total_owners'     => User::where('role', UserRole::Owner)->count(),
            'total_agents'     => User::where('role', UserRole::Agent)->count(),
            'total_managers'   => User::where('role', UserRole::Manager)->count(),
            'total_halls'      => Hall::count(),
            'total_bookings'   => HallBooking::count(),
            'pending_refs'     => Referral::where('status', 'pending')->count(),
            'pending_partners' => Partner::whereIn('type', ['account', 'officiant'])->where('status', 'pending')->count(),
        ];

        $recentUsers = User::latest()->take(6)->get();

        return view('supervisor.dashboard', compact('stats', 'recentUsers'));
    }

    // =========================================================================
    // USER MANAGEMENT
    // =========================================================================

    /**
     * List all users with optional role and keyword filters.
     *
     * Filters:
     *   - role   (query string): filter by UserRole value
     *   - search (query string): searches name, email, and phone
     */
    public function users(Request $request): View
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name',  'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%")
                  ->orWhere('phone', 'like', "%{$term}%");
            });
        }

        $users = $query->latest()->paginate(20);

        return view('supervisor.users', compact('users'));
    }

    /**
     * Show the create-user form.
     */
    public function createUser(): View
    {
        return view('supervisor.create-user');
    }

    /**
     * Validate and persist a new user account.
     *
     * If the new user's role is Agent, a referral code is auto-generated.
     * Supervisors can create accounts for: supervisor, manager, agent, owner.
     */
    public function storeUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'phone'    => ['required', 'string', 'max:20'],
            'role'     => ['required', 'in:supervisor,manager,agent,owner'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'role'     => UserRole::from($validated['role']),
            'password' => Hash::make($validated['password']),
        ]);

        if ($user->role === UserRole::Agent) {
            AgentRefCode::generateFor($user->id);
        }

        return redirect()->route('supervisor.users')
            ->with('success', "تم إنشاء حساب {$user->name} بنجاح.");
    }

    /**
     * Show the edit form for the given user.
     */
    public function editUser(int $id): View
    {
        $user = User::findOrFail($id);

        return view('supervisor.edit-user', compact('user'));
    }

    /**
     * Validate and update an existing user's profile data.
     *
     * Password is only updated when explicitly provided.
     * If the role is changed to Agent and no referral code exists, one is generated.
     */
    public function updateUser(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', "unique:users,email,{$id}"],
            'phone'    => ['required', 'string', 'max:20'],
            'role'     => ['required', 'in:supervisor,manager,agent,owner,user'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $data = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role'  => UserRole::from($validated['role']),
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        if ($user->role === UserRole::Agent && ! $user->refCode) {
            AgentRefCode::generateFor($user->id);
        }

        return redirect()->route('supervisor.users')
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    /**
     * Permanently delete a user account.
     *
     * Guards (both enforced here and in the view):
     *   - Cannot delete own account.
     *   - Cannot delete accounts with the Admin role.
     */
    public function deleteUser(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الخاص.');
        }

        if ($user->role === UserRole::Supervisor) {
            return back()->with('error', 'لا يمكن حذف حساب مشرف النظام.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('supervisor.users')
            ->with('success', "تم حذف حساب {$name} بنجاح.");
    }

    // =========================================================================
    // REFERRALS
    // =========================================================================

    /**
     * List referrals with optional status and agent filters.
     *
     * Filters:
     *   - status (query string): pending | confirmed | rejected
     *   - agent  (query string): agent user ID
     */
    public function referrals(Request $request): View
    {
        $query = Referral::with(['agent', 'user', 'hall', 'booking']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('agent')) {
            $query->where('agent_id', $request->agent);
        }

        $referrals = $query->latest()->paginate(20);
        $agents    = User::where('role', UserRole::Agent)->get();

        return view('supervisor.referrals', compact('referrals', 'agents'));
    }

    /**
     * Confirm or reject a pending referral.
     *
     * On confirmation:
     *   - Commission amount is calculated as a percentage of the linked booking total.
     *   - confirmed_by and confirmed_at timestamps are recorded.
     *
     * Only referrals in "pending" status can be actioned.
     */
    public function confirmReferral(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'action' => ['required', 'in:confirmed,rejected'],
            'notes'  => ['nullable', 'string', 'max:500'],
        ]);

        $referral = Referral::with('booking')->findOrFail($id);

        if ($referral->status !== 'pending') {
            return back()->with('error', 'هذه الإحالة ليست في حالة انتظار.');
        }

        $data = ['status' => $request->action];

        if ($request->filled('notes')) {
            $data['notes'] = $request->notes;
        }

        if ($request->action === 'confirmed') {
            $bookingTotal = $referral->booking?->total_price ?? 0;

            $data['commission_amount'] = $bookingTotal > 0
                ? round((float) $bookingTotal * ($referral->commission_rate / 100), 2)
                : null;

            $data['confirmed_by'] = Auth::id();
            $data['confirmed_at'] = now();
        }

        $referral->update($data);

        $message = $request->action === 'confirmed'
            ? 'تم تأكيد الإحالة وحساب العمولة.'
            : 'تم رفض الإحالة.';

        return back()->with('success', $message);
    }

    // =========================================================================
    // FINANCIALS
    // =========================================================================

    /**
     * Show the financial overview dashboard.
     *
     * Displays:
     *   - Monthly revenue & booking counts (last 12 months)
     *   - Booking status distribution (pie/bar chart data)
     *   - Monthly commission totals (last 12 months)
     *   - Summary KPI cards (total revenue, commissions, bookings by status)
     *
     * Heavy query logic is delegated to private helper methods to keep this
     * method focused on assembling the view data.
     */
    public function financials(): View
    {
        [$months, $revenues, $bookingCounts] = $this->buildMonthlyRevenueData();
        $commissions = $this->buildMonthlyCommissionData();
        $statusDist  = $this->buildStatusDistribution();

        $totals = [
            'total_revenue'      => HallBooking::where('status', 'confirmed')->sum('total_price'),
            'total_commissions'  => Referral::whereIn('status', ['confirmed', 'paid'])->sum('commission_amount'),
            'total_bookings'     => HallBooking::count(),
            'confirmed_bookings' => HallBooking::where('status', 'confirmed')->count(),
            'pending_bookings'   => HallBooking::where('status', 'pending')->count(),
            'cancelled_bookings' => HallBooking::where('status', 'cancelled')->count(),
        ];

        return view('supervisor.financials', compact(
            'months', 'revenues', 'bookingCounts', 'statusDist', 'commissions', 'totals'
        ));
    }

    // =========================================================================
    // HALLS
    // =========================================================================

    /**
     * List pending hall requests awaiting supervisor decision.
     */
    public function hallRequests(): View
    {
        $halls = Hall::with('owner')
            ->where('status', HallStatus::Pending)
            ->latest()->paginate(20);

        return view('supervisor.hall-requests', compact('halls'));
    }

    /**
     * List all halls with optional status and name filters.
     *
     * Filters:
     *   - status (query string): active | inactive | pending | under_review | rejected
     *   - search (query string): partial match on hall name
     */
    public function halls(Request $request): View
    {
        $query = Hall::with('owner');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        $halls = $query->latest()->paginate(20);

        return view('supervisor.halls', compact('halls'));
    }

    /**
     * Quickly update a hall's status directly from the halls list.
     *
     * Accepted status values: active, inactive, pending, under_review, rejected.
     */
    public function updateHallStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:active,inactive,pending,under_review,rejected'],
        ]);

        Hall::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة القاعة.');
    }

    /**
     * Show the full hall details page for supervisor review.
     */
    public function reviewHall(int $id): View
    {
        $hall = Hall::with(['owner', 'verificationDocuments'])->findOrFail($id);

        return view('supervisor.review-hall', compact('hall'));
    }

    /**
     * Approve or reject a hall after reviewing its details.
     *
     * On approval  → status is set to "active".
     * On rejection → status is set to "rejected".
     */
    public function decideHall(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'decision' => ['required', 'in:active,rejected'],
            'note'     => ['nullable', 'string', 'max:500'],
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

        $message = $request->decision === 'active'
            ? 'تمت الموافقة على الطلب وأصبحت القاعة نشطة، وتم إشعار المالك بالبريد الإلكتروني.'
            : 'تم رفض طلب القاعة وتم إشعار المالك بالبريد الإلكتروني.';

        return redirect()->route('supervisor.hall-requests')->with('success', $message);
    }

    // =========================================================================
    // BOOKINGS
    // =========================================================================

    /**
     * List all bookings with optional status and hall filters.
     *
     * Filters:
     *   - status (query string): pending | confirmed | cancelled
     *   - hall   (query string): hall ID
     */
    public function bookings(Request $request): View
    {
        $query = HallBooking::with(['hall', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('hall')) {
            $query->where('hall_id', $request->hall);
        }

        $bookings = $query->latest()->paginate(20);
        $halls    = Hall::select('id', 'name')->orderBy('name')->get();

        return view('supervisor.bookings', compact('bookings', 'halls'));
    }

    // =========================================================================
    // DOCUMENT APPROVALS
    // =========================================================================

    /**
     * List all hall verification documents that are pending review.
     */
    public function approvals(): View
    {
        $documents = HallVerificationDocument::with(['hall', 'owner', 'partner', 'officiant'])
            ->where('status', DocumentStatus::Pending)
            ->latest()
            ->paginate(15);

        return view('supervisor.approvals', compact('documents'));
    }

    /**
     * Show the full verification document for detailed review.
     */
    public function reviewDocument(int $id): View
    {
        $document = HallVerificationDocument::with(['hall', 'owner', 'partner', 'officiant'])->findOrFail($id);

        return view('supervisor.review-document', compact('document'));
    }

    /**
     * Approve or reject a hall verification document.
     *
     * On approval  → document status → Approved, linked hall status → Active.
     * On rejection → document status → Rejected only.
     */
    public function processApproval(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'action' => ['required', 'in:approved,rejected'],
            'note'   => ['nullable', 'string', 'max:500'],
        ]);

        $document = HallVerificationDocument::with(['hall', 'partner', 'officiant'])->findOrFail($id);

        $document->update([
            'status' => $request->action === 'approved'
                ? DocumentStatus::Approved
                : DocumentStatus::Rejected,
            'notes'  => $request->note,
        ]);

        $newStatus = $request->action === 'approved' ? 'active' : 'rejected';

        if ($document->hall) {
            $document->hall->update(['status' => $request->action === 'approved' ? HallStatus::Active : HallStatus::Rejected]);
        } elseif ($document->officiant) {
            $document->officiant->update(['status' => $newStatus]);
        } elseif ($document->partner) {
            $document->partner->update(['status' => $newStatus]);
        }

        $message = $request->action === 'approved'
            ? 'تم قبول الوثيقة وتفعيل الحساب.'
            : 'تم رفض الوثيقة.';

        return redirect()->route('supervisor.approvals')->with('success', $message);
    }

    // =========================================================================
    // PARTNERS
    // =========================================================================

    /**
     * List all supervisor partners/categories and show the management page.
     */
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

        return view('supervisor.partners', compact('categories', 'partners'));
    }

    /**
     * Save a new partner category.
     */
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

    /**
     * Delete a partner category (cascades to partners).
     */
    public function deleteCategory(int $id): RedirectResponse
    {
        $category = PartnerCategory::where('supervisor_id', Auth::id())->findOrFail($id);
        $category->delete();

        return back()->with('success', 'تم حذف التصنيف وجميع شركائه بنجاح.');
    }

    /**
     * Save a new supervisor partner.
     */
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

        // Ensure category belongs to this supervisor
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

    /**
     * Delete a supervisor partner.
     */
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

    // =========================================================================
    // PRIVATE HELPERS
    // =========================================================================

    private function buildMonthlyRevenueData(): array
    {
        $rows = HallBooking::selectRaw(
                "DATE_FORMAT(created_at, '%Y-%m') as month,
                 SUM(total_price) as revenue,
                 COUNT(*) as count"
            )
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderBy('month')
            ->get();

        $months = $revenues = $bookingCounts = [];

        for ($i = 11; $i >= 0; $i--) {
            $key  = now()->subMonths($i)->format('Y-m');
            $row  = $rows->firstWhere('month', $key);

            $months[]        = now()->subMonths($i)->translatedFormat('M Y');
            $revenues[]      = $row ? (float) $row->revenue : 0;
            $bookingCounts[] = $row ? (int)   $row->count   : 0;
        }

        return [$months, $revenues, $bookingCounts];
    }

    private function buildMonthlyCommissionData(): array
    {
        $rows = Referral::selectRaw(
                "DATE_FORMAT(confirmed_at, '%Y-%m') as month,
                 SUM(commission_amount) as total"
            )
            ->whereIn('status', ['confirmed', 'paid'])
            ->where('confirmed_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupByRaw("DATE_FORMAT(confirmed_at, '%Y-%m')")
            ->orderBy('month')
            ->get();

        $commissions = [];

        for ($i = 11; $i >= 0; $i--) {
            $key  = now()->subMonths($i)->format('Y-m');
            $row  = $rows->firstWhere('month', $key);

            $commissions[] = $row ? (float) $row->total : 0;
        }

        return $commissions;
    }

    private function buildStatusDistribution()
    {
        return HallBooking::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(fn($row) => [$row->status->value => $row->total]);
    }

    // ── Orders (cart orders) ──────────────────────────────────────────────────

    public function orders(Request $request): View
    {
        $status = $request->query('status');
        $query  = Order::with(['user', 'items'])->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('supervisor.orders.index', compact('orders', 'status'));
    }

    public function approveOrder(Request $request, Order $order): RedirectResponse
    {
        $order->update([
            'status'      => 'confirmed',
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return back()->with('success', 'تم تأكيد الطلب #' . $order->order_number);
    }

    public function rejectOrder(Request $request, Order $order): RedirectResponse
    {
        $order->update([
            'status'      => 'rejected',
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return back()->with('success', 'تم رفض الطلب #' . $order->order_number);
    }
}
