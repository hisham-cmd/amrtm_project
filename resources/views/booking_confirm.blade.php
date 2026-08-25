{{-- Hall booking form - redesigned --}}
<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('booking_confirm.page_title') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* === RESET & BASE === */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        /* Override global style.css flex+height:100% that blocks scrolling */
        html {
            height: auto !important;
            display: block !important;
            overflow-y: auto !important;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: #eef4f0 !important;
            color: #1e293b;
            min-height: 100vh;
            height: auto !important;
            display: block !important;
            overflow-y: auto !important;
        }

        /* === PAGE WRAPPER === */
        .booking-page {
            padding: 42px 16px 72px;
            min-height: calc(100vh - 200px);
            background:
                radial-gradient(circle at top right, rgba(46, 125, 84, 0.10), transparent 28%),
                linear-gradient(180deg, #f4faf6 0%, #edf5f0 100%);
        }

        .booking-layout {
            max-width: 1180px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 24px;
            align-items: start;
        }

        /* === FORM CONTAINER === */
        .booking-container {
            width: 100%;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(26, 92, 56, 0.08);
            box-shadow: 0 20px 55px rgba(15, 61, 36, 0.12);
        }

        .booking-aside {
            background: linear-gradient(180deg, #1a5c38 0%, #13442a 100%);
            color: #fff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 18px 45px rgba(15, 61, 36, 0.16);
            position: sticky;
            top: 110px;
            overflow: hidden;
        }

        .booking-aside::before {
            content: '';
            position: absolute;
            inset: auto -30px -50px auto;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .aside-label {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.92);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .aside-title {
            position: relative;
            z-index: 1;
            font-size: 25px;
            line-height: 1.4;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .aside-subtitle {
            position: relative;
            z-index: 1;
            color: rgba(255,255,255,0.80);
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .aside-stats {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 18px;
        }

        .aside-stat {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 16px;
            padding: 14px;
        }

        .aside-stat-value {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .aside-stat-label {
            font-size: 12px;
            color: rgba(255,255,255,0.76);
        }

        .aside-list {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 10px;
        }

        .aside-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .aside-item-label {
            color: rgba(255,255,255,0.74);
            font-size: 12px;
        }

        .aside-item-value {
            font-size: 13px;
            font-weight: 700;
            text-align: left;
        }

        /* === FORM HEADER BAR === */
        .booking-header {
            background: linear-gradient(135deg, #1a5c38 0%, #226a43 100%);
            padding: 22px 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .booking-header h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 800;
        }

        .booking-header i {
            color: rgba(255,255,255,0.75);
            font-size: 16px;
        }

        /* === FORM BODY === */
        .booking-body {
            padding: 34px 30px 38px;
            background: linear-gradient(180deg, #ffffff 0%, #fcfefd 100%);
        }

        /* === FORM GROUPS === */
        .form-group {
            margin-bottom: 20px;
        }

        .form-section-title {
            font-size: 15px;
            font-weight: 800;
            color: #163b27;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e8f4ec;
            color: #1a5c38;
            font-size: 12px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 7px;
        }

        .form-group label .req {
            color: #ef4444;
            margin-right: 2px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* === INPUTS === */
        .form-control {
            width: 100%;
            min-height: 52px;
            padding: 13px 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 14px;
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
            color: #1e293b;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: #1a5c38;
            box-shadow: 0 0 0 3px rgba(26, 92, 56, 0.10);
        }

        /* Select arrow */
        .select-wrap {
            position: relative;
        }

        .select-wrap::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 11px;
            pointer-events: none;
        }

        select.form-control {
            padding-left: 34px;
            cursor: pointer;
        }

        /* Hint below inputs */
        .input-hint {
            font-size: 11.5px;
            color: #6b7280;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .input-hint i {
            color: #9ca3af;
            font-size: 11px;
        }

        /* Textarea */
        textarea.form-control {
            resize: vertical;
            min-height: 132px;
        }

        /* === DIVIDER === */
        .form-divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 4px 0 22px;
        }

        .payment-panel {
            padding: 22px;
            border-radius: 20px;
            background: linear-gradient(180deg, #f6fbf7 0%, #eef7f1 100%);
            border: 1px solid #dbe9df;
            margin-bottom: 22px;
        }

        .payment-intro {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .payment-intro-copy h3 {
            font-size: 16px;
            font-weight: 800;
            color: #163b27;
            margin-bottom: 6px;
        }

        .payment-intro-copy p {
            font-size: 13px;
            line-height: 1.8;
            color: #587062;
            max-width: 560px;
        }

        .payment-badge {
            flex-shrink: 0;
            padding: 8px 12px;
            border-radius: 999px;
            background: #dff4e5;
            color: #1a5c38;
            font-size: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .payment-method-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .payment-method-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 92px;
            border-radius: 18px;
            background: #fff;
            border: 1.5px solid #dbe7de;
            color: #294a38;
            cursor: pointer;
            transition: transform 0.18s ease, border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
            text-align: center;
            padding: 12px 10px;
        }

        .payment-method-card i {
            font-size: 20px;
            color: #1a5c38;
        }

        .payment-method-card span {
            font-size: 12px;
            font-weight: 800;
        }

        .payment-method-card small {
            font-size: 11px;
            color: #6b7280;
        }

        .payment-method-input:checked + .payment-method-card {
            border-color: #1a5c38;
            background: #f3fbf6;
            box-shadow: 0 10px 22px rgba(26, 92, 56, 0.10);
            transform: translateY(-2px);
        }

        .payment-help {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .payment-fields-group {
            display: none;
            margin-top: 18px;
            animation: fadeSlideIn 0.22s ease;
        }

        .payment-fields-group.is-active {
            display: block;
        }

        .payment-group-title {
            font-size: 13px;
            font-weight: 800;
            color: #1a5c38;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .payment-group-title i {
            font-size: 12px;
        }

        .payment-method-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid #dbe7de;
            color: #476454;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .payment-method-chip strong {
            color: #1a5c38;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-note {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 14px;
            background: #fff;
            border: 1px dashed #c8dbce;
            color: #486455;
            font-size: 12px;
            line-height: 1.8;
        }

        /* === ACTION BUTTONS === */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #e5ece7;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: #1a5c38;
            color: #fff;
            padding: 14px 34px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            font-family: 'Cairo', sans-serif;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            text-decoration: none;
        }

        .btn-submit:hover {
            background: #155230;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 92, 56, 0.25);
        }

        .btn-submit .wa-icon {
            color: #4ade80;
            font-size: 16px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #fff;
            color: #374151;
            padding: 13px 28px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            border: 1.5px solid #d1d5db;
            cursor: pointer;
            font-family: 'Cairo', sans-serif;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }

        .btn-back:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        /* === FIX: Remove header diagonal clip on this page === */
        .top-bar {
            clip-path: none !important;
            padding-bottom: 10px !important;
        }

        /* === BREADCRUMB STEPS BAR === */
        .steps-trail {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 14px 5%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            flex-wrap: wrap;
        }

        .trail-step {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            color: #9ca3af;
            text-decoration: none;
            white-space: nowrap;
            transition: color 0.2s;
        }

        .trail-step.done {
            color: #1a5c38;
        }

        .trail-step.done:hover {
            color: #155230;
            text-decoration: underline;
        }

        .trail-step.active {
            color: #1a5c38;
            font-weight: 800;
        }

        .trail-step .step-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s;
        }

        .trail-step.done .step-num {
            background: #d1fae5;
            color: #1a5c38;
        }

        .trail-step.active .step-num {
            background: #1a5c38;
            color: #fff;
        }

        .trail-arrow {
            color: #d1d5db;
            font-size: 11px;
            margin: 0 10px;
            flex-shrink: 0;
        }

        /* === RESPONSIVE === */
        @media (max-width: 640px) {
            .booking-page    { padding: 24px 10px 52px; }
            .booking-body    { padding: 22px 16px 28px; }
            .booking-header  { padding: 16px 18px; }
            .booking-header h2 { font-size: 18px; }
            .form-row        { grid-template-columns: 1fr; gap: 0; }
            .payment-methods,
            .payment-help   { grid-template-columns: 1fr; }
            .payment-intro  { flex-direction: column; }
            .form-actions    { flex-direction: column-reverse; }
            .btn-submit,
            .btn-back        { width: 100%; justify-content: center; }
        }

        @media (max-width: 980px) {
            .booking-layout {
                grid-template-columns: 1fr;
            }

            .booking-aside {
                position: static;
                order: -1;
            }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

<!-- ===== BREADCRUMB STEPS ===== -->
<div class="steps-trail">
    <a href="/halls_list" class="trail-step done">
        <div class="step-num"><i class="fa fa-check" style="font-size:9px;"></i></div>
        <span>{{ __('booking_confirm.halls_list') }}</span>
    </a>
    <i class="fa {{ $dir === 'rtl' ? 'fa-angle-left' : 'fa-angle-right' }} trail-arrow"></i>
    <a href="{{ route('halls.show', ['hall' => $hall]) }}" class="trail-step done">
        <div class="step-num"><i class="fa fa-check" style="font-size:9px;"></i></div>
        <span>{{ __('booking_confirm.hall_details') }}</span>
    </a>
    <i class="fa {{ $dir === 'rtl' ? 'fa-angle-left' : 'fa-angle-right' }} trail-arrow"></i>
    <span class="trail-step active">
        <div class="step-num">3</div>
        <span>{{ __('booking_confirm.booking_confirm') }}</span>
    </span>
</div>

<div class="booking-page">
    <div class="booking-layout">

        <div class="booking-container">

        <!-- Header bar -->
        <div class="booking-header">
            <i class="fa fa-calendar-check"></i>
            <h2>{{ __('booking_confirm.header_title') }}: {{ $hall->name }}</h2>
        </div>

        <!-- Form body -->
        <div class="booking-body">
            <form id="hallBookingForm" method="POST" action="{{ route('halls.book', $hall) }}">
                @csrf

                @if($errors->any())
                <div style="background:#fef2f2; border:1px solid #fca5a5; border-radius:10px; padding:14px 18px; margin-bottom:18px; color:#b91c1c; font-size:13px;">
                    <ul style="margin:0; padding-right:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- اسم صاحب الحجز -->
                <div class="form-section-title">
                    <i class="fa fa-user"></i>
                    <span>{{ __('booking_confirm.sec_booking_data') }}</span>
                </div>
                <div class="form-group">
                    <label for="owner_name">{{ __('booking_confirm.owner_name') }} <span class="req">*</span></label>
                    <input id="owner_name" type="text" class="form-control" name="owner_name"
                           placeholder="{{ __('booking_confirm.owner_name_ph') }}" value="{{ old('owner_name') }}" required>
                </div>

                <hr class="form-divider">

                <!-- تاريخ الحجز  |  نوع المناسبة -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="booking_date">{{ __('booking_confirm.booking_date') }} <span class="req">*</span></label>
                        <input id="booking_date" type="text" class="form-control @error('booking_date') is-invalid @enderror"
                               name="booking_date" value="{{ old('booking_date') }}"
                               placeholder="{{ __('booking_confirm.booking_date_ph') }}" readonly required>
                        @error('booking_date')
                            <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                        @enderror
                        <div class="input-hint" id="date-busy-hint" style="display:none; color:#ef4444;">
                            <i class="fa fa-circle-xmark"></i>
                            {{ __('booking_confirm.busy_dates_hint') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="occasion_type">{{ __('booking_confirm.occasion_type') }} <span class="req">*</span></label>
                        <div class="select-wrap">
                            <select id="occasion_type" class="form-control" name="occasion_type" required>
                                <option value="" disabled {{ old('occasion_type') ? '' : 'selected' }}>{{ __('booking_confirm.occasion_ph') }}</option>
                                <option value="wedding"    {{ old('occasion_type') === 'wedding'    ? 'selected' : '' }}>{{ __('booking_confirm.wedding') }}</option>
                                <option value="engagement" {{ old('occasion_type') === 'engagement' ? 'selected' : '' }}>{{ __('booking_confirm.engagement') }}</option>
                                <option value="birthday"   {{ old('occasion_type') === 'birthday'   ? 'selected' : '' }}>{{ __('booking_confirm.birthday') }}</option>
                                <option value="corporate"  {{ old('occasion_type') === 'corporate'  ? 'selected' : '' }}>{{ __('booking_confirm.corporate') }}</option>
                                <option value="graduation" {{ old('occasion_type') === 'graduation' ? 'selected' : '' }}>{{ __('booking_confirm.graduation') }}</option>
                                <option value="meeting"    {{ old('occasion_type') === 'meeting'    ? 'selected' : '' }}>{{ __('booking_confirm.meeting') }}</option>
                                <option value="other"      {{ old('occasion_type') === 'other'      ? 'selected' : '' }}>{{ __('booking_confirm.other') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="form-divider">

                <!-- عدد الضيوف  |  عدد الطاولات -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="guests_count">{{ __('booking_confirm.guests_count') }} <span class="req">*</span></label>
                        <input id="guests_count" type="number" class="form-control"
                               name="guests_count" placeholder="{{ __('booking_confirm.guests_ph') }}"
                               value="{{ old('guests_count') }}"
                               min="1" max="{{ $hall->capacity }}" required>
                        <div class="input-hint">
                            <i class="fa fa-circle-info"></i>
                            {{ __('booking_confirm.guests_hint', ['count' => $hall->capacity]) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tables_count">{{ __('booking_confirm.tables_count') }} <span class="req">*</span></label>
                        <input id="tables_count" type="number" class="form-control"
                               name="tables_count" placeholder="{{ __('booking_confirm.tables_ph') }}"
                               value="{{ old('tables_count') }}"
                               min="1" max="{{ $hall->max_tables }}" required>
                        <div class="input-hint">
                            <i class="fa fa-circle-info"></i>
                            {{ __('booking_confirm.tables_hint', ['count' => $hall->max_tables]) }}
                        </div>
                    </div>
                </div>

                <hr class="form-divider">

                <div class="form-section-title">
                    <i class="fa fa-credit-card"></i>
                    <span>{{ __('booking_confirm.sec_payment') }}</span>
                </div>

                <div class="payment-panel">
                    <div class="payment-intro">
                        <div class="payment-intro-copy">
                            <h3>{{ __('booking_confirm.payment_title') }}</h3>
                            <p>{{ __('booking_confirm.payment_desc') }}</p>
                        </div>
                        <div class="payment-badge">
                            <i class="fa fa-shield-halved"></i>
                            <span>{{ __('booking_confirm.payment_badge') }}</span>
                        </div>
                    </div>

                    <div class="payment-methods">
                        <label>
                            <input class="payment-method-input" type="radio" name="payment_method" value="mada" {{ old('payment_method', 'mada') === 'mada' ? 'checked' : '' }}>
                            <span class="payment-method-card">
                                <i class="fa fa-credit-card"></i>
                                <span>مدى</span>
                                <small>{{ __('booking_confirm.local_card') }}</small>
                            </span>
                        </label>
                        <label>
                            <input class="payment-method-input" type="radio" name="payment_method" value="visa" {{ old('payment_method') === 'visa' ? 'checked' : '' }}>
                            <span class="payment-method-card">
                                <i class="fa fa-credit-card"></i>
                                <span>Visa</span>
                                <small>{{ __('booking_confirm.intl_card') }}</small>
                            </span>
                        </label>
                        <label>
                            <input class="payment-method-input" type="radio" name="payment_method" value="mastercard" {{ old('payment_method') === 'mastercard' ? 'checked' : '' }}>
                            <span class="payment-method-card">
                                <i class="fa fa-credit-card"></i>
                                <span>Mastercard</span>
                                <small>{{ __('booking_confirm.intl_card') }}</small>
                            </span>
                        </label>
                        <label>
                            <input class="payment-method-input" type="radio" name="payment_method" value="apple_pay" {{ old('payment_method') === 'apple_pay' ? 'checked' : '' }}>
                            <span class="payment-method-card">
                                <i class="fa-brands fa-apple-pay"></i>
                                <span>Apple Pay</span>
                                <small>{{ __('booking_confirm.digital_wallet') }}</small>
                            </span>
                        </label>
                        <label>
                            <input class="payment-method-input" type="radio" name="payment_method" value="stc_pay" {{ old('payment_method') === 'stc_pay' ? 'checked' : '' }}>
                            <span class="payment-method-card">
                                <i class="fa fa-mobile-screen-button"></i>
                                <span>stc pay</span>
                                <small>{{ __('booking_confirm.digital_wallet') }}</small>
                            </span>
                        </label>
                    </div>
                    @error('payment_method')
                        <div style="color:#ef4444; font-size:12px; margin:-6px 0 12px;">{{ $message }}</div>
                    @enderror

                    <div class="payment-fields-group" data-payment-fields="mada visa mastercard">
                        <div class="payment-group-title">
                            <i class="fa fa-credit-card"></i>
                            <span>{{ __('booking_confirm.card_data_title') }}</span>
                        </div>
                        <div class="payment-method-chip"><span>{{ __('booking_confirm.selected_method') }}</span> <strong data-payment-chip>{{ __('booking_confirm.card_default') }}</strong></div>
                        <div class="payment-help">
                            <div class="form-group" style="margin-bottom:0;">
                                <label for="payment_contact">{{ __('booking_confirm.last4_label') }}</label>
                                <input id="payment_contact" type="text" class="form-control @error('payment_contact') is-invalid @enderror"
                                       name="payment_contact" value="{{ old('payment_contact') }}"
                                       placeholder="{{ __('booking_confirm.last4_ph') }}">
                                @error('payment_contact')
                                    <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom:0;">
                                <label for="payment_email">{{ __('booking_confirm.billing_email') }}</label>
                                <input id="payment_email" type="email" class="form-control @error('payment_email') is-invalid @enderror"
                                       name="payment_email" value="{{ old('payment_email') }}"
                                       placeholder="name@example.com">
                                @error('payment_email')
                                    <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" style="margin:16px 0 0;">
                            <label for="payment_reference">{{ __('booking_confirm.cardholder') }}</label>
                            <input id="payment_reference" type="text" class="form-control @error('payment_reference') is-invalid @enderror"
                                   name="payment_reference" value="{{ old('payment_reference') }}"
                                   placeholder="{{ __('booking_confirm.cardholder_ph') }}">
                            @error('payment_reference')
                                <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="payment-fields-group" data-payment-fields="apple_pay">
                        <div class="payment-group-title">
                            <i class="fa-brands fa-apple-pay"></i>
                            <span>{{ __('booking_confirm.apple_pay_title') }}</span>
                        </div>
                        <div class="payment-method-chip"><span>{{ __('booking_confirm.selected_method') }}</span> <strong>Apple Pay</strong></div>
                        <div class="payment-help" style="grid-template-columns:1fr;">
                            <div class="form-group" style="margin-bottom:0;">
                                <label for="payment_email_apple">{{ __('booking_confirm.apple_email') }}</label>
                                <input id="payment_email_apple" type="email" class="form-control @error('payment_email') is-invalid @enderror"
                                       name="payment_email" value="{{ old('payment_email') }}"
                                       placeholder="appleid@example.com">
                                @error('payment_email')
                                    <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" style="margin:16px 0 0;">
                            <label for="payment_reference_apple">{{ __('booking_confirm.apple_reference') }}</label>
                            <input id="payment_reference_apple" type="text" class="form-control @error('payment_reference') is-invalid @enderror"
                                   name="payment_reference" value="{{ old('payment_reference') }}"
                                   placeholder="{{ __('booking_confirm.apple_reference_ph') }}">
                            @error('payment_reference')
                                <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="payment-fields-group" data-payment-fields="stc_pay">
                        <div class="payment-group-title">
                            <i class="fa fa-mobile-screen-button"></i>
                            <span>{{ __('booking_confirm.stc_title') }}</span>
                        </div>
                        <div class="payment-method-chip"><span>{{ __('booking_confirm.selected_method') }}</span> <strong>stc pay</strong></div>
                        <div class="payment-help">
                            <div class="form-group" style="margin-bottom:0;">
                                <label for="payment_contact_stc">{{ __('booking_confirm.stc_phone') }}</label>
                                <input id="payment_contact_stc" type="text" class="form-control @error('payment_contact') is-invalid @enderror"
                                       name="payment_contact" value="{{ old('payment_contact') }}"
                                       placeholder="05xxxxxxxx">
                                @error('payment_contact')
                                    <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom:0;">
                                <label for="payment_reference_stc">{{ __('booking_confirm.stc_owner') }}</label>
                                <input id="payment_reference_stc" type="text" class="form-control @error('payment_reference') is-invalid @enderror"
                                       name="payment_reference" value="{{ old('payment_reference') }}"
                                       placeholder="{{ __('booking_confirm.stc_owner_ph') }}">
                                @error('payment_reference')
                                    <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" style="margin:16px 0 0;">
                            <label for="payment_email_stc">{{ __('booking_confirm.stc_email') }}</label>
                            <input id="payment_email_stc" type="email" class="form-control @error('payment_email') is-invalid @enderror"
                                   name="payment_email" value="{{ old('payment_email') }}"
                                   placeholder="{{ __('booking_confirm.stc_email_ph') }}">
                            @error('payment_email')
                                <div style="color:#ef4444; font-size:12px; margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="payment-note">
                        <strong>{{ __('booking_confirm.payment_note_label') }}</strong>
                        {{ __('booking_confirm.payment_note') }}
                    </div>
                </div>

                <!-- ملاحظات -->
                <div class="form-group">
                    <label for="booking_notes">{{ __('booking_confirm.notes') }}</label>
                    <textarea id="booking_notes" class="form-control" name="notes"
                              placeholder="{{ __('booking_confirm.notes_ph') }}">{{ old('notes') }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa fa-credit-card"></i>
                        {{ __('booking_confirm.submit') }}
                    </button>
                    <a href="javascript:history.back()" class="btn-back">
                        {{ __('booking_confirm.back') }}
                    </a>
                </div>

            </form>
        </div>

        </div>

        <aside class="booking-aside">
            <div class="aside-label">
                <i class="fa fa-sparkles"></i>
                <span>{{ __('booking_confirm.aside_label') }}</span>
            </div>

            <h3 class="aside-title">{{ $hall->name }}</h3>
            <p class="aside-subtitle">{{ __('booking_confirm.aside_desc') }}</p>

            <div class="aside-stats">
                <div class="aside-stat">
                    <div class="aside-stat-value">{{ $hall->capacity }}</div>
                    <div class="aside-stat-label">{{ __('booking_confirm.max_capacity') }}</div>
                </div>
                <div class="aside-stat">
                    <div class="aside-stat-value">{{ $hall->max_tables }}</div>
                    <div class="aside-stat-label">{{ __('booking_confirm.tables_label') }}</div>
                </div>
            </div>

            <div class="aside-list">
                <div class="aside-item">
                    <span class="aside-item-label">{{ __('booking_confirm.city') }}</span>
                    <span class="aside-item-value">{{ $hall->city ?: __('booking_confirm.unspecified') }}</span>
                </div>
                <div class="aside-item">
                    <span class="aside-item-label">{{ __('booking_confirm.daily_price') }}</span>
                    <span class="aside-item-value">{{ number_format((float) $hall->price_per_day, 2) }} {{ __('booking_confirm.sar') }}</span>
                </div>
                <div class="aside-item">
                    <span class="aside-item-label">{{ __('booking_confirm.unavailable_days') }}</span>
                    <span class="aside-item-value">{{ count($disabledDates) }}</span>
                </div>
                <div class="aside-item">
                    <span class="aside-item-label">{{ __('booking_confirm.contact') }}</span>
                    <span class="aside-item-value">{{ $hall->whatsapp_number ?: __('booking_confirm.not_available') }}</span>
                </div>
            </div>
        </aside>

    </div>
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    /* Disabled dates injected from server */
    const disabledDates = @json($disabledDates);

    const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
    const paymentFieldGroups = document.querySelectorAll('[data-payment-fields]');
    const paymentChipTargets = document.querySelectorAll('[data-payment-chip]');

    function togglePaymentFields() {
        const selectedInput = document.querySelector('input[name="payment_method"]:checked');
        const selectedMethod = selectedInput ? selectedInput.value : null;
        const selectedLabel = selectedInput ? selectedInput.parentElement.querySelector('.payment-method-card span')?.textContent?.trim() : '';

        paymentFieldGroups.forEach((group) => {
            const allowedMethods = group.dataset.paymentFields.split(' ');
            const isActive = selectedMethod && allowedMethods.includes(selectedMethod);

            group.classList.toggle('is-active', isActive);

            group.querySelectorAll('input').forEach((input) => {
                input.disabled = !isActive;

                if (!isActive) {
                    input.required = false;
                }
            });
        });

        paymentChipTargets.forEach((target) => {
            target.textContent = selectedLabel || '{{ __('booking_confirm.card_default') }}';
        });

        if (selectedMethod === 'apple_pay') {
            const appleEmail = document.getElementById('payment_email_apple');
            if (appleEmail) appleEmail.required = true;
        }

        if (selectedMethod === 'stc_pay') {
            const stcContact = document.getElementById('payment_contact_stc');
            const stcReference = document.getElementById('payment_reference_stc');
            if (stcContact) stcContact.required = true;
            if (stcReference) stcReference.required = true;
        }

        if (selectedMethod && ['mada', 'visa', 'mastercard'].includes(selectedMethod)) {
            const cardContact = document.getElementById('payment_contact');
            const cardReference = document.getElementById('payment_reference');
            if (cardContact) cardContact.required = true;
            if (cardReference) cardReference.required = true;
        }
    }

    paymentMethodInputs.forEach((input) => {
        input.addEventListener('change', togglePaymentFields);
    });

    togglePaymentFields();

    flatpickr('#booking_date', {
        dateFormat: 'Y-m-d',
        minDate: 'today',
        disable: disabledDates,
        @if($locale === 'ar')
        locale: {
            firstDayOfWeek: 6,
            weekdays: { shorthand: ['أح','إث','ث','أر','خ','ج','س'], longhand: ['الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت'] },
            months: { shorthand: ['ينا','فبر','مار','أبر','ماي','يون','يول','أغس','سبت','أكت','نوف','ديس'], longhand: ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'] },
        },
        @endif
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            // Extra visual hint for disabled days handled by flatpickr automatically
        }
    });
</script>

</body>
</html>