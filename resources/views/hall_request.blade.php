<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب إضافة قاعة | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            background: #f0f4f2;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ==============================
           HERO BANNER
        ============================== */
        .hero-banner {
            background: linear-gradient(135deg, #1a5c38 0%, #2d8a5a 60%, #52b788 100%);
            padding: 42px 5% 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 40px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .hero-icon {
            width: 70px; height: 70px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #fff;
            margin-bottom: 14px;
        }

        .hero-title {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }

        .hero-sub {
            font-size: 14px;
            color: rgba(255,255,255,0.78);
            font-weight: 500;
        }

        /* ==============================
           BREADCRUMB
        ============================== */
        .breadcrumb-row {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 5%;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .breadcrumb-row a { color: #1a5c38; text-decoration: none; font-weight: 600; }
        .breadcrumb-row a:hover { text-decoration: underline; }
        .breadcrumb-row .sep { color: #9ca3af; }
        .breadcrumb-row .current { color: #6c7a72; font-weight: 500; }

        /* ==============================
           FORM WRAPPER
        ============================== */
        .form-wrapper {
            max-width: 820px;
            margin: 32px auto 60px;
            padding: 0 20px;
        }

        /* ==============================
           ALERT
        ============================== */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
            color: #dc2626;
            font-size: 13.5px;
        }

        .alert-error ul { padding-right: 20px; margin-top: 6px; }
        .alert-error li { margin-bottom: 4px; }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
            color: #166534;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ==============================
           FORM SECTIONS
        ============================== */
        .form-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .section-header {
            background: #f8faf9;
            border-bottom: 1px solid #e8f0eb;
            padding: 16px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header i {
            color: #1a5c38;
            font-size: 16px;
        }

        .section-header h3 {
            font-size: 15px;
            font-weight: 800;
            color: #0f3d24;
        }

        .section-body {
            padding: 22px;
        }

        /* ==============================
           FIELD GRID
        ============================== */
        .field-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 20px;
        }

        .field-full { grid-column: 1 / -1; }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .form-label .req { color: #ef4444; margin-right: 3px; }

        .form-control {
            background: #f8faf9;
            border: 1.5px solid #d1e8d8;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13.5px;
            font-family: 'Cairo', sans-serif;
            color: #1e293b;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .form-control:focus {
            border-color: #1a5c38;
            box-shadow: 0 0 0 3px rgba(26,92,56,0.08);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        .field-error {
            font-size: 12px;
            color: #ef4444;
            font-weight: 600;
            margin-top: 2px;
        }

        .field-hint {
            font-size: 11.5px;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* Photo upload */
        .photo-upload-wrap {
            border: 2px dashed #c8ddc4;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: #f8faf9;
            transition: border-color 0.2s;
            cursor: pointer;
            position: relative;
        }

        .photo-upload-wrap:hover { border-color: #1a5c38; }

        .photo-upload-wrap input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .photo-upload-wrap i {
            font-size: 28px;
            color: #a8c9a4;
            display: block;
            margin-bottom: 6px;
        }

        .photo-upload-wrap p {
            font-size: 12.5px;
            color: #9ca3af;
            font-weight: 600;
        }

        .photo-preview {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
            display: none;
        }

        /* ==============================
           SUBMIT BUTTON
        ============================== */
        .btn-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: linear-gradient(135deg, #1a5c38, #2d8a5a);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-size: 16px;
            font-weight: 800;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 4px 16px rgba(26,92,56,0.3);
        }

        .btn-submit:hover {
            opacity: 0.93;
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* ==============================
           NOTICE BOX
        ============================== */
        .notice-box {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 22px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            font-size: 13px;
            color: #92400e;
        }

        .notice-box i { color: #d97706; margin-top: 2px; flex-shrink: 0; }

        /* ==============================
           RESPONSIVE
        ============================== */
        @media (max-width: 640px) {
            .field-grid { grid-template-columns: 1fr; }
            .hero-title  { font-size: 22px; }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

<!-- Hero -->
<div class="hero-banner">
    <div class="hero-icon"><i class="fa fa-building-circle-arrow-right"></i></div>
    <h1 class="hero-title">{{ __('hall_request.page_title') }}</h1>
    <p class="hero-sub">{{ __('hall_request.page_sub') }}</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumb-row">
    <a href="{{ route('halls.list') }}"><i class="fa fa-home"></i> {{ __('hall_request.home') }}</a>
    <span class="sep"><i class="fa fa-angle-left"></i></span>
    <a href="{{ route('halls.list') }}">{{ __('hall_request.halls') }}</a>
    <span class="sep"><i class="fa fa-angle-left"></i></span>
    <span class="current">{{ __('hall_request.page_title') }}</span>
</div>

<!-- Main Form -->
<div class="form-wrapper">

    {{-- Success --}}
    @if(session('success'))
        <div class="alert-success">
            <i class="fa fa-circle-check fa-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Errors --}}
    @if($errors->any())
        <div class="alert-error">
            <strong><i class="fa fa-triangle-exclamation"></i> {{ __('hall_request.fix_errors') }}</strong>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Notice -->
    <div class="notice-box">
        <i class="fa fa-circle-info"></i>
        <div>{!! __('hall_request.review_notice') !!}</div>
    </div>

    <form action="{{ route('halls.request.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ====== SECTION 1: Basic Info ====== --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fa fa-circle-info"></i>
                <h3>{{ __('hall_request.sec_basic') }}</h3>
            </div>
            <div class="section-body">
                <div class="field-grid">

                    <div class="form-group field-full">
                        <label class="form-label">{{ __('hall_request.hall_name') }} <span class="req">{{ __('hall_request.required') }}</span></label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               value="{{ old('name') }}" placeholder="{{ __('hall_request.hall_name_ph') }}" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group field-full">
                        <label class="form-label">{{ __('hall_request.hall_desc') }}</label>
                        <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="{{ __('hall_request.hall_desc_ph') }}">{{ old('description') }}</textarea>
                        @error('description')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.city') }} <span class="req">{{ __('hall_request.required') }}</span></label>
                        <input type="text" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                               value="{{ old('city') }}" placeholder="{{ __('hall_request.city_ph') }}" required>
                        @error('city')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.address') }} <span class="req">{{ __('hall_request.required') }}</span></label>
                        <input type="text" name="location" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}"
                               value="{{ old('location') }}" placeholder="{{ __('hall_request.address_ph') }}" required>
                        @error('location')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- ====== SECTION 2: Capacity & Pricing ====== --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fa fa-chart-bar"></i>
                <h3>{{ __('hall_request.sec_capacity') }}</h3>
            </div>
            <div class="section-body">
                <div class="field-grid">

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.capacity') }} <span class="req">{{ __('hall_request.required') }}</span></label>
                        <input type="number" name="capacity" class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}"
                               value="{{ old('capacity') }}" min="1" placeholder="{{ __('hall_request.capacity_ph') }}" required>
                        @error('capacity')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.tables') }} <span class="req">{{ __('hall_request.required') }}</span></label>
                        <input type="number" name="max_tables" class="form-control {{ $errors->has('max_tables') ? 'is-invalid' : '' }}"
                               value="{{ old('max_tables') }}" min="1" placeholder="{{ __('hall_request.tables_ph') }}" required>
                        @error('max_tables')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.price_per_day') }} <span class="req">{{ __('hall_request.required') }}</span></label>
                        <input type="number" name="price_per_day" class="form-control {{ $errors->has('price_per_day') ? 'is-invalid' : '' }}"
                               value="{{ old('price_per_day') }}" min="0" step="0.01" placeholder="{{ __('hall_request.price_ph') }}" required>
                        @error('price_per_day')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.whatsapp') }}</label>
                        <input type="text" name="whatsapp_number" class="form-control {{ $errors->has('whatsapp_number') ? 'is-invalid' : '' }}"
                               value="{{ old('whatsapp_number') }}" placeholder="{{ __('hall_request.whatsapp_ph') }}">
                        @error('whatsapp_number')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- ====== SECTION 3: Photos ====== --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fa fa-images"></i>
                <h3>{{ __('hall_request.sec_photos') }}</h3>
            </div>
            <div class="section-body">
                <div class="field-grid">

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.profile_photo') }}</label>
                        <div class="photo-upload-wrap" onclick="">
                            <input type="file" name="profile_photo" accept="image/*" onchange="previewImage(this, 'prev-profile')">
                            <i class="fa fa-user-circle"></i>
                            <p>{{ __('hall_request.upload_profile_ph') }}</p>
                            <p style="font-size:11px; color:#c0ccc5;">{{ __('hall_request.photo_hint') }}</p>
                        </div>
                        <img id="prev-profile" class="photo-preview" src="" alt="">
                        @error('profile_photo')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.cover_photo') }}</label>
                        <div class="photo-upload-wrap">
                            <input type="file" name="cover_photo" accept="image/*" onchange="previewImage(this, 'prev-cover')">
                            <i class="fa fa-panorama"></i>
                            <p>{{ __('hall_request.upload_cover_ph') }}</p>
                            <p style="font-size:11px; color:#c0ccc5;">{{ __('hall_request.photo_hint') }}</p>
                        </div>
                        <img id="prev-cover" class="photo-preview" src="" alt="">
                        @error('cover_photo')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- ====== SECTION 4: Owner Info (pre-filled from auth) ====== --}}
        <div class="form-section">
            <div class="section-header">
                <i class="fa fa-user-tie"></i>
                <h3>{{ __('hall_request.sec_owner') }}</h3>
            </div>
            <div class="section-body">
                <div class="field-grid">
                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.name') }}</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                        <span class="field-hint">{{ __('hall_request.account_hint') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ __('hall_request.email') }}</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit">
            <i class="fa fa-paper-plane"></i>
            {{ __('hall_request.submit') }}
        </button>

    </form>
</div>

@include('partials.footer')

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>
