<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة القاعات | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath)
            ? json_decode(file_get_contents($manifestPath), true)
            : null;

        $appCss = $manifest['resources/css/app.css']['file'] ?? null;
        $appJs = $manifest['resources/js/app.js']['file'] ?? null;
        $inlineCss = $appCss ? public_path('build/' . $appCss) : null;
        $inlineJs = $appJs ? public_path('build/' . $appJs) : null;
        $useDevVite = app()->environment(['local', 'development']) && file_exists(public_path('hot'));
    @endphp

    @if ($useDevVite)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @elseif ($inlineCss && file_exists($inlineCss))
        <style>{!! file_get_contents($inlineCss) !!}</style>
    @elseif ($appCss)
        <link rel="stylesheet" href="{{ asset('build/' . $appCss) }}">
    @else
        {{-- CDN fallback when build files are not deployed on the server --}}
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif

    @if (!$useDevVite)
        @if ($inlineJs && file_exists($inlineJs))
            <script type="module">{!! file_get_contents($inlineJs) !!}</script>
        @elseif ($appJs)
            <script type="module" src="{{ asset('build/' . $appJs) }}"></script>
        @endif
    @endif
    <style>
        body { font-family: 'Cairo', sans-serif; }
        /* Override header clip-path on this page */
        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }
        /* Custom select arrow (pseudo-element — can't be done with Tailwind utilities) */
        .select-wrap { position: relative; }
        .select-wrap::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 10px;
            pointer-events: none;
        }

        /* ================================
           SERVICES BAR (category chips marquee)
        ================================ */
        .services-bar {
            position: relative;
            background: #1a5c38;
            padding: 20px 5% 38px;
            overflow: visible;
        }

        .services-bar-header {
            position: relative;
            z-index: 1;
            text-align: center;
            margin-bottom: 28px;
            margin-top: 14px;
        }

        .services-bar-header .sb-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 6px;
        }

        .services-bar-header .sb-line::before,
        .services-bar-header .sb-line::after {
            content: '';
            flex: 1;
            max-width: 80px;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.35));
        }

        .services-bar-header .sb-line::after {
            background: linear-gradient(to left, transparent, rgba(255,255,255,0.35));
        }

        .services-bar-icon {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.22);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #a7f3d0;
            font-size: 16px;
        }

        .services-bar-label {
            font-size: 14px;
            font-weight: 700;
            color: rgba(255,255,255,0.75);
            letter-spacing: .08em;
        }

        /* Track wrapper with fade edges */
        .services-track-wrapper {
            overflow: hidden;
            position: relative;
            z-index: 1;
            direction: ltr;
            /* extra vertical padding so hover scale isn't clipped */
            padding: 10px 0;
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 70px, black calc(100% - 70px), transparent 100%);
            mask-image:         linear-gradient(to right, transparent 0%, black 70px, black calc(100% - 70px), transparent 100%);
        }

        .services-track {
            display: flex;
            direction: ltr;
            width: max-content;
            gap: 16px;
            animation: servicesMarquee 35s linear infinite;
            will-change: transform;
        }

        .services-track:hover {
            animation-play-state: paused;
        }

        @keyframes servicesMarquee {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Each category chip */
        .svc-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: rgba(255,255,255,0.10);
            border: 1.5px solid rgba(255,255,255,0.28);
            border-radius: 40px;
            font-family: 'Cairo', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.90);
            white-space: nowrap;
            cursor: pointer;
            backdrop-filter: blur(4px);
            transition: background .18s, border-color .18s, color .18s, transform .18s, box-shadow .18s;
            user-select: none;
        }

        .svc-chip:hover {
            background: rgba(255,255,255,0.24);
            border-color: rgba(167,243,208,0.80);
            color: #fff;
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 8px 24px rgba(0,0,0,0.28);
        }

        .svc-chip .chip-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #a7f3d0;
            flex-shrink: 0;
        }

        /* ================================
           PARTNERS MODAL
        ================================ */
        #partnersModal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        #partnersModal.open {
            display: flex;
        }

        .pm-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(10,30,18,0.62);
            backdrop-filter: blur(3px);
            cursor: pointer;
        }

        .pm-box {
            position: relative;
            z-index: 1;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.28);
            width: min(520px, 93vw);
            max-height: 82vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: pmIn .22s cubic-bezier(.34,1.56,.64,1);
        }

        @keyframes pmIn {
            from { transform: scale(.88) translateY(20px); opacity: 0; }
            to   { transform: scale(1)   translateY(0);    opacity: 1; }
        }

        .pm-header {
            padding: 20px 22px 16px;
            background: linear-gradient(135deg, #1a5c38, #2d8a5a);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pm-header-icon {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            border: 1.5px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a7f3d0;
            font-size: 17px;
            flex-shrink: 0;
        }

        .pm-title {
            flex: 1;
            font-family: 'Cairo', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: #fff;
        }

        .pm-close {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }

        .pm-close:hover { background: rgba(255,255,255,0.28); }

        .pm-body {
            overflow-y: auto;
            padding: 20px 20px 24px;
            flex: 1;
        }

        .pm-empty {
            text-align: center;
            padding: 40px 0;
            color: #9ca3af;
            font-size: 14px;
        }

        /* Grid layout */
        .pm-partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 14px;
        }

        .pm-partner-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 16px 10px 14px;
            background: #fff;
            border: 1.5px solid #e8f0eb;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(26,92,56,0.07);
            transition: transform .18s, box-shadow .18s, border-color .18s;
            cursor: default;
        }

        .pm-partner-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(26,92,56,0.13);
            border-color: #6ee7a8;
        }

        /* Logo container — fixed square */
        .pm-logo-wrap {
            width: 90px;
            height: 72px;
            border-radius: 12px;
            background: #f4f9f6;
            border: 1px solid #e2ede7;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .pm-logo-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: 6px;
        }

        .pm-logo-wrap .pm-placeholder-icon {
            font-size: 26px;
            color: #2d8a5a;
            opacity: .55;
        }

        .pm-partner-name {
            font-family: 'Cairo', sans-serif;
            font-size: 12.5px;
            font-weight: 700;
            color: #0f3d24;
            text-align: center;
            line-height: 1.35;
            word-break: break-word;
        }

        /* ================================
           PREMIUM CARD CUSTOM STYLES (No-Tailwind Fallback)
        ================================ */
        .vip-card-wrapper {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 4px 15px rgba(200, 169, 81, 0.15);
            overflow: hidden;
            border: 1px solid rgba(200, 169, 81, 0.4);
            position: relative;
            transition: box-shadow 0.3s;
        }
        .vip-card-wrapper:hover {
            box-shadow: 0 8px 25px rgba(200, 169, 81, 0.25);
        }
        .vip-header {
            padding: 16px;
            background: linear-gradient(135deg, #0f3d24, #1a5c38);
            border-bottom: 1px solid rgba(200, 169, 81, 0.2);
            position: relative;
            overflow: hidden;
        }
        .vip-header-bg-icon {
            position: absolute;
            left: -15px;
            top: 0;
            font-size: 70px;
            color: #ffffff;
            opacity: 0.04;
            transform: rotate(-12deg);
            transition: transform 0.5s;
        }
        .vip-card-wrapper:hover .vip-header-bg-icon {
            transform: scale(1.1) rotate(-12deg);
        }
        .vip-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 10;
        }
        .vip-title {
            font-size: 15px;
            font-weight: 800;
            color: #c8a951;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .vip-badge {
            background: #c8a951;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-flex;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .vip-subtitle {
            font-size: 11.5px;
            color: #a7f3d0;
            margin-top: 6px;
            position: relative;
            z-index: 10;
            opacity: 0.95;
            font-weight: 600;
            line-height: 1.5;
        }
        .vip-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .vip-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }
        .vip-item:hover {
            background: #f0faf4;
        }
        .vip-item-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid rgba(26, 92, 56, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }
        .vip-item-icon i {
            font-size: 18px;
            color: #c8a951;
            transition: color 0.3s;
        }
        .vip-item:hover .vip-item-icon {
            background: #1a5c38;
            border-color: #1a5c38;
        }
        .vip-item:hover .vip-item-icon i {
            color: #ffffff;
        }
        .vip-item-text {
            flex: 1;
        }
        .vip-item-title {
            font-size: 13.5px;
            font-weight: 800;
            color: #0f3d24;
            transition: color 0.3s;
            margin-bottom: 2px;
        }
        .vip-item:hover .vip-item-title {
            color: #1a5c38;
        }
        .vip-item-desc {
            font-size: 11.5px;
            color: #6c7a72;
        }
        .vip-item-arrow {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #f8faf9;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }
        .vip-item-arrow i {
            font-size: 10px;
            color: #9ca3af;
            transition: color 0.3s;
        }
        .vip-item:hover .vip-item-arrow {
            background: #c8a951;
        }
        .vip-item:hover .vip-item-arrow i {
            color: #ffffff;
        }
        .vip-footer-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px;
            background: #fbfaf4;
            border-top: 1px solid rgba(200, 169, 81, 0.2);
            color: #0f3d24;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.3s;
        }
        .vip-footer-btn i {
            font-size: 11px;
            color: #c8a951;
            transition: all 0.3s;
        }
        .vip-footer-btn:hover {
            background: #c8a951;
            color: #ffffff;
        }
        .vip-footer-btn:hover i {
            color: #ffffff;
            transform: translateX(-4px);
        }
        .vip-bottom-accent {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, transparent, #c8a951, transparent);
        }

        /* ================================
           PAGE-LEVEL NAV BAR
        ================================ */
        .page-main-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            background: transparent;
            margin-bottom: 22px;
        }

        .page-nav-item {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 18px;
            font-family: 'Cairo', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            color: #8fa898;
            text-decoration: none;
            border: none;
            background: transparent;
            white-space: nowrap;
            transition: color .18s;
            position: relative;
        }

        .page-nav-item:hover {
            color: #1a5c38;
        }

        .page-nav-item.active {
            color: #1a5c38;
        }

        .page-nav-item.active .page-nav-dot {
            background: #1a5c38;
            box-shadow: 0 0 0 3px rgba(26,92,56,0.15);
        }

        .page-nav-item.disabled {
            color: #c8d4cc;
            cursor: default;
            pointer-events: none;
        }

        .page-nav-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #c8d4cc;
            flex-shrink: 0;
            transition: background .18s, box-shadow .18s;
        }

        .page-nav-item:hover .page-nav-dot {
            background: #2d8a5a;
        }

        /* Separator */
        .page-nav-sep {
            color: #c8d4cc;
            font-size: 11px;
            padding: 0 2px;
            user-select: none;
            flex-shrink: 0;
        }

        /* Partners pill — only one that gets a real pill look */
        .page-nav-partners {
            color: #fff;
            background: #c8a951;
            border-radius: 30px;
            padding: 8px 18px;
            margin-right: 6px;
            font-size: 13px;
            transition: background .18s, transform .15s;
        }

        .page-nav-partners:hover {
            background: #b5942e;
            color: #fff;
            transform: translateY(-1px);
        }

        .page-nav-partners .page-nav-dot { display: none; }
    </style>
</head>
<body class="bg-[#f0f4f2] text-[#1e293b] min-h-screen">

@include('partials.header')
{{-- @include('partials.partners_bar') --}}
{{-- @include('partials.sponsors_bar') --}}
@include('partials.sidebar_nav')

<!-- Nav Tabs -->
<div class="max-w-[1400px] mx-auto px-5 pt-7" dir="{{ $dir }}">
    <div class="flex items-center gap-2 mb-5" style="position:relative;">
        {{-- الشرائح الرئيسية في المنتصف --}}
        <div class="flex flex-wrap gap-2" style="margin: 0 auto;">
            <a href="{{ route('halls.list') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#1a5c38] bg-[#1a5c38] text-white shadow-sm transition-all"
               style="font-family:'Cairo',sans-serif;">
                <i class="fa fa-building text-xs"></i>
                {{ __('halls.halls') }}
            </a>
            <a href="#"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all"
               style="font-family:'Cairo',sans-serif;">
                <i class="fa fa-umbrella-beach text-xs"></i>
                {{ __('halls.chalets') }}
            </a>
            <a href="#"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all"
               style="font-family:'Cairo',sans-serif;">
                <i class="fa fa-tree text-xs"></i>
                {{ __('halls.rest_houses') }}
            </a>
            <a href="{{ route('services.list') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all"
               style="font-family:'Cairo',sans-serif;">
                <i class="fa fa-handshake text-xs"></i>
                {{ __('halls.partner_services') }}
            </a>
        </div>
        <a href="{{ route('services.list') }}?category=مأذون شرعي&hide_nav=1"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all shrink-0"
           style="font-family:'Cairo',sans-serif; margin-right: auto;">
            <i class="fa fa-scroll text-xs"></i>
            {{ __('halls.marriage_notary') }}
        </a>
        
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-5 pb-16 grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start" dir="{{ $locale === 'ar' ? 'ltr' : 'rtl' }}">

    <!-- ===== MAIN CONTENT ===== -->
    <div class="lg:order-1" dir="{{ $dir }}">

        {{-- <nav class="page-main-nav">
            <a href="{{ route('halls.list') }}" class="page-nav-item {{ request()->routeIs('halls.list') ? 'active' : '' }}">
                <span class="page-nav-icon"><i class="fa fa-building"></i></span>
                القاعات
            </a>
            <span class="page-nav-sep"><i class="fa fa-chevron-left"></i></span>
            <a href="#" class="page-nav-item disabled">
                <span class="page-nav-dot"></span>
                الشاليهات
            </a>
            <span class="page-nav-sep"><i class="fa fa-chevron-left"></i></span>
            <a href="#" class="page-nav-item disabled">
                <span class="page-nav-dot"></span>
                الإستراحات
            </a>
            <a href="{{ route('services.list') }}" class="page-nav-item page-nav-partners">
                <i class="fa fa-handshake" style="font-size:12px;"></i>
                خدمات الشركاء
            </a>
        </nav> --}}
        <!-- Header row -->
        {{-- <div class="flex items-center justify-between mb-4">
            <h1 id="sectionTitle" class="text-[22px] font-extrabold text-[#0f3d24]">القاعات</h1>
            <span id="totalBadge" class="bg-[#1a5c38] text-white text-[13px] font-bold px-4 py-1 rounded-full">
                {{ $halls->count() }} قاعة
            </span>
        </div> --}}

        
        <!-- Filters -->
        <div class="bg-white rounded-2xl p-5 mb-5 shadow-sm">
            <div class="flex gap-3 flex-wrap items-end">

                <div class="flex flex-col gap-1 flex-1 min-w-[140px]">
                    <label class="text-xs font-bold text-[#6c7a72]">{{ __('halls.country') }}</label>
                    <div class="select-wrap">
                        <select id="filterCountry" class="appearance-none bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-3 py-2.5 text-[13px] text-gray-700 outline-none w-full focus:border-[#1a5c38] transition-colors" style="font-family:'Cairo',sans-serif;">
                            <option value="">{{ __('halls.all_countries') }}</option>
                            @foreach($halls->pluck('country')->unique()->sort() as $country)
                            <option value="{{ $country }}"
                                @auth @if(Auth::user()->country === $country) selected @endif @endauth>
                                {{ $country }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-col gap-1 flex-1 min-w-[140px]">
                    <label class="text-xs font-bold text-[#6c7a72]">{{ __('halls.city') }}</label>
                    <div class="select-wrap">
                        <select id="filterCity" class="appearance-none bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-3 py-2.5 text-[13px] text-gray-700 outline-none w-full focus:border-[#1a5c38] transition-colors" style="font-family:'Cairo',sans-serif;">
                            <option value="">{{ __('halls.all_cities') }}</option>
                            @foreach($halls->pluck('city')->unique()->sort() as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-1 flex-1 min-w-[140px]">
                    <label class="text-xs font-bold text-[#6c7a72]">{{ __('halls.hall_type') }}</label>
                    <div class="select-wrap">
                        <select id="filterType" class="appearance-none bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-3 py-2.5 text-[13px] text-gray-700 outline-none w-full focus:border-[#1a5c38] transition-colors" style="font-family:'Cairo',sans-serif;">
                            <option value="">{{ __('halls.all_types') }}</option>
                            <option value="افراح">{{ __('halls.type_weddings') }}</option>
                            <option value="اجتماعات">{{ __('halls.type_meetings') }}</option>
                            <option value="مؤتمرات">{{ __('halls.type_conferences') }}</option>
                            <option value="تدريب">{{ __('halls.type_training') }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-col gap-1 flex-1 min-w-[140px]">
                    <label class="text-xs font-bold text-[#6c7a72]">{{ __('halls.price_range') }}</label>
                    <div class="select-wrap">
                        <select id="filterPrice" class="appearance-none bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-3 py-2.5 text-[13px] text-gray-700 outline-none w-full focus:border-[#1a5c38] transition-colors" style="font-family:'Cairo',sans-serif;">
                            <option value="">{{ __('halls.all_prices') }}</option>
                            <option value="0-3000">{{ __('halls.price_low') }}</option>
                            <option value="3000-6000">{{ __('halls.price_mid') }}</option>
                            <option value="6000-99999">{{ __('halls.price_high') }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-col gap-1 flex-1 min-w-[140px]">
                    <label class="text-xs font-bold text-[#6c7a72]">{{ __('halls.sort') }}</label>
                    <div class="select-wrap">
                        <select id="filterSort" class="appearance-none bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-3 py-2.5 text-[13px] text-gray-700 outline-none w-full focus:border-[#1a5c38] transition-colors" style="font-family:'Cairo',sans-serif;">
                            <option value="">{{ __('halls.sort_newest') }}</option>
                            <option value="price_asc">{{ __('halls.sort_price_asc') }}</option>
                            <option value="price_desc">{{ __('halls.sort_price_desc') }}</option>
                            <option value="capacity_desc">{{ __('halls.sort_capacity') }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-1 flex-1 min-w-[140px]">
                    <label class="text-xs font-bold text-[#6c7a72]">تاريخ الوفرة</label>
                    <input type="date" id="filterDate"
                           min="{{ date('Y-m-d') }}"
                           class="bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-3 py-2.5 text-[13px] text-gray-700 outline-none w-full focus:border-[#1a5c38] transition-colors"
                           style="font-family:'Cairo',sans-serif;">
                </div>

                <div class="flex items-end">
                    <button id="btnReset" class="inline-flex items-center gap-1.5 bg-white text-[#1a5c38] border-[1.5px] border-[#1a5c38] px-4 py-2.5 rounded-xl text-[13px] font-bold cursor-pointer whitespace-nowrap hover:bg-[#f0faf4] transition-colors" style="font-family:'Cairo',sans-serif;">
                        <i class="fa fa-rotate-right"></i>
                        {{ __('halls.reset_filters') }}
                    </button>
                </div>

            </div>
        </div>
        
        <!-- Results count -->
        <p id="resultsCount" class="text-[13px] font-semibold text-[#6c7a72] mb-3.5">
            {{ __('halls.results_count') }}: <strong>{{ $halls->count() }}</strong> {{ __('halls.halls_count') }}
        </p>
        
        <!-- Cards grid -->
        <div id="hallsList" class="grid gap-4" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr))">
            
            @forelse($halls as $hall)
            @php
                $thumb = $hall->profile_photo
                ? route('public.storage', ['path' => $hall->profile_photo])
                : ($hall->media->first()
                    ? route('public.storage', ['path' => $hall->media->first()->file_path])
                    : asset('images/hall-placeholder.svg'));
                $featureName = $hall->features->first()?->name ?? 'قاعة أفراح';
                $busyDatesArr = $hall->busyDates->pluck('busy_date')->map(fn($d) => $d->format('Y-m-d'))->toArray();
                $bookedDatesArr = $hall->bookings->pluck('booking_date')->map(fn($d) => $d->format('Y-m-d'))->toArray();
                $disabledDatesArr = array_values(array_unique(array_merge($busyDatesArr, $bookedDatesArr)));
                @endphp

<div class="hall-card group bg-white rounded-[18px] overflow-hidden shadow-md cursor-pointer transition-all duration-200 flex flex-col hover:-translate-y-0.5 hover:shadow-xl"
                 data-name="{{ $hall->name }}"
                 data-country="{{ $hall->country }}"
                 data-city="{{ $hall->city }}"
                 data-feature="{{ $featureName }}"
                 data-price="{{ (float) $hall->price_per_day }}"
                 data-capacity="{{ $hall->capacity }}"
                 data-disabled-dates="{{ json_encode($disabledDatesArr) }}"
                 data-hall-url="{{ route('halls.show', $hall) }}">

                <!-- Image -->
                <div class="relative w-full h-[170px] overflow-hidden shrink-0">
                    <img src="{{ $thumb }}" alt="{{ $hall->name }}"
                         class="w-full h-full object-cover block transition-transform duration-300 group-hover:scale-105">
                    <span class="absolute top-2.5 right-2.5 bg-white text-[#1a5c38] text-[11.5px] font-extrabold px-3 py-1 rounded-full shadow">
                        {{ __('halls.wedding_hall_tag') }}
                    </span>
                    @if($featureName)
                        <span class="absolute top-[38px] right-2.5 bg-amber-400 text-white text-[11px] font-bold px-3 py-0.5 rounded-full shadow">
                            {{ $featureName }}
                        </span>
                        @endif
                        <div class="absolute bottom-2.5 left-2.5 bg-white/95 text-[#0f3d24] text-sm font-extrabold px-3 py-1.5 rounded-xl shadow" dir="rtl">
                            <span class="text-[11px] text-[#1a5c38] font-bold ms-1">ر.س</span>{{ number_format($hall->price_per_day, 0) }}
                        </div>
                    </div>
                    
                    <!-- Body -->
                    <div class="px-4 pt-3 pb-4 flex-1 flex flex-col gap-2">
                        <div class="text-base font-extrabold text-[#0f3d24]">{{ $hall->name }}</div>
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center gap-1.5 text-[12.5px] text-[#6c7a72] font-medium">
                            <i class="fa fa-location-dot text-[#1a5c38] text-xs w-3.5 text-center shrink-0"></i>
                            <span>{{ $hall->city }}{{ $hall->location ? ' — ' . $hall->location : '' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[12.5px] text-[#6c7a72] font-medium">
                            <i class="fa fa-chair text-[#1a5c38] text-xs w-3.5 text-center shrink-0"></i>
                            <span>{{ __('halls.capacity_label') }} {{ $hall->capacity }} {{ __('halls.persons') }} &nbsp;|&nbsp; {{ $hall->max_tables }} {{ __('halls.table') }}</span>
                        </div>
                        @if($hall->whatsapp_number)
                        <div class="flex items-center gap-1.5 text-[12.5px] text-[#6c7a72] font-medium">
                            <i class="fa-brands fa-whatsapp text-[#1a5c38] text-xs w-3.5 text-center shrink-0"></i>
                            <span>{{ $hall->whatsapp_number }}</span>
                        </div>
                        @endif
                    </div>
                    <button onclick="window.location.href='{{ route('halls.show', $hall) }}'"
                    class="mt-1 flex items-center justify-center gap-2 w-full bg-[#1a5c38] text-white border-none rounded-xl py-2.5 text-[13.5px] font-bold cursor-pointer transition-colors hover:bg-[#155230]"
                    style="font-family:'Cairo',sans-serif;">
                    <i class="fa fa-eye"></i>
                    {{ __('halls.view_details') }}
                </button>
                </div>
                
            </div>

            @empty
            <div class="col-span-2 text-center py-12 text-gray-400">
                <i class="fas fa-building text-5xl opacity-30 block mb-3"></i>
                {{ __('halls.no_halls') }}
            </div>
            @endforelse
            
        </div><!-- /#hallsList -->
        
        <!-- ===== PARTNERS SECTION ===== -->
        <div id="partnersList" class="grid gap-4" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); display:none;">
            {{-- Populated by JS when a category chip/row is clicked --}}
        </div>
        
    </div><!-- /main col -->
    <!-- ===== SIDEBAR ===== -->
    <div class="flex flex-col gap-4 lg:sticky lg:top-5 lg:order-2" style="padding-right: 68px" dir="rtl">
        
        <!-- Profile / Stats Card -->
        <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            <div class="bg-gradient-to-br from-[#1a5c38] to-[#2d8a5a] text-center">
                    <img src="/images/new-logo1.png" 
                    alt="أمر تم" 
                    class="w-full object-cover bg-white">
                {{-- <div class="text-white text-[17px] font-extrabold">أمر تم</div> --}}
            </div>
            
            {{-- <div class="grid grid-cols-2 gap-px bg-gray-200">
                <div class="bg-white py-3.5 px-2.5 text-center">
                    <div class="text-[22px] font-extrabold text-[#1a5c38] leading-none mb-1">{{ $halls->count() }}</div>
                    <div class="text-[11.5px] text-[#6c7a72] font-semibold">إجمالي القاعات</div>
                </div>
                <div class="bg-white py-3.5 px-2.5 text-center">
                    <div class="text-[22px] font-extrabold text-[#1a5c38] leading-none mb-1">{{ array_sum(array_map('count', $partnersByCategory)) }}</div>
                    <div class="text-[11.5px] text-[#6c7a72] font-semibold">خدمات شركائنا</div>
                </div>
                <div class="bg-white py-3.5 px-2.5 text-center">
                    <div class="text-[22px] font-extrabold text-[#1a5c38] leading-none mb-1">{{ $halls->pluck('city')->unique()->count() }}</div>
                    <div class="text-[11.5px] text-[#6c7a72] font-semibold">مدينة</div>
                </div>
                <div class="bg-white py-3.5 px-2.5 text-center">
                    <div class="text-[22px] font-extrabold text-[#1a5c38] leading-none mb-1">{{ count($partnersByCategory) }}</div>
                    <div class="text-[11.5px] text-[#6c7a72] font-semibold">فئات الخدمات</div>
                </div>
            </div> --}}
            
            <div class="p-4 pt-0 flex flex-col gap-2">
                @auth
                @else
                <a href="{{ route('login') }}"
                       class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-[13px] font-bold bg-[#1a5c38] text-white no-underline hover:opacity-90 transition-opacity"
                       style="font-family:'Cairo',sans-serif;">
                       <i class="fa fa-right-to-bracket"></i>
                       تسجيل الدخول للحجز
                    </a>
                    <a href="{{ route('register') }}"
                    class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-[13px] font-bold bg-white text-[#1a5c38] border-[1.5px] border-[#1a5c38] no-underline hover:opacity-90 transition-opacity"
                    style="font-family:'Cairo',sans-serif;">
                    <i class="fa fa-user-plus"></i>
                    إنشاء حساب
                    </a>
                    @endauth
            </div>
        </div>
        
        <!-- Premium Featured Partners Card (Fixed Edges & Positioned Above Contact) -->
        {{-- <div class="bg-white rounded-[18px] shadow-sm hover:shadow-md overflow-hidden border-[1.5px] border-[#c8a951] relative transition-shadow duration-300">
            
            <!-- Header Section of Card -->
            <div class="vip-header" style="padding: 16px; background: linear-gradient(135deg, #1a5c38, #2d8a5a); border-bottom: 1.5px solid #c8a951; position: relative; overflow: hidden;">
                <!-- Background decorative icon -->
                <i class="fa fa-crown vip-header-bg-icon"></i>
                
                <div class="vip-title-row" style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 10;">
                    <div class="flex items-center gap-2 text-[15px] font-extrabold text-white">
                        <i class="fa fa-star fa-pulse" style="color: #c8a951;"></i>
                        شركاء التميز
                    </div>
                    <span class="bg-[#c8a951] text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full shadow-sm fa-bounce inline-flex">
                        VIP
                    </span>
                </div>
                <p class="text-[11.5px] text-white mt-1.5 relative z-10 opacity-90 font-semibold leading-relaxed">نخبة الشركاء الاستراتيجيين ومزوّدي الخدمات الفاخرة </p>
            </div>
            
            <!-- Body Section -->
            <div class="vip-body" style="padding: 16px; display: flex; flex-direction: column; gap: 8px;">
                
                <!-- Premium Partner 1 -->
                <a href="#" class="vip-item focus:outline-none">
                    <div class="vip-item-icon">
                        <i class="fa fa-file-contract"></i>
                    </div>
                    <div class="vip-item-text">
                        <h4 class="vip-item-title">المأذون الشرعي</h4>
                        <p class="vip-item-desc">عقود النكاح </p>
                    </div>
                    <div class="vip-item-arrow">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                </a>
                
                <!-- Premium Partner 2 -->
                <a href="#" class="vip-item focus:outline-none">
                    <div class="vip-item-icon">
                        <i class="fa fa-camera-retro"></i>
                    </div>
                    <div class="vip-item-text">
                        <h4 class="vip-item-title">عدسة الإبداع للإنتاج</h4>
                        <p class="vip-item-desc">تصوير وتوثيق مناسبات</p>
                    </div>
                    <div class="vip-item-arrow">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                </a>
                
                <!-- Premium Partner 3 -->
                <a href="#" class="vip-item focus:outline-none">
                    <div class="vip-item-icon">
                        <i class="fa fa-gem"></i>
                    </div>
                    <div class="vip-item-text">
                        <h4 class="vip-item-title">لمسة جمال الماسية</h4>
                        <p class="vip-item-desc">العناية وتجهيز العرائس</p>
                    </div>
                    <div class="vip-item-arrow">
                        <i class="fa fa-chevron-left"></i>
                    </div>
                </a>
                
            </div>
            
            <a href="#" class="vip-footer-btn"> 
                استعرض كافة الخدمات
                <i class="fa fa-arrow-left"></i>
            </a>
            
            <!-- Premium Bottom Border Line Accent -->
            <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-gradient-to-r from-transparent via-[#c8a951] to-transparent"></div>
        </div> --}}

        <!-- Contact Info Card -->
        {{-- <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            <div class="p-4">
                <div class="text-sm font-extrabold text-[#0f3d24] mb-3 flex items-center gap-1.5">
                    <i class="fa fa-address-card text-[#1a5c38]"></i>
                    معلومات التواصل --}}
                {{-- </div>
                <div class="flex items-center justify-between py-2 border-b border-[#f0f4f2] text-[13px]">
                    <span class="text-gray-400 text-xs">الهاتف</span>
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-[#0f3d24]">920000000</span>
                        <i class="fa fa-phone text-[#1a5c38] text-sm"></i>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-[#f0f4f2] text-[13px]">
                    <span class="text-gray-400 text-xs">البريد الإلكتروني</span>
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-[#0f3d24] text-[12px]">info@amrtm.com.sa</span>
                        <i class="fa fa-envelope text-[#1a5c38] text-sm"></i>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2 text-[13px]">
                    <span class="text-gray-400 text-xs">واتساب</span>
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-[#0f3d24]">920000000</span>
                        <i class="fa-brands fa-whatsapp text-[#1a5c38] text-sm"></i>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            <div class="p-4">
                <div class="text-sm font-extrabold text-[#0f3d24] mb-3 flex items-center gap-1.5">
                    <i class="fa fa-layer-group text-[#1a5c38]"></i>
                    تصنيفات الخدمات
                </div>
                <div class="flex flex-col gap-1.5">
                    @foreach($categories as $cat)
                    <button class="sidebar-cat-btn category-row-btn w-full flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-[#e8f5e9] transition-all text-right"
                            data-category="{{ $cat->name }}"
                            style="font-family:'Cairo',sans-serif; background:#f8fdf9; border:1.5px solid #e2ede7; cursor:pointer;">
                        <div style="min-width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#1a5c38,#2d8a5a);color:#fff;font-size:13px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            {{ $cat->partners_count }}
                        </div>
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;flex:1;line-height:1.3;">{{ $cat->name }}</span>
                        <i class="fa fa-angle-left" style="color:#9ca3af;font-size:11px;flex-shrink:0;"></i>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Cities Card -->
        {{-- <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            <div class="p-4">
                <div class="text-sm font-extrabold text-[#0f3d24] mb-3 flex items-center gap-1.5">
                    <i class="fa fa-city text-[#1a5c38]"></i>
                    المدن المتاحة
                </div>
                @foreach($halls->pluck('city')->unique()->sort() as $city)
                <div class="flex items-center justify-between py-2 border-b border-[#f0f4f2] last:border-b-0 text-[13px]">
                    <span class="font-bold text-[#0f3d24]">{{ $city }}</span>
                    <span class="bg-[#1a5c38] text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                        {{ $halls->where('city', $city)->count() }} قاعة
                    </span>
                </div>
                @endforeach
            </div>
        </div> --}}
        
    </div><!-- /sidebar -->

</div><!-- /page wrapper -->
@include('partials.partners_bar')
@include('partials.footer')

<script>

    // ===== بيانات الشركاء (مُحقونة من PHP) =====
    const partnersByCategoryData = @json($partnersByCategory);

    // ===== عناصر DOM =====
    const hallCards      = document.querySelectorAll('.hall-card');
    const resultsCount   = document.getElementById('resultsCount');
    const totalBadge     = document.getElementById('totalBadge');
    const filterCountry  = document.getElementById('filterCountry');
    const filterCity     = document.getElementById('filterCity');
    const filterType     = document.getElementById('filterType');
    const filterPrice    = document.getElementById('filterPrice');
    const filterSort     = document.getElementById('filterSort');
    const btnReset       = document.getElementById('btnReset');
    const hallsList    = document.getElementById('hallsList');
    const partnersList = document.getElementById('partnersList');
    const sectionTitle = document.getElementById('sectionTitle');
    const btnShowHalls = document.getElementById('btnShowHalls');
    const filterBar    = document.querySelector('#hallsList')?.closest('.lg\\:order-1')?.querySelector('.bg-white.rounded-2xl');

    // ===== إظهار/إخفاء (global حتى يراها partners_bar IIFE) =====
    window.showPartnersSection = function(category) {
        const partners = partnersByCategoryData[category] || [];

        // إخفاء القاعات وإظهار الشركاء
        hallsList.style.display = 'none';
        partnersList.style.display = 'grid';
        sectionTitle.textContent = category;
        resultsCount.innerHTML = `عدد النتائج: <strong>${partners.length}</strong> مقدم خدمة`;
        totalBadge.textContent = partners.length + ' خدمة';
        if (btnShowHalls) btnShowHalls.style.display = 'flex';

        // تمييز الزر النشط
        document.querySelectorAll('.category-row-btn').forEach(b => {
            b.style.background = b.dataset.category === category ? '#f0faf4' : 'none';
            b.style.color = b.dataset.category === category ? '#1a5c38' : '';
        });

        // بناء البطاقات
        if (partners.length === 0) {
            partnersList.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:3rem;color:#9ca3af;font-family:'Cairo',sans-serif;">
                <i class="fa fa-building" style="font-size:2.8rem;opacity:.2;display:block;margin-bottom:12px;"></i>
                لا يوجد مقدمو خدمة في هذا التصنيف حتى الآن
            </div>`;
        } else {
            partnersList.innerHTML = partners.map(p => `
                <div class="bg-white rounded-[18px] overflow-hidden shadow-md flex flex-col hover:-translate-y-0.5 hover:shadow-xl transition-all duration-200">
                    <div class="relative w-full h-[170px] bg-[#f4f9f6] flex items-center justify-center overflow-hidden">
                        ${ p.logo_url
                            ? `<img src="${p.logo_url}" alt="${p.name}" class="w-full h-full object-cover" loading="lazy">`
                            : `<i class="fa fa-building" style="font-size:3rem;color:#2d8a5a;opacity:.3;"></i>` }
                        <span style="position:absolute;top:10px;right:10px;background:#fff;color:#1a5c38;font-size:11.5px;font-weight:800;padding:4px 12px;border-radius:20px;box-shadow:0 2px 6px rgba(0,0,0,.12);">${category}</span>
                    </div>
                    <div style="padding:14px 16px 16px;flex:1;display:flex;flex-direction:column;gap:8px;">
                        <div style="font-size:15px;font-weight:800;color:#0f3d24;">${p.name}</div>
                        ${ p.description ? `<div style="font-size:12.5px;color:#6c7a72;">${p.description}</div>` : '' }
                        ${ p.phone ? `<div style="display:flex;align-items:center;gap:6px;font-size:12.5px;color:#6c7a72;"><i class="fa fa-phone" style="color:#1a5c38;"></i>${p.phone}</div>` : '' }
                        ${ p.whatsapp ? `<div style="display:flex;align-items:center;gap:6px;font-size:12.5px;color:#6c7a72;"><i class="fa-brands fa-whatsapp" style="color:#1a5c38;"></i>${p.whatsapp}</div>` : '' }
                        ${ p.profile_url
                            ? `<a href="${p.profile_url}" style="margin-top:4px;display:flex;align-items:center;justify-content:center;gap:8px;background:#1a5c38;color:#fff;border-radius:12px;padding:10px;font-size:13.5px;font-weight:700;font-family:'Cairo',sans-serif;text-decoration:none;transition:background .2s;" onmouseover="this.style.background='#155230'" onmouseout="this.style.background='#1a5c38'">
                                <i class="fa fa-eye"></i> عرض الملف الكامل
                            </a>`
                            : `<div style="margin-top:4px;display:flex;align-items:center;justify-content:center;gap:8px;background:#f0faf4;color:#1a5c38;border:1.5px solid #c8e6d4;border-radius:12px;padding:10px;font-size:12.5px;font-weight:700;font-family:'Cairo',sans-serif;">
                                <i class="fa fa-phone"></i> تواصل مباشرة
                            </div>`
                        }
                    </div>
                </div>`).join('');
        }

        // سكرول للأعلى
        sectionTitle.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    window.showHallsSection = function() {
        partnersList.style.display = 'none';
        hallsList.style.display = 'grid';
        sectionTitle.textContent = 'القاعات';
        if (btnShowHalls) btnShowHalls.style.display = 'none';
        document.querySelectorAll('.category-row-btn').forEach(b => b.style.background = 'none');
        // إعادة العدّاد
        const visible = Array.from(hallCards).filter(c => c.style.display !== 'none').length;
        resultsCount.innerHTML = `عدد النتائج: <strong>${visible}</strong> قاعة`;
        totalBadge.textContent = visible + ' قاعة';
        sectionTitle.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ربط أزرار التصنيف في السايدبار
    document.querySelectorAll('.category-row-btn').forEach(btn =>
        btn.addEventListener('click', () => showPartnersSection(btn.dataset.category))
    );

    if (btnShowHalls) btnShowHalls.addEventListener('click', showHallsSection);

    // ===== فلاتر القاعات =====
    const filterDate = document.getElementById('filterDate');

    function applyFilters() {
        const countryVal = filterCountry.value.toLowerCase();
        const cityVal    = filterCity.value.toLowerCase();
        const typeVal    = filterType.value.toLowerCase();
        const priceVal   = filterPrice.value;
        const sortVal    = filterSort.value;
        const dateVal    = filterDate ? filterDate.value : '';

        let cards = Array.from(hallCards);

        cards.forEach(card => {
            const country = (card.dataset.country || '').toLowerCase();
            const city    = (card.dataset.city    || '').toLowerCase();
            const name    = (card.dataset.name    || '').toLowerCase();
            const feature = (card.dataset.feature || '').toLowerCase();
            const price   = parseFloat(card.dataset.price) || 0;

            let show = true;
            if (countryVal && !country.includes(countryVal))                            show = false;
            if (cityVal  && !city.includes(cityVal))                                    show = false;
            if (typeVal  && !feature.includes(typeVal) && !name.includes(typeVal))      show = false;
            if (priceVal) {
                const [min, max] = priceVal.split('-').map(Number);
                if (price < min || price > max) show = false;
            }
            if (dateVal) {
                const disabled = JSON.parse(card.dataset.disabledDates || '[]');
                if (disabled.includes(dateVal)) show = false;
            }
            card.style.display = show ? 'flex' : 'none';
        });

        const visibleCards = cards.filter(c => c.style.display !== 'none');
        if (sortVal) {
            visibleCards.sort((a, b) => {
                const pa = parseFloat(a.dataset.price)    || 0;
                const pb = parseFloat(b.dataset.price)    || 0;
                const ca = parseInt(a.dataset.capacity)   || 0;
                const cb = parseInt(b.dataset.capacity)   || 0;
                if (sortVal === 'price_asc')     return pa - pb;
                if (sortVal === 'price_desc')    return pb - pa;
                if (sortVal === 'capacity_desc') return cb - ca;
                return 0;
            });
            visibleCards.forEach(c => hallsList.appendChild(c));
        }

        const count = visibleCards.length;
        resultsCount.innerHTML = `عدد النتائج: <strong>${count}</strong> قاعة`;
        totalBadge.textContent = count + ' قاعة';
    }

    filterCountry.addEventListener('change', applyFilters);
    filterCity.addEventListener('change',   applyFilters);
    filterType.addEventListener('change',   applyFilters);
    filterPrice.addEventListener('change',  applyFilters);
    filterSort.addEventListener('change',   applyFilters);
    if (filterDate) filterDate.addEventListener('change', applyFilters);

    btnReset.addEventListener('click', () => {
        filterCountry.value = '';
        filterCity.value    = '';
        filterType.value    = '';
        filterPrice.value   = '';
        filterSort.value    = '';
        if (filterDate) filterDate.value = '';
        applyFilters();
    });

    // ===== Override: إعادة توجيه chips الشريط المتحرك لقسم الشركاء بدل الـ modal =====
    // نُضيف listener بـ capture: true ليعمل قبل الـ IIFE في partners_bar
    document.addEventListener('click', function(e) {
        const chip = e.target.closest('#servicesTrack .svc-chip');
        if (!chip) return;
        e.stopImmediatePropagation();
        window.showPartnersSection(chip.dataset.category);
    }, true); // capture phase — يعمل قبل أي handler آخر
</script>

</body>
</html>
