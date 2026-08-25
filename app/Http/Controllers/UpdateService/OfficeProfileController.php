<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Models\Business\Office;
use App\Models\Business\OfficeProfile;
use App\Models\Business\Specialty;
use App\Models\Business\OfficeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OfficeProfileController extends Controller
{
    /**
     * =========================================================================
     * صفحة استكمال بيانات المكتب
     * =========================================================================
     */
    public function show(?string $token = null)
    {
        /*
        |--------------------------------------------------------------------------
        | تحديد المكتب
        |--------------------------------------------------------------------------
        */

        if ($token) {

            // الدخول من الرابط العام
            $office = Office::where('public_token', $token)->first();

            if (!$office) {
                abort(404, 'رابط المكتب غير صحيح أو منتهي.');
            }

        } else {

            // الدخول من حساب المكتب
            $user = Auth::guard('office')->user();

            if (!$user) {
                return redirect()->route('amrtm.login');
            }

            $office = $user->office;

            if (!$office) {
                abort(404, 'المكتب غير موجود.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        $profile = $office->profile;

        /*
        |--------------------------------------------------------------------------
        | التخصصات الخاصة بنوع المكتب
        |--------------------------------------------------------------------------
        */

        $specialties = DB::connection('business')
            ->table('bs_specialties')
            ->where('office_type', $office->type)
            ->where('is_active', 1)
            ->orderBy('name_ar')
            ->get([
                'id',
                'name_ar',
                'name_en',
            ]);

        /*
        |--------------------------------------------------------------------------
        | عرض الصفحة
        |--------------------------------------------------------------------------
        */

        return view(
            'update_service.provider-register',
            compact(
                'office',
                'profile',
                'specialties'
            )
        );
    }


    /**
     * =========================================================================
     * حفظ بيانات المكتب
     * =========================================================================
     */
    public function save(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | المستخدم الحالي
        |--------------------------------------------------------------------------
        */

        $user = Auth::guard('office')->user();

        if (!$user) {
            return redirect()->route('amrtm.login');
        }

        /*
        |--------------------------------------------------------------------------
        | المكتب
        |--------------------------------------------------------------------------
        */

        $office = $user->office;

        if (!$office) {
            abort(404, 'المكتب غير موجود.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | بيانات المكتب
            |--------------------------------------------------------------------------
            */

            'office_name_ar' => [
                'required',
                'string',
                'max:191',
            ],

            'office_name_en' => [
                'required',
                'string',
                'max:191',
            ],

            'type' => [
                'required',
                'in:law,services,customs,accounting,engineering,freelance',
            ],

            'phone' => [
                'required',
                'string',
                'max:191',
            ],

            'email' => [
                'required',
                'email',
                'max:191',
            ],

            /*
            |--------------------------------------------------------------------------
            | العنوان
            |--------------------------------------------------------------------------
            */

            'country' => [
                'required',
                'string',
                'max:191',
            ],

            'governorate' => [
                'required',
                'string',
                'max:191',
            ],

            'city' => [
                'required',
                'string',
                'max:191',
            ],

            'district' => [
                'required',
                'string',
                'max:191',
            ],

            'street' => [
                'required',
                'string',
                'max:191',
            ],

            'building_number' => [
                'required',
                'string',
                'max:191',
            ],

            'office_number' => [
                'nullable',
                'string',
                'max:191',
            ],

            /*
            |--------------------------------------------------------------------------
            | السجل التجاري
            |--------------------------------------------------------------------------
            */

            'cr_number' => [
                'required',
                'string',
                'max:191',
            ],

            /*
            |--------------------------------------------------------------------------
            | الترخيص
            |--------------------------------------------------------------------------
            */

            'license_number' => [
                'required',
                'string',
                'max:191',
            ],

            /*
            |--------------------------------------------------------------------------
            | العلامة التجارية
            |--------------------------------------------------------------------------
            */

            'trademark_registration_number' => [
                'nullable',
                'string',
                'max:80',
            ],

            /*
            |--------------------------------------------------------------------------
            | التخصص
            |--------------------------------------------------------------------------
            */

            'specialty' => [
                'nullable',
                'string',
                'max:100',
            ],

            'custom_specialty' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | السجل التجاري - ملف
            |--------------------------------------------------------------------------
            |
            | مهم:
            | استخدمنا extensions بدل mimes
            |
            */

            'commercial_register_image' => [
                'required',
                'file',
                'extensions:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | الترخيص - ملف
            |--------------------------------------------------------------------------
            */

            'license_image' => [
                'required',
                'file',
                'extensions:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | شهادة العلامة التجارية
            |--------------------------------------------------------------------------
            */

            'logo' => [
                'nullable',
                'file',
                'extensions:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | الشهادات العملية
            |--------------------------------------------------------------------------
            */

            'certificates' => [
                'nullable',
                'array',
            ],

            'certificates.*' => [
                'file',
                'extensions:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | شهادات التقدير
            |--------------------------------------------------------------------------
            */

            'appreciation_certificates' => [
                'nullable',
                'array',
            ],

            'appreciation_certificates.*' => [
                'file',
                'extensions:jpg,jpeg,png,pdf',
                'max:5120',
            ],

            /*
            |--------------------------------------------------------------------------
            | السيرة الذاتية
            |--------------------------------------------------------------------------
            */

            'cv' => [
                'required',
                'file',
                'extensions:pdf,doc,docx',
                'max:5120',
            ],

        ], [

            /*
            |--------------------------------------------------------------------------
            | بيانات المكتب
            |--------------------------------------------------------------------------
            */

            'office_name_ar.required' =>
                'اسم المكتب بالعربية مطلوب.',

            'office_name_en.required' =>
                'اسم المكتب بالإنجليزية مطلوب.',

            'type.required' =>
                'نوع المكتب مطلوب.',

            'type.in' =>
                'نوع المكتب غير صحيح.',

            'phone.required' =>
                'رقم الجوال مطلوب.',

            'email.required' =>
                'البريد الإلكتروني مطلوب.',

            'email.email' =>
                'البريد الإلكتروني غير صحيح.',

            /*
            |--------------------------------------------------------------------------
            | العنوان
            |--------------------------------------------------------------------------
            */

            'country.required' =>
                'الدولة مطلوبة.',

            'governorate.required' =>
                'المنطقة مطلوبة.',

            'city.required' =>
                'المدينة مطلوبة.',

            'district.required' =>
                'الحي مطلوب.',

            'street.required' =>
                'الشارع مطلوب.',

            'building_number.required' =>
                'رقم المبنى مطلوب.',

            /*
            |--------------------------------------------------------------------------
            | الأرقام
            |--------------------------------------------------------------------------
            */

            'cr_number.required' =>
                'رقم السجل التجاري مطلوب.',

            'license_number.required' =>
                'رقم الترخيص مطلوب.',

            /*
            |--------------------------------------------------------------------------
            | السجل التجاري
            |--------------------------------------------------------------------------
            */

            'commercial_register_image.required' =>
                'إرفاق السجل التجاري مطلوب.',

            'commercial_register_image.file' =>
                'ملف السجل التجاري غير صالح.',

            'commercial_register_image.extensions' =>
                'السجل التجاري يجب أن يكون JPG أو JPEG أو PNG أو PDF.',

            'commercial_register_image.max' =>
                'حجم السجل التجاري يجب ألا يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | الترخيص
            |--------------------------------------------------------------------------
            */

            'license_image.required' =>
                'إرفاق ترخيص المزاولة المهنية مطلوب.',

            'license_image.file' =>
                'ملف الترخيص غير صالح.',

            'license_image.extensions' =>
                'ملف الترخيص يجب أن يكون JPG أو JPEG أو PNG أو PDF.',

            'license_image.max' =>
                'حجم ملف الترخيص يجب ألا يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | العلامة التجارية
            |--------------------------------------------------------------------------
            */

            'logo.file' =>
                'ملف شهادة تسجيل العلامة التجارية غير صالح.',

            'logo.extensions' =>
                'شهادة تسجيل العلامة التجارية يجب أن تكون JPG أو JPEG أو PNG أو PDF.',

            'logo.max' =>
                'حجم شهادة تسجيل العلامة التجارية يجب ألا يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | الشهادات
            |--------------------------------------------------------------------------
            */

            'certificates.array' =>
                'صيغة الشهادات العملية غير صحيحة.',

            'certificates.*.file' =>
                'أحد ملفات الشهادات العملية غير صالح.',

            'certificates.*.extensions' =>
                'الشهادة العملية يجب أن تكون JPG أو JPEG أو PNG أو PDF.',

            'certificates.*.max' =>
                'حجم أحد ملفات الشهادات العملية يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | شهادات التقدير
            |--------------------------------------------------------------------------
            */

            'appreciation_certificates.array' =>
                'صيغة شهادات التقدير غير صحيحة.',

            'appreciation_certificates.*.file' =>
                'أحد ملفات شهادات التقدير غير صالح.',

            'appreciation_certificates.*.extensions' =>
                'شهادة التقدير يجب أن تكون JPG أو JPEG أو PNG أو PDF.',

            'appreciation_certificates.*.max' =>
                'حجم شهادة التقدير يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | CV
            |--------------------------------------------------------------------------
            */

            'cv.required' =>
                'السيرة الذاتية مطلوبة.',

            'cv.file' =>
                'ملف السيرة الذاتية غير صالح.',

            'cv.extensions' =>
                'السيرة الذاتية يجب أن تكون PDF أو DOC أو DOCX.',

            'cv.max' =>
                'حجم السيرة الذاتية يجب ألا يتجاوز 5MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | التخصص
        |--------------------------------------------------------------------------
        */

        $selectedSpecialty = $validated['specialty'] ?? null;

        $customSpecialty = trim(
            $validated['custom_specialty'] ?? ''
        );


        /*
        |--------------------------------------------------------------------------
        | ممنوع اختيار تخصص وكتابة تخصص يدوي معًا
        |--------------------------------------------------------------------------
        */

        if (
            $selectedSpecialty &&
            $selectedSpecialty !== 'other' &&
            $customSpecialty !== ''
        ) {

            return back()
                ->withErrors([
                    'specialty' =>
                        'اختر تخصصًا من القائمة أو اكتب تخصصًا آخر، وليس الاثنين معًا.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | التحقق من التخصص
        |--------------------------------------------------------------------------
        */

        $specialtyId = null;


        if (
            $selectedSpecialty &&
            $selectedSpecialty !== 'other'
        ) {

            $specialtyExists = DB::connection('business')
                ->table('bs_specialties')
                ->where('id', $selectedSpecialty)
                ->where('office_type', $validated['type'])
                ->where('is_active', 1)
                ->exists();


            if (!$specialtyExists) {

                return back()
                    ->withErrors([
                        'specialty' =>
                            'التخصص المختار غير متاح لنوع المكتب المحدد.'
                    ])
                    ->withInput();
            }


            $specialtyId = (int) $selectedSpecialty;

            $customSpecialty = null;
        }


        /*
        |--------------------------------------------------------------------------
        | التخصص الآخر
        |--------------------------------------------------------------------------
        */

        if ($selectedSpecialty === 'other') {

            if ($customSpecialty === '') {

                return back()
                    ->withErrors([
                        'custom_specialty' =>
                            'اكتب التخصص الذي تمارسه.'
                    ])
                    ->withInput();
            }

            $selectedSpecialty = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        try {

            DB::connection('business')->transaction(
                function () use (
                    $office,
                    $validated,
                    $request,
                    $specialtyId,
                    $customSpecialty
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | تحديث Office
                    |--------------------------------------------------------------------------
                    */

                    $office->name_ar =
                        $validated['office_name_ar'];

                    $office->name_en =
                        $validated['office_name_en'];

                    $office->type =
                        $validated['type'];

                    $office->phone =
                        $validated['phone'];

                    $office->email =
                        $validated['email'];

                    $office->city =
                        $validated['city'];

                    $office->cr_number =
                        $validated['cr_number'];

                    $office->save();


                    /*
                    |--------------------------------------------------------------------------
                    | Profile
                    |--------------------------------------------------------------------------
                    */

                    $profile = OfficeProfile::firstOrNew([
                        'office_id' => $office->id,
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | إنشاء Office Code
                    |--------------------------------------------------------------------------
                    */

                    if (empty($profile->office_code)) {

                        do {

                            $officeCode =
                                'OFF-' .
                                strtoupper(
                                    Str::random(10)
                                );

                        } while (
                            DB::connection('business')
                                ->table('bs_office_profiles')
                                ->where(
                                    'office_code',
                                    $officeCode
                                )
                                ->exists()
                        );


                        $profile->office_code =
                            $officeCode;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | QR Code
                    |--------------------------------------------------------------------------
                    */

                    if (empty($profile->qr_code)) {

                        $profile->qr_code =
                            $profile->office_code;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | البيانات الأساسية
                    |--------------------------------------------------------------------------
                    */

                    $profile->license_number =
                        $validated['license_number'];

                    $profile->cr_number =
                        $validated['cr_number'];

                    $profile->mobile =
                        $validated['phone'];


                    /*
                    |--------------------------------------------------------------------------
                    | العنوان
                    |--------------------------------------------------------------------------
                    */

                    $profile->country =
                        $validated['country'];

                    $profile->governorate =
                        $validated['governorate'];

                    $profile->city =
                        $validated['city'];

                    $profile->district =
                        $validated['district'];

                    $profile->street =
                        $validated['street'];

                    $profile->building_number =
                        $validated['building_number'];

                    $profile->office_number =
                        $validated['office_number'] ?? null;


                    /*
                    |--------------------------------------------------------------------------
                    | العلامة التجارية
                    |--------------------------------------------------------------------------
                    */

                    $profile->trademark_registration_number =
                        $validated[
                            'trademark_registration_number'
                        ] ?? null;


                    /*
                    |--------------------------------------------------------------------------
                    | التخصص اليدوي
                    |--------------------------------------------------------------------------
                    */

                    $profile->custom_specialty =
                        $customSpecialty !== ''
                            ? $customSpecialty
                            : null;


                    /*
                    |--------------------------------------------------------------------------
                    | الوصف
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !isset(
                            $profile->description_ar
                        )
                    ) {

                        $profile->description_ar =
                            null;
                    }

                    if (
                        !isset(
                            $profile->description_en
                        )
                    ) {

                        $profile->description_en =
                            null;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | مهم جدًا
                    |--------------------------------------------------------------------------
                    | handled_cases في قاعدة البيانات:
                    |
                    | INT UNSIGNED
                    | NOT NULL
                    | DEFAULT 0
                    |
                    | لذلك لا نضع null
                    |--------------------------------------------------------------------------
                    */

                    if (
                        is_null(
                            $profile->handled_cases
                        )
                    ) {

                        $profile->handled_cases = 0;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | حالة Profile
                    |--------------------------------------------------------------------------
                    */

                    $profile->profile_completed =
                        true;

                    $profile->verification_status =
                        'pending';

                    $profile->submitted_at =
                        now();

                    $profile->approved_at =
                        null;


                    /*
                    |--------------------------------------------------------------------------
                    | حفظ Profile
                    |--------------------------------------------------------------------------
                    */

                    $profile->save();


                    /*
                    |--------------------------------------------------------------------------
                    | التخصصات
                    |--------------------------------------------------------------------------
                    */

                    if ($specialtyId) {

                        DB::connection('business')
                            ->table('bs_office_specialties')
                            ->where(
                                'office_id',
                                $office->id
                            )
                            ->delete();


                        DB::connection('business')
                            ->table('bs_office_specialties')
                            ->insert([

                                'office_id' =>
                                    $office->id,

                                'specialty_id' =>
                                    $specialtyId,

                                'created_at' =>
                                    now(),

                                'updated_at' =>
                                    now(),

                            ]);

                    } else {

                        DB::connection('business')
                            ->table('bs_office_specialties')
                            ->where(
                                'office_id',
                                $office->id
                            )
                            ->delete();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | الملفات الأساسية
                    |--------------------------------------------------------------------------
                    */

                    $documents = [

                        'commercial_register_image' =>
                            'commercial_register',

                        'license_image' =>
                            'license',

                        'logo' =>
                            'trademark_certificate',

                        'cv' =>
                            'cv',
                    ];


                    foreach (
                        $documents as
                        $inputName => $documentType
                    ) {

                        if (
                            !$request->hasFile(
                                $inputName
                            )
                        ) {
                            continue;
                        }


                        $uploadedFile =
                            $request->file(
                                $inputName
                            );


                        if (
                            !$uploadedFile ||
                            !$uploadedFile->isValid()
                        ) {
                            continue;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | مسار الملف
                        |--------------------------------------------------------------------------
                        */

                        $path =
                            $uploadedFile->store(
                                'office_documents/' .
                                $office->id .
                                '/' .
                                $documentType,
                                'public'
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | حفظ المستند
                        |--------------------------------------------------------------------------
                        */

                        OfficeDocument::create([

                            'office_id' =>
                                $office->id,

                            'document_type' =>
                                $documentType,

                            'file' =>
                                $path,

                            'file_name' =>
                                $uploadedFile
                                    ->getClientOriginalName(),

                            'is_verified' =>
                                false,

                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | الشهادات العملية
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $request->hasFile(
                            'certificates'
                        )
                    ) {

                        foreach (
                            $request->file(
                                'certificates'
                            ) as $uploadedFile
                        ) {

                            if (
                                !$uploadedFile ||
                                !$uploadedFile->isValid()
                            ) {
                                continue;
                            }


                            $path =
                                $uploadedFile->store(
                                    'office_documents/' .
                                    $office->id .
                                    '/certificates',
                                    'public'
                                );


                            OfficeDocument::create([

                                'office_id' =>
                                    $office->id,

                                'document_type' =>
                                    'professional_certificate',

                                'file' =>
                                    $path,

                                'file_name' =>
                                    $uploadedFile
                                        ->getClientOriginalName(),

                                'is_verified' =>
                                    false,

                            ]);
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | شهادات التقدير
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $request->hasFile(
                            'appreciation_certificates'
                        )
                    ) {

                        foreach (
                            $request->file(
                                'appreciation_certificates'
                            ) as $uploadedFile
                        ) {

                            if (
                                !$uploadedFile ||
                                !$uploadedFile->isValid()
                            ) {
                                continue;
                            }


                            $path =
                                $uploadedFile->store(
                                    'office_documents/' .
                                    $office->id .
                                    '/appreciation',
                                    'public'
                                );


                            OfficeDocument::create([

                                'office_id' =>
                                    $office->id,

                                'document_type' =>
                                    'appreciation_certificate',

                                'file' =>
                                    $path,

                                'file_name' =>
                                    $uploadedFile
                                        ->getClientOriginalName(),

                                'is_verified' =>
                                    false,

                            ]);
                        }
                    }
                }
            );


        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | تسجيل الخطأ الحقيقي
            |--------------------------------------------------------------------------
            */

            report($e);


            return back()
                ->withErrors([

                    'save' =>
                        'حدث خطأ أثناء حفظ بيانات المكتب: ' .
                        $e->getMessage(),

                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | النجاح
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('amrtm.office.complete')
            ->with(
                'success',
                'تم حفظ بيانات المكتب وإرسالها للمراجعة بنجاح.'
            );
    }


    /**
     * =========================================================================
     * إرسال المكتب للمراجعة
     * =========================================================================
     */
    public function submit()
    {
        /*
        |--------------------------------------------------------------------------
        | المستخدم
        |--------------------------------------------------------------------------
        */

        $user = Auth::guard('office')->user();

        if (!$user) {

            return redirect()
                ->route('amrtm.login');
        }


        /*
        |--------------------------------------------------------------------------
        | المكتب
        |--------------------------------------------------------------------------
        */

        $office = $user->office;

        if (!$office) {

            abort(
                404,
                'المكتب غير موجود.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        $profile = $office->profile;


        if (!$profile) {

            return redirect()
                ->route(
                    'amrtm.office.complete'
                )
                ->withErrors([

                    'profile' =>
                        'يجب استكمال بيانات المكتب أولاً.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | التأكد أن البيانات مكتملة
        |--------------------------------------------------------------------------
        */

        if (!$profile->profile_completed) {

            return redirect()
                ->route(
                    'amrtm.office.complete'
                )
                ->withErrors([

                    'profile' =>
                        'يجب استكمال جميع البيانات المطلوبة أولاً.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Office Code
        |--------------------------------------------------------------------------
        */

        if (empty($profile->office_code)) {

            return redirect()
                ->route(
                    'amrtm.office.complete'
                )
                ->withErrors([

                    'profile' =>
                        'لم يتم إنشاء كود المكتب.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | QR Code
        |--------------------------------------------------------------------------
        */

        if (empty($profile->qr_code)) {

            $profile->qr_code =
                $profile->office_code;

            $profile->save();
        }


        /*
        |--------------------------------------------------------------------------
        | إذا كان قيد المراجعة
        |--------------------------------------------------------------------------
        */

        if (
            $profile->verification_status ===
            'pending'
        ) {

            return redirect()
                ->route(
                    'amrtm.office.complete'
                )
                ->with(
                    'info',
                    'بيانات المكتب قيد المراجعة بالفعل.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | إذا كان معتمد
        |--------------------------------------------------------------------------
        */

        if (
            $profile->verification_status ===
            'approved'
        ) {

            return redirect()
                ->route(
                    'amrtm.office.dashboard'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | إرسال للمراجعة
        |--------------------------------------------------------------------------
        */

        $profile->update([

            'verification_status' =>
                'pending',

            'submitted_at' =>
                now(),

            'approved_at' =>
                null,

            'handled_cases' =>
                $profile->handled_cases ?? 0,

        ]);


        /*
        |--------------------------------------------------------------------------
        | النجاح
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'amrtm.office.complete'
            )
            ->with(
                'success',
                'تم إرسال بيانات المكتب للمراجعة بنجاح.'
            );
    }


    /**
     * =========================================================================
     * الملف العام للمكتب
     * =========================================================================
     */
    public function publicProfile($token)
    {
        /*
        |--------------------------------------------------------------------------
        | المكتب
        |--------------------------------------------------------------------------
        */

        $office = Office::where(
                'public_token',
                $token
            )
            ->where(
                'is_verified',
                true
            )
            ->where(
                'is_active',
                true
            )
            ->with([
                'profile',
                'documents',
                'specialtiesRelation',
                'services',
            ])
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | الصفحة
        |--------------------------------------------------------------------------
        */

        return view(
            'office.public',
            compact('office')
        );
    }
}