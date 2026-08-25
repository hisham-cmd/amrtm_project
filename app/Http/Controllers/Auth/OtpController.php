<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class OtpController extends Controller
{
    // ── Generate & send ───────────────────────────────────────────────────────

    public static function generateAndSend(User $user): void
    {
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put("otp_code:{$user->id}", $code, now()->addMinutes(10));

        try {
            Http::withToken(config('services.resend.key'))
                ->post('https://api.resend.com/emails', [
                    'from'    => config('mail.from.address'),
                    'to'      => [$user->email],
                    'subject' => 'كود التحقق — منصة أمر تم',
                    'html'    => view('mail.otp-verification', ['user' => $user, 'code' => $code])->render(),
                ]);
        } catch (\Throwable) {
            // فشل الإرسال يُسجَّل في laravel.log — العملية لا تتوقف
        }
    }

    // ── Show OTP form ─────────────────────────────────────────────────────────

    public function show(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('otp_pending_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.verify-otp');
    }

    // ── Verify code ───────────────────────────────────────────────────────────

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'يرجى إدخال كود التحقق.',
            'code.digits'   => 'الكود يجب أن يكون 6 أرقام.',
        ]);

        $userId = $request->session()->get('otp_pending_user_id');

        if (! $userId) {
            return redirect()->route('login')->withErrors(['code' => 'انتهت الجلسة، يرجى تسجيل الدخول مجدداً.']);
        }

        $cached = Cache::get("otp_code:{$userId}");

        if (! $cached || $request->code !== $cached) {
            return back()->withErrors(['code' => 'الكود غير صحيح أو انتهت صلاحيته.'])->withInput();
        }

        // كود صحيح — تنظيف وتسجيل الدخول
        Cache::forget("otp_code:{$userId}");
        Cache::forget("otp_resend_lock:{$userId}");

        $request->session()->forget('otp_pending_user_id');

        $remember = $request->session()->pull('otp_remember', false);
        $user     = User::findOrFail($userId);

        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended($this->defaultRedirect($user->role)->getTargetUrl());
    }

    // ── Resend code ───────────────────────────────────────────────────────────

    public function resend(Request $request): RedirectResponse
    {
        $userId = $request->session()->get('otp_pending_user_id');

        if (! $userId) {
            return redirect()->route('login');
        }

        if (Cache::has("otp_resend_lock:{$userId}")) {
            return back()->with('resend_error', 'يرجى الانتظار دقيقتين قبل إعادة الإرسال.');
        }

        $user = User::findOrFail($userId);
        static::generateAndSend($user);

        Cache::put("otp_resend_lock:{$userId}", true, now()->addMinutes(2));

        return back()->with('resend_success', 'تم إرسال كود جديد إلى بريدك الإلكتروني.');
    }

    // ── Helper ────────────────────────────────────────────────────────────────

    private function defaultRedirect(UserRole $role): RedirectResponse
    {
        return match($role) {
            UserRole::Supervisor => redirect()->route('supervisor.dashboard'),
            UserRole::Manager    => redirect()->route('manager.dashboard'),
            UserRole::Agent      => redirect()->route('agent.dashboard'),
            UserRole::Owner      => redirect()->route('owner.dashboard'),
            UserRole::Partner    => redirect()->route('partner.dashboard'),
            UserRole::Officiant  => redirect()->route('officiant.dashboard'),
            UserRole::User       => redirect()->route('halls.list'),
        };
    }
}
