<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
            ])->onlyInput('email');
        }

        // TODO: إعادة تفعيل OTP بعد حل مشكلة الإيميل
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        $default = match($user->role) {
            UserRole::Supervisor => route('supervisor.dashboard'),
            UserRole::Manager    => route('manager.dashboard'),
            UserRole::Agent      => route('agent.dashboard'),
            UserRole::Owner      => route('owner.dashboard'),
            UserRole::Partner    => route('partner.dashboard'),
            UserRole::Officiant  => route('officiant.dashboard'),
            UserRole::User       => route('halls.list'),
        };

        return redirect()->intended($default);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
