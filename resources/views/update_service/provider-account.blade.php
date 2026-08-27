<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>تسجيل منشأة جديدة — آمر تم</title>

    <link rel="icon"
          type="image/png"
          href="{{ asset('images/new-logo1.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-light: #ecfdf5;

            --text: #172033;
            --muted: #718096;

            --border: #e5e7eb;
            --danger: #dc2626;
            --danger-bg: #fff7f7;

            --success: #059669;
            --success-bg: #ecfdf5;

            --white: #ffffff;
            --bg: #f4f7f8;

            --radius-lg: 18px;
            --radius-md: 12px;
            --radius-sm: 9px;

            --shadow:
                0 8px 30px rgba(15, 23, 42, .055);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background:
                linear-gradient(
                    180deg,
                    #f7fafb 0%,
                    #f3f6f8 100%
                );

            color: var(--text);

            font-family:
                "Cairo",
                sans-serif;
        }

        button,
        input,
        select {
            font-family: "Cairo", sans-serif;
        }

        /* =====================================================
           SUCCESS PAGE
        ===================================================== */

        .success-page {
            min-height: 100vh;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 30px 18px;
        }

        .success-card {
            width: min(620px, 100%);

            padding: 45px 30px;

            background: #fff;

            border:
                1px solid #e5e7eb;

            border-radius: 22px;

            text-align: center;

            box-shadow:
                0 15px 45px
                rgba(15, 23, 42, .08);
        }

        .success-icon {
            width: 82px;
            height: 82px;

            margin:
                0 auto 22px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                #e8f8ef;

            color:
                #198754;

            font-size: 40px;
        }

        .success-card h1 {
            margin:
                0 0 12px;

            color:
                #198754;

            font-size: 27px;

            font-weight: 800;
        }

        .success-card p {
            margin: 0;

            color: #555;

            font-size: 15px;

            line-height: 2;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .page-container {
            width:
                min(
                    1240px,
                    calc(100% - 32px)
                );

            margin:
                24px auto 50px;
        }

        /* =====================================================
           HERO
        ===================================================== */

        .page-hero {
            position: relative;

            overflow: hidden;

            margin-bottom: 20px;

            padding:
                36px 35px;

            border-radius: 22px;

            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    #0f766e 0%,
                    #116e68 48%,
                    #0d5d58 100%
                );

            box-shadow:
                0 15px 35px
                rgba(15,118,110,.15);
        }

        .page-hero::before {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.045);

            top: -170px;
            right: -80px;
        }

        .page-hero::after {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.035);

            bottom: -140px;
            left: -80px;
        }

        .hero-content {
            position: relative;

            z-index: 2;

            text-align: center;
        }

        .hero-icon {
            width: 64px;
            height: 64px;

            margin:
                0 auto 13px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 17px;

            background:
                rgba(255,255,255,.12);

            border:
                1px solid
                rgba(255,255,255,.16);

            font-size: 25px;
        }

        .page-hero h1 {
            margin:
                0 0 7px;

            font-size: 27px;

            font-weight: 800;
        }

        .page-hero p {
            max-width: 700px;

            margin: auto;

            color:
                rgba(255,255,255,.88);

            font-size: 13px;

            line-height: 1.9;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            display: flex;

            align-items: flex-start;

            gap: 10px;

            margin-bottom: 15px;

            padding:
                13px 15px;

            border-radius: 12px;

            font-size: 12px;

            line-height: 1.8;
        }

        .alert i {
            margin-top: 4px;
        }

        .alert-danger {
            background:
                #fff7f7;

            border:
                1px solid #fecaca;

            color:
                #991b1b;
        }

        .alert-info {
            background:
                #eff6ff;

            border:
                1px solid #bfdbfe;

            color:
                #1e40af;
        }

        .error-list {
            margin:
                6px 0 0;

            padding-right:
                18px;
        }

        .error-list li {
            margin-bottom: 3px;
        }

        /* =====================================================
           SECTION CARD
        ===================================================== */

        .section-card {
            margin-bottom: 17px;

            padding: 22px;

            background:
                var(--white);

            border:
                1px solid var(--border);

            border-radius:
                var(--radius-lg);

            box-shadow:
                var(--shadow);
        }

        /* =====================================================
           SECTION HEADER
        ===================================================== */

        .section-header {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 18px;

            padding-bottom: 15px;

            border-bottom:
                1px solid #eef1f3;
        }

        .section-header-icon {
            width: 43px;
            height: 43px;

            min-width: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color:
                var(--primary);

            background:
                var(--primary-light);

            font-size: 18px;
        }

        .section-header-text h2 {
            margin: 0;

            color:
                #172033;

            font-size: 17px;

            font-weight: 800;
        }

        .section-header-text p {
            margin:
                2px 0 0;

            color:
                var(--muted);

            font-size: 11px;
        }

        /* =====================================================
           FORM GRID
        ===================================================== */

        .form-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    4,
                    minmax(0, 1fr)
                );

            gap:
                14px 15px;
        }

        .form-group {
            min-width: 0;
        }

        .form-label {
            display: block;

            margin-bottom: 6px;

            color:
                #374151;

            font-size: 12px;

            font-weight: 700;
        }

        .required {
            color:
                var(--danger);

            margin-right: 2px;
        }

        /* =====================================================
           INPUT
        ===================================================== */

        .input-wrapper {
            position: relative;

            width: 100%;
        }

        .input-icon {
            position: absolute;

            right: 13px;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                var(--primary);

            font-size: 13px;

            z-index: 2;

            pointer-events: none;
        }

        .form-control {
            width: 100%;

            height: 43px;

            min-height: 43px;

            padding:
                8px 38px 8px 12px;

            border:
                1px solid #d8dee5;

            border-radius:
                var(--radius-sm);

            background:
                #fff;

            color:
                #1f2937;

            font-size: 12px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .form-control:hover {
            border-color:
                #b9c4ce;
        }

        .form-control:focus {
            border-color:
                var(--primary);

            box-shadow:
                0 0 0 3px
                rgba(15,118,110,.07);
        }

        .form-control::placeholder {
            color:
                #a0a8b3;
        }

        .form-control.invalid,
        .form-control.is-invalid {
            border-color:
                var(--danger) !important;

            background:
                var(--danger-bg);

            box-shadow:
                0 0 0 3px
                rgba(220,38,38,.07) !important;
        }

        .field-error {
            margin-top: 5px;

            color:
                var(--danger);

            font-size: 10px;

            line-height: 1.6;
        }

        select.form-control {
            appearance: none;

            cursor: pointer;

            padding-left:
                35px;
        }

        .select-arrow {
            position: absolute;

            left: 12px;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                #7b8794;

            font-size: 10px;

            pointer-events:
                none;
        }

        /* =====================================================
           PASSWORD
        ===================================================== */

        .password-toggle {
            position: absolute;

            left: 10px;

            top: 50%;

            transform:
                translateY(-50%);

            border: 0;

            background: transparent;

            color:
                #7b8794;

            cursor: pointer;

            z-index: 3;
        }

        .password-toggle:hover {
            color:
                var(--primary);
        }

        /* =====================================================
           SPECIALTY
        ===================================================== */

        .specialty-box {
            padding:
                17px;

            border:
                1px solid #e6eaee;

            border-radius:
                14px;

            background:
                #fafcfc;
        }

        .specialty-box > .form-group {
            max-width:
                550px;
        }

        .specialty-info {
            display: flex;

            align-items: flex-start;

            gap: 9px;

            margin-top:
                12px;

            padding:
                10px 12px;

            color:
                #1e40af;

            background:
                #eff6ff;

            border:
                1px solid #bfdbfe;

            border-radius:
                10px;

            font-size:
                11px;

            line-height:
                1.8;
        }

        .specialty-info i {
            margin-top:
                4px;
        }

        .manual-specialty {
            display:
                none;

            margin-top:
                13px;

            max-width:
                550px;
        }

        .manual-specialty.show {
            display:
                block;
        }

        .manual-note {
            margin-top:
                8px;

            padding:
                9px 11px;

            border-radius:
                9px;

            background:
                #fff7ed;

            border:
                1px solid #fed7aa;

            color:
                #9a3412;

            font-size:
                10px;

            line-height:
                1.7;
        }

        /* =====================================================
           DOCUMENTS
        ===================================================== */

        .documents-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap:
                13px;
        }

        .file-box {
            min-width: 0;
        }

        .file-label {
            min-height:
                155px;

            display: flex;

            flex-direction:
                column;

            align-items: center;

            justify-content: center;

            padding:
                15px;

            text-align:
                center;

            background:
                #fafcfd;

            border:
                1.5px dashed #cbd5df;

            border-radius:
                14px;

            cursor:
                pointer;

            transition:
                .2s ease;
        }

        .file-label:hover {
            background:
                #f0fdfa;

            border-color:
                var(--primary);

            transform:
                translateY(-2px);

            box-shadow:
                0 7px 18px
                rgba(15,118,110,.07);
        }

        .file-label.invalid {
            background:
                #fff7f7;

            border-color:
                var(--danger);
        }

        .file-icon {
            width: 48px;
            height: 48px;

            margin-bottom:
                9px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius:
                13px;

            background:
                var(--primary-light);

            color:
                var(--primary);

            font-size:
                19px;
        }

        .file-title {
            color:
                #374151;

            font-size:
                12px;

            font-weight:
                800;
        }

        .file-hint {
            margin-top:
                4px;

            color:
                #9aa3ad;

            font-size:
                9px;

            line-height:
                1.6;
        }

        .file-input {
            display:
                none;
        }

        .file-name {
            min-height:
                17px;

            margin-top:
                5px;

            text-align:
                center;

            color:
                var(--primary);

            font-size:
                10px;

            font-weight:
                700;

            word-break:
                break-word;
        }

        /* =====================================================
           INFO
        ===================================================== */

        .info-note {
            display:
                flex;

            align-items:
                flex-start;

            gap:
                9px;

            margin-top:
                14px;

            padding:
                11px 13px;

            background:
                #f0fdfa;

            border:
                1px solid #ccfbf1;

            border-radius:
                10px;

            color:
                #115e59;

            font-size:
                11px;

            line-height:
                1.8;
        }

        .info-note i {
            margin-top:
                4px;
        }

        /* =====================================================
           ACTIONS
        ===================================================== */

        .form-actions {
            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                20px;
        }

        .action-note {
            color:
                #6b7280;

            font-size:
                11px;

            line-height:
                1.9;
        }

        .action-note i {
            color:
                var(--primary);

            margin-left:
                4px;
        }

        .submit-btn {
            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                8px;

            min-height:
                45px;

            padding:
                8px 24px;

            border:
                0;

            border-radius:
                10px;

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #115e59
                );

            color:
                #fff;

            font-size:
                12px;

            font-weight:
                800;

            cursor:
                pointer;

            white-space:
                nowrap;

            box-shadow:
                0 6px 15px
                rgba(15,118,110,.16);

            transition:
                .2s ease;
        }

        .submit-btn:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 9px 20px
                rgba(15,118,110,.22);
        }

        .submit-btn:disabled {
            opacity:
                .7;

            cursor:
                not-allowed;

            transform:
                none;

            box-shadow:
                none;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .form-grid {
                grid-template-columns:
                    repeat(
                        3,
                        minmax(0, 1fr)
                    );
            }
        }

        @media (max-width: 850px) {

            .page-container {
                width:
                    calc(100% - 24px);

                margin-top:
                    15px;
            }

            .form-grid {
                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }

            .documents-grid {
                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }
        }

        @media (max-width: 580px) {

            .page-container {
                width:
                    calc(100% - 14px);

                margin:
                    8px auto 25px;
            }

            .page-hero {
                padding:
                    27px 15px;

                border-radius:
                    15px;
            }

            .hero-icon {
                width:
                    50px;

                height:
                    50px;

                border-radius:
                    13px;

                font-size:
                    21px;
            }

            .page-hero h1 {
                font-size:
                    21px;
            }

            .page-hero p {
                font-size:
                    11px;

                line-height:
                    1.8;
            }

            .section-card {
                padding:
                    14px;

                border-radius:
                    13px;
            }

            .section-header {
                gap:
                    9px;

                margin-bottom:
                    13px;

                padding-bottom:
                    11px;
            }

            .section-header-icon {
                width:
                    37px;

                height:
                    37px;

                min-width:
                    37px;
            }

            .section-header-text h2 {
                font-size:
                    15px;
            }

            .section-header-text p {
                font-size:
                    9px;
            }

            .form-grid {
                grid-template-columns:
                    1fr;

                gap:
                    10px;
            }

            .documents-grid {
                grid-template-columns:
                    1fr;

                gap:
                    10px;
            }

            .specialty-box {
                padding:
                    11px;
            }

            .specialty-box > .form-group,
            .manual-specialty {
                max-width:
                    none;
            }

            .form-actions {
                flex-direction:
                    column;

                align-items:
                    stretch;
            }

            .submit-btn {
                width:
                    100%;
            }

            .success-card {
                padding:
                    35px 20px;
            }

            .success-card h1 {
                font-size:
                    23px;
            }

            .success-card p {
                font-size:
                    13px;
            }
        }
    </style>
</head>


<body>

{{-- =========================================================
     SUCCESS
     مهم:
     لو نجح التسجيل، تظهر الرسالة فقط ولا تظهر الفورم.
========================================================= --}}

@if(session('success'))

    <div class="success-page">

        <div class="success-card">

            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <h1>
                تم إرسال الطلب بنجاح
            </h1>

            <p>
                {{ session('success') }}
            </p>

        </div>

    </div>

@else

    <div class="page-container">

        {{-- =================================================
             HERO
        ================================================== --}}

        <section class="page-hero">

            <div class="hero-content">

                <div class="hero-icon">
                    <i class="fas fa-building-user"></i>
                </div>

                <h1>
                    تسجيل منشأة جديدة
                </h1>

                <p>
                    أدخل بيانات المكتب أو المنشأة والمستندات المطلوبة
                    لإرسال طلب التسجيل للمراجعة والاعتماد.
                </p>

            </div>

        </section>


        {{-- =================================================
             GENERAL ERRORS
        ================================================== --}}

        @if($errors->any())

            <div class="alert alert-danger">

                <i class="fas fa-circle-exclamation"></i>

                <div>

                    <strong>
                        يرجى مراجعة البيانات التالية:
                    </strong>

                    <ul class="error-list">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        @if(session('info'))

            <div class="alert alert-info">

                <i class="fas fa-circle-info"></i>

                <div>
                    {{ session('info') }}
                </div>

            </div>

        @endif


        {{-- =================================================
             FORM
        ================================================== --}}

        <form
            method="POST"
            action="{{ route('amrtm.provider.account.store') }}"
            enctype="multipart/form-data"
            id="provider-form">

            @csrf


            {{-- =================================================
                 OFFICE DATA
            ================================================== --}}

            <section class="section-card">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-building"></i>
                    </div>

                    <div class="section-header-text">

                        <h2>
                            بيانات المنشأة
                        </h2>

                        <p>
                            البيانات الأساسية للمكتب أو مقدم الخدمة
                        </p>

                    </div>

                </div>


                <div class="form-grid">


                    {{-- الاسم العربي --}}

                    <div class="form-group">

                        <label class="form-label">

                            اسم المكتب (باللغة العربيه)

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-building input-icon"></i>

                            <input
                                type="text"
                                name="name_ar"
                                class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                placeholder="اسم المكتب بالعربية"
                                value="{{ old('name_ar') }}"
                                required>

                        </div>

                        @error('name_ar')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الاسم الإنجليزي --}}

                    <div class="form-group">

                        <label class="form-label">

                            اسم المكتب (باللغة الانجليزيه)

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-building input-icon"></i>

                            <input
                                type="text"
                                name="name_en"
                                class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                placeholder="Office Name"
                                value="{{ old('name_en') }}"
                                dir="ltr"
                                required>

                        </div>

                        @error('name_en')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- المدير --}}

                    <div class="form-group">

                        <label class="form-label">

                            اسم مدير المكتب

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-user-tie input-icon"></i>

                            <input
                                type="text"
                                name="manager_name"
                                class="form-control {{ $errors->has('manager_name') ? 'is-invalid' : '' }}"
                                placeholder="أدخل اسم مدير المكتب"
                                value="{{ old('manager_name') }}"
                                required>

                        </div>

                        @error('manager_name')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- نوع المكتب --}}

                    <div class="form-group">

                        <label class="form-label">

                            إسم المنشأة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-layer-group input-icon"></i>

                            <select
                                name="office_type"
                                id="office_type"
                                class="form-control {{ $errors->has('office_type') ? 'is-invalid' : '' }}"
                                required>

                                <option value="">
                                    اختر نوع المنشأة
                                </option>

                                <option
                                    value="law"
                                    {{ old('office_type') === 'law' ? 'selected' : '' }}>
                                    مكاتب المحاماة
                                </option>

                                <option
                                    value="services"
                                    {{ old('office_type') === 'services' ? 'selected' : '' }}>
                                    مكاتب الخدمات والتعقيب
                                </option>

                                <option
                                    value="customs"
                                    {{ old('office_type') === 'customs' ? 'selected' : '' }}>
                                    مكاتب التخليص الجمركي
                                </option>

                                <option
                                    value="accounting"
                                    {{ old('office_type') === 'accounting' ? 'selected' : '' }}>
                                    مكاتب الاستشارات المالية والضريبية
                                </option>

                                <option
                                    value="engineering"
                                    {{ old('office_type') === 'engineering' ? 'selected' : '' }}>
                                    مكاتب الاستشارات الهندسية
                                </option>

                                <option
                                    value="freelance"
                                    {{ old('office_type') === 'freelance' ? 'selected' : '' }}>
                                    أصحاب المهن الحرة
                                </option>

                            </select>

                            <i class="fas fa-chevron-down select-arrow"></i>

                        </div>

                        @error('office_type')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الجوال --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم الجوال

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-phone input-icon"></i>

                            <input
                                type="tel"
                                name="phone"
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                placeholder="05xxxxxxxx"
                                value="{{ old('phone') }}"
                                required>

                        </div>

                        @error('phone')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- البريد --}}

                    <div class="form-group">

                        <label class="form-label">

                            البريد الإلكتروني

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-envelope input-icon"></i>

                            <input
                                type="email"
                                name="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                placeholder="example@email.com"
                                value="{{ old('email') }}"
                                dir="ltr"
                                autocomplete="off"
                                required>

                        </div>

                        @error('email')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- password --}}

                    <div class="form-group">

                        <label class="form-label">

                            كلمة المرور

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-lock input-icon"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="8 أحرف على الأقل"
                                autocomplete="new-password"
                                minlength="8"
                                required>

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        @error('password')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- confirmation --}}

                    <div class="form-group">

                        <label class="form-label">

                            تأكيد كلمة المرور

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-lock input-icon"></i>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="أعد إدخال كلمة المرور"
                                autocomplete="new-password"
                                minlength="8"
                                required>

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_confirmation">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                    </div>


                    {{-- الدولة --}}

                    <div class="form-group">

                        <label class="form-label">

                            الدولة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-globe input-icon"></i>

                            <input
                                type="text"
                                name="country"
                                class="form-control"
                                placeholder="المملكة العربية السعودية"
                                
                                required>

                        </div>

                        @error('country')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- المنطقة --}}

                    <div class="form-group">

                        <label class="form-label">

                            المنطقة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-map input-icon"></i>

                            <input
                                type="text"
                                name="governorate"
                                class="form-control"
                                placeholder="منطقة مكة المكرمة"
                                value="{{ old('governorate') }}"
                                required>

                        </div>

                        @error('governorate')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- المدينة --}}

                    <div class="form-group">

                        <label class="form-label">

                            المدينة

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-location-dot input-icon"></i>

                            <input
                                type="text"
                                name="city"
                                class="form-control"
                                placeholder="جدة"
                                value="{{ old('city') }}"
                                required>

                        </div>

                        @error('city')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الحي --}}

                    <div class="form-group">

                        <label class="form-label">

                            الحي

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-map-location-dot input-icon"></i>

                            <input
                                type="text"
                                name="district"
                                class="form-control"
                                placeholder="اسم الحي"
                                value="{{ old('district') }}"
                                required>

                        </div>

                        @error('district')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- الشارع --}}

                    <div class="form-group">

                        <label class="form-label">

                            الشارع

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-road input-icon"></i>

                            <input
                                type="text"
                                name="street"
                                class="form-control"
                                placeholder="اسم الشارع"
                                value="{{ old('street') }}"
                                required>

                        </div>

                        @error('street')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- رقم المبنى --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم المبنى

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-house input-icon"></i>

                            <input
                                type="text"
                                name="building_number"
                                class="form-control"
                                placeholder="رقم المبنى"
                                value="{{ old('building_number') }}"
                                required>

                        </div>

                        @error('building_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- رقم المكتب --}}

                    <div class="form-group">

                        <label class="form-label">
                            رقم المكتب
                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-door-open input-icon"></i>

                            <input
                                type="text"
                                name="office_number"
                                class="form-control"
                                placeholder="رقم المكتب"
                                value="{{ old('office_number') }}">

                        </div>

                    </div>


                    {{-- CR --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم السجل التجاري (الموحد)

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-file-invoice input-icon"></i>

                            <input
                                type="text"
                                name="cr_number"
                                id="cr_number"
                                class="form-control"
                                placeholder="رقم السجل التجاري"
                                value="{{ old('cr_number') }}"
                                required>

                        </div>

                        @error('cr_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- License --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم ترخيص المزاولة المهنية

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-id-card input-icon"></i>

                            <input
                                type="text"
                                name="license_number"
                                id="license_number"
                                class="form-control"
                                placeholder="رقم الترخيص"
                                value="{{ old('license_number') }}"
                                required>

                        </div>

                        @error('license_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Trademark --}}

                    <div class="form-group">

                        <label class="form-label">

                            رقم تسجيل العلامة التجارية

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-certificate input-icon"></i>

                            <input
                                type="text"
                                name="trademark_registration_number"
                                id="trademark_registration_number"
                                class="form-control"
                                placeholder="اختياري"
                                value="{{ old('trademark_registration_number') }}">

                        </div>

                        @error('trademark_registration_number')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                </div>

            </section>


            {{-- =================================================
                 SPECIALTY
            ================================================== --}}

            <section class="section-card">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>

                    <div class="section-header-text">

                        <h2>
                            أختر التخصص الذي تمارسه حاليآ من القائمة التالية 
                        </h2>

                        <p>
                            اختر تخصصًا معتمدًا أو أضف تخصصًا جديدًا للمراجعة
                        </p>

                    </div>

                </div>


                <div class="specialty-box">

                    <div class="form-group">

                        <label class="form-label">

                            التخصص

                            <span class="required">*</span>

                        </label>

                        <div class="input-wrapper">

                            <i class="fas fa-list-check input-icon"></i>

                            <select
                                name="specialty"
                                id="specialty"
                                class="form-control"
                                required
                                disabled>

                                <option value="">
                                    اختر نوع المنشأة أولاً
                                </option>

                            </select>

                            <i class="fas fa-chevron-down select-arrow"></i>

                        </div>

                        @error('specialty')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="specialty-info">

                        <i class="fas fa-circle-info"></i>

                        <div id="specialty-message">

                            اختر نوع المنشأة أولاً لعرض التخصصات المتاحة.

                        </div>

                    </div>


                    <div
                        class="manual-specialty"
                        id="manual-specialty">

                        <div class="form-group">

                            <label class="form-label">

                                اكتب التخصص الذي تمارسه حاليآ

                                <span class="required">*</span>

                            </label>

                            <div class="input-wrapper">

                                <i class="fas fa-pen input-icon"></i>

                                <input
                                    type="text"
                                    name="manual_specialty"
                                    id="manual_specialty"
                                    class="form-control"
                                    placeholder="اكتب تخصصك هنا"
                                    value="{{ old('manual_specialty') }}">

                            </div>

                            @error('manual_specialty')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="manual-note">

                                <i class="fas fa-clock"></i>

                                التخصص المكتوب يدويًا سيتم إرساله للإدارة للمراجعة.
                                لن يظهر كتخصص معتمد إلا بعد موافقة الإدارة.

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 DOCUMENTS
            ================================================== --}}

            <section class="section-card">

                <div class="section-header">

                    <div class="section-header-icon">
                        <i class="fas fa-paperclip"></i>
                    </div>

                    <div class="section-header-text">

                        <h2>
                            إرفاق المستندات التالية
                        </h2>

                        <p>
                            المستندات المطلوبة لإتمام طلب التسجيل
                        </p>

                    </div>

                </div>


                <div class="documents-grid">


                    {{-- CR FILE --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="commercial_register_image-label"
                            for="commercial_register_image">

                            <div class="file-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>

                            <div class="file-title">

                               إرفاق السجل التجاري

                                <span class="required">*</span>

                            </div>

                            <div class="file-hint">
                                جميع أنواع الملفات مسموحة
                            </div>

                        </label>

                        <input
                            type="file"
                            id="commercial_register_image"
                            name="commercial_register_image"
                            class="file-input"
                            required>

                        <div
                            class="file-name"
                            id="commercial_register_image-name">
                        </div>

                        @error('commercial_register_image')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- LICENSE FILE --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="license_image-label"
                            for="license_image">

                            <div class="file-icon">
                                <i class="fas fa-id-card"></i>
                            </div>

                            <div class="file-title">

                               إرفاق ترخيص المزاولة المهنية

                                <span class="required">*</span>

                            </div>

                            <div class="file-hint">
                                جميع أنواع الملفات مسموحة
                            </div>

                        </label>

                        <input
                            type="file"
                            id="license_image"
                            name="license_image"
                            class="file-input"
                            required>

                        <div
                            class="file-name"
                            id="license_image-name">
                        </div>

                        @error('license_image')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TRADEMARK --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="trademark_certificate-label"
                            for="trademark_certificate">

                            <div class="file-icon">
                                <i class="fas fa-certificate"></i>
                            </div>

                            <div class="file-title">

                               إرفاق شهادة تسجيل العلامة التجارية

                                <span
                                    class="required"
                                    id="trademark-required-star"
                                    style="display:none;">

                                    *

                                </span>

                            </div>

                            <div
                                class="file-hint"
                                id="trademark-file-hint">

                                اختيارية — تصبح مطلوبة عند إدخال رقم العلامة

                            </div>

                        </label>

                        <input
                            type="file"
                            id="trademark_certificate"
                            name="trademark_certificate"
                            class="file-input">

                        <div
                            class="file-name"
                            id="trademark_certificate-name">
                        </div>

                        @error('trademark_certificate')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CERTIFICATES --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="certificates-label"
                            for="certificates">

                            <div class="file-icon">
                                <i class="fas fa-award"></i>
                            </div>

                            <div class="file-title">
                               إرفاق الشهادات العملية
                            </div>

                            <div class="file-hint">
                                أكثر من ملف — اختيارية
                            </div>

                        </label>

                        <input
                            type="file"
                            id="certificates"
                            name="certificates[]"
                            class="file-input"
                            multiple>

                        <div
                            class="file-name"
                            id="certificates-name">
                        </div>

                    </div>


                    {{-- APPRECIATION --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="appreciation_certificates-label"
                            for="appreciation_certificates">

                            <div class="file-icon">
                                <i class="fas fa-medal"></i>
                            </div>

                            <div class="file-title">
                               إرفاق شهادات التقدير
                            </div>

                            <div class="file-hint">
                                أكثر من ملف — اختيارية
                            </div>

                        </label>

                        <input
                            type="file"
                            id="appreciation_certificates"
                            name="appreciation_certificates[]"
                            class="file-input"
                            multiple>

                        <div
                            class="file-name"
                            id="appreciation_certificates-name">
                        </div>

                    </div>


                    {{-- CV --}}

                    <div class="file-box">

                        <label
                            class="file-label"
                            id="cv-label"
                            for="cv">

                            <div class="file-icon">
                                <i class="fas fa-file-lines"></i>
                            </div>

                            <div class="file-title">
                               إرفاق السيرة الذاتية
                            </div>

                            <div class="file-hint">
                                اختيارية
                            </div>

                        </label>

                        <input
                            type="file"
                            id="cv"
                            name="cv"
                            class="file-input">

                        <div
                            class="file-name"
                            id="cv-name">
                        </div>

                    </div>


                </div>


                <div class="info-note">

                    <i class="fas fa-shield-halved"></i>

                    <div>

                        يتم حفظ المستندات بشكل آمن، ولن يظهر المكتب
                        بشكل نهائي على المنصة إلا بعد مراجعة واعتماد الإدارة.

                    </div>

                </div>

            </section>


            {{-- =================================================
                 SUBMIT
            ================================================== --}}

            <section class="section-card">

                <div class="form-actions">

                    <div class="action-note">

                        <i class="fas fa-circle-info"></i>

                        تأكد من صحة جميع البيانات قبل الإرسال.

                        <br>

                        الحقول التي تحمل
                        <span class="required">*</span>
                        إلزامية.

                    </div>


                    <button
                        type="submit"
                        class="submit-btn"
                        id="submit-btn">

                        <i class="fas fa-paper-plane"></i>

                        إرسال الطلب للمراجعة

                    </button>

                </div>

            </section>

        </form>

    </div>

@endif


<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const officeType =
        document.getElementById('office_type');

    const specialty =
        document.getElementById('specialty');

    const specialtyMessage =
        document.getElementById('specialty-message');

    const manualBox =
        document.getElementById('manual-specialty');

    const manualInput =
        document.getElementById('manual_specialty');

    const form =
        document.getElementById('provider-form');

    const submitButton =
        document.getElementById('submit-btn');

    const trademarkNumber =
        document.getElementById('trademark_registration_number');

    const trademarkCertificate =
        document.getElementById('trademark_certificate');

    const trademarkRequiredStar =
        document.getElementById('trademark-required-star');

    const trademarkFileHint =
        document.getElementById('trademark-file-hint');


    /*
    |--------------------------------------------------------------------------
    | لو فيه success لا يوجد form أصلاً
    |--------------------------------------------------------------------------
    */

    if (!form) {
        return;
    }


    /* =====================================================
       ROUTE
    ===================================================== */

    const specialtiesUrl =
        @json(route('amrtm.provider.account.specialties'));


    /* =====================================================
       MANUAL SPECIALTY
    ===================================================== */

    function showManualSpecialty() {

        if (!manualBox || !manualInput) {
            return;
        }

        manualBox.classList.add('show');

        manualInput.required = true;
    }


    function hideManualSpecialty() {

        if (!manualBox || !manualInput) {
            return;
        }

        manualBox.classList.remove('show');

        manualInput.required = false;

        /*
         * لا نمسح القيمة هنا حتى لا تضيع old()
         * في حالة validation error.
         */
    }


    function handleSpecialtyChange() {

        if (!specialty) {
            return;
        }

        if (specialty.value === 'other') {

            showManualSpecialty();

        } else {

            hideManualSpecialty();

        }
    }


    /* =====================================================
       LOAD SPECIALTIES
    ===================================================== */

    async function loadSpecialties(
        selectedSpecialty = ''
    ) {

        if (!officeType || !specialty) {
            return;
        }

        const officeTypeValue =
            officeType.value;


        if (!officeTypeValue) {

            specialty.innerHTML = `
                <option value="">
                    اختر نوع المنشأة أولاً
                </option>
            `;

            specialty.disabled = true;

            if (specialtyMessage) {

                specialtyMessage.textContent =
                    'اختر نوع المنشأة أولاً لعرض التخصصات المتاحة.';

            }

            hideManualSpecialty();

            return;
        }


        specialty.disabled = true;

        specialty.innerHTML = `
            <option value="">
                جاري تحميل التخصصات...
            </option>
        `;


        if (specialtyMessage) {

            specialtyMessage.textContent =
                'جاري تحميل التخصصات...';

        }


        try {

            const response =
                await fetch(
                    specialtiesUrl +
                    '?office_type=' +
                    encodeURIComponent(
                        officeTypeValue
                    ),
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                    }
                );


            if (!response.ok) {

                throw new Error(
                    'HTTP ' +
                    response.status
                );
            }


            const data =
                await response.json();


            specialty.innerHTML = `
                <option value="">
                    اختر التخصص
                </option>
            `;


            if (
                data.success &&
                Array.isArray(data.specialties)
            ) {

                data.specialties.forEach(
                    function (item) {

                        const option =
                            document.createElement(
                                'option'
                            );

                        option.value =
                            item.id;

                        option.textContent =
                            item.name_ar;

                        if (
                            String(item.id) ===
                            String(selectedSpecialty)
                        ) {

                            option.selected =
                                true;

                        }

                        specialty.appendChild(
                            option
                        );

                    }
                );


                /*
                 * التخصص اليدوي
                 */

                const otherOption =
                    document.createElement(
                        'option'
                    );

                otherOption.value =
                    'other';

                otherOption.textContent =
                    'تخصص آخر — سأكتبه يدويًا';


                if (
                    String(selectedSpecialty) ===
                    'other'
                ) {

                    otherOption.selected =
                        true;

                }


                specialty.appendChild(
                    otherOption
                );


                specialty.disabled =
                    false;


                if (specialtyMessage) {

                    specialtyMessage.textContent =
                        data.specialties.length
                            ? 'تم تحميل التخصصات المعتمدة لهذا النوع.'
                            : 'لا توجد تخصصات معتمدة حاليًا، يمكنك إضافة تخصص يدوي للمراجعة.';

                }


                handleSpecialtyChange();


            } else {

                specialty.innerHTML = `
                    <option value="">
                        اختر التخصص
                    </option>

                    <option value="other">
                        تخصص آخر — سأكتبه يدويًا
                    </option>
                `;

                specialty.disabled =
                    false;

                specialty.value =
                    'other';

                showManualSpecialty();

                if (specialtyMessage) {

                    specialtyMessage.textContent =
                        'لا توجد تخصصات متاحة حاليًا. يمكنك كتابة التخصص يدويًا.';

                }

            }


        } catch (error) {

            console.error(
                'Specialties Error:',
                error
            );


            specialty.innerHTML = `
                <option value="">
                    اختر التخصص
                </option>

                <option value="other">
                    تخصص آخر — سأكتبه يدويًا
                </option>
            `;

            specialty.disabled =
                false;

            specialty.value =
                'other';

            showManualSpecialty();

            if (specialtyMessage) {

                specialtyMessage.textContent =
                    'تعذر تحميل التخصصات. يمكنك كتابة التخصص يدويًا.';

            }

        }

    }


    /* =====================================================
       OFFICE TYPE
    ===================================================== */

    officeType.addEventListener(
        'change',
        function () {

            loadSpecialties();

        }
    );


    /* =====================================================
       SPECIALTY
    ===================================================== */

    specialty.addEventListener(
        'change',
        handleSpecialtyChange
    );


    /* =====================================================
       OLD VALUES
    ===================================================== */

    const oldOfficeType =
        @json(old('office_type'));

    const oldSpecialty =
        @json(old('specialty'));


    /* =====================================================
       PASSWORD TOGGLE
    ===================================================== */

    document
        .querySelectorAll('.password-toggle')
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const targetId =
                        this.dataset.target;

                    const input =
                        document.getElementById(
                            targetId
                        );

                    if (!input) {
                        return;
                    }

                    const icon =
                        this.querySelector('i');

                    if (
                        input.type ===
                        'password'
                    ) {

                        input.type =
                            'text';

                        if (icon) {
                            icon.className =
                                'fas fa-eye-slash';
                        }

                    } else {

                        input.type =
                            'password';

                        if (icon) {
                            icon.className =
                                'fas fa-eye';
                        }

                    }

                }
            );

        });


    /* =====================================================
       PASSWORD MATCH
    ===================================================== */

    const password =
        document.getElementById('password');

    const passwordConfirmation =
        document.getElementById(
            'password_confirmation'
        );


    function checkPasswordMatch() {

        if (
            !password ||
            !passwordConfirmation
        ) {
            return true;
        }

        if (
            !passwordConfirmation.value
        ) {

            passwordConfirmation.classList.remove(
                'is-invalid'
            );

            return true;
        }

        const match =
            password.value ===
            passwordConfirmation.value;


        if (!match) {

            passwordConfirmation.classList.add(
                'is-invalid'
            );

        } else {

            passwordConfirmation.classList.remove(
                'is-invalid'
            );

        }

        return match;
    }


    if (passwordConfirmation) {

        passwordConfirmation.addEventListener(
            'input',
            checkPasswordMatch
        );

    }


    /* =====================================================
       TRADEMARK REQUIREMENT
    ===================================================== */

    function updateTrademarkRequirement() {

        if (
            !trademarkNumber ||
            !trademarkCertificate
        ) {
            return;
        }


        const numberEntered =
            trademarkNumber.value.trim().length > 0;


        if (numberEntered) {

            trademarkCertificate.required =
                true;

            if (trademarkRequiredStar) {

                trademarkRequiredStar.style.display =
                    'inline';

            }

            if (trademarkFileHint) {

                trademarkFileHint.textContent =
                    'جميع أنواع الملفات مسموحة — إلزامية لأن رقم العلامة التجارية تم إدخاله';

            }

        } else {

            trademarkCertificate.required =
                false;

            if (trademarkRequiredStar) {

                trademarkRequiredStar.style.display =
                    'none';

            }

            if (trademarkFileHint) {

                trademarkFileHint.textContent =
                    'اختيارية — تصبح إلزامية إذا تم إدخال رقم العلامة التجارية';

            }

        }

    }


    if (trademarkNumber) {

        trademarkNumber.addEventListener(
            'input',
            updateTrademarkRequirement
        );

    }


    /* =====================================================
       FILES
    ===================================================== */

    const fileInputs = [

        {
            id: 'commercial_register_image',
            label: 'السجل التجاري'
        },

        {
            id: 'license_image',
            label: 'ترخيص المزاولة المهنية'
        },

        {
            id: 'trademark_certificate',
            label: 'شهادة تسجيل العلامة التجارية'
        },

        {
            id: 'certificates',
            label: 'الشهادات العملية'
        },

        {
            id: 'appreciation_certificates',
            label: 'شهادات التقدير'
        },

        {
            id: 'cv',
            label: 'السيرة الذاتية'
        }

    ];


    fileInputs.forEach(
        function (config) {

            const input =
                document.getElementById(
                    config.id
                );

            const nameBox =
                document.getElementById(
                    config.id + '-name'
                );


            if (
                !input ||
                !nameBox
            ) {
                return;
            }


            input.addEventListener(
                'change',
                function () {

                    const files =
                        Array.from(
                            this.files || []
                        );


                    nameBox.textContent =
                        '';


                    const label =
                        document.getElementById(
                            config.id + '-label'
                        );


                    if (label) {

                        label.classList.remove(
                            'invalid'
                        );

                    }


                    if (!files.length) {
                        return;
                    }


                    if (
                        files.length === 1
                    ) {

                        nameBox.textContent =
                            files[0].name;

                    } else {

                        nameBox.textContent =
                            'تم اختيار ' +
                            files.length +
                            ' ملفات';

                    }

                }
            );

        }
    );


    /* =====================================================
       INITIAL LOAD
    ===================================================== */

    if (oldOfficeType) {

        officeType.value =
            oldOfficeType;

        loadSpecialties(
            oldSpecialty || ''
        );

    }


    updateTrademarkRequirement();


    /* =====================================================
       FORM SUBMIT
    ===================================================== */

    form.addEventListener(
        'submit',
        function (event) {

            updateTrademarkRequirement();


            /* ---------------------------------------------
               OFFICE TYPE
            --------------------------------------------- */

            if (!officeType.value) {

                event.preventDefault();

                officeType.focus();

                alert(
                    'يرجى اختيار نوع المنشأة.'
                );

                return;
            }


            /* ---------------------------------------------
               SPECIALTY
            --------------------------------------------- */

            if (!specialty.value) {

                event.preventDefault();

                specialty.focus();

                alert(
                    'يرجى اختيار التخصص.'
                );

                return;
            }


            /* ---------------------------------------------
               MANUAL SPECIALTY
            --------------------------------------------- */

            if (
                specialty.value ===
                'other'
            ) {

                if (
                    !manualInput.value.trim()
                ) {

                    event.preventDefault();

                    showManualSpecialty();

                    manualInput.focus();

                    alert(
                        'يرجى كتابة التخصص اليدوي.'
                    );

                    return;
                }

            }


            /* ---------------------------------------------
               PASSWORD
            --------------------------------------------- */

            if (
                !checkPasswordMatch()
            ) {

                event.preventDefault();

                passwordConfirmation.focus();

                alert(
                    'كلمتا المرور غير متطابقتين.'
                );

                return;
            }


            /* ---------------------------------------------
               REQUIRED FILES
            --------------------------------------------- */

            const requiredFileIds = [

                'commercial_register_image',
                'license_image'

            ];


            if (
                trademarkCertificate &&
                trademarkCertificate.required
            ) {

                requiredFileIds.push(
                    'trademark_certificate'
                );

            }


            for (
                const fileId
                of requiredFileIds
            ) {

                const input =
                    document.getElementById(
                        fileId
                    );


                if (
                    !input ||
                    !input.files ||
                    !input.files.length
                ) {

                    event.preventDefault();


                    const label =
                        document.querySelector(
                            'label[for="' +
                            fileId +
                            '"]'
                        );


                    if (label) {

                        label.classList.add(
                            'invalid'
                        );

                        label.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                    }


                    const config =
                        fileInputs.find(
                            item =>
                                item.id ===
                                fileId
                        );


                    alert(
                        'يرجى إرفاق: ' +
                        (
                            config
                                ? config.label
                                : 'المرفق المطلوب'
                        )
                    );


                    return;
                }

            }


            /* ---------------------------------------------
               SUBMIT
            --------------------------------------------- */

            submitButton.disabled =
                true;

            submitButton.innerHTML = `
                <i class="fas fa-spinner fa-spin"></i>
                جاري إرسال الطلب...
            `;

        }
    );

});

</script>

</body>

</html>