<?php

namespace App\Http\Controllers\Agent;

use App\Enums\HallStatus;
use App\Enums\OccasionType;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\AgentRefCode;
use App\Models\Hall;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $agent   = Auth::user();
        $refCode = AgentRefCode::where('agent_id', $agent->id)->first();

        $stats = [
            'total'     => Referral::where('agent_id', $agent->id)->count(),
            'pending'   => Referral::where('agent_id', $agent->id)->where('status', 'pending')->count(),
            'confirmed' => Referral::where('agent_id', $agent->id)->where('status', 'confirmed')->count(),
            'earned'    => Referral::where('agent_id', $agent->id)
                              ->whereIn('status', ['confirmed', 'paid'])
                              ->sum('commission_amount'),
        ];

        $recentReferrals = Referral::with(['user', 'hall'])
            ->where('agent_id', $agent->id)
            ->latest()
            ->take(5)
            ->get();

        return view('agent.dashboard', compact('agent', 'refCode', 'stats', 'recentReferrals'));
    }

    public function createHallOwner(): View
    {
        return view('agent.register-hall-owner');
    }

    public function referrals(Request $request): View
    {
        $agent = Auth::user();

        $query = Referral::with(['user', 'hall'])
            ->where('agent_id', $agent->id);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $referrals = $query->latest()->paginate(15);

        $halls = Hall::select('id', 'name')->orderBy('name')->get();

        return view('agent.referrals', compact('referrals', 'halls'));
    }

    public function storeHallOwner(Request $request): RedirectResponse
    {
        $request->validate([
            'owner_name'      => 'required|string|max:100',
            'owner_phone'     => 'required|string|max:20',
            'owner_email'     => 'required|email|unique:users,email',
            'owner_password'  => 'required|string|min:8|max:100',
            'name'            => 'required|string|max:100',
            'description'     => 'nullable|string',
            'location'        => 'required|string|max:200',
            'city'            => 'required|string|max:100',
            'capacity'        => 'required|integer|min:1',
            'max_tables'      => 'required|integer|min:1',
            'price_per_day'   => 'required|numeric|min:0',
            'whatsapp_number' => 'nullable|string|max:20',
            'profile_photo'   => 'nullable|image|max:2048',
            'cover_photo'     => 'nullable|image|max:2048',
        ]);

        $agent = Auth::user();

        DB::transaction(function () use ($request, $agent): void {
            $owner = User::create([
                'name'              => $request->owner_name,
                'phone'             => $request->owner_phone,
                'email'             => $request->owner_email,
                'role'              => UserRole::Owner,
                'password'          => Hash::make($request->owner_password),
                'email_verified_at' => now(),
            ]);

            $data = $request->only([
                'name',
                'description',
                'location',
                'city',
                'capacity',
                'max_tables',
                'price_per_day',
                'whatsapp_number',
            ]);

            $data['owner_id'] = $owner->id;
            $data['registered_by'] = $agent->id;
            $data['registration_commission_rate'] = 10;
            $data['status'] = HallStatus::Pending;

            if ($request->hasFile('profile_photo')) {
                $data['profile_photo'] = $request->file('profile_photo')->store('halls/photos', 'public');
            }

            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $request->file('cover_photo')->store('halls/covers', 'public');
            }

            Hall::create($data);
        });

        return back()->with('success', 'تم تسجيل مالك القاعة وإنشاء القاعة بنجاح. الطلب بانتظار المراجعة والتفعيل.');
    }

    public function halls(Request $request): View
    {
        $halls = Hall::where('status', HallStatus::Active)
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
            })
            ->orderBy('name')
            ->paginate(12);

        return view('agent.halls', compact('halls'));
    }
}
