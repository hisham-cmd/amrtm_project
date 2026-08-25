<?php

namespace App\Http\Controllers\Jobs\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jobs\JobUser;
use App\Models\Jobs\Company;
use App\Models\Jobs\JobSeeker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                   => 'required|string|max:255',
            'email'                  => 'required|string|email|max:255|unique:users',
            'password'               => 'required|string|min:8|confirmed',
            'user_type'              => 'required|in:job_seeker,company',
            'phone'                  => 'required|string|min:10',
            'seeker_type'            => 'required_if:user_type,job_seeker|nullable|in:administrative,professional,leadership',
            'desired_specialization' => 'required_if:user_type,job_seeker|nullable|string|max:255',
            'company_type'           => 'required_if:user_type,company|nullable|in:transfer,employment,leasing,other',
        ], [
            'seeker_type.required_if'            => 'يرجى اختيار نوع الوظيفة المطلوبة.',
            'desired_specialization.required_if' => 'يرجى اختيار التخصص الوظيفي من القائمة.',
            'company_type.required_if'           => 'يرجى اختيار نوع الشركة.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /* ── إنشاء المستخدم الأساسي ── */
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'user_type' => $request->user_type,
            'password'  => Hash::make($request->password),
        ]);

        if ($request->user_type === 'company') {

            Company::create([
                'user_id'          => $user->id,
                'company_name'     => $request->company_name ?? $request->name,
                'company_type'     => $request->company_type,
                'transfer_reasons' => $request->company_type === 'transfer'
                                        ? ($request->transfer_reasons ?? [])
                                        : null,
                'transfer_notes'   => $request->company_type === 'transfer'
                                        ? $request->transfer_notes
                                        : null,
                'location'         => $request->location ?? '',
                'phone'            => $request->phone,
                'hr_contact_name'  => $request->hr_contact_name ?? $request->name,
                'hr_contact_email' => $request->email,
                'is_verified'      => true,
            ]);

        } else {

            JobSeeker::create([
                'user_id'                => $user->id,
                'first_name'             => $request->first_name ?? $request->name,
                'last_name'              => $request->last_name ?? '',
                'seeker_type'            => $request->seeker_type,
                'desired_specialization' => $request->desired_specialization, // ← الجديد
                'phone'                  => $request->phone,
                'location'               => $request->location ?? '',
            ]);

        }

        auth()->login($user);

        return redirect(
            $request->user_type === 'company'
                ? '/company/dashboard'
                : '/job-seeker/dashboard'
        )->with('success', 'تم التسجيل بنجاح');
    }
}

