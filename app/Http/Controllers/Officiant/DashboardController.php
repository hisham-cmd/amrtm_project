<?php

namespace App\Http\Controllers\Officiant;

use App\Http\Controllers\Controller;
use App\Models\Officiant;
use App\Models\OfficiantBooking;
use App\Models\OfficiantMedia;
use App\Models\OfficiantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private function profile(): ?Officiant
    {
        return Auth::user()->officiantProfile;
    }

    // ── Dashboard home ────────────────────────────────────────────────────

    public function index(): View
    {
        $profile        = $this->profile();
        $services       = $profile?->services ?? collect();
        $media          = $profile?->media ?? collect();
        $recentBookings = $profile
            ? $profile->bookings()->with(['user', 'service'])->take(5)->get()
            : collect();
        $pendingCount   = $profile?->bookings()->where('status', 'pending')->count() ?? 0;

        return view('officiant.dashboard', compact('profile', 'services', 'media', 'recentBookings', 'pendingCount'));
    }

    // ── Profile setup / edit ──────────────────────────────────────────────

    public function profileSetup(): View
    {
        return view('officiant.profile-setup', ['profile' => $this->profile()]);
    }

    public function saveProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'license_number' => ['required', 'string', 'max:60'],
            'working_hours'  => ['nullable', 'string', 'max:100'],
            'country'        => ['nullable', 'string', 'max:100'],
            'city'           => ['nullable', 'string', 'max:100'],
            'neighborhood'   => ['nullable', 'string', 'max:100'],
            'street'         => ['nullable', 'string', 'max:150'],
            'address'        => ['nullable', 'string', 'max:255'],
            'bio'            => ['nullable', 'string', 'max:1000'],
            'phone'          => ['nullable', 'string', 'max:20'],
            'bank_account'   => ['nullable', 'string', 'max:60'],
            'iban'           => ['nullable', 'string', 'max:34'],
            'profile_photo'  => ['nullable', 'image', 'max:2048'],
            'cover_photo'    => ['nullable', 'image', 'max:4096'],
        ]);

        $profile = $this->profile();
        abort_if(! $profile, 403);

        $data = $request->only(['license_number', 'working_hours', 'country', 'city', 'neighborhood', 'street', 'address', 'bio', 'phone', 'bank_account', 'iban']);

        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('officiants/photos', 'public');
        }

        if ($request->hasFile('cover_photo')) {
            if ($profile->cover_photo) {
                Storage::disk('public')->delete($profile->cover_photo);
            }
            $data['cover_photo'] = $request->file('cover_photo')->store('officiants/covers', 'public');
        }

        $profile->fill($data)->save();

        return redirect()->route('officiant.dashboard')->with('success', 'تم حفظ بيانات البروفايل بنجاح.');
    }

    // ── Pending / Rejected pages ──────────────────────────────────────────

    public function applicationPending(): View
    {
        return view('officiant.application-pending', ['profile' => $this->profile()]);
    }

    public function applicationRejected(): View
    {
        return view('officiant.application-rejected', ['profile' => $this->profile()]);
    }

    // ── Media (gallery) ───────────────────────────────────────────────────

    public function media(): View
    {
        $profile = $this->profile();
        $media   = $profile?->media ?? collect();
        return view('officiant.media', compact('profile', 'media'));
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
            $path = $image->store('officiants/media', 'public');
            OfficiantMedia::create([
                'officiant_id' => $profile->id,
                'file_path'    => $path,
                'sort_order'   => $profile->media()->count(),
            ]);
        }

        return back()->with('success', 'تم رفع الصور بنجاح.');
    }

    public function deleteMedia(OfficiantMedia $media): RedirectResponse
    {
        abort_if($media->officiant_id !== $this->profile()?->id, 403);
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return back()->with('success', 'تم حذف الصورة.');
    }

    // ── Services ──────────────────────────────────────────────────────────

    public function services(): View
    {
        $profile  = $this->profile();
        $services = $profile?->services ?? collect();
        return view('officiant.services', compact('profile', 'services'));
    }

    public function storeService(Request $request): RedirectResponse
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'price'       => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
        ]);

        $profile = $this->profile();
        abort_if(! $profile, 403);

        OfficiantService::create([
            'officiant_id' => $profile->id,
            'title'        => $request->title,
            'description'  => $request->description,
            'price'        => $request->price,
            'sort_order'   => $profile->services()->count(),
        ]);

        return back()->with('success', 'تمت إضافة الخدمة.');
    }

    public function deleteService(OfficiantService $service): RedirectResponse
    {
        abort_if($service->officiant_id !== $this->profile()?->id, 403);
        $service->delete();

        return back()->with('success', 'تم حذف الخدمة.');
    }

    // ── Bookings ──────────────────────────────────────────────────────────

    public function bookings(): View
    {
        $profile  = $this->profile();
        $bookings = $profile
            ? $profile->bookings()->with(['user', 'service'])->paginate(15)
            : collect();

        return view('officiant.bookings', compact('profile', 'bookings'));
    }

    public function updateBookingStatus(Request $request, OfficiantBooking $booking): RedirectResponse
    {
        abort_if($booking->officiant_id !== $this->profile()?->id, 403);

        $request->validate(['status' => ['required', 'in:pending,confirmed,cancelled']]);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطلب.');
    }
}
