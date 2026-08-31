<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Models\Business\Office;
use App\Models\Business\OfficeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProviderAccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | صفحة التسجيل
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('update_service.provider-account');
    }


    /*
    |--------------------------------------------------------------------------
    | جلب التخصصات حسب نوع المكتب
    |--------------------------------------------------------------------------
    */

    public function specialties(Request $request)
    {
        $request->validate([
            'office_type' => [
                'required',
                'in:law,services,customs,accounting,engineering,freelance',
            ],
        ]);

        $specialties = DB::connection('business')
            ->table('bs_specialties')
            ->where('office_type', $request->office_type)
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


    /*
    |--------------------------------------------------------------------------
    | حفظ طلب تسجيل المكتب
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
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

            'name_ar' => [
                'required',
                'string',
                'max:191',
            ],

            'name_en' => [
                'required',
                'string',
                'max:191',
            ],

            'manager_name' => [
                'required',
                'string',
                'max:191',
            ],

            'office_type' => [
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
                'unique:business.bs_offices,email',
                'unique:business.bs_office_users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
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
            | أرقام المستندات
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | التخصص
            |--------------------------------------------------------------------------
            */

            'specialty' => [
                'required',
            ],

            'manual_specialty' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | الملفات
            |--------------------------------------------------------------------------
            */

            'commercial_register_image' => [
                'required',
                'file',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:5120',
            ],

            'license_image' => [
                'required',
                'file',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:5120',
            ],

            'trademark_certificate' => [
                'nullable',
                'file',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:5120',
            ],

            'certificates' => [
                'nullable',
                'array',
            ],

            'certificates.*' => [
                'file',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:5120',
            ],

            'appreciation_certificates' => [
                'nullable',
                'array',
            ],

            'appreciation_certificates.*' => [
                'file',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:5120',
            ],

            'cv' => [
                'required',
                'file',
                'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'max:5120',
            ],

        ], [

            /*
            |--------------------------------------------------------------------------
            | بيانات المكتب
            |--------------------------------------------------------------------------
            */

            'name_ar.required' =>
                'اسم المكتب بالعربية مطلوب.',

            'name_en.required' =>
                'اسم المكتب بالإنجليزية مطلوب.',

            'manager_name.required' =>
                'اسم مدير المكتب مطلوب.',

            'office_type.required' =>
                'نوع المكتب مطلوب.',

            'office_type.in' =>
                'نوع المكتب غير صحيح.',

            'phone.required' =>
                'رقم الجوال مطلوب.',

            'email.required' =>
                'البريد الإلكتروني مطلوب.',

            'email.email' =>
                'البريد الإلكتروني غير صحيح.',

            'email.unique' =>
                'هذا البريد الإلكتروني مسجل مسبقاً.',

            'password.required' =>
                'كلمة المرور مطلوبة.',

            'password.min' =>
                'كلمة المرور يجب أن تكون 8 أحرف على الأقل.',

            'password.confirmed' =>
                'تأكيد كلمة المرور غير مطابق.',

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
                'رقم ترخيص المزاولة المهنية مطلوب.',

            /*
            |--------------------------------------------------------------------------
            | التخصص
            |--------------------------------------------------------------------------
            */

            'specialty.required' =>
                'يرجى اختيار التخصص.',

            /*
            |--------------------------------------------------------------------------
            | السجل التجاري
            |--------------------------------------------------------------------------
            */

            'commercial_register_image.required' =>
                'ملف السجل التجاري مطلوب.',

            'commercial_register_image.file' =>
                'ملف السجل التجاري غير صالح.',

            'commercial_register_image.mimetypes' =>
                'يجب أن يكون السجل التجاري ملفاً من نوع JPG أو JPEG أو PNG أو PDF.',

            'commercial_register_image.max' =>
                'حجم ملف السجل التجاري يجب ألا يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | الترخيص
            |--------------------------------------------------------------------------
            */

            'license_image.required' =>
                'ملف الترخيص مطلوب.',

            'license_image.file' =>
                'ملف الترخيص غير صالح.',

            'license_image.mimetypes' =>
                'يجب أن يكون الترخيص ملفاً من نوع JPG أو JPEG أو PNG أو PDF.',

            'license_image.max' =>
                'حجم ملف الترخيص يجب ألا يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | العلامة التجارية
            |--------------------------------------------------------------------------
            */

            'trademark_certificate.file' =>
                'ملف شهادة العلامة التجارية غير صالح.',

            'trademark_certificate.mimetypes' =>
                'يجب أن تكون شهادة العلامة التجارية JPG أو JPEG أو PNG أو PDF.',

            'trademark_certificate.max' =>
                'حجم شهادة العلامة التجارية يجب ألا يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | الشهادات العملية
            |--------------------------------------------------------------------------
            */

            'certificates.array' =>
                'صيغة الشهادات العملية غير صحيحة.',

            'certificates.*.file' =>
                'أحد ملفات الشهادات العملية غير صالح.',

            'certificates.*.mimetypes' =>
                'يجب أن تكون الشهادات العملية JPG أو JPEG أو PNG أو PDF.',

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

            'appreciation_certificates.*.mimetypes' =>
                'يجب أن تكون شهادات التقدير JPG أو JPEG أو PNG أو PDF.',

            'appreciation_certificates.*.max' =>
                'حجم أحد ملفات شهادات التقدير يتجاوز 5MB.',

            /*
            |--------------------------------------------------------------------------
            | CV
            |--------------------------------------------------------------------------
            */

            'cv.required' =>
                'السيرة الذاتية مطلوبة.',

            'cv.file' =>
                'ملف السيرة الذاتية غير صالح.',

            'cv.mimetypes' =>
                'السيرة الذاتية يجب أن تكون PDF أو DOC أو DOCX.',

            'cv.max' =>
                'حجم السيرة الذاتية يجب ألا يتجاوز 5MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | التأكد من التخصص اليدوي
        |--------------------------------------------------------------------------
        */

        if (
            $request->specialty === 'other' &&
            !trim((string) $request->manual_specialty)
        ) {

            return back()
                ->withErrors([
                    'manual_specialty' =>
                        'يرجى كتابة التخصص اليدوي.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | التأكد من التخصص الموجود في قاعدة البيانات
        |--------------------------------------------------------------------------
        */

        $specialtyId = null;

        if ($request->specialty !== 'other') {

            $specialtyId = DB::connection('business')
                ->table('bs_specialties')
                ->where('id', $request->specialty)
                ->where('office_type', $request->office_type)
                ->where('is_active', 1)
                ->value('id');

            if (!$specialtyId) {

                return back()
                    ->withErrors([
                        'specialty' =>
                            'التخصص المحدد غير متاح لنوع المكتب المختار.'
                    ])
                    ->withInput();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | الملفات التي تم حفظها
        |--------------------------------------------------------------------------
        */

        $storedFiles = [];

        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        $connection = DB::connection('business');

        try {

            $connection->beginTransaction();


            /*
            |--------------------------------------------------------------------------
            | إنشاء المكتب
            |--------------------------------------------------------------------------
            */

            $office = Office::create([

                'type' =>
                    $request->office_type,

                'name_ar' =>
                    $request->name_ar,

                'name_en' =>
                    $request->name_en,

                'description_ar' =>
                    null,

                'description_en' =>
                    null,

                'phone' =>
                    $request->phone,

                'email' =>
                    $request->email,

                'city' =>
                    $request->city,

                'cr_number' =>
                    $request->cr_number,

                'logo' =>
                    null,

                'specialties' =>
                    null,

                'is_active' =>
                    1,

                'is_verified' =>
                    0,

                'commission_rate' =>
                    0.00,

                'public_token' =>
                    Str::random(40),

                'created_at' =>
                    now(),

                'updated_at' =>
                    now(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | كود المكتب
            |--------------------------------------------------------------------------
            */

            $officeCode =
                'OFF-' .
                str_pad(
                    (string) $office->id,
                    6,
                    '0',
                    STR_PAD_LEFT
                );


            $office->office_code = $officeCode;

            $office->save();


            /*
            |--------------------------------------------------------------------------
            | إنشاء مستخدم المكتب
            |--------------------------------------------------------------------------
            */

            $user = OfficeUser::create([

                'office_id' =>
                    $office->id,

                'name' =>
                    $request->manager_name,

                'email' =>
                    $request->email,

                'password' =>
                    Hash::make($request->password),

                'role' =>
                    'owner',

                'is_active' =>
                    1,

            ]);


            /*
            |--------------------------------------------------------------------------
            | إنشاء Profile المكتب
            |--------------------------------------------------------------------------
            */

            $connection
                ->table('bs_office_profiles')
                ->insert([

                    'office_id' =>
                        $office->id,

                    'license_number' =>
                        $request->license_number,

                    'cr_number' =>
                        $request->cr_number,

                    'mobile' =>
                        $request->phone,

                    'country' =>
                        $request->country,

                    'governorate' =>
                        $request->governorate,

                    'city' =>
                        $request->city,

                    'district' =>
                        $request->district,

                    'street' =>
                        $request->street,

                    'building_number' =>
                        $request->building_number,

                    'office_number' =>
                        $request->office_number,

                    'description_ar' =>
                        null,

                    'description_en' =>
                        null,

                    /*
                    |--------------------------------------------------------------------------
                    | مهم جداً
                    |--------------------------------------------------------------------------
                    | الحقل NOT NULL
                    */

                    'handled_cases' =>
                        0,

                    'custom_specialty' =>
                        $request->specialty === 'other'
                            ? trim($request->manual_specialty)
                            : null,

                    'profile_completed' =>
                        0,

                    'verification_status' =>
                        'pending',

                    'submitted_at' =>
                        now(),

                    'approved_at' =>
                        null,

                    'office_code' =>
                        $officeCode,

                    'qr_code' =>
                        null,

                    'trademark_registration_number' =>
                        $request->trademark_registration_number,

                    'created_at' =>
                        now(),

                    'updated_at' =>
                        now(),

                ]);


            /*
            |--------------------------------------------------------------------------
            | حفظ التخصص
            |--------------------------------------------------------------------------
            */

            if ($specialtyId) {

                $connection
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
            }


            /*
            |--------------------------------------------------------------------------
            | دالة مساعدة لحفظ المستند
            |--------------------------------------------------------------------------
            */

            $saveDocument = function (
                $file,
                string $documentType,
                string $folder
            ) use (
                $office,
                $connection,
                &$storedFiles
            ) {

                if (!$file || !$file->isValid()) {
                    return;
                }

                $path = $file->store(
                    'office-documents/' .
                    $office->id .
                    '/' .
                    $folder,
                    'public'
                );

                $storedFiles[] = $path;

                $connection
                    ->table('bs_office_documents')
                    ->insert([

                        'office_id' =>
                            $office->id,

                        'document_type' =>
                            $documentType,

                        'file' =>
                            $path,

                        'file_name' =>
                            $file->getClientOriginalName(),

                        'is_verified' =>
                            0,

                        'created_at' =>
                            now(),

                        'updated_at' =>
                            now(),

                    ]);
            };


            /*
            |--------------------------------------------------------------------------
            | السجل التجاري
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('commercial_register_image')) {

                $saveDocument(
                    $request->file('commercial_register_image'),
                    'commercial_register',
                    'commercial-register'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | الترخيص
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('license_image')) {

                $saveDocument(
                    $request->file('license_image'),
                    'license',
                    'license'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | شهادة العلامة التجارية
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('trademark_certificate')) {

                $saveDocument(
                    $request->file('trademark_certificate'),
                    'trademark_certificate',
                    'trademark'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | الشهادات العملية
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('certificates')) {

                foreach (
                    $request->file('certificates')
                    as $file
                ) {

                    $saveDocument(
                        $file,
                        'certificate',
                        'certificates'
                    );
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
                    )
                    as $file
                ) {

                    $saveDocument(
                        $file,
                        'appreciation_certificate',
                        'appreciation-certificates'
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | السيرة الذاتية
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('cv')) {

                $saveDocument(
                    $request->file('cv'),
                    'cv',
                    'cv'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Commit
            |--------------------------------------------------------------------------
            */

            $connection->commit();


            /*
            |--------------------------------------------------------------------------
            | نجاح العملية
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('amrtm.provider.account.create')
                ->with(
                    'success',
                    'تم إرسال طلب تسجيل المكتب بنجاح، وسيتم مراجعته من الإدارة.'
                );


        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Rollback
            |--------------------------------------------------------------------------
            */

            if ($connection->transactionLevel() > 0) {
                $connection->rollBack();
            }


            /*
            |--------------------------------------------------------------------------
            | حذف الملفات المرفوعة
            |--------------------------------------------------------------------------
            */

            foreach ($storedFiles as $path) {

                try {

                    Storage::disk('public')
                        ->delete($path);

                } catch (\Throwable $deleteException) {

                    Log::warning(
                        'Failed to delete uploaded file',
                        [
                            'path' =>
                                $path,

                            'error' =>
                                $deleteException->getMessage(),
                        ]
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | تسجيل الخطأ الحقيقي في Laravel Log
            |--------------------------------------------------------------------------
            */

            Log::error(
                'Provider office registration failed',
                [
                    'message' =>
                        $e->getMessage(),

                    'file' =>
                        $e->getFile(),

                    'line' =>
                        $e->getLine(),

                    'office_type' =>
                        $request->office_type,

                    'email' =>
                        $request->email,
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | إظهار الخطأ الحقيقي مؤقتاً
            |--------------------------------------------------------------------------
            |
            | بعد ما نتأكد أن كل شيء يعمل، نرجع الرسالة العامة.
            |
            */

            return back()
                ->withErrors([
                    'registration' =>
                        'الخطأ الحقيقي: ' .
                        $e->getMessage(),
                ])
                ->withInput();
        }
    }
}