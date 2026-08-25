{{--
    Sponsors Bar — trusted community partners & special relations.
    Place directly after @include('partials.header')
    Usage: @include('partials.sponsors_bar')
--}}
@once
<style>
    /* ==============================
       SPONSORS BAR
    ============================== */
    .spb-section {
        position: relative;
        background: linear-gradient(180deg, #0f3d24 0%, #1a6640 30%, #2d8a5a 60%, #cce9d8 100%);
        padding: 36px 5% 40px;
        overflow: hidden;
    }

    /* Curved bottom — page bg bites into section bottom */
    .spb-section::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 50px;
        background: #f0f4f2;
        border-radius: 50% 50% 0 0 / 50px 50px 0 0;
        pointer-events: none;
    }

    /* Header */
    .spb-header {
        position: relative;
        z-index: 1;
        text-align: center;
        margin-bottom: 22px;
        margin-top: 10px;
    }
    .spb-header .spb-line {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        margin-bottom: 6px;
    }
    .spb-header .spb-line::before,
    .spb-header .spb-line::after {
        content: '';
        flex: 1;
        max-width: 80px;
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.35));
    }
    .spb-header .spb-line::after {
        background: linear-gradient(to left, transparent, rgba(255,255,255,0.35));
    }
    .spb-icon-circle {
        width: 38px; height: 38px;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.35);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #a7f3d0;
        font-size: 15px;
    }
    .spb-header-label {
        font-size: 13px;
        font-weight: 700;
        color: rgba(255,255,255,0.85);
        letter-spacing: .07em;
        font-family: 'Cairo', sans-serif;
    }

    /* Marquee */
    .spb-track-wrapper {
        overflow: hidden;
        position: relative;
        z-index: 1;
        direction: ltr;
        padding: 8px 0;
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 60px, black calc(100% - 60px), transparent 100%);
        mask-image:         linear-gradient(to right, transparent 0%, black 60px, black calc(100% - 60px), transparent 100%);
    }
    .spb-track {
        display: flex;
        direction: ltr;
        width: max-content;
        gap: 14px;
        animation: spbMarquee 40s linear infinite;
        will-change: transform;
    }
    .spb-track:hover { animation-play-state: paused; }
    @keyframes spbMarquee {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Chips */
    .spb-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 20px;
        background: rgba(255,255,255,0.55);
        border: 1.5px solid rgba(26,92,56,0.30);
        border-radius: 40px;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #0f3d24;
        white-space: nowrap;
        cursor: default;
        backdrop-filter: blur(6px);
        transition: background .18s, border-color .18s, color .18s, transform .18s, box-shadow .18s;
        user-select: none;
    }
    .spb-chip:hover {
        background: rgba(255,255,255,0.95);
        border-color: #2d8a5a;
        color: #0f3d24;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 6px 20px rgba(26,92,56,0.14);
    }
    .spb-chip .spb-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #2d8a5a;
        flex-shrink: 0;
        transition: background .18s;
    }
    .spb-chip:hover .spb-dot {
        background: #1a5c38;
    }

    @media (max-width: 768px) {
        .spb-section { padding: 28px 3% 32px; }
        .spb-chip { font-size: 12px; padding: 7px 14px; }
    }
</style>
@endonce

<section class="spb-section" dir="rtl">

    {{-- Header --}}
    <div class="spb-header">
        <div class="spb-line">
            <span class="spb-icon-circle"><i class="fa fa-handshake"></i></span>
        </div>
        <span class="spb-header-label">شركاؤنا المميزون</span>
    </div>

    {{-- Marquee --}}
    <div class="spb-track-wrapper">
        <div class="spb-track">
            @php
            $sponsors = [
                ['name' => 'الغرفة التجارية',    'icon' => 'fa-building-columns'],
                ['name' => 'هيئة الفعاليات',     'icon' => 'fa-star'],
                ['name' => 'رواد الأعمال',        'icon' => 'fa-rocket'],
                ['name' => 'شركة تقنية المدينة',  'icon' => 'fa-microchip'],
                ['name' => 'بنك التنمية',         'icon' => 'fa-landmark'],
                ['name' => 'منصة نشاط',           'icon' => 'fa-chart-line'],
                ['name' => 'مجموعة رؤية',         'icon' => 'fa-eye'],
                ['name' => 'أكاديمية ريادة',      'icon' => 'fa-graduation-cap'],
                ['name' => 'تحالف الضيافة',       'icon' => 'fa-utensils'],
                ['name' => 'مبادرة ازدهار',       'icon' => 'fa-seedling'],
            ];
            @endphp

            {{-- First copy --}}
            @foreach($sponsors as $sp)
                <span class="spb-chip">
                    <span class="spb-dot"></span>
                    <i class="fa {{ $sp['icon'] }}" style="font-size:12px; color:#2d8a5a; opacity:.8"></i>
                    {{ $sp['name'] }}
                </span>
            @endforeach

            {{-- Second copy (seamless loop) --}}
            @foreach($sponsors as $sp)
                <span class="spb-chip">
                    <span class="spb-dot"></span>
                    <i class="fa {{ $sp['icon'] }}" style="font-size:12px; color:#2d8a5a; opacity:.8"></i>
                    {{ $sp['name'] }}
                </span>
            @endforeach
        </div>
    </div>

</section>
