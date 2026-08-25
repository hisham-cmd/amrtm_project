```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تسجيل المكتب | منصة آمر تم</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family:
                "Tahoma",
                "Arial",
                sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        .page-wrapper {
            min-height: 100vh;
            padding: 40px 15px;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: auto;
        }

        .page-header {
            background: linear-gradient(
                135deg,
                #0f766e,
                #115e59
            );
            color: #fff;
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .page-header h1 {
            margin: 0 0 10px;
            font-size: 28px;
        }

        .page-header p {
            margin: 0;
            opacity: .9;
            line-height: 1.8;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
            border: 1px solid #e5e7eb;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-number {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #0f766e;
            color: #fff;
            font-weight: bold;
        }

        .section-title h2 {
            margin: 0;
            font-size: 20px;
            color: #134e4a;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
        }

        label span {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 13px 14px;
            font-size: 15px;
            font-family: inherit;
            background: #fff;
            transition: .2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0f766e;
            box-shadow:
                0 0 0 3px rgba(15, 118, 110, .10);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .hint {
            font-size: 12px;
            color: #6b7280;
        }

        .file-box {
            border: 2px dashed #cbd5e1;
            background: #f8fafc;
            padding: 18px;
            border-radius: 12px;
        }

        .file-box input {
            border: 0;
            padding: 0;
            background: transparent;
        }

        .file-list {
            margin-top: 10px;
            font-size: 13px;
            color: #475569;
        }

        .file-list div {
            background: #fff;
            padding: 8px 10px;
            border-radius: 8px;
            margin-bottom: 5px;
            border: 1px solid #e5e7eb;
        }

        .alert {
            padding: 16px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
        }

        .alert ul {
            margin: 0;
            padding-right: 20px;
        }

        .office-status {
            background: #f0fdfa;
            border: 1px solid #99f6e4;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 22px;
        }

        .office-status h3 {
            margin: 0 0 15px;
            color: #115e59;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .status-item {
            background: #fff;
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }

        .status-item small {
            display: block;
            color: #64748b;
            margin-bottom: 5px;
        }

        .status-item strong {
            color: #1e293b;
            word-break: break-word;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #dcfce7;
            color: #166534;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .other-specialty {
            display: none;
            margin-top: 15px;
        }

        .submit-area {
            background: #fff;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
            text-align: center;
        }

        .submit-btn {
            border: 0;
            background: #0f766e;
            color: #fff;
            padding: 15px 45px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
            font-family: inherit;
        }

        .submit-btn:hover {
            background: #115e59;
            transform: translateY(-1px);
        }

        .submit-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        .loading {
            display: none;
            margin-top: 12px;
            color: #0f766e;
            font-size: 14px;
        }

        .required-note {
            margin-top: 12px;
            color: #6b7280;
            font-size: 12px;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 768px) {

            .page-wrapper {
                padding: 20px 10px;
            }

            .card {
                padding: 20px 15px;
            }

            .page-header {
                padding: 22px 18px;
            }

            .page-header h1 {
                font-size: 23px;
            }

            .grid,
            .grid-3,
            .status-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }

            .submit-btn {
                width: 100%;
            }
        }
    </style>
</head>


<body>

<div class="page-wrapper">

    <div class="container">


        {{-- ============================================================= --}}
        {{-- Header --}}
        {{-- ============================================================= --}}

        <div class="page-header">

            <h1>
                {{ $office ? 'استكمال بيانات المكتب' : 'تسجيل مكتب جديد' }}
            </h1>

            <p>
                قم بإدخال بيانات المكتب والمستندات المطلوبة.
                بعد الإرسال سيتم تحويل الطلب إلى الإدارة للمراجعة والاعتماد.
            </p>

        </div>


        {{-- ============================================================= --}}
        {{-- Success --}}
        {{-- ============================================================= --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- ============================================================= --}}
        {{-- Info --}}
        {{-- ============================================================= --}}

        @if(session('info'))

            <div class="alert alert-info">
                {{ session('info') }}
            </div>

        @endif


        {{-- ============================================================= --}}
        {{-- Errors --}}
        {{-- ============================================================= --}}

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    يوجد بعض الأخطاء في البيانات:
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ============================================================= --}}
        {{-- Existing Office --}}
        {{-- ============================================================= --}}

        @if($office)

            <div class="office-status">

                <h3>
                    بيانات المكتب الحالية
                </h3>

                <div class="status-grid">

                    <div class="status-item">

                        <small>
                            كود المكتب
                        </small>

                        <strong>
                            {{ $profile?->office_code ?? $office->office_code ?? '—' }}
                        </strong>

                    </div>


                    <div class="status-item">

                        <small>
                            اسم المكتب
                        </small>

                        <strong>
                            {{ $office->name_ar }}
                        </strong>

                    </div>


                    <div class="status-item">

                        <small>
                            البريد الإلكتروني
                        </small>

                        <strong>
                            {{ $office->email }}
                        </strong>

                    </div>


                    <div class="status-item">

                        <small>
                            رقم الجوال
                        </small>

                        <strong>
                            {{ $profile?->mobile ?? $office->phone ?? '—' }}
                        </strong>

                    </div>


                    <div class="status-item">

                        <small>
                            المدينة
                        </small>

                        <strong>
                            {{ $profile?->city ?? $office->city ?? '—' }}
                        </strong>

                    </div>


                    <div class="status-item">

                        <small>
                            حالة الطلب
                        </small>

                        @if(
                            $profile &&
                            $profile->verification_status === 'pending'
                        )

                            <span class="badge badge-pending">
                                قيد المراجعة
                            </span>

                        @elseif(
                            $profile &&
                            $profile->verification_status === 'approved'
                        )

                            <span class="badge badge-approved">
                                معتمد
                            </span>

                        @elseif(
                            $profile &&
                            $profile->verification_status === 'rejected'
                        )

                            <span class="badge badge-rejected">
                                مرفوض
                            </span>

                        @else

                            <span class="badge badge-pending">
                                غير مكتمل
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @endif


        {{-- ============================================================= --}}
        {{-- Form --}}
        {{-- ============================================================= --}}

        <form
            id="providerForm"
            action="{{ route('amrtm.provider.account.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- ========================================================= --}}
            {{-- 1 - Basic Information --}}
            {{-- ========================================================= --}}

            <div class="card">

                <div class="section-title">

                    <div class="section-number">
                        1
                    </div>

                    <h2>
                        البيانات الأساسية
                    </h2>

                </div>


                <div class="grid">


                    {{-- Office Type --}}

                    <div class="field">

                        <label>
                            نوع المكتب
                            <span>*</span>
                        </label>

                        <select
                            name="office_type"
                            id="office_type"
                            required
                        >

                            <option value="">
                                اختر نوع المكتب
                            </option>

                            <option
                                value="law"
                                {{ old('office_type', $office?->type) === 'law' ? 'selected' : '' }}
                            >
                                مكتب محاماة
                            </option>

                            <option
                                value="services"
                                {{ old('office_type', $office?->type) === 'services' ? 'selected' : '' }}
                            >
                                مكتب خدمات
                            </option>

                            <option
                                value="customs"
                                {{ old('office_type', $office?->type) === 'customs' ? 'selected' : '' }}
                            >
                                مكتب تخليص جمركي
                            </option>

                            <option
                                value="accounting"
                                {{ old('office_type', $office?->type) === 'accounting' ? 'selected' : '' }}
                            >
                                مكتب محاسبة
                            </option>

                            <option
                                value="engineering"
                                {{ old('office_type', $office?->type) === 'engineering' ? 'selected' : '' }}
                            >
                                مكتب هندسي
                            </option>

                            <option
                                value="freelance"
                                {{ old('office_type', $office?->type) === 'freelance' ? 'selected' : '' }}
                            >
                                مكتب عمل حر
                            </option>

                        </select>

                    </div>


                    {{-- Arabic Name --}}

                    <div class="field">

                        <label>
                            اسم المكتب بالعربية
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="name_ar"
                            value="{{ old('name_ar', $office?->name_ar) }}"
                            placeholder="اسم المكتب بالعربية"
                            required
                        >

                    </div>


                    {{-- English Name --}}

                    <div class="field">

                        <label>
                            اسم المكتب بالإنجليزية
                        </label>

                        <input
                            type="text"
                            name="name_en"
                            value="{{ old('name_en', $office?->name_en) }}"
                            placeholder="Office name in English"
                        >

                    </div>


                    {{-- Phone --}}

                    <div class="field">

                        <label>
                            رقم الهاتف
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $office?->phone) }}"
                            placeholder="05xxxxxxxx"
                            required
                        >

                    </div>


                    {{-- Email --}}

                    <div class="field">

                        <label>
                            البريد الإلكتروني
                            <span>*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $office?->email) }}"
                            placeholder="example@email.com"
                            required
                        >

                        <div class="hint">
                            سيتم استخدام البريد للتواصل مع المكتب.
                        </div>

                    </div>


                    {{-- Mobile --}}

                    <div class="field">

                        <label>
                            رقم الجوال
                        </label>

                        <input
                            type="text"
                            name="mobile"
                            value="{{ old('mobile', $profile?->mobile) }}"
                            placeholder="رقم الجوال"
                        >

                    </div>


                    {{-- Description Arabic --}}

                    <div class="field full">

                        <label>
                            وصف المكتب بالعربية
                        </label>

                        <textarea
                            name="description_ar"
                            placeholder="اكتب نبذة عن المكتب والخدمات التي يقدمها..."
                        >{{ old('description_ar', $profile?->description_ar) }}</textarea>

                    </div>


                    {{-- Description English --}}

                    <div class="field full">

                        <label>
                            وصف المكتب بالإنجليزية
                        </label>

                        <textarea
                            name="description_en"
                            placeholder="Office description..."
                        >{{ old('description_en', $profile?->description_en) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- 2 - Address --}}
            {{-- ========================================================= --}}

            <div class="card">

                <div class="section-title">

                    <div class="section-number">
                        2
                    </div>

                    <h2>
                        العنوان
                    </h2>

                </div>


                <div class="grid">


                    <div class="field">

                        <label>
                            الدولة
                        </label>

                        <input
                            type="text"
                            name="country"
                            value="{{ old('country', $profile?->country ?? 'السعودية') }}"
                            placeholder="الدولة"
                        >

                    </div>


                    <div class="field">

                        <label>
                            المنطقة
                        </label>

                        <input
                            type="text"
                            name="governorate"
                            value="{{ old('governorate', $profile?->governorate) }}"
                            placeholder="المنطقة"
                        >

                    </div>


                    <div class="field">

                        <label>
                            المدينة
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="city"
                            value="{{ old('city', $profile?->city ?? $office?->city) }}"
                            placeholder="المدينة"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            الحي
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="district"
                            value="{{ old('district', $profile?->district) }}"
                            placeholder="الحي"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            الشارع
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="street"
                            value="{{ old('street', $profile?->street) }}"
                            placeholder="اسم الشارع"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            رقم المبنى
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="building_number"
                            value="{{ old('building_number', $profile?->building_number) }}"
                            placeholder="رقم المبنى"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            رقم المكتب
                        </label>

                        <input
                            type="text"
                            name="office_number"
                            value="{{ old('office_number', $profile?->office_number) }}"
                            placeholder="رقم المكتب"
                        >

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- 3 - Licenses --}}
            {{-- ========================================================= --}}

            <div class="card">

                <div class="section-title">

                    <div class="section-number">
                        3
                    </div>

                    <h2>
                        السجل التجاري والتراخيص
                    </h2>

                </div>


                <div class="grid">


                    <div class="field">

                        <label>
                            رقم السجل التجاري
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="cr_number"
                            value="{{ old('cr_number', $profile?->cr_number ?? $office?->cr_number) }}"
                            placeholder="رقم السجل التجاري"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            رقم الترخيص
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="license_number"
                            value="{{ old('license_number', $profile?->license_number) }}"
                            placeholder="رقم الترخيص"
                            required
                        >

                    </div>


                    <div class="field">

                        <label>
                            رقم تسجيل العلامة التجارية
                        </label>

                        <input
                            type="text"
                            name="trademark_registration_number"
                            value="{{ old('trademark_registration_number', $profile?->trademark_registration_number) }}"
                            placeholder="رقم تسجيل العلامة التجارية"
                        >

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- 4 - Specialties --}}
            {{-- ========================================================= --}}

            <div class="card">

                <div class="section-title">

                    <div class="section-number">
                        4
                    </div>

                    <h2>
                        التخصص
                    </h2>

                </div>


                <div class="grid">


                    <div class="field full">

                        <label>
                            التخصص
                            <span>*</span>
                        </label>

                        <select
                            name="specialty"
                            id="specialty"
                            required
                        >

                            <option value="">
                                اختر نوع المكتب أولاً
                            </option>

                            @if(isset($specialties))

                                @foreach($specialties as $specialty)

                                    <option
                                        value="{{ $specialty->id }}"
                                        {{ old('specialty', $profile?->custom_specialty ? 'other' : $profile?->specialty_id) == $specialty->id ? 'selected' : '' }}
                                    >
                                        {{ $specialty->name_ar }}

                                        @if($specialty->name_en)
                                            - {{ $specialty->name_en }}
                                        @endif

                                    </option>

                                @endforeach

                            @endif

                            <option
                                value="other"
                                {{ old('specialty', $profile?->custom_specialty ? 'other' : '') === 'other' ? 'selected' : '' }}
                            >
                                أخرى
                            </option>

                        </select>

                    </div>


                    <div
                        class="field full other-specialty"
                        id="otherSpecialtyBox"
                    >

                        <label>
                            اكتب التخصص
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="manual_specialty"
                            id="manual_specialty"
                            value="{{ old('manual_specialty', $profile?->custom_specialty) }}"
                            placeholder="اكتب التخصص الذي تمارسه"
                        >

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- 5 - Documents --}}
            {{-- ========================================================= --}}

            <div class="card">

                <div class="section-title">

                    <div class="section-number">
                        5
                    </div>

                    <h2>
                        المستندات المطلوبة
                    </h2>

                </div>


                <div class="grid">


                    {{-- Commercial Register --}}

                    <div class="field">

                        <label>
                            السجل التجاري
                            <span>*</span>
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="commercial_register_image"
                                id="commercial_register_image"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                            >

                            <div
                                class="file-list"
                                id="commercialRegisterList"
                            ></div>

                        </div>

                        <div class="hint">
                            JPG / JPEG / PNG / PDF — الحد الأقصى 20MB
                        </div>

                    </div>


                    {{-- License --}}

                    <div class="field">

                        <label>
                            ترخيص مزاولة المهنة
                            <span>*</span>
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="license_image"
                                id="license_image"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                            >

                            <div
                                class="file-list"
                                id="licenseList"
                            ></div>

                        </div>

                        <div class="hint">
                            JPG / JPEG / PNG / PDF — الحد الأقصى 20MB
                        </div>

                    </div>


                    {{-- Trademark --}}

                    <div class="field">

                        <label>
                            شهادة تسجيل العلامة التجارية
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="trademark_certificate"
                                id="trademark_certificate"
                                accept=".jpg,.jpeg,.png,.pdf"
                            >

                            <div
                                class="file-list"
                                id="trademarkList"
                            ></div>

                        </div>

                        <div class="hint">
                            اختيارية إلا إذا أدخلت رقم العلامة التجارية.
                        </div>

                    </div>


                    {{-- CV --}}

                    <div class="field">

                        <label>
                            السيرة الذاتية
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="cv"
                                id="cv"
                                accept=".pdf,.doc,.docx"
                            >

                            <div
                                class="file-list"
                                id="cvList"
                            ></div>

                        </div>

                        <div class="hint">
                            PDF / DOC / DOCX — الحد الأقصى 20MB
                        </div>

                    </div>


                    {{-- Professional Certificates --}}

                    <div class="field">

                        <label>
                            الشهادات العملية
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="certificates[]"
                                id="certificates"
                                accept=".jpg,.jpeg,.png,.pdf"
                                multiple
                            >

                            <div
                                class="file-list"
                                id="certificatesList"
                            ></div>

                        </div>

                    </div>


                    {{-- Appreciation Certificates --}}

                    <div class="field">

                        <label>
                            شهادات التقدير
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="appreciation_certificates[]"
                                id="appreciation_certificates"
                                accept=".jpg,.jpeg,.png,.pdf"
                                multiple
                            >

                            <div
                                class="file-list"
                                id="appreciationList"
                            ></div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- Submit --}}
            {{-- ========================================================= --}}

            <div class="submit-area">

                <button
                    type="submit"
                    class="submit-btn"
                    id="submitBtn"
                >
                    حفظ وإرسال للمراجعة
                </button>

                <div
                    class="loading"
                    id="loading"
                >
                    جاري حفظ البيانات ورفع الملفات...
                </div>

                <div class="required-note">
                    الحقول التي تحتوي على علامة
                    <strong style="color:#dc2626">*</strong>
                    إلزامية.
                </div>

            </div>


        </form>

    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | CSRF
    |--------------------------------------------------------------------------
    */

    const csrfToken =
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');


    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const officeType =
        document.getElementById('office_type');

    const specialty =
        document.getElementById('specialty');

    const otherSpecialtyBox =
        document.getElementById('otherSpecialtyBox');

    const manualSpecialty =
        document.getElementById('manual_specialty');


    /*
    |--------------------------------------------------------------------------
    | Show / Hide Other Specialty
    |--------------------------------------------------------------------------
    */

    function toggleOtherSpecialty() {

        if (
            specialty.value === 'other'
        ) {

            otherSpecialtyBox.style.display =
                'flex';

            manualSpecialty.required =
                true;

        } else {

            otherSpecialtyBox.style.display =
                'none';

            manualSpecialty.required =
                false;

            manualSpecialty.value =
                '';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Load Specialties
    |--------------------------------------------------------------------------
    */

    async function loadSpecialties(
        type,
        selected = null
    ) {

        if (!type) {

            specialty.innerHTML = `
                <option value="">
                    اختر نوع المكتب أولاً
                </option>
            `;

            return;
        }


        specialty.innerHTML = `
            <option value="">
                جاري تحميل التخصصات...
            </option>
        `;


        try {

            const response =
                await fetch(
                    "{{ route('amrtm.provider.account.specialties') }}?office_type="
                    + encodeURIComponent(type),
                    {
                        headers: {
                            'Accept':
                                'application/json',
                            'X-CSRF-TOKEN':
                                csrfToken
                        }
                    }
                );


            const data =
                await response.json();


            specialty.innerHTML = `
                <option value="">
                    اختر التخصص
                </option>
            `;


            if (
                data.success &&
                Array.isArray(
                    data.specialties
                )
            ) {

                data.specialties.forEach(
                    item => {

                        const option =
                            document.createElement(
                                'option'
                            );

                        option.value =
                            item.id;

                        option.textContent =
                            item.name_en
                                ? item.name_ar +
                                  ' - ' +
                                  item.name_en
                                : item.name_ar;

                        if (
                            selected &&
                            String(selected) ===
                            String(item.id)
                        ) {

                            option.selected =
                                true;
                        }

                        specialty.appendChild(
                            option
                        );
                    }
                );
            }


            const other =
                document.createElement(
                    'option'
                );

            other.value =
                'other';

            other.textContent =
                'أخرى';

            if (
                selected === 'other'
            ) {

                other.selected =
                    true;
            }

            specialty.appendChild(
                other
            );


            toggleOtherSpecialty();


        } catch (error) {

            console.error(error);

            specialty.innerHTML = `
                <option value="">
                    حدث خطأ في تحميل التخصصات
                </option>
            `;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Office Type Change
    |--------------------------------------------------------------------------
    */

    officeType.addEventListener(
        'change',
        function () {

            loadSpecialties(
                this.value
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Specialty Change
    |--------------------------------------------------------------------------
    */

    specialty.addEventListener(
        'change',
        toggleOtherSpecialty
    );


    /*
    |--------------------------------------------------------------------------
    | Initial Specialty
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const currentType =
                officeType.value;

            const oldSpecialty =
                @json(old(
                    'specialty',
                    $profile?->specialty_id
                ));

            const isOther =
                @json(
                    old(
                        'specialty',
                        $profile?->custom_specialty
                            ? 'other'
                            : null
                    )
                ) === 'other';


            if (currentType) {

                loadSpecialties(
                    currentType,
                    isOther
                        ? 'other'
                        : oldSpecialty
                );

            }

            toggleOtherSpecialty();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | File Preview
    |--------------------------------------------------------------------------
    */

    function previewFiles(
        inputId,
        listId
    ) {

        const input =
            document.getElementById(
                inputId
            );

        const list =
            document.getElementById(
                listId
            );


        if (
            !input ||
            !list
        ) {
            return;
        }


        input.addEventListener(
            'change',
            function () {

                list.innerHTML =
                    '';


                Array
                    .from(this.files)
                    .forEach(file => {

                        const div =
                            document.createElement(
                                'div'
                            );

                        div.textContent =
                            '📎 ' +
                            file.name;

                        list.appendChild(
                            div
                        );

                    });

            }
        );
    }


    previewFiles(
        'commercial_register_image',
        'commercialRegisterList'
    );

    previewFiles(
        'license_image',
        'licenseList'
    );

    previewFiles(
        'trademark_certificate',
        'trademarkList'
    );

    previewFiles(
        'cv',
        'cvList'
    );

    previewFiles(
        'certificates',
        'certificatesList'
    );

    previewFiles(
        'appreciation_certificates',
        'appreciationList'
    );


    /*
    |--------------------------------------------------------------------------
    | Submit Loading
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('providerForm')
        .addEventListener(
            'submit',
            function () {

                const btn =
                    document.getElementById(
                        'submitBtn'
                    );

                const loading =
                    document.getElementById(
                        'loading'
                    );


                btn.disabled =
                    true;

                btn.textContent =
                    'جاري الحفظ...';

                loading.style.display =
                    'block';
            }
        );

</script>

</body>
</html>