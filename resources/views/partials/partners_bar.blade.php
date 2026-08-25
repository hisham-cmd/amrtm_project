{{--
    Reusable Partners / Services marquee bar + modal.
    Requires the parent page/controller to pass:
      - $featureCategories  (Collection of category name strings)
      - $partnersByCategory (Array keyed by category name)
--}}
@if(isset($featureCategories) && $featureCategories->isNotEmpty())

{{-- ── Inline styles (rendered only once per page via @once) ── --}}
@once
<style>
    /* ================================
       SERVICES BAR — Harmonized with Header
    ================================ */
    .services-bar {
        position: relative;
        background: #2d8a5a; /* نفس درجة الهيدر المريحة */
        padding: 20px 5% 38px;
        overflow: visible;
        clip-path: none;
        margin-top: 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .services-bar-header {
        position: relative;
        z-index: 1;
        text-align: center;
        margin-bottom: 18px;
        margin-top: 0;
    }
    .services-bar-header .sb-line {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }
    .services-bar-header .sb-line::before,
    .services-bar-header .sb-line::after {
        content: none;
    }
    .services-bar-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
        border: 2px solid rgba(255, 255, 255, 0.35);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #a7f3d0;
        font-size: 17px;
    }
    .services-bar-label {
        font-size: 14px;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: .01em;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    }

    .services-track-wrapper {
        overflow: hidden;
        position: relative;
        z-index: 1;
        direction: ltr; /* Force LTR for predictable animation math */
        padding: 16px 0 18px;
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 80px, black calc(100% - 80px), transparent 100%);
        mask-image: linear-gradient(to right, transparent 0%, black 80px, black calc(100% - 80px), transparent 100%);
    }
    
    .services-track {
        display: flex;
        width: max-content;
        gap: 12px;
        align-items: center;
        /* Forced important to bypass any Tailwind prefers-reduced-motion rules! */
        animation: servicesMarquee 25s linear infinite !important;
        animation-play-state: running !important;
        transform: translateX(0);
    }
    
    .services-track:hover {
        animation-play-state: paused !important;
    }
    
    @keyframes servicesMarquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .svc-chip {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 20px;
        background: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-radius: 50px;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 800;
        color: #145b35;
        white-space: nowrap;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15), 0 2px 6px rgba(0, 0, 0, 0.08);
        transition: background .35s ease, border-color .35s ease, color .35s ease, box-shadow .35s ease, transform .35s ease;
        user-select: none;
    }
    .svc-chip:hover {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(255, 255, 255, 0.6);
        color: #0f3d24;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.22), 0 3px 10px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px) scale(1.015);
    }
    .svc-chip .chip-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #2a9f62;
        flex-shrink: 0;
        transition: background .35s ease;
        box-shadow: 0 0 0 3px rgba(42, 159, 98, 0.18);
    }
    .svc-chip:hover .chip-dot {
        background: #145b35;
        box-shadow: 0 0 0 3px rgba(20, 91, 53, 0.2);
    }

    @media (max-width: 768px) {
        .services-bar {
            padding: 30px 4% 30px;
            clip-path: none;
            margin-top: -20px;
        }
        .services-bar-header {
            margin-bottom: 14px;
        }
        .services-bar-label {
            font-size: 12.5px;
            line-height: 1.65;
        }
        .services-track-wrapper {
            padding: 12px 0 14px;
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 28px, black calc(100% - 28px), transparent 100%);
            mask-image: linear-gradient(to right, transparent 0%, black 28px, black calc(100% - 28px), transparent 100%);
        }
        .svc-chip {
            padding: 9px 16px;
            font-size: 12.5px;
        }
        }
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
        background: rgba(10, 30, 18, 0.62);
        backdrop-filter: blur(3px);
        cursor: pointer;
    }
    .pm-box {
        position: relative;
        z-index: 1;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.28);
        width: min(520px, 93vw);
        max-height: 82vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: pmIn .22s cubic-bezier(.34, 1.56, .64, 1);
    }
    @keyframes pmIn {
        from {
            transform: scale(.88) translateY(20px);
            opacity: 0;
        }
        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }
    .pm-header {
        padding: 20px 22px 16px;
        background: linear-gradient(135deg, #145b35, #2a9f62);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .pm-header-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
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
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s;
    }
    .pm-close:hover {
        background: rgba(255, 255, 255, 0.28);
    }
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
        box-shadow: 0 2px 8px rgba(26, 92, 56, 0.07);
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        cursor: default;
    }
    .pm-partner-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(26, 92, 56, 0.12);
        border-color: #6ee7a8;
    }
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
        color: #2a9f62;
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
</style>
@endonce

{{-- ── Data for JS ── --}}
<script id="partnersCategoryData" type="application/json">
    {!! json_encode($partnersByCategory, JSON_UNESCAPED_UNICODE) !!}
</script>

{{-- ── Marquee bar ── --}}
<section class="services-bar" dir="rtl">
    <div class="services-bar-header">
        <div class="sb-line">
            <span class="services-bar-icon"><i class="fa fa-handshake"></i></span>
        </div>
        <p class="services-bar-label">خدمات شركائنا وموردينا المعتمدين — اضغط على أي خدمة لعرض الشركات</p>
    </div>
    <div class="services-track-wrapper">
        <div class="services-track" id="servicesTrack" dir="ltr">
            {{-- Multiple sets inside so width is guaranteed to exceed screen twice over --}}
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            
            {{-- Mirror Set for seamless 50% jump back --}}
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
            @foreach($featureCategories as $cat)
            <button class="svc-chip" data-category="{{ $cat }}" type="button">
                <span class="chip-dot"></span>{{ $cat }}
            </button>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Modal ── --}}
<div id="partnersModal" role="dialog" aria-modal="true" aria-labelledby="pmTitle">
    <div class="pm-backdrop" id="pmBackdrop"></div>
    <div class="pm-box">
        <div class="pm-header">
            <div class="pm-header-icon"><i class="fa fa-building"></i></div>
            <div class="pm-title" id="pmTitle">الشركاء</div>
            <button class="pm-close" id="pmClose" aria-label="إغلاق"><i class="fa fa-xmark"></i></button>
        </div>
        <div class="pm-body" id="pmBody">
            {{-- populated by JS --}}
        </div>
    </div>
</div>

{{-- ── JS ── --}}
<script>
(function () {
    const dataEl = document.getElementById('partnersCategoryData');
    if (!dataEl) return;

    const partnersByCategory = JSON.parse(dataEl.textContent);
    const modal      = document.getElementById('partnersModal');
    const pmTitle    = document.getElementById('pmTitle');
    const pmBody     = document.getElementById('pmBody');
    const pmClose    = document.getElementById('pmClose');
    const pmBackdrop = document.getElementById('pmBackdrop');

    function openModal(category) {
        // إذا كانت الصفحة تحتوي على showPartnersSection (مثل halls_list) → فوّض إليها
        if (typeof window.showPartnersSection === 'function') {
            window.showPartnersSection(category);
            return;
        }
        pmTitle.textContent = category;
        const partners = partnersByCategory[category] || [];

        if (partners.length === 0) {
            pmBody.innerHTML = `<div class="pm-empty">
                <i class="fa fa-building" style="font-size:2.5rem;opacity:.2;display:block;margin-bottom:12px;"></i>
                لا توجد شركات مسجّلة في هذه الفئة حتى الآن
            </div>`;
        } else {
            const cards = partners.map(p => {
                const logoHtml = p.logo_url
                    ? `<img src="${p.logo_url}" alt="${p.name}" loading="lazy">`
                    : `<i class="fa fa-building pm-placeholder-icon"></i>`;
                return `<div class="pm-partner-card">
                    <div class="pm-logo-wrap">${logoHtml}</div>
                    <span class="pm-partner-name">${p.name}</span>
                </div>`;
            }).join('');
            pmBody.innerHTML = `<div class="pm-partners-grid">${cards}</div>`;
        }

        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }

    // Marquee JS
    const track = document.getElementById('servicesTrack');
    if (track) {
        const totalWidth = track.scrollWidth / 2; // half because we have duplicates
        let pos = 0;
        let paused = false;
        track.addEventListener('mouseenter', () => paused = true);
        track.addEventListener('mouseleave', () => paused = false);
        function marqueeStep() {
            if (!paused) {
                pos += 1;
                if (pos >= totalWidth) pos = 0;
                track.style.transform = `translateX(-${pos}px)`;
            }
            requestAnimationFrame(marqueeStep);
        }
        requestAnimationFrame(marqueeStep);
    }

    document.getElementById('servicesTrack')?.addEventListener('click', e => {
        const chip = e.target.closest('.svc-chip');
        if (!chip) return;
        const category = chip.dataset.category;
        // إذا كانت صفحة القاعات، استخدم الـ section المدمج بدل الـ modal
        if (typeof showPartnersSection === 'function') {
            showPartnersSection(category);
        } else {
            openModal(category);
        }
    });

    pmClose.addEventListener('click', closeModal);
    pmBackdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
})();
</script>

@endif