<?php
namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Mail\CadresApplicationReceived;
use App\Models\Jobs\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CadresApplicationController extends Controller
{
    public function create()
    {
        return view('jobs.cadres.apply');
    }

    public function store(Request $request)
    {
        $request->validate([
            // ── خطوة 1 ──
            'first_name'       => 'required|string|max:80',
            'last_name'        => 'required|string|max:80',
            'birth_date'       => 'required|date|before:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'gender'           => 'required|in:male,female',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email|max:150',
            'nationality'      => 'required|string|max:80',

            // ── خطوة 2 ──
            'passport_number'  => 'required|string|max:50',
            'passport_expiry'  => 'required|date|after:today',
            'passport_country' => 'required|string|max:80',

            // ── خطوة 3 ──
            'photo'            => 'required|image|mimes:jpg,jpeg,png|max:3072',
            'cv'               => 'required|file|mimes:pdf,doc,docx|max:5120',
            'certificate'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'education_level'  => 'required|in:high_school,diploma,bachelor,master,phd,other',
            'specialization'   => 'nullable|string|max:120',

            // ── خطوة 4 ──
            'origin_country'     => 'required|string|max:80',
            'target_countries'   => 'required|array|min:1',
            'target_countries.*' => 'string|max:80',
            'job_title_desired'  => 'required|string|max:120',
            'desired_job_type'   => 'required|in:full_time,part_time,remote,freelance',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0',
            'notes'              => 'nullable|string|max:1000',
        ], [
            'first_name.required'      => 'الاسم الأول مطلوب',
            'last_name.required'       => 'الاسم الأخير مطلوب',
            'birth_date.required'      => 'تاريخ الميلاد مطلوب',
            'birth_date.before'        => 'يجب أن يكون عمرك 18 سنة أو أكثر',
            'gender.required'          => 'الجنس مطلوب',
            'phone.required'           => 'رقم الجوال مطلوب',
            'email.required'           => 'البريد الإلكتروني مطلوب',
            'email.email'              => 'البريد الإلكتروني غير صحيح',
            'nationality.required'     => 'الجنسية مطلوبة',
            'passport_number.required' => 'رقم الجواز مطلوب',
            'passport_expiry.required' => 'تاريخ انتهاء الجواز مطلوب',
            'passport_expiry.after'    => 'يجب أن يكون الجواز سارياً',
            'passport_country.required'=> 'دولة إصدار الجواز مطلوبة',
            'photo.required'           => 'الصورة الشخصية مطلوبة',
            'photo.image'              => 'يجب أن تكون صورة صحيحة',
            'photo.max'                => 'حجم الصورة يجب ألا يتجاوز 3 ميجا',
            'cv.required'              => 'السيرة الذاتية مطلوبة',
            'cv.mimes'                 => 'يجب أن تكون السيرة الذاتية PDF أو Word',
            'cv.max'                   => 'حجم الملف يجب ألا يتجاوز 5 ميجا',
            'education_level.required' => 'المستوى التعليمي مطلوب',
            'origin_country.required'  => 'دولة الإقامة مطلوبة',
            'target_countries.required'=> 'اختر دولة واحدة على الأقل',
            'target_countries.min'     => 'اختر دولة واحدة على الأقل',
            'job_title_desired.required' => 'المسمى الوظيفي مطلوب',
            'desired_job_type.required'=> 'نوع الدوام مطلوب',
        ]);

        $data = $request->only([
            'first_name', 'last_name', 'birth_date', 'gender', 'phone', 'email', 'nationality',
            'passport_number', 'passport_expiry', 'passport_country',
            'education_level', 'specialization',
            'origin_country', 'target_countries', 'job_title_desired', 'desired_job_type',
            'expected_salary_min', 'expected_salary_max', 'notes',
        ]);

        // رفع الملفات
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('cadres/photos', 'public');
        }
        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cadres/cvs', 'public');
        }
        if ($request->hasFile('certificate')) {
            $data['certificate'] = $request->file('certificate')->store('cadres/certificates', 'public');
        }

        $data['application_type'] = 'cadres';
        $data['status']           = 'pending';
        $data['job_seeker_id']    = auth()->user()?->jobSeeker?->id;
        $data['job_id']           = null;

        $application = Application::create($data);

        try {
            Mail::to($application->email)->send(new CadresApplicationReceived($application));
        } catch (\Throwable) {
            // الإرسال الفاشل لا يوقف العملية — يُسجَّل في laravel.log
        }

        return redirect()->route('jobs.cadres.success');
    }

    public function success()
    {
        return view('jobs.cadres.success');
    }
}
