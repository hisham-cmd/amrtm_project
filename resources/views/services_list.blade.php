<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدمات الشركاء | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath)
            ? json_decode(file_get_contents($manifestPath), true)
            : null;
        $appCss = $manifest['resources/css/app.css']['file'] ?? null;
        $appJs  = $manifest['resources/js/app.js']['file']  ?? null;
        $inlineCss = $appCss ? public_path('build/' . $appCss) : null;
        $inlineJs  = $appJs  ? public_path('build/' . $appJs)  : null;
        $useDevVite = app()->environment(['local', 'development']) && file_exists(public_path('hot'));
    @endphp

    @if ($useDevVite)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @elseif ($inlineCss && file_exists($inlineCss))
        <style>{!! file_get_contents($inlineCss) !!}</style>
    @elseif ($appCss)
        <link rel="stylesheet" href="{{ asset('build/' . $appCss) }}">
    @else
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
        body { clip-path: none !important; }

        /* ---- CAT CHIPS ---- */
        .cat-chip {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 16px; border-radius: 30px; cursor: pointer;
            font-family: 'Cairo', sans-serif; font-size: 13px; font-weight: 700;
            border: 1.5px solid #d1e8d8; background: #f8fdf9; color: #1a5c38;
            transition: all 0.2s;
        }
        .cat-chip:hover { background: #e8f5e9; border-color: #1a5c38; }
        .cat-chip.active { background: #1a5c38; border-color: #1a5c38; color: #fff; }
        .cat-chip.active span { background: rgba(255,255,255,0.25); color: #fff; }

        /* ---- RESULTS BAR ---- */
        .srv-results-bar {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 12px; margin-bottom: 14px;
        }
        .srv-results-text { font-size: 13px; color: #6c7a72; font-family: 'Cairo', sans-serif; }
        .srv-results-text strong { color: #1a5c38; font-weight: 800; }
        .srv-view-btns { display: flex; gap: 6px; }
        .srv-view-btn {
            width: 36px; height: 36px; border-radius: 10px; cursor: pointer;
            background: #fff; border: 1.5px solid #d1e8d8;
            color: #9ca3af; font-size: 14px; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .srv-view-btn.active, .srv-view-btn:hover { background: #e8f5e9; color: #1a5c38; border-color: #1a5c38; }

        /* ---- SERVICES GRID ---- */
        .srv-grid {
            display: grid; gap: 16px;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
        .srv-grid.list-view { grid-template-columns: 1fr; }

        /* ---- SERVICE CARD ---- */
        .srv-card {
            background: #fff;
            border-radius: 18px; overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer; display: flex; flex-direction: column;
        }
        .srv-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0,0,0,0.13);
        }
        .srv-card-banner {
            height: 160px; position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #0d2448 0%, #1a3a6e 100%);
        }
        .srv-card-banner .banner-icon { font-size: 52px; color: #a8d5b5; }
        .srv-card-banner .banner-img { width: 100%; height: 100%; object-fit: cover; }
        .srv-card-category {
            position: absolute; top: 12px; right: 12px;
            background: rgba(0,0,0,0.45); backdrop-filter: blur(8px);
            color: #fff; font-size: 11px; font-weight: 700;
            padding: 4px 12px; border-radius: 20px;
        }
        .srv-card-rating {
            position: absolute; bottom: 12px; left: 12px;
            background: rgba(0,0,0,0.45); backdrop-filter: blur(8px);
            color: #fbbf24; font-size: 12px; font-weight: 700;
            padding: 4px 10px; border-radius: 20px; display: flex; align-items: center; gap: 4px;
        }
        .srv-card-body { padding: 18px; flex: 1; display: flex; flex-direction: column; font-family: 'Cairo', sans-serif; }
        .srv-card-title { font-size: 16px; font-weight: 800; color: #0f3d24; margin-bottom: 6px; line-height: 1.35; }
        .srv-card-desc { font-size: 13px; color: #6c7a72; line-height: 1.7; margin-bottom: 14px; flex: 1; }
        .srv-card-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; }
        .srv-tag {
            font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px;
            background: #e8f5e9; color: #1a5c38; border: 1px solid #c8e6c9;
        }
        .srv-card-footer {
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px; padding-top: 14px;
            border-top: 1px solid #f0f4f2;
        }
        .srv-card-price { font-size: 17px; font-weight: 800; color: #1a5c38; }
        .srv-card-price span { font-size: 12px; color: #9ca3af; font-weight: 600; }
        .srv-card-btn {
            display: inline-flex; align-items: center; gap: 7px;
            background: #1a5c38; color: #fff; border: none; border-radius: 12px;
            padding: 9px 16px; font-size: 13px; font-weight: 700;
            font-family: 'Cairo', sans-serif; cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
        }
        .srv-card-btn:hover { opacity: 0.88; transform: scale(0.97); }

        /* ---- LIST VIEW ---- */
        .srv-grid.list-view .srv-card { flex-direction: row; }
        .srv-grid.list-view .srv-card-banner { width: 200px; height: auto; flex-shrink: 0; border-radius: 0; }
        .srv-grid.list-view .srv-card-body { padding: 20px 24px; }

        /* ---- EMPTY STATE ---- */
        #noResults { text-align: center; padding: 60px 20px; }
        #noResults i { font-size: 48px; color: #d1e8d8; display: block; margin-bottom: 16px; }
        #noResults p { color: #9ca3af; font-size: 15px; }

        /* ---- REQUEST MODAL ---- */
        .req-modal-overlay {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(5,15,35,0.7); backdrop-filter: blur(6px);
            align-items: flex-start; justify-content: center;
            padding: 40px 20px; overflow-y: auto;
        }
        .req-modal-overlay.open { display: flex; }
        .req-modal {
            background: #fff; border-radius: 24px;
            width: 100%; max-width: 540px; padding: 36px;
            position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        }
        .req-modal-close {
            position: absolute; top: 18px; left: 18px;
            width: 34px; height: 34px; border-radius: 50%; border: none;
            background: #f0f4f2; color: #6c7a72; font-size: 15px;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .req-modal-close:hover { background: #e8f0ec; }
        .req-modal-badge {
            display: inline-flex; align-items: center; gap: 7px;
            background: #e8f5e9; border: 1px solid #c8e6c9;
            color: #1a5c38; font-size: 12px; font-weight: 700;
            padding: 5px 14px; border-radius: 20px; margin-bottom: 14px;
        }
        .req-modal h2 { font-size: 20px; font-weight: 800; color: #0f3d24; margin-bottom: 6px; }
        .req-modal-sub { font-size: 13.5px; color: #6c7a72; margin-bottom: 24px; }
        .req-field { margin-bottom: 16px; }
        .req-field label { display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 7px; }
        .req-field input,
        .req-field select,
        .req-field textarea {
            width: 100%; background: #f8faf9;
            border: 1.5px solid #d1e8d8;
            border-radius: 12px; padding: 11px 14px;
            color: #1e293b; font-family: 'Cairo', sans-serif; font-size: 14px;
            outline: none; transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .req-field input:focus,
        .req-field select:focus,
        .req-field textarea:focus { border-color: #1a5c38; }
        .req-field textarea { resize: vertical; min-height: 100px; }
        .req-submit-btn {
            width: 100%; padding: 13px; border: none; border-radius: 14px;
            background: #1a5c38; color: #fff;
            font-family: 'Cairo', sans-serif; font-size: 15px; font-weight: 800;
            cursor: pointer; transition: opacity 0.2s, transform 0.2s;
            margin-top: 8px;
        }
        .req-submit-btn:hover { opacity: 0.88; transform: translateY(-1px); }
        .req-success {
            display: none; text-align: center; padding: 40px 20px;
        }
        .req-success i { font-size: 52px; color: #4ade80; margin-bottom: 14px; display: block; }
        .req-success h3 { font-size: 20px; font-weight: 800; color: #0f3d24; margin-bottom: 8px; }
        .req-success p { color: #6c7a72; font-size: 14px; line-height: 1.75; }

        /* ---- SIDEBAR_NAV FIX ---- */
        .select-wrap { position: relative; }
        .select-wrap::after {
            content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            pointer-events: none; color: #9ca3af; font-size: 11px;
        }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 640px) {
            .srv-grid { grid-template-columns: 1fr; }
            .srv-grid.list-view .srv-card { flex-direction: column; }
            .srv-grid.list-view .srv-card-banner { width: 100%; height: 140px; }
            .req-modal { padding: 24px 18px; }
        }
    </style>
</head>
<body class="bg-[#f0f4f2] text-[#1e293b] min-h-screen">

@include('partials.header')
@include('partials.sidebar_nav')

{{-- ===== Nav Tabs ===== --}}
<div class="max-w-[1400px] mx-auto px-5 pt-7" dir="rtl">
    <div class="flex flex-wrap justify-center gap-2 mb-5">
        <a href="{{ route('halls.list') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all"
           style="font-family:'Cairo',sans-serif;">
            <i class="fa fa-building text-xs"></i>
            القاعات
        </a>
        <a href="#"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all"
           style="font-family:'Cairo',sans-serif;">
            <i class="fa fa-umbrella-beach text-xs"></i>
            الشاليهات
        </a>
        <a href="#"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#d1e8d8] bg-white text-[#1a5c38] hover:bg-[#f0faf4] transition-all"
           style="font-family:'Cairo',sans-serif;">
            <i class="fa fa-tree text-xs"></i>
            الإستراحات
        </a>
        <a href="{{ route('services.list') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold border-[1.5px] border-[#1a5c38] bg-[#1a5c38] text-white shadow-sm transition-all"
           style="font-family:'Cairo',sans-serif;">
            <i class="fa fa-handshake text-xs"></i>
            خدمات الشركاء
        </a>
    </div>
</div>

{{-- ===== Page Layout ===== --}}
<div class="max-w-[1400px] mx-auto px-5 pb-16 grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start" dir="ltr">

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="lg:order-1" dir="rtl">
    {{-- @if(!request('hide_nav')) --}}
        {{-- Header row --}}
        @php
            $officiantCount       = isset($officiants) ? $officiants->count() : 0;
            $officiantCatName     = 'مأذون شرعي';
            $totalCount           = $partners->count() + $officiantCount;
            $officiantCatInDb     = $categories->contains('name', $officiantCatName);
        @endphp
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-[22px] font-extrabold text-[#0f3d24]">خدمات الشركاء</h1>
            <span id="totalBadge" class="bg-[#1a5c38] text-white text-[13px] font-bold px-4 py-1 rounded-full">
                {{ $totalCount }} مقدم خدمة
            </span>
        </div>

        {{-- Category Filter Chips --}}
        @if(!request('hide_nav'))
        <div class="bg-white rounded-2xl p-4 mb-5 shadow-sm">
            <div class="flex flex-wrap gap-2 items-center">
                <button class="cat-chip active" data-category="" style="font-family:'Cairo',sans-serif;">
                    <i class="fa fa-layer-group text-[10px]"></i>
                    الكل
                </button>
                @foreach($categories as $cat)
                <button class="cat-chip" data-category="{{ $cat->name }}" style="font-family:'Cairo',sans-serif;">
                    {{ $cat->name }}
                    <span class="bg-[#e8f5e9] text-[#1a5c38] text-[10px] font-extrabold px-1.5 py-0.5 rounded-full">
                        {{ $cat->name === $officiantCatName ? $cat->partners_count + $officiantCount : $cat->partners_count }}
                    </span>
                </button>
                @endforeach
                @if(!$officiantCatInDb && $officiantCount > 0)
                <button class="cat-chip" data-category="{{ $officiantCatName }}" style="font-family:'Cairo',sans-serif;">
                    <i class="fa fa-user-tie text-[10px]"></i>
                    {{ $officiantCatName }}
                    <span class="bg-[#e8f5e9] text-[#1a5c38] text-[10px] font-extrabold px-1.5 py-0.5 rounded-full">{{ $officiantCount }}</span>
                </button>
                @endif
            </div>
        </div>
        @endif

<!-- ===== RESULTS BAR ===== -->
<div class="srv-results-bar">
    <p class="srv-results-text" style="font-family:'Cairo',sans-serif;">
        عرض <strong id="visibleCount">{{ $totalCount }}</strong> خدمة من أصل {{ $totalCount }}
    </p>
    <div class="srv-view-btns">
        <button class="srv-view-btn active" id="gridViewBtn" title="عرض شبكي">
            <i class="fa fa-grip"></i>
        </button>
        <button class="srv-view-btn" id="listViewBtn" title="عرض قائمة">
            <i class="fa fa-list"></i>
        </button>
    </div>
</div>

<!-- ===== SERVICES GRID ===== -->
<div class="srv-grid" id="srvGrid">

        @if($partners->count() > 0)
            {{-- ====== REAL DATABASE DATA ====== --}}
            @forelse($partners as $partner)
            @php
                $catName = $partner->category?->name ?? '';
                $logo    = $partner->logo_url ?? null;
                $svcCount = $partner->services->count();
                $firstSvc = $partner->services->first();
            @endphp
            <div class="srv-card" data-category="{{ $catName }}"
                 onclick="openRequestModal('{{ addslashes($partner->company_name) }}', '{{ addslashes($catName) }}')">
                <div class="srv-card-banner" style="background: linear-gradient(135deg, #e8f5e9 0%, #f0faf4 100%);">
                    @if($logo)
                        <img src="{{ $logo }}" alt="{{ $partner->company_name }}" class="banner-img" style="object-fit:contain; padding:20px;">
                    @else
                        <i class="fa fa-handshake banner-icon"></i>
                    @endif
                    @if($catName)
                    <span class="srv-card-category">{{ $catName }}</span>
                    @endif
                    <span class="srv-card-rating"><i class="fa fa-star"></i> 4.8</span>
                </div>
                <div class="srv-card-body">
                    <h3 class="srv-card-title">{{ $partner->company_name }}</h3>
                    <p class="srv-card-desc">
                        {{ $partner->description ?? 'خدمات متكاملة ومتخصصة لتلبية احتياجاتك بأعلى معايير الجودة والاحترافية.' }}
                    </p>
                    <div class="srv-card-tags">
                        @if($partner->city)
                            <span class="srv-tag"><i class="fa fa-location-dot" style="font-size:10px;"></i> {{ $partner->city }}</span>
                        @endif
                        @if($svcCount > 0)
                            <span class="srv-tag">{{ $svcCount }} خدمة</span>
                        @endif
                    </div>
                    <div class="srv-card-footer">
                        @if($firstSvc && $firstSvc->price)
                            <div class="srv-card-price">{{ $firstSvc->price }} <span>/ خدمة</span></div>
                        @else
                            <div class="srv-card-price">حسب الطلب <span></span></div>
                        @endif
                    </div>
                    {{-- CTA Buttons --}}
                    <div style="display:flex;gap:8px;margin-top:auto;">
                        <button onclick="event.stopPropagation(); window.location.href='{{ route('partners.profile', $partner) }}'"
                                class="flex-1 flex items-center justify-center gap-2 bg-[#1a5c38] text-white border-none rounded-xl py-2.5 text-[13px] font-bold cursor-pointer transition-colors hover:bg-[#155230]"
                                style="font-family:'Cairo',sans-serif;">
                            <i class="fa fa-eye"></i> عرض الملف
                        </button>
                        @if($firstSvc)
                        @auth
                        <button onclick="event.stopPropagation(); openServiceCartModal({{ $firstSvc->id }}, '{{ addslashes($partner->company_name) }} — {{ addslashes($firstSvc->title) }}')"
                                style="display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:0 14px;background:#f0fdf4;color:#1a5c38;border:1.5px solid #a8c9a4;border-radius:12px;font-family:'Cairo',sans-serif;font-size:13px;font-weight:800;cursor:pointer;white-space:nowrap;transition:background .2s;"
                                onmouseover="this.style.background='#d1fae5'" onmouseout="this.style.background='#f0fdf4'">
                            <i class="fa fa-cart-plus"></i>
                        </button>
                        @else
                        <a href="{{ route('login') }}"
                           onclick="event.stopPropagation();"
                           style="display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:0 14px;background:#f0fdf4;color:#1a5c38;border:1.5px solid #a8c9a4;border-radius:12px;font-size:13px;font-weight:800;text-decoration:none;">
                            <i class="fa fa-cart-plus"></i>
                        </a>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>

            @empty
            <div class="col-span-2 text-center py-12 text-gray-400">
                <i class="fas fa-handshake text-5xl opacity-30 block mb-3"></i>
                لا يوجد شركاء متاحون حالياً
            </div>
            @endforelse
        @endif

        {{-- ===== OFFICIANT CARDS (inside same grid, category = مأذون شرعي) ===== --}}
        @if(isset($officiants) && $officiants->isNotEmpty())
            @foreach($officiants as $officiant)
            @php
                $svcCount = $officiant->services->count();
                $firstSvc = $officiant->services->first();
                $photoUrl = $officiant->profile_photo
                                ? route('public.storage', ['path' => $officiant->profile_photo])
                                : null;
            @endphp
            <div class="srv-card" data-category="{{ $officiantCatName }}">
                <div class="srv-card-banner" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
                    @if($photoUrl)
                        <img src="{{ $photoUrl }}" alt="{{ $officiant->user->name }}" class="banner-img" style="object-fit:cover;">
                    @else
                        <i class="fa fa-user-tie banner-icon" style="color:#1a5c38;"></i>
                    @endif
                    <span class="srv-card-category">{{ $officiantCatName }}</span>
                    @if($officiant->city)
                    <span class="srv-card-rating" style="color:#fff;"><i class="fa fa-location-dot"></i> {{ $officiant->city }}</span>
                    @endif
                </div>
                <div class="srv-card-body">
                    <h3 class="srv-card-title">{{ $officiant->user?->name }}</h3>
                    <div class="srv-card-tags">
                        @if($officiant->working_hours)
                            <span class="srv-tag"><i class="fa fa-clock" style="font-size:10px;"></i> {{ $officiant->working_hours }}</span>
                        @endif
                        @if($svcCount > 0)
                            <span class="srv-tag">{{ $svcCount }} خدمة</span>
                        @endif
                    </div>
                    <div class="srv-card-footer">
                        @if($firstSvc?->price)
                            <div class="srv-card-price">{{ $firstSvc->price }} <span>/ خدمة</span></div>
                        @else
                            <div class="srv-card-price">حسب الطلب</div>
                        @endif
                    </div>
                    <div style="display:flex;gap:8px;margin-top:12px;">
                        <button onclick="window.location.href='{{ route('officiants.profile', $officiant->id) }}'"
                                class="flex-1 flex items-center justify-center gap-2 bg-[#1a5c38] text-white border-none rounded-xl py-2.5 text-[13px] font-bold cursor-pointer transition-colors hover:bg-[#155230]"
                                style="font-family:'Cairo',sans-serif;">
                            <i class="fa fa-eye"></i> عرض الملف
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        @endif

        </div>{{-- /#srvGrid --}}

        {{-- No results message --}}
        <div id="noResults" class="hidden text-center py-12 text-gray-400">
            <i class="fas fa-search text-5xl opacity-30 block mb-3"></i>
            <p>لا توجد نتائج لهذا التصنيف</p>
        </div>

    </div>{{-- /main col --}}

    {{-- ===== SIDEBAR ===== --}}
    <div class="flex flex-col gap-4 lg:sticky lg:top-5 lg:order-2" style="padding-right: 68px" dir="rtl">

        {{-- Logo + CTA Card --}}
        <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            <div class="bg-gradient-to-br from-[#1a5c38] to-[#2d8a5a]">
                <img src="/images/new-logo1.png" alt="أمر تم" class="w-full object-cover bg-white">
            </div>
            <div class="p-4 flex flex-col gap-2">
                @auth
                    @php
                        $userRole = Auth::user()->role->value;
                        $dashboardRoute = match($userRole) {
                            'partner'    => route('partner.dashboard'),
                            'officiant'  => route('officiant.dashboard'),
                            'owner'      => route('owner.dashboard'),
                            'admin'      => route('admin.dashboard'),
                            'supervisor' => route('supervisor.dashboard'),
                            'manager'    => route('manager.dashboard'),
                            'agent'      => route('agent.dashboard'),
                            default      => url('/'),
                        };
                    @endphp
                    <a href="{{ $dashboardRoute }}"
                       class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-[13px] font-bold bg-[#1a5c38] text-white no-underline hover:opacity-90 transition-opacity"
                       style="font-family:'Cairo',sans-serif;">
                        <i class="fa fa-gauge"></i>
                        لوحة التحكم
                    </a>
                @else
                <a href="{{ route('login') }}"
                   class="flex items-center justify-center gap-2 py-2.5 rounded-xl text-[13px] font-bold bg-[#1a5c38] text-white no-underline hover:opacity-90 transition-opacity"
                   style="font-family:'Cairo',sans-serif;">
                    <i class="fa fa-right-to-bracket"></i>
                    تسجيل الدخول
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

        {{-- Search Card --}}
        {{-- <div class="bg-white rounded-[18px] shadow-md p-4">
            <div class="text-sm font-extrabold text-[#0f3d24] mb-3 flex items-center gap-1.5">
                <i class="fa fa-magnifying-glass text-[#1a5c38]"></i>
                بحث عن شريك
            </div>
            <div class="relative">
                <input type="text" id="sidebarSearch" placeholder="ابحث باسم الشركة أو التصنيف..."
                       class="w-full bg-[#f8faf9] border-[1.5px] border-[#d1e8d8] rounded-xl px-4 py-2.5 text-[13px] text-gray-700 outline-none focus:border-[#1a5c38] transition-colors pr-10"
                       style="font-family:'Cairo',sans-serif;">
                <i class="fa fa-search absolute right-3 top-1/2 -translate-y-1/2 text-[#9ca3af] text-sm pointer-events-none"></i>
            </div>
        </div> --}}

        {{-- Stats Card --}}
        <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            

        {{-- Categories Card --}}
        @if($categories->count() > 0)
        <div class="bg-white rounded-[18px] shadow-md overflow-hidden">
            <div class="p-4">
                <div class="text-sm font-extrabold text-[#0f3d24] mb-3 flex items-center gap-1.5">
                    <i class="fa fa-layer-group text-[#1a5c38]"></i>
                    تصنيفات الخدمات
                </div>
                <div class="flex flex-col gap-1.5">
                    <button class="sidebar-cat-btn w-full flex items-center gap-3 py-2 px-3 rounded-xl transition-all text-right"
                            data-category=""
                            style="font-family:'Cairo',sans-serif; background:#1a5c38; border:1.5px solid #1a5c38; cursor:pointer;" id="sidebarAllBtn">
                        <div style="min-width:30px;height:30px;border-radius:8px;background:rgba(255,255,255,0.25);color:#fff;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            {{ $totalCount }}
                        </div>
                        <span style="font-size:13px;font-weight:700;color:#fff;flex:1;line-height:1.3;">الكل</span>
                        <i class="fa fa-angle-left" style="color:rgba(255,255,255,0.6);font-size:11px;flex-shrink:0;"></i>
                    </button>
                    @foreach($categories as $cat)
                    @php $catDisplayCount = $cat->name === $officiantCatName ? $cat->partners_count + $officiantCount : $cat->partners_count; @endphp
                    <button class="sidebar-cat-btn w-full flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-[#e8f5e9] transition-all text-right"
                            data-category="{{ $cat->name }}"
                            style="font-family:'Cairo',sans-serif; background:#f8fdf9; border:1.5px solid #e2ede7; cursor:pointer;">
                        <div style="min-width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#1a5c38,#2d8a5a);color:#fff;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            {{ $catDisplayCount }}
                        </div>
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;flex:1;line-height:1.3;">{{ $cat->name }}</span>
                        <i class="fa fa-angle-left" style="color:#9ca3af;font-size:11px;flex-shrink:0;"></i>
                    </button>
                    @endforeach
                    {{-- Virtual officiant category button (only if not already in DB categories) --}}
                    @if(!$officiantCatInDb && $officiantCount > 0)
                    <button class="sidebar-cat-btn w-full flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-[#e8f5e9] transition-all text-right"
                            data-category="{{ $officiantCatName }}"
                            style="font-family:'Cairo',sans-serif; background:#f8fdf9; border:1.5px solid #e2ede7; cursor:pointer;">
                        <div style="min-width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#1a5c38,#2d8a5a);color:#fff;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            {{ $officiantCount }}
                        </div>
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;flex:1;line-height:1.3;">{{ $officiantCatName }}</span>
                        <i class="fa fa-angle-left" style="color:#9ca3af;font-size:11px;flex-shrink:0;"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- Cities Card --}}
        @if($partners->pluck('city')->filter()->unique()->count() > 0)
        <div class="bg-white rounded-[18px] shadow-md overflow-hidden mt-8">
            <div class="p-4">
                <div class="text-sm font-extrabold text-[#0f3d24] mb-3 flex items-center gap-1.5">
                    <i class="fa fa-city text-[#1a5c38]"></i>
                    المدن المتاحة
                </div>
                @foreach($partners->pluck('city')->filter()->unique()->sort() as $city)
                <div class="flex items-center justify-between py-2 border-b border-[#f0f4f2] last:border-b-0 text-[13px]">
                    <span class="font-bold text-[#0f3d24]" style="font-family:'Cairo',sans-serif;">{{ $city }}</span>
                    <span class="bg-[#e8f5e9] text-[#1a5c38] text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                        {{ $partners->where('city', $city)->count() }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>{{-- /sidebar --}}
</div>{{-- /page wrapper --}}

{{-- ===== REQUEST MODAL ===== --}}
<div class="req-modal-overlay" id="reqModalOverlay" onclick="closeRequestModal(event)">
    <div class="req-modal" dir="rtl">
        <button class="req-modal-close" onclick="closeReqModal()"><i class="fa fa-xmark"></i></button>
        <div id="reqFormWrap">
            <div class="req-modal-badge"><i class="fa fa-handshake"></i> طلب خدمة</div>
            <h2>طلب الخدمة</h2>
            <p class="req-modal-sub" id="reqModalSubtitle">اكتب تفاصيل طلبك وسيتواصل معك الشريك</p>
            <form onsubmit="submitServiceRequest(event)">
                <input type="hidden" id="reqCompany" name="company">
                <input type="hidden" id="reqCategory" name="category">
                <div class="req-field">
                    <label>الاسم الكامل <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" placeholder="اكتب اسمك الكامل" required
                           @auth value="{{ Auth::user()->name }}" @endauth>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="req-field">
                        <label>رقم الجوال <span style="color:#ef4444;">*</span></label>
                        <input type="tel" name="phone" placeholder="+966 5X XXX XXXX" required dir="ltr">
                    </div>
                    <div class="req-field">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="example@email.com" dir="ltr"
                               @auth value="{{ Auth::user()->email }}" @endauth>
                    </div>
                </div>
                <div class="req-field">
                    <label>تفاصيل الطلب</label>
                    <textarea name="message" placeholder="اكتب تفاصيل طلبك هنا..."></textarea>
                </div>
                <button type="submit" class="req-submit-btn" style="font-family:'Cairo',sans-serif;">
                    <i class="fa fa-paper-plane"></i> إرسال الطلب
                </button>
            </form>
        </div>
        <div class="req-success" id="reqSuccess" style="display:none;">
            <i class="fa fa-circle-check"></i>
            <h3>تم إرسال طلبك بنجاح!</h3>
            <p>سيتواصل معك الشريك خلال 24 ساعة عمل. يمكنك متابعة طلباتك من لوحة التحكم.</p>
            <button onclick="closeReqModal()" class="srv-card-btn" style="margin-top:20px;padding:12px 28px;font-family:'Cairo',sans-serif;">
                <i class="fa fa-check"></i> حسناً
            </button>
        </div>
    </div>
</div>

<script>
/* ---- Category filter ---- */
const cards = Array.from(document.querySelectorAll('.srv-card[data-category]'));
const visibleCountEl = document.getElementById('visibleCount');
const noResults = document.getElementById('noResults');

function filterServices(cat) {
    let visible = 0;
    cards.forEach(card => {
        const match = !cat || card.dataset.category === cat;
        card.style.display = match ? 'flex' : 'none';
        card.style.flexDirection = match ? 'column' : '';
        if (match) visible++;
    });
    if (visibleCountEl) visibleCountEl.textContent = visible;
    if (noResults) noResults.classList.toggle('hidden', visible > 0);
}

/* cat chips (top filter) */
document.querySelectorAll('.cat-chip').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterServices(btn.dataset.category);
    });
});

/* sidebar cat buttons - update active state */
document.querySelectorAll('.sidebar-cat-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        /* reset all sidebar buttons */
        document.querySelectorAll('.sidebar-cat-btn').forEach(b => {
            b.style.background = '#f8fdf9';
            b.style.borderColor = '#e2ede7';
            b.querySelector('span').style.color = '#0f3d24';
            const icon = b.querySelector('i.fa-angle-left');
            if (icon) icon.style.color = '#9ca3af';
            const badge = b.querySelector('div[style*="min-width"]');
            if (badge) { badge.style.background = 'linear-gradient(135deg,#1a5c38,#2d8a5a)'; badge.style.color = '#fff'; }
        });
        /* activate clicked */
        btn.style.background = '#1a5c38';
        btn.style.borderColor = '#1a5c38';
        const sp = btn.querySelector('span');
        if (sp) sp.style.color = '#fff';
        const ic = btn.querySelector('i.fa-angle-left');
        if (ic) ic.style.color = 'rgba(255,255,255,0.6)';
        const bdg = btn.querySelector('div[style*="min-width"]');
        if (bdg) { bdg.style.background = 'rgba(255,255,255,0.25)'; }
        /* sync top chips */
        document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
        const chip = document.querySelector(`.cat-chip[data-category="${btn.dataset.category}"]`);
        if (chip) chip.classList.add('active');
        filterServices(btn.dataset.category);
        /* clear search */
        const sb = document.getElementById('sidebarSearch');
        if (sb) sb.value = '';
    });
});

/* ---- Sidebar search ---- */
const sidebarSearchEl = document.getElementById('sidebarSearch');
if (sidebarSearchEl) {
    sidebarSearchEl.addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        let visible = 0;
        cards.forEach(card => {
            const name = (card.querySelector('.srv-card-title')?.textContent || '').toLowerCase();
            const cat  = (card.dataset.category || '').toLowerCase();
            const match = !q || name.includes(q) || cat.includes(q);
            card.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (visibleCountEl) visibleCountEl.textContent = visible;
        if (noResults) noResults.classList.toggle('hidden', visible > 0);
        /* reset category chips if searching */
        if (q) {
            document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
        }
    });
}

/* ---- Grid / List view toggle ---- */
const srvGrid = document.getElementById('srvGrid');
document.getElementById('gridViewBtn').addEventListener('click', function() {
    srvGrid.classList.remove('list-view');
    this.classList.add('active');
    document.getElementById('listViewBtn').classList.remove('active');
});
document.getElementById('listViewBtn').addEventListener('click', function() {
    srvGrid.classList.add('list-view');
    this.classList.add('active');
    document.getElementById('gridViewBtn').classList.remove('active');
});

/* ---- Request Modal ---- */
function openRequestModal(company, category) {
    document.getElementById('reqCompany').value = company;
    document.getElementById('reqCategory').value = category;
    document.getElementById('reqModalSubtitle').textContent = 'طلب خدمة من: ' + company;
    document.getElementById('reqFormWrap').style.display = '';
    document.getElementById('reqSuccess').style.display = 'none';
    document.getElementById('reqModalOverlay').classList.add('open');
}
function closeReqModal() {
    document.getElementById('reqModalOverlay').classList.remove('open');
}
function closeRequestModal(e) {
    if (e.target === document.getElementById('reqModalOverlay')) closeReqModal();
}
function submitServiceRequest(e) {
    e.preventDefault();
    const btn = e.target.querySelector('.req-submit-btn');
    btn.textContent = 'جاري الإرسال...';
    btn.disabled = true;
    setTimeout(() => {
        document.getElementById('reqFormWrap').style.display = 'none';
        document.getElementById('reqSuccess').style.display = 'block';
    }, 1200);
}

/* ---- URL category param (from halls_list redirect) ---- */
const urlCat = new URLSearchParams(window.location.search).get('category');
if (urlCat) {
    /* run filter directly */
    filterServices(urlCat);

    /* activate matching cat-chip */
    document.querySelectorAll('.cat-chip').forEach(b => b.classList.remove('active'));
    const chip = document.querySelector(`.cat-chip[data-category="${urlCat}"]`);
    if (chip) chip.classList.add('active');

    /* activate matching sidebar button */
    document.querySelectorAll('.sidebar-cat-btn').forEach(b => {
        const isMatch = b.dataset.category === urlCat;
        b.style.background    = isMatch ? '#1a5c38' : '#f8fdf9';
        b.style.borderColor   = isMatch ? '#1a5c38' : '#e2ede7';
        const sp  = b.querySelector('span');
        const ic  = b.querySelector('i.fa-angle-left');
        const bdg = b.querySelector('div[style*="min-width"]');
        if (sp)  sp.style.color  = isMatch ? '#fff' : '#0f3d24';
        if (ic)  ic.style.color  = isMatch ? 'rgba(255,255,255,0.6)' : '#9ca3af';
        if (bdg) bdg.style.background = isMatch ? 'rgba(255,255,255,0.25)' : 'linear-gradient(135deg,#1a5c38,#2d8a5a)';
    });
}
</script>

{{-- Shared Cart Modal (services list) --}}
@auth
<div id="service-cart-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:20px;padding:28px;max-width:400px;width:92%;font-family:'Cairo',sans-serif;direction:rtl;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h3 style="font-size:16px;font-weight:800;color:#0f3d24;"><i class="fa fa-cart-plus" style="margin-left:8px;color:#2d6a4f;"></i>أضف للسلة</h3>
            <button onclick="document.getElementById('service-cart-modal').style.display='none'"
                    style="background:none;border:none;font-size:22px;cursor:pointer;color:#9ca3af;line-height:1;">×</button>
        </div>
        <div id="service-cart-modal-label" style="background:#f0faf4;border-radius:12px;padding:12px 14px;margin-bottom:18px;font-size:13px;font-weight:800;color:#0f3d24;"></div>
        <form method="POST" action="{{ route('cart.add') }}" id="service-cart-form">
            @csrf
            <input type="hidden" name="item_type" value="service">
            <input type="hidden" name="item_id" id="service-cart-item-id">
            <div style="margin-bottom:20px;">
                <label style="font-size:12.5px;font-weight:700;color:#0f3d24;display:block;margin-bottom:7px;">
                    <i class="fa fa-calendar" style="margin-left:5px;color:#2d6a4f;"></i>تاريخ المناسبة
                </label>
                <input type="date" name="event_date" id="service-event-month" min="{{ date('Y-m-d') }}"
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
<script>
function openServiceCartModal(serviceId, label) {
    document.getElementById('service-cart-item-id').value = serviceId;
    document.getElementById('service-cart-modal-label').textContent = label;
    document.getElementById('service-event-month').value = '';
    document.getElementById('service-cart-modal').style.display = 'flex';
}
</script>
@endauth

</body>
</html>
