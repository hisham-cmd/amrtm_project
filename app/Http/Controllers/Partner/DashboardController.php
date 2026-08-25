<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\PartnerMedia;
use App\Models\PartnerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private function profile(): ?Partner
    {
        return Auth::user()->partnerProfile;
    }

    // ── Dashboard home ────────────────────────────────────────────────────

    public function index(): View
    {
        $profile  = $this->profile();
        $services = $profile?->services ?? collect();
        $media    = $profile?->media ?? collect();

        return view('partner.dashboard', compact('profile', 'services', 'media'));
    }

    // ── Profile setup / edit ──────────────────────────────────────────────

    public function profileSetup(): View
    {
        $profile    = $this->profile();
        $categories = PartnerCategory::orderBy('name')->get();
        return view('partner.profile-setup', compact('profile', 'categories'));
    }

    public function saveProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:150'],
            'category_id'  => ['nullable', 'exists:partner_categories,id'],
            'description'  => ['nullable', 'string', 'max:1000'],
            'city'         => ['required', 'string', 'max:100'],
            'address'      => ['nullable', 'string', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:20'],
            'whatsapp'     => ['nullable', 'string', 'max:20'],
            'website'      => ['nullable', 'url', 'max:255'],
            'logo'         => ['nullable', 'image', 'max:2048'],
            'cover'        => ['nullable', 'image', 'max:2048'],
        ]);

        $profile = $this->profile() ?? new Partner(['user_id' => Auth::id(), 'status' => 'pending']);

        $data = $request->only([
            'company_name', 'category_id', 'description',
            'city', 'address', 'phone', 'whatsapp', 'website',
        ]);

        if ($request->hasFile('logo')) {
            if ($profile->logo_path) {
                Storage::disk('public')->delete($profile->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('partners/logos', 'public');
        }

        if ($request->hasFile('cover')) {
            if ($profile->cover_path) {
                Storage::disk('public')->delete($profile->cover_path);
            }
            $data['cover_path'] = $request->file('cover')->store('partners/covers', 'public');
        }

        $profile->fill($data)->save();

        return redirect()->route('partner.dashboard')->with('success', 'تم حفظ بيانات بروفايلك بنجاح.');
    }

    // ── Pending / Rejected pages ──────────────────────────────────────────

    public function applicationPending(): View
    {
        return view('partner.application-pending', ['profile' => $this->profile()]);
    }

    public function applicationRejected(): View
    {
        return view('partner.application-rejected', ['profile' => $this->profile()]);
    }

    // ── Media (gallery) ───────────────────────────────────────────────────

    public function media(): \Illuminate\View\View
    {
        $profile = $this->profile();
        $media   = $profile?->media ?? collect();
        return view('partner.media', compact('profile', 'media'));
    }

    public function uploadMedia(Request $request): RedirectResponse
    {
        $request->validate([
            'images'   => ['required', 'array', 'max:10'],
            'images.*' => ['image', 'max:3072'],
        ]);

        $profile = $this->profile();
        abort_if(! $profile, 403);

        foreach ($request->file('images') as $image) {
            $path = $image->store('partners/media', 'public');
            PartnerMedia::create([
                'partner_id' => $profile->id,
                'file_path'  => $path,
                'sort_order' => $profile->media()->count(),
            ]);
        }

        return back()->with('success', 'تم رفع الصور بنجاح.');
    }

    public function deleteMedia(PartnerMedia $media): RedirectResponse
    {
        abort_if($media->partner_id !== $this->profile()?->id, 403);
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return back()->with('success', 'تم حذف الصورة.');
    }

    // ── Services ──────────────────────────────────────────────────────────

    public function services(): \Illuminate\View\View
    {
        $profile  = $this->profile();
        $services = $profile?->services ?? collect();
        return view('partner.services', compact('profile', 'services'));
    }

    public function storeService(Request $request): RedirectResponse
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'price'       => ['nullable', 'string', 'max:100'],
        ]);

        $profile = $this->profile();
        abort_if(! $profile, 403);

        PartnerService::create([
            'partner_id'  => $profile->id,
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'sort_order'  => $profile->services()->count(),
        ]);

        return back()->with('success', 'تمت إضافة الخدمة.');
    }

    public function deleteService(PartnerService $service): RedirectResponse
    {
        abort_if($service->partner_id !== $this->profile()?->id, 403);
        $service->delete();

        return back()->with('success', 'تم حذف الخدمة.');
    }
}
