<?php

namespace App\Http\Controllers\Supervisor;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /**
     * Determine route prefix based on authenticated user's role.
     * Supports both supervisor and manager.
     */
    private function routePrefix(): string
    {
        $role = auth()->user()?->role?->value ?? 'supervisor';
        return match ($role) {
            'manager' => 'manager.partner-accounts',
            default   => 'supervisor.partner-accounts',
        };
    }

    // ── List all partners ─────────────────────────────────────────────────

    public function index(Request $request): View
    {
        $query = Partner::whereIn('type', ['account', 'officiant'])->with(['user', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $partners     = $query->latest()->paginate(20)->withQueryString();
        $routePrefix  = $this->routePrefix();
        $statusFilter = $request->status;

        return view('supervisor.partners.index', compact('partners', 'routePrefix', 'statusFilter'));
    }

    // ── Create partner account ─────────────────────────────────────────────

    public function create(): View
    {
        $categories  = PartnerCategory::orderBy('name')->get();
        $routePrefix = $this->routePrefix();

        return view('supervisor.partners.create', compact('categories', 'routePrefix'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'         => ['required', 'string', 'max:100'],
            'email'        => ['required', 'email', 'unique:users,email'],
            'phone'        => ['required', 'string', 'max:20'],
            'password'     => ['required', 'string', 'min:8'],
            'company_name' => ['required', 'string', 'max:150'],
            'category_id'  => ['nullable', 'exists:partner_categories,id'],
            'description'  => ['nullable', 'string', 'max:1000'],
            'city'         => ['required', 'string', 'max:100'],
            'address'      => ['nullable', 'string', 'max:255'],
            'phone_biz'    => ['nullable', 'string', 'max:20'],
            'whatsapp'     => ['nullable', 'string', 'max:20'],
            'website'      => ['nullable', 'url', 'max:255'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => UserRole::Partner,
            'password' => Hash::make($request->password),
        ]);

        Partner::create([
            'user_id'      => $user->id,
            'category_id'  => $request->category_id,
            'company_name' => $request->company_name,
            'description'  => $request->description,
            'city'         => $request->city,
            'address'      => $request->address,
            'phone'        => $request->phone_biz ?? $request->phone,
            'whatsapp'     => $request->whatsapp,
            'website'      => $request->website,
            'status'       => 'active',
        ]);

        return redirect()->route($this->routePrefix() . '.index')
            ->with('success', "تم إنشاء حساب الشريك \"{$request->company_name}\" بنجاح.");
    }

    // ── Approve / Reject ──────────────────────────────────────────────────

    public function updateStatus(Request $request, Partner $partner): RedirectResponse
    {
        $request->validate([
            'status'     => ['required', 'in:active,rejected'],
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        $partner->update([
            'status'     => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        $label = $request->status === 'active' ? 'تم قبول' : 'تم رفض';

        return back()->with('success', "{$label} الشريك \"{$partner->company_name}\".");
    }

    // ── Show single partner ───────────────────────────────────────────────

    public function show(Partner $partner): View
    {
        $partner->load(['user', 'category', 'media', 'services', 'verificationDocuments']);
        $categories  = PartnerCategory::orderBy('name')->get();
        $routePrefix = $this->routePrefix();

        return view('supervisor.partners.show', compact('partner', 'categories', 'routePrefix'));
    }

    // ── Delete partner account ─────────────────────────────────────────────

    public function destroy(Partner $partner): RedirectResponse
    {
        $name = $partner->company_name;
        $partner->user()->delete();

        return redirect()->route($this->routePrefix() . '.index')
            ->with('success', "تم حذف الشريك \"{$name}\" بنجاح.");
    }
}
