<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدمات الشركاء | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
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
        body { font-family: 'Cairo', sans-serif; background: #f0f4f2; color: #1e293b; min-height: 100vh; }
        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }

        /* ── Hero ── */
        .services-hero {
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 50%, #2d8a5a 100%);
            padding: 52px 5% 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .services-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(200,169,81,.12) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 20%, rgba(167,243,208,.08) 0%, transparent 50%);
        }
        .services-hero-content { position: relative; z-index: 1; }
        .services-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.22);
            color: #a7f3d0;
            font-size: 12.5px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 30px;
            margin-bottom: 18px;
            backdrop-filter: blur(4px);
        }
        .services-hero h1 {
            font-size: clamp(24px, 4vw, 38px);
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
            line-height: 1.3;
        }
        .services-hero p {
            font-size: 15px;
            color: rgba(255,255,255,.78);
            max-width: 560px;
            margin: 0 auto 28px;
            line-height: 1.7;
        }
        .hero-stats {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
        }
        .hero-stat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }
        .hero-stat-num {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }
        .hero-stat-label {
            font-size: 12px;
            color: rgba(255,255,255,.65);
            font-weight: 600;
        }
        .hero-stat-sep {
            width: 1px;
            height: 36px;
            background: rgba(255,255,255,.2);
        }

        /* ── Category filter chips ── */
        .filter-bar {
            background: #fff;
            border-bottom: 1px solid #e8f0eb;
            padding: 14px 5%;
            position: sticky;
            top: 0;
            z-index: 50;
            display: flex;
            align-items: center;
            gap: 10px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .filter-bar::-webkit-scrollbar { display: none; }
        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border-radius: 30px;
            font-family: 'Cairo', sans-serif;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            cursor: pointer;
            border: 1.5px solid #d1e8d8;
            background: #f8fdf9;
            color: #0f3d24;
            transition: all .18s;
        }
        .filter-chip:hover, .filter-chip.active {
            background: #1a5c38;
            border-color: #1a5c38;
            color: #fff;
        }
        .filter-chip .chip-count {
            background: rgba(0,0,0,.12);
            color: inherit;
            font-size: 11px;
            font-weight: 800;
            padding: 1px 7px;
            border-radius: 20px;
        }
        .filter-chip.active .chip-count {
            background: rgba(255,255,255,.25);
        }

        /* ── Page layout ── */
        .page-body {
            max-width: 1300px;
            margin: 0 auto;
            padding: 36px 20px 60px;
        }

        /* ── Category section ── */
        .category-section {
            margin-bottom: 52px;
        }
        .category-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 22px;
        }
        .category-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #1a5c38, #2d8a5a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            flex-shrink: 0;
        }
        .category-title {
            font-size: 20px;
            font-weight: 800;
            color: #0f3d24;
        }
        .category-count {
            font-size: 12px;
            color: #6c7a72;
            font-weight: 600;
            background: #f0f4f2;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .category-divider {
            flex: 1;
            height: 1px;
            background: linear-gradient(to left, transparent, #d1e8d8);
        }

        /* ── Partner cards ── */
        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .partner-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1.5px solid #e8f0eb;
            box-shadow: 0 2px 10px rgba(26,92,56,.06);
            display: flex;
            flex-direction: column;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .partner-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(26,92,56,.13);
            border-color: #a7f3d0;
        }

        /* Logo area */
        .partner-logo-area {
            height: 140px;
            background: #f4f9f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            border-bottom: 1px solid #e8f0eb;
        }
        .partner-logo-area img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: 16px;
        }
        .partner-logo-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a5c38, #2d8a5a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 26px;
        }
        .partner-cat-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255,255,255,.95);
            color: #1a5c38;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
        }

        /* Card body */
        .partner-body {
            padding: 18px 18px 0;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .partner-name {
            font-size: 16px;
            font-weight: 800;
            color: #0f3d24;
            line-height: 1.3;
        }
        .partner-desc {
            font-size: 13px;
            color: #6c7a72;
            line-height: 1.6;
            flex: 1;
        }
        .partner-contact {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 4px;
        }
        .partner-contact-row {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12.5px;
            color: #6c7a72;
        }
        .partner-contact-row i {
            color: #1a5c38;
            width: 14px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Card footer */
        .partner-footer {
            padding: 14px 18px 18px;
            display: flex;
            gap: 8px;
        }
        .btn-profile {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #1a5c38;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            text-decoration: none;
            cursor: pointer;
            transition: background .18s;
        }
        .btn-profile:hover { background: #155230; color: #fff; }
        .btn-whatsapp {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            text-decoration: none;
            transition: background .18s, border-color .18s;
            flex-shrink: 0;
        }
        .btn-whatsapp:hover { background: #dcfce7; border-color: #86efac; }
        .btn-phone {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #eff6ff;
            border: 1.5px solid #bfdbfe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            text-decoration: none;
            transition: background .18s, border-color .18s;
            flex-shrink: 0;
        }
        .btn-phone:hover { background: #dbeafe; border-color: #93c5fd; }

        /* Empty state */
        .empty-cat {
            text-align: center;
            padding: 32px;
            color: #9ca3af;
            background: #fff;
            border-radius: 16px;
            border: 1.5px dashed #d1fae5;
        }

        /* Back to halls */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1a5c38;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            background: #f0faf4;
            border: 1.5px solid #d1e8d8;
            padding: 8px 18px;
            border-radius: 30px;
            margin-bottom: 28px;
            transition: background .18s;
        }
        .back-link:hover { background: #e0f5ea; }

        @media (max-width: 640px) {
            .partners-grid { grid-template-columns: 1fr; }
            .hero-stats { gap: 20px; }
            .services-hero { padding: 36px 5% 44px; }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

@php
    $totalPartners = $categories->sum(fn($c) => $c->partners->count());
    $totalCategories = $categories->count();

    $categoryIcons = [
        'default'          => 'fa-handshake',
        'دعوات'            => 'fa-envelope-open-text',
        'الدعوات'          => 'fa-envelope-open-text',
        'الدعوات الالكترونية' => 'fa-mobile-screen',
        'بروتوكول'         => 'fa-crown',
        'بروتوكولات'       => 'fa-crown',
        'بوفية'            => 'fa-utensils',
        'تصوير'            => 'fa-camera-retro',
        'زهور'             => 'fa-seedling',
        'ديكور'            => 'fa-palette',
        'موسيقى'           => 'fa-music',
        'مأذون'            => 'fa-file-contract',
        'مطبخ'             => 'fa-kitchen-set',
    ];

    function getCategoryIcon(array $icons, string $name): string {
        foreach ($icons as $key => $icon) {
            if (str_contains($name, $key)) return $icon;
        }
        return $icons['default'];
    }
@endphp

{{-- ===== HERO ===== --}}
<div class="services-hero">
    <div class="services-hero-content">
        <div class="services-hero-badge">
            <i class="fa fa-handshake"></i>
            منصة أمر تم
        </div>
        <h1>خدمات شركائنا المتميزين</h1>
        <p>نخبة من مزودي الخدمات المتخصصة في مناسباتكم — اختر الخدمة التي تحتاجها وتواصل مباشرة مع مقدمها</p>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">{{ $totalPartners }}</div>
                <div class="hero-stat-label">مقدم خدمة</div>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat-num" style="display:flex;flex-direction:column;align-items:center;gap:2px;">
                <span style="font-size:28px;font-weight:800;color:#fff;line-height:1;">{{ $totalCategories }}</span>
                <span style="font-size:12px;color:rgba(255,255,255,.65);font-weight:600;">تصنيف خدمي</span>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat">
                <div class="hero-stat-num">24/7</div>
                <div class="hero-stat-label">جاهزون للتواصل</div>
            </div>
        </div>
    </div>
</div>

{{-- ===== FILTER CHIPS ===== --}}
@if($categories->count() > 1)
<div class="filter-bar" id="filterBar">
    <button class="filter-chip active" data-target="all" onclick="filterCategory(this, 'all')">
        <i class="fa fa-th-large" style="font-size:11px;"></i>
        الكل
        <span class="chip-count">{{ $totalPartners }}</span>
    </button>
    @foreach($categories as $cat)
    @if($cat->partners->count() > 0)
    <button class="filter-chip" data-target="cat-{{ $cat->id }}" onclick="filterCategory(this, 'cat-{{ $cat->id }}')">
        {{ $cat->name }}
        <span class="chip-count">{{ $cat->partners->count() }}</span>
    </button>
    @endif
    @endforeach
</div>
@endif

{{-- ===== PAGE BODY ===== --}}
<div class="page-body">

    <a href="{{ route('halls.list') }}" class="back-link">
        <i class="fa fa-arrow-right text-xs"></i>
        العودة للقاعات
    </a>

    @forelse($categories as $cat)
    @if($cat->partners->count() > 0)
    <div class="category-section" id="cat-{{ $cat->id }}">

        {{-- Category header --}}
        <div class="category-header">
            <div class="category-icon">
                <i class="fa {{ getCategoryIcon($categoryIcons, $cat->name) }}"></i>
            </div>
            <div>
                <div class="category-title">{{ $cat->name }}</div>
            </div>
            <span class="category-count">{{ $cat->partners->count() }} مقدم خدمة</span>
            <div class="category-divider"></div>
        </div>

        {{-- Partners grid --}}
        <div class="partners-grid">
            @foreach($cat->partners as $partner)
            <div class="partner-card">

                {{-- Logo --}}
                <div class="partner-logo-area">
                    @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->company_name }}" loading="lazy">
                    @else
                        <div class="partner-logo-placeholder">
                            <i class="fa {{ getCategoryIcon($categoryIcons, $cat->name) }}"></i>
                        </div>
                    @endif
                    <span class="partner-cat-badge">{{ $cat->name }}</span>
                </div>

                {{-- Body --}}
                <div class="partner-body">
                    <div class="partner-name">{{ $partner->company_name }}</div>
                    @if($partner->description)
                    <div class="partner-desc">{{ $partner->description }}</div>
                    @else
                    <div class="partner-desc" style="color:#c4ccc8;font-style:italic;">لا يوجد وصف مُدخل</div>
                    @endif
                    <div class="partner-contact">
                        @if($partner->phone)
                        <div class="partner-contact-row">
                            <i class="fa fa-phone"></i>
                            <span>{{ $partner->phone }}</span>
                        </div>
                        @endif
                        @if($partner->whatsapp)
                        <div class="partner-contact-row">
                            <i class="fa-brands fa-whatsapp" style="color:#25d366;"></i>
                            <span>{{ $partner->whatsapp }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Footer buttons --}}
                <div class="partner-footer">
                    <a href="{{ route('partners.profile', $partner->id) }}" class="btn-profile">
                        <i class="fa fa-eye text-xs"></i>
                        تفاصيل الخدمة
                    </a>
                    @if($partner->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $partner->whatsapp) }}" target="_blank" rel="noopener" class="btn-whatsapp" title="واتساب">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    @endif
                    @if($partner->phone)
                    <a href="tel:{{ $partner->phone }}" class="btn-phone" title="اتصال">
                        <i class="fa fa-phone"></i>
                    </a>
                    @endif
                </div>

            </div>
            @endforeach
        </div>

    </div>
    @endif
    @empty
    <div class="empty-cat">
        <i class="fa fa-handshake" style="font-size:3rem;opacity:.2;display:block;margin-bottom:12px;"></i>
        لا يوجد شركاء مضافون حتى الآن
    </div>
    @endforelse

</div>

@include('partials.partners_bar')
@include('partials.footer')

<script>
    function filterCategory(btn, target) {
        // Update chips
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');

        // Show/hide sections
        document.querySelectorAll('.category-section').forEach(sec => {
            if (target === 'all' || sec.id === target) {
                sec.style.display = '';
            } else {
                sec.style.display = 'none';
            }
        });

        // Smooth scroll to top of body
        document.querySelector('.page-body').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>

</body>
</html>
