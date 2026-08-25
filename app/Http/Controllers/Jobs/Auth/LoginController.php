<?php

namespace App\Http\Controllers\Jobs\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('jobs.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('jobs')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('jobs')->user();

            if ($user->user_type === 'company') {
                return redirect('/jobs/company/dashboard')->with('success', 'مرحبا بك');
            } else {
                return redirect('/jobs/job-seeker/dashboard')->with('success', 'مرحبا بك');
            }
        }

        return back()->withErrors([
            'email' => 'بيانات المرور غير صحيحة',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('jobs')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/jobs')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
