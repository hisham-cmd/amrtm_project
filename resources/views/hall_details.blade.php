<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل القاعة | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            background: #f0f4f2;
            min-height: 100vh;
            color: #1e293b;
        }

        /* Header styles are in partials/header.blade.php */

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

        .trail-step.done              { color: #1a5c38; }
        .trail-step.done:hover        { color: #155230; text-decoration: underline; }
        .trail-step.active            { color: #1a5c38; font-weight: 800; }

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

        .trail-step.done   .step-num  { background: #d1fae5; color: #1a5c38; }
        .trail-step.active .step-num  { background: #1a5c38; color: #fff; }

        .trail-arrow {
            color: #d1d5db;
            font-size: 11px;
            margin: 0 10px;
            flex-shrink: 0;
        }

        /* ==============================
           HERO BANNER — full width
        ============================== */
        .hall-hero {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: #0f3d24;
        }

        .hall-hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=1400&h=500&fit=crop');
            background-size: cover;
            background-position: center;
            filter: brightness(0.42);
            transition: filter 0.4s;
        }

        /* Gradient fade: dark at bottom for content legibility */
        .hall-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0,0,0,0.05) 0%,
                rgba(0,0,0,0.55) 100%
            );
            pointer-events: none;
        }

        .hall-hero-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 0 5% 24px;
            gap: 16px;
        }

        /* Hall identity: avatar + name */
        .hero-identity {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .hero-avatar {
            width: 72px;
            height: 72px;
            border-radius: 16px;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.9);
            box-shadow: 0 4px 16px rgba(0,0,0,0.35);
            flex-shrink: 0;
        }

        .hero-text { text-align: {{ $dir === 'rtl' ? 'right' : 'left' }}; }

        .hero-hall-name {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.6);
            line-height: 1.2;
        }

        .hero-hall-type {
            font-size: 14px;
            color: #a7f3d0;
            font-weight: 600;
            margin-top: 3px;
        }

        /* QR — top-left corner */
        .hero-qr {
            position: absolute;
            top: 18px;
            @if($dir === 'rtl') left: 5%; @else right: 5%; @endif
            background: #ffffff;
            border-radius: 18px;
            padding: 14px 14px 10px;
            width: 164px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0;
            box-shadow:
                0 8px 32px rgba(0,0,0,0.30),
                0 2px 8px  rgba(0,0,0,0.12),
                0 0 0 3px #1a5c38,
                0 0 0 5px rgba(255,255,255,0.9);
            z-index: 2;
            text-decoration: none;
        }

        .hero-qr img {
            width: 132px;
            height: 132px;
            display: block;
            border-radius: 6px;
        }

        .hero-qr svg {
            width: 132px;
            height: 132px;
            display: block;
            border-radius: 6px;
            background: #ffffff;
        }

        .hero-qr-divider {
            width: 80%;
            height: 1px;
            background: linear-gradient(to right, transparent, #c8ddc4, transparent);
            margin: 8px 0 6px;
        }

        .hero-qr-label {
            font-size: 10px;
            font-weight: 700;
            color: #1a5c38;
            letter-spacing: 0.06em;
            text-align: center;
            font-family: 'Cairo', sans-serif;
            margin-bottom: 2px;
        }

        /* ==============================
           BOOK NOW BUTTON
        ============================== */
        .book-now-wrap {
            background: #e8f5e9;
            padding: 20px 5% 0;
            position: relative;
        }

        .book-now-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: linear-gradient(135deg, #2d6a4f, #1a5c38);
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            font-family: 'Cairo', sans-serif;
            padding: 18px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }

        .book-now-btn:hover {
            background: linear-gradient(135deg, #1a5c38, #0f3d24);
            transform: none;
        }

        .book-now-btn i {
            font-size: 20px;
        }

        /* ==============================
           MAIN CONTENT AREA
        ============================== */
        .main-area {
            background: #e8f5e9;
            padding: 14px 5% 40px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ==============================
           SECTION CARD
        ============================== */
        .section-card {
            background: #c8ddc4;
            border-radius: 16px;
            padding: 18px 22px;
            border: 1px solid #a8c9a4;
            margin-bottom: 12px;
        }

        .section-card:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: #0f3d24;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: flex-end;
        }

        .section-title i {
            color: #2d6a4f;
            font-size: 15px;
        }

        /* ==============================
           INFO GRID
        ============================== */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .info-cell {
            background: #fff;
            border-radius: 10px;
            padding: 12px 14px;
            text-align: center;
        }

        .info-cell-label {
            font-size: 11px;
            font-weight: 700;
            color: #2d6a4f;
            margin-bottom: 4px;
        }

        .info-cell-value {
            font-size: 14px;
            font-weight: 700;
            color: #0f3d24;
        }

        /* ==============================
           MEDIA SECTION (sidebar)
        ============================== */
        .sidebar-col .section-card {
            margin-bottom: 18px;
        }

        .media-empty {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            padding: 20px 0;
        }

        .media-gallery {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .media-gallery-item {
            display: block;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid rgba(15, 61, 36, 0.08);
            box-shadow: 0 8px 20px rgba(15, 61, 36, 0.08);
        }

        .media-gallery-item:first-child {
            grid-column: 1 / -1;
        }

        .media-gallery-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
        }

        .media-gallery-item:first-child .media-gallery-image {
            height: 180px;
        }

        /* ==============================
           PRICE SECTION
        ============================== */
        .price-main-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .price-desc {
            font-size: 13px;
            color: #475569;
            font-weight: 500;
            flex: 1;
            text-align: right;
        }

        .price-badge {
            background: #fff;
            border-radius: 10px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .price-badge .price-label {
            font-size: 11px;
            color: #2d6a4f;
            font-weight: 700;
        }

        .price-badge .price-value {
            font-size: 16px;
            color: #0f3d24;
            font-weight: 800;
        }

        .price-badge i {
            color: #2d6a4f;
        }

        /* ==============================
           SPECIAL OFFERS
        ============================== */
        .offers-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .offer-card {
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 60%, #2d6a4f 100%);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(15,61,36,0.25);
            position: relative;
        }

        .offer-card-inner {
            padding: 16px 18px 12px;
        }

        .offer-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .offer-title {
            font-size: 17px;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }

        .offer-discount-badge {
            background: #fbbf24;
            color: #78350f;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
        }

        .offer-services {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 10px;
        }

        .offer-service-tag {
            background: rgba(255,255,255,0.18);
            color: #fff;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .offer-description {
            margin-top: 10px;
            font-size: 13px;
            color: rgba(255,255,255,0.85);
            line-height: 1.6;
            background: rgba(0,0,0,0.15);
            border-radius: 8px;
            padding: 8px 12px;
        }

        .offer-dates-bar {
            background: rgba(0,0,0,0.2);
            padding: 7px 18px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #a7f3d0;
        }

        .offer-active-dot {
            position: absolute;
            top: 12px;
            left: 14px;
            background: #fbbf24;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(251,191,36,0.3);
        }

        /* ==============================
           SEASONAL PRICES
        ============================== */
        .seasonal-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 12px;
        }

        .seasonal-item {
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 60%, #2d6a4f 100%);
            border-radius: 14px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(15,61,36,0.18);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .seasonal-item::before { display: none; }

        .seasonal-item-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px 6px;
            gap: 8px;
        }

        .seasonal-item-badge {
            background: rgba(255,255,255,0.15);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 700;
            color: #a7f3d0;
            letter-spacing: 0.04em;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .seasonal-item-num {
            font-size: 10px;
            font-weight: 800;
            color: rgba(255,255,255,0.4);
        }

        .seasonal-item-price {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            padding: 4px 14px 2px;
            line-height: 1.1;
            text-align: right;
        }

        .seasonal-item-price span {
            font-size: 12px;
            font-weight: 600;
            color: #a7f3d0;
            margin-right: 3px;
        }

        .seasonal-item-dates {
            background: rgba(0,0,0,0.2);
            padding: 7px 14px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #d1fae5;
            direction: rtl;
        }

        .seasonal-item-dates i {
            color: #6ee7b7;
            font-size: 11px;
            flex-shrink: 0;
        }

        /* ==============================
           FEATURES SECTION
        ============================== */
        .features-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .feature-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #0f3d24;
        }

            .feature-tag.special {
                background: #fffbe6;
                border: 1.5px solid #f7c948;
                color: #b38600;
                box-shadow: 0 2px 8px rgba(247,201,72,0.08);
            }

            .feature-tag.special i {
                color: #f7c948;
                font-size: 15px;
            }

        .feature-tag i {
            color: #2d6a4f;
            font-size: 14px;
        }

        .features-empty {
            color: #64748b;
            font-size: 13px;
            text-align: right;
        }

        /* Footer styles are in partials/footer.blade.php */

        /* ==============================
           RESPONSIVE
        ============================== */
        @media (max-width: 900px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hall-hero          { height: 200px; }
            .hero-hall-name     { font-size: 20px; }
            .hero-qr            { width: 128px; padding: 10px 10px 6px; @if($dir === 'rtl') left: 5%; right: auto; @else right: 5%; left: auto; @endif }
            .hero-qr img,
            .hero-qr svg        { width: 104px; height: 104px; }
        }

        @media (max-width: 600px) {
            .top-site-name      { display: none; }
            .hall-hero          { height: 180px; }
            .hero-avatar        { width: 54px; height: 54px; }
            .hero-hall-name     { font-size: 18px; }
            .hero-qr            { width: 108px; padding: 8px 8px 5px; top: 10px; @if($dir === 'rtl') left: 5%; right: auto; @else right: 5%; left: auto; @endif }
            .hero-qr img,
            .hero-qr svg        { width: 88px; height: 88px; }
            .info-grid          { grid-template-columns: repeat(2, 1fr); }
            .main-area          { padding: 18px 4% 40px; }
            .book-now-btn       { font-size: 16px; padding: 15px; }
        }
    </style>
</head>
<body>

@include('partials.header')
{{-- @include('partials.sponsors_bar') --}}
@include('partials.sidebar_nav')
{{-- @include('partials.partners_bar')  --}}

<!-- ===== BREADCRUMB STEPS ===== -->
<div class="steps-trail">
    <a href="/halls_list" class="trail-step done">
        <div class="step-num"><i class="fa fa-check" style="font-size:9px;"></i></div>
        <span>{{ __('hall_details.halls_list') }}</span>
    </a>
    <i class="fa fa-angle-left trail-arrow"></i>
    <span class="trail-step active">
        <div class="step-num">2</div>
        <span id="bc-hall-name">{{ __('hall_details.hall_details') }}</span>
    </span>
    <i class="fa fa-angle-left trail-arrow"></i>
    <span class="trail-step">
        <div class="step-num">3</div>
        <span>{{ __('hall_details.booking_confirm') }}</span>
    </span>
</div>

<!-- ============ HALL HERO ============ -->
<div class="hall-hero">
    <div class="hall-hero-bg" id="bannerBg"></div>

    <!-- QR — top left (LTR) / top right (RTL) -->
    <a href="{{ $hallQrCodeUrl }}"
       class="hero-qr"
       title="{{ __('hall_details.download_qr') }}"
       download="{{ \Illuminate\Support\Str::slug($hall->name, '-') ?: 'hall' }}-qr.svg">
        {!! $hallQrCodeSvg !!}
        <div class="hero-qr-divider"></div>
        <span class="hero-qr-label">{{ __('hall_details.scan_to_book') }}</span>
    </a>

    <!-- Hall name + avatar — bottom right -->
    <div class="hall-hero-content">
        <div class="hero-identity">
            <img id="bannerAvatar"
                 src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=200&h=200&fit=crop"
                 alt="صورة القاعة"
                 class="hero-avatar">
            <div class="hero-text">
                <div class="hero-hall-name" id="bannerName">لمسات</div>
                <div class="hero-hall-type" id="bannerType">قاعة الافراح</div>
            </div>
        </div>
    </div>
</div>


<!-- ============ MAIN CONTENT ============ -->
<div class="main-area">
    <div class="content-grid">
        
        <!-- ===== RIGHT COLUMN (main info) ===== -->
        <div class="main-col">

            <!-- Hall Information -->
            <div class="section-card">
                <div class="section-title">
                    {{ __('hall_details.hall_info') }}
                    <i class="fa fa-circle-info"></i>
                </div>
                <div class="info-grid">
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-flag" style="margin-left:4px;"></i>{{ __('hall_details.country') }}</div>
                        <div class="info-cell-value" id="infoCountry">السعودية</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-city" style="margin-left:4px;"></i>{{ __('hall_details.city') }}</div>
                        <div class="info-cell-value" id="infoCity">الرياض</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-map" style="margin-left:4px;"></i>{{ __('hall_details.district') }}</div>
                        <div class="info-cell-value" id="infoDistrict">حي اليرموك</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-phone" style="margin-left:4px;"></i>{{ __('hall_details.phone') }}</div>
                        <div class="info-cell-value" id="infoPhone">0504915222</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-road" style="margin-left:4px;"></i>{{ __('hall_details.street') }}</div>
                        <div class="info-cell-value" id="infoStreet">حي الحمراء</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-location-dot" style="margin-left:4px;"></i>{{ __('hall_details.national_address') }}</div>
                        <div class="info-cell-value" id="infoNationalAddr">9512357</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-table" style="margin-left:4px;"></i>{{ __('hall_details.tables_count') }}</div>
                        <div class="info-cell-value" id="infoTables">30</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-chair" style="margin-left:4px;"></i>{{ __('hall_details.chairs_count') }}</div>
                        <div class="info-cell-value" id="infoChairs">200</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-envelope" style="margin-left:4px;"></i>{{ __('hall_details.email') }}</div>
                        <div class="info-cell-value" style="font-size:12px;" id="infoEmail">salehalshamrani@hotmail.com</div>
                    </div>
                </div>
            </div>

            <!-- Official Price -->
            <div class="section-card">
                <div class="section-title">
                    {{ __('hall_details.official_price') }}
                    <i class="fa fa-tag"></i>
                </div>
                <div class="price-main-row">
                    <div class="price-badge">
                        <i class="fa fa-money-bill-wave"></i>
                        <div>
                            <div class="price-label">{{ __('hall_details.official_price') }}</div>
                            <div class="price-value" id="infoOfficialPrice">0.00 ريال</div>
                        </div>
                    </div>
                    <div class="price-desc">{{ __('hall_details.base_price_desc') }}</div>
                </div>
            </div>

            <!-- Seasonal Prices -->
            <div class="section-card">
                <div class="section-title">
                    {{ __('hall_details.seasonal_prices') }}
                    <i class="fa fa-tag"></i>
                </div>
                <ul class="seasonal-list" id="seasonalPricesList"></ul>
            </div>

            <!-- Special Offers -->
            <div class="section-card" id="offersCard" style="display:none;">
                <div class="section-title">
                    {{ __('hall_details.special_offers') }}
                    <i class="fa fa-gift"></i>
                </div>
                <div id="offersList"></div>
            </div>

            <!-- Hall Features -->
            <div class="section-card">
                <div class="section-title">
                    {{ __('hall_details.hall_features') }}
                    <i class="fa fa-star"></i>
                </div>
                <div class="features-grid">
                    @if($hall->features->isNotEmpty())
                        @foreach($hall->features as $feature)
                            <span class="feature-tag">
                                <i class="fa fa-check-circle" style="color:#16a34a;font-size:15px;margin-left:4px;"></i>
                                @if($feature->icon)
                                    <i class="fa {{ $feature->icon }}"></i>
                                @endif
                                {{ $feature->name }}
                            </span>
                        @endforeach
                    @else
                        <div class="features-empty">{{ __('hall_details.no_features') }}</div>
                    @endif
                </div>
            </div>

                        <div class="section-card">
                <div class="section-title">
                    {{ __('hall_details.extra_features') }}
                    <i class="fa fa-star"></i>
                </div>
                    <div class="features-grid">
                        @if($hall->additionalFeatures->isNotEmpty())
                            @foreach($hall->additionalFeatures as $feature)
                                <span class="feature-tag special">
                                    <i class="fa fa-crown"></i>
                                    @if($feature->icon)
                                        <i class="fa {{ $feature->icon }}"></i>
                                    @endif
                                    {{ $feature->name }}
                                </span>
                            @endforeach
                        @else
                            <div class="features-empty">{{ __('hall_details.no_extra_features') }}</div>
                        @endif
                    </div>
            </div>

        </div><!-- /.main-col -->
        
        <!-- ===== LEFT COLUMN (sidebar) ===== -->
        <div class="sidebar-col">

            <!-- Media Section -->
            <div class="section-card">
                <div class="section-title">
                    {{ __('hall_details.hall_media') }}
                    <i class="fa fa-photo-film"></i>
                </div>
                @if($hall->media->isNotEmpty())
                <div class="media-gallery" id="mediaContent">
                        @foreach($hall->media as $item)
                            <a href="{{ asset('storage/' . $item->file_path) }}" class="media-gallery-item" target="_blank" rel="noopener noreferrer" aria-label="{{ __('hall_details.view_image') }} {{ $loop->iteration }}">
                                <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ __('hall_details.hall_image_alt') }} {{ $loop->iteration }}" class="media-gallery-image" loading="lazy">
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="media-empty" id="mediaContent">
                        {{ __('hall_details.no_media') }}
                    </div>
                @endif
            </div>

        </div><!-- /.sidebar-col -->

    </div><!-- /.content-grid -->
</div><!-- /.main-area -->

<!-- ============ BOOK NOW BUTTON ============ -->
<div class="book-now-wrap" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
    <a href="{{ route('halls.booking', ['hall' => $hall->id]) }}" class="book-now-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">
        <i class="fa fa-calendar-check"></i>
        {{ __('hall_details.book_now') }}
    </a>
    @auth
    <button type="button" onclick="document.getElementById('hall-cart-modal').style.display='flex'"
            style="display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:14px 28px;border-radius:14px;background:#f0fdf4;color:#1a5c38;border:2px solid #a8c9a4;font-family:'Cairo',sans-serif;font-size:15px;font-weight:800;cursor:pointer;transition:background .2s;"
            onmouseover="this.style.background='#d1fae5'" onmouseout="this.style.background='#f0fdf4'">
        <i class="fa fa-cart-plus"></i> {{ __('hall_details.add_to_cart') }}
    </button>
    @else
    <a href="{{ route('login') }}"
       style="display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:14px 28px;border-radius:14px;background:#f0fdf4;color:#1a5c38;border:2px solid #a8c9a4;font-family:'Cairo',sans-serif;font-size:15px;font-weight:800;text-decoration:none;">
        <i class="fa fa-cart-plus"></i> {{ __('hall_details.add_to_cart') }}
    </a>
    @endauth
</div>
<br>

@include('partials.footer')

{{-- Hall Cart Modal --}}
@auth
<div id="hall-cart-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:20px;padding:28px;max-width:400px;width:92%;font-family:'Cairo',sans-serif;direction:rtl;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h3 style="font-size:16px;font-weight:800;color:#0f3d24;"><i class="fa fa-cart-plus" style="margin-left:8px;color:#2d6a4f;"></i>أضف القاعة للسلة</h3>
            <button onclick="document.getElementById('hall-cart-modal').style.display='none'"
                    style="background:none;border:none;font-size:20px;cursor:pointer;color:#9ca3af;line-height:1;">×</button>
        </div>
        <div style="background:#f0faf4;border-radius:12px;padding:12px 14px;margin-bottom:18px;">
            <div style="font-size:13px;font-weight:800;color:#0f3d24;">{{ $hall->name }}</div>
            <div style="font-size:12px;color:#6c7a72;margin-top:3px;">{{ number_format((float)$hall->price_per_day, 2) }} ريال</div>
        </div>
        <form method="POST" action="{{ route('cart.add') }}" id="hall-cart-form">
            @csrf
            <input type="hidden" name="item_type" value="hall">
            <input type="hidden" name="item_id" value="{{ $hall->id }}">
            <input type="hidden" name="event_date" id="hall-event-date-hidden">
            <div style="margin-bottom:20px;">
                <label style="font-size:12.5px;font-weight:700;color:#0f3d24;display:block;margin-bottom:7px;">
                    <i class="fa fa-calendar" style="margin-left:5px;color:#2d6a4f;"></i>تاريخ المناسبة
                </label>
                <input type="date" name="event_date" id="hall-event-month" min="{{ date('Y-m-d') }}"
                       style="width:100%;padding:11px;border-radius:10px;border:1.5px solid #a8c9a4;font-family:'Cairo';font-size:14px;outline:none;color:#0f3d24;">
                <div style="font-size:11px;color:#9ca3af;margin-top:5px;">البيانات الشخصية ستُسحب من حسابك تلقائياً</div>
            </div>
            <button type="submit"
                    style="display:flex;align-items:center;justify-content:center;gap:9px;width:100%;padding:13px;border-radius:12px;background:#1a5c38;color:#fff;font-family:'Cairo',sans-serif;font-size:14px;font-weight:800;border:none;cursor:pointer;">
                <i class="fa fa-cart-plus"></i> أضف للسلة
            </button>
        </form>
    </div>
</div>
@endauth

<script>
    const hallData = {
        name: @json($hall->name),
        type: 'قاعة أفراح',
        country: 'السعودية',
        city: @json($hall->city),
        district: @json($hall->location),
        phone: @json($hall->whatsapp_number ?? '—'),
        street: @json($hall->location),
        nationalAddr: '—',
        tables: @json((string) $hall->max_tables),
        chairs: @json((string) $hall->capacity),
        email: '',
        officialPrice: @json(number_format((float)$hall->price_per_day, 2) . ' ريال'),
        profileImage: @json($hall->profile_photo ? route('public.storage', ['path' => $hall->profile_photo]) : ($hall->media->first() ? route('public.storage', ['path' => $hall->media->first()->file_path]) : asset('images/hall-placeholder.svg'))),
        coverImage: @json($hall->cover_photo ? route('public.storage', ['path' => $hall->cover_photo]) : ($hall->media->first() ? route('public.storage', ['path' => $hall->media->first()->file_path]) : asset('images/hall-placeholder.svg'))),
        seasonal: @json($seasonalPricesData),
        offers: @json($offersData)
    };

    const disabledDates = @json($disabledDates);

    function populate(d) {
        var fallbackAvatar = 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=200&h=200&fit=crop';
        var fallbackCover = 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=1200&h=400&fit=crop';
        var avatarEl = document.getElementById('bannerAvatar');
        var coverEl = document.getElementById('bannerBg');

        document.getElementById('bc-hall-name').textContent = d.name;
        document.getElementById('bannerName').textContent = d.name;
        document.getElementById('bannerType').textContent = d.type;
        avatarEl.src = d.profileImage || d.coverImage || fallbackAvatar;
        avatarEl.alt = d.name;
        coverEl.style.backgroundImage = `url('${d.coverImage || d.profileImage || fallbackCover}')`;
        document.title = `${d.name} | أمر تم`;

        avatarEl.onerror = function () {
            avatarEl.onerror = null;
            avatarEl.src = fallbackAvatar;
        };

        var coverProbe = new Image();
        coverProbe.onerror = function () {
            coverEl.style.backgroundImage = `url('${fallbackCover}')`;
        };
        coverProbe.src = d.coverImage || d.profileImage || fallbackCover;

        document.getElementById('infoCountry').textContent = d.country || '—';
        document.getElementById('infoCity').textContent = d.city || '—';
        document.getElementById('infoDistrict').textContent = d.district || '—';
        document.getElementById('infoPhone').textContent = d.phone || '—';
        document.getElementById('infoStreet').textContent = d.street || '—';
        document.getElementById('infoNationalAddr').textContent = d.nationalAddr || '—';
        document.getElementById('infoTables').textContent = d.tables || '—';
        document.getElementById('infoChairs').textContent = d.chairs || '—';
        document.getElementById('infoEmail').textContent = d.email || '—';
        document.getElementById('infoOfficialPrice').textContent = d.officialPrice || '0.00 ريال';

        var seasonalList = document.getElementById('seasonalPricesList');
        if (seasonalList) {
            if (d.seasonal && d.seasonal.length > 0) {
                seasonalList.innerHTML = d.seasonal.map(function (s, i) {
                    return `<li class="seasonal-item">
                        <div class="seasonal-item-header">
                            <span class="seasonal-item-num">#${i + 1}</span>
                            <span class="seasonal-item-badge"><i class="fa fa-tags"></i> سعر موسمي</span>
                        </div>
                        <div class="seasonal-item-price">${s.price}<span>/ يوم</span></div>
                        <div class="seasonal-item-dates">
                            <i class="fa fa-calendar-range"></i>
                            ${s.from} &nbsp;—&nbsp; ${s.to}
                        </div>
                    </li>`;
                }).join('');
            } else {
                seasonalList.innerHTML = '<li style="color:#64748b;font-size:13px;text-align:right;padding:10px 0;">لا توجد أسعار موسمية</li>';
            }
        }

        // Offers
        var offersCard = document.getElementById('offersCard');
        var offersList = document.getElementById('offersList');
        var activeOffers = (d.offers || []).filter(function(o){ return o.is_active_now; });
        if (offersCard && offersList) {
            if (activeOffers.length > 0) {
                offersCard.style.display = '';
                offersList.innerHTML = '<div class="offers-list">' + activeOffers.map(function(o) {
                    var discountHtml = '';
                    if (o.discount_type !== 'none' && o.discount_value) {
                        var val = o.discount_type === 'percentage'
                            ? parseFloat(o.discount_value).toFixed(0) + '%'
                            : parseFloat(o.discount_value).toLocaleString('ar') + ' ريال';
                        discountHtml = `<span class="offer-discount-badge"><i class="fa fa-percent"></i> خصم ${val}</span>`;
                    }
                    var servicesHtml = '';
                    if (o.included_services && o.included_services.length > 0) {
                        servicesHtml = `<div class="offer-services">${o.included_services.map(s =>
                            `<span class="offer-service-tag"><i class="fa fa-check" style="font-size:10px;"></i>${s}</span>`
                        ).join('')}</div>`;
                    }
                    var descHtml = o.description
                        ? `<div class="offer-description">${o.description}</div>` : '';
                    return `<div class="offer-card">
                        <div class="offer-active-dot"></div>
                        <div class="offer-card-inner">
                            <div class="offer-card-top">
                                <div class="offer-title">${o.title}</div>
                                ${discountHtml}
                            </div>
                            ${servicesHtml}
                            ${descHtml}
                        </div>
                        <div class="offer-dates-bar">
                            <i class="fa fa-calendar-range"></i>
                            ${o.from} &nbsp;—&nbsp; ${o.to}
                        </div>
                    </div>`;
                }).join('') + '</div>';
            }
        }
    }

    populate(hallData);
</script>

</body>
</html>
