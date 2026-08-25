<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\BsOffice;
use App\Models\BsOfficeProfile;
use App\Models\BsSpecialty;
use App\Models\BsOfficeSpecialty;

class ProviderAccountController extends Controller
{
    /**
     * =========================================================================
     * صفحة تسجيل / استكمال بيانات المكتب
     * =========================================================================
     */
    public function create(Request $request)
    {
        $office = null;
        $profile = null;
        $specialties = collect();

        /*
        |--------------------------------------------------------------------------
        | لو عندنا email في الرابط
        |--------------------------------------------------------------------------
        */

        if ($request->filled('email')) {

            $office = BsOffice::where(
                'email',
                $request->email
            )->first();

            if ($office) {

                $profile = BsOfficeProfile::where(
                    'office_id',
                    $office->id
                )->first();

                $specialties = BsSpecialty::where(
                    'office_type',
                    $office->type
                )
                ->where('is_active', 1)
                ->orderBy('name_ar')
                ->get([
                    'id',
                    'name_ar',
                    'name_en',
                ]);
            }
        }

        return view(
            'provider.account.create',
            compact(
                'office',
                'profile',
                'specialties'
            )
        );
    }


    /**
     * =========================================================================
     * تحميل التخصصات حسب نوع المكتب
     * =========================================================================
     */
    public function specialties(Request $request)
    {
        $validated = $request->validate([
            'office_type' => [
                'required',
                'string',
            ],
        ]);

        $specialties = BsSpecialty::query()
            ->where(
                'office_type',
                $validated['office_type']
            )
            ->where('is_active', 1)
            ->orderBy('name_ar')
            ->get([
                'id',
                'name_ar',
                'name_en',
            ]);

        return response()->json([
            'success' => true,
            'specialties' => $specialties,
        ]);
    }


    /**
     * =========================================================================
     * حفظ طلب تسجيل المكتب
     * =========================================================================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'office_type' => [
                'required',
                'string',
                'in:law,services,customs,accounting,engineering,freelance',
            ],

            'name_ar' => [
                'required',
                'string',
                'max:191',
            ],

            'name_en' => [
                'nullable',
                'string',
                'max:191',
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

            'mobile' => [
                'nullable',
                'string',
                'max:191',
            ],

            'country' => [
                'nullable',
                'string',
                'max:191',
            ],

            'governorate' => [
                'nullable',
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

            'description_ar' => [
                'nullable',
                'string',
            ],

            'description_en' => [
                'nullable',
                'string',
            ],

            'cr_number' => [
                'required',
                'string',
                'max:191',
            ],

            'license_number' => [
                'required',
                'string',
                'max:191',
            ],

            'trademark_registration_number' => [
                'nullable',
                'string',
                'max:80',
            ],

            'specialty' => [
                'required',
            ],

            'manual_specialty' => [
                'nullable',
                'string',
                'max:191',
            ],

            'commercial_register_image' => [
                'required',
                'file',
                'max:20480',
            ],

            'license_image' => [
                'required',
                'file',
                'max:20480',
            ],

            'trademark_certificate' => [
                'nullable',
                'file',
                'max:20480',
            ],

            'certificates' => [
                'nullable',
                'array',
            ],

            'certificates.*' => [
                'file',
                'max:20480',
            ],

            'appreciation_certificates' => [
                'nullable',
                'array',
            ],

            'appreciation_certificates.*' => [
                'file',
                'max:20480',
            ],

            'cv' => [
                'nullable',
                'file',
                'max:20480',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | التخصص اليدوي
        |--------------------------------------------------------------------------
        */

        if (
            $validated['specialty'] === 'other' &&
            !trim($validated['manual_specialty'] ?? '')
        ) {

            return back()
                ->withErrors([
                    'manual_specialty' =>
                        'يرجى كتابة التخصص الذي تمارسه حاليًا.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | التخصص المعتمد
        |--------------------------------------------------------------------------
        */

        $specialty = null;

        if ($validated['specialty'] !== 'other') {

            $specialty = BsSpecialty::query()
                ->where(
                    'id',
                    $validated['specialty']
                )
                ->where(
                    'office_type',
                    $validated['office_type']
                )
                ->where('is_active', 1)
                ->first();

            if (!$specialty) {

                return back()
                    ->withErrors([
                        'specialty' =>
                            'التخصص المختار غير متاح لنوع المنشأة المحدد.',
                    ])
                    ->withInput();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | العلامة التجارية
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $validated['trademark_registration_number']
            )
            &&
            !$request->hasFile(
                'trademark_certificate'
            )
        ) {

            return back()
                ->withErrors([
                    'trademark_certificate' =>
                        'يجب إرفاق شهادة تسجيل العلامة التجارية عند إدخال رقم العلامة التجارية.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | البحث عن مكتب موجود بنفس البريد
            |--------------------------------------------------------------------------
            */

            $office = BsOffice::where(
                'email',
                $validated['email']
            )->first();


            /*
            |--------------------------------------------------------------------------
            | تحديد هل المكتب جديد
            |--------------------------------------------------------------------------
            */

            $isNewOffice = !$office;


            /*
            |--------------------------------------------------------------------------
            | لو المكتب موجود ومعتمد
            |--------------------------------------------------------------------------
            */

            if (
                $office &&
                (
                    (int) $office->is_verified === 1 ||
                    (int) $office->is_active === 1
                )
            ) {

                DB::rollBack();

                return back()
                    ->withErrors([
                        'email' =>
                            'هذا البريد الإلكتروني مرتبط بمكتب مسجل ومعتمد بالفعل.',
                    ])
                    ->withInput();
            }


            /*
            |--------------------------------------------------------------------------
            | إنشاء المكتب لو مش موجود
            |--------------------------------------------------------------------------
            */

            if (!$office) {

                $office = BsOffice::create([

                    'type' =>
                        $validated['office_type'],

                    'name_ar' =>
                        $validated['name_ar'],

                    'name_en' =>
                        $validated['name_en'] ?? null,

                    'phone' =>
                        $validated['phone'],

                    'email' =>
                        $validated['email'],

                    'city' =>
                        $validated['city'],

                    'cr_number' =>
                        $validated['cr_number'],

                    'is_active' =>
                        0,

                    'is_verified' =>
                        0,

                    'commission_rate' =>
                        0,

                    'public_token' =>
                        Str::random(64),
                ]);


                /*
                |--------------------------------------------------------------------------
                | Office Code
                |--------------------------------------------------------------------------
                */

                $officeCode =
                    'OFF-' .
                    str_pad(
                        $office->id,
                        6,
                        '0',
                        STR_PAD_LEFT
                    );


                $office->update([
                    'office_code' => $officeCode,
                ]);

            } else {

                /*
                |--------------------------------------------------------------------------
                | المكتب موجود - تحديث البيانات
                |--------------------------------------------------------------------------
                */

                $office->update([

                    'type' =>
                        $validated['office_type'],

                    'name_ar' =>
                        $validated['name_ar'],

                    'name_en' =>
                        $validated['name_en'] ?? null,

                    'phone' =>
                        $validated['phone'],

                    'city' =>
                        $validated['city'],

                    'cr_number' =>
                        $validated['cr_number'],

                    'is_active' =>
                        0,

                    'is_verified' =>
                        0,

                ]);


                /*
                |--------------------------------------------------------------------------
                | Office Code
                |--------------------------------------------------------------------------
                */

                $officeCode =
                    $office->office_code;

                if (!$officeCode) {

                    $officeCode =
                        'OFF-' .
                        str_pad(
                            $office->id,
                            6,
                            '0',
                            STR_PAD_LEFT
                        );

                    $office->update([
                        'office_code' => $officeCode,
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Profile
            |--------------------------------------------------------------------------
            */

            $profile =
                BsOfficeProfile::firstOrNew([
                    'office_id' =>
                        $office->id,
                ]);


            $profile->license_number =
                $validated['license_number'];

            $profile->cr_number =
                $validated['cr_number'];

            $profile->mobile =
                $validated['mobile'] ?? null;

            $profile->country =
                $validated['country'] ?? null;

            $profile->governorate =
                $validated['governorate'] ?? null;

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

            $profile->description_ar =
                $validated['description_ar'] ?? null;

            $profile->description_en =
                $validated['description_en'] ?? null;

            $profile->handled_cases =
                $profile->handled_cases ?? 0;

            $profile->custom_specialty =
                $validated['specialty'] === 'other'
                    ? trim(
                        $validated['manual_specialty'] ?? ''
                    )
                    : null;

            $profile->profile_completed =
                1;

            $profile->verification_status =
                'pending';

            $profile->submitted_at =
                now();

            $profile->approved_at =
                null;

            $profile->office_code =
                $officeCode;

            $profile->trademark_registration_number =
                $validated[
                    'trademark_registration_number'
                ] ?? null;


            /*
            |--------------------------------------------------------------------------
            | QR Code
            |--------------------------------------------------------------------------
            */

            if (!$profile->qr_code) {

                $profile->qr_code =
                    $officeCode;
            }


            $profile->save();


            /*
            |--------------------------------------------------------------------------
            | حذف التخصص القديم
            |--------------------------------------------------------------------------
            */

            BsOfficeSpecialty::where(
                'office_id',
                $office->id
            )->delete();


            /*
            |--------------------------------------------------------------------------
            | إضافة التخصص الجديد
            |--------------------------------------------------------------------------
            */

            if ($specialty) {

                BsOfficeSpecialty::create([

                    'office_id' =>
                        $office->id,

                    'specialty_id' =>
                        $specialty->id,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | رفع الملفات
            |--------------------------------------------------------------------------
            */

            $this->uploadDocuments(
                $request,
                $office->id
            );


            /*
            |--------------------------------------------------------------------------
            | Commit
            |--------------------------------------------------------------------------
            */

            DB::commit();


            /*
            |--------------------------------------------------------------------------
            | حفظ بيانات للعرض في الصفحة
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'amrtm.provider.account.create',
                    [
                        'email' =>
                            $office->email,
                    ]
                )
                ->with(
                    'success',
                    $isNewOffice
                        ? 'تم تسجيل المكتب بنجاح وإرسال البيانات للمراجعة.'
                        : 'تم تحديث بيانات المكتب وإرسالها للمراجعة بنجاح.'
                );


        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

            return back()
                ->withErrors([
                    'general' =>
                        'حدث خطأ أثناء حفظ البيانات: ' .
                        $e->getMessage(),
                ])
                ->withInput();
        }
    }


    /**
     * =========================================================================
     * رفع مستندات المكتب
     * =========================================================================
     */
    private function uploadDocuments(
        Request $request,
        int $officeId
    ) {

        $basePath =
            'offices/' .
            $officeId;


        /*
        |--------------------------------------------------------------------------
        | المستندات الأساسية
        |--------------------------------------------------------------------------
        */

        $documents = [

            'commercial_register_image' =>
                [
                    'type' => 'commercial_register',
                    'folder' => 'commercial-register',
                ],

            'license_image' =>
                [
                    'type' => 'license',
                    'folder' => 'license',
                ],

            'trademark_certificate' =>
                [
                    'type' => 'trademark',
                    'folder' => 'trademark',
                ],

            'cv' =>
                [
                    'type' => 'cv',
                    'folder' => 'cv',
                ],
        ];


        foreach ($documents as $input => $data) {

            if (!$request->hasFile($input)) {
                continue;
            }

            $file = $request->file($input);

            if (!$file || !$file->isValid()) {
                continue;
            }

            $path = $file->store(
                $basePath . '/' . $data['folder'],
                'public'
            );

            DB::table(
                'bs_office_documents'
            )->insert([

                'office_id' =>
                    $officeId,

                'document_type' =>
                    $data['type'],

                'file_path' =>
                    $path,

                'created_at' =>
                    now(),

                'updated_at' =>
                    now(),
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
                ) as $file
            ) {

                if (
                    !$file ||
                    !$file->isValid()
                ) {
                    continue;
                }

                $path = $file->store(
                    $basePath . '/certificates',
                    'public'
                );

                DB::table(
                    'bs_office_documents'
                )->insert([

                    'office_id' =>
                        $officeId,

                    'document_type' =>
                        'certificate',

                    'file_path' =>
                        $path,

                    'created_at' =>
                        now(),

                    'updated_at' =>
                        now(),
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
                ) as $file
            ) {

                if (
                    !$file ||
                    !$file->isValid()
                ) {
                    continue;
                }

                $path = $file->store(
                    $basePath . '/appreciation',
                    'public'
                );

                DB::table(
                    'bs_office_documents'
                )->insert([

                    'office_id' =>
                        $officeId,

                    'document_type' =>
                        'appreciation',

                    'file_path' =>
                        $path,

                    'created_at' =>
                        now(),

                    'updated_at' =>
                        now(),
                ]);
            }
        }
    }
}