<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشاريعنا | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <link rel="stylesheet" href="/css/agencies.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ---- Project popup modal ---- */
        .proj-modal-overlay {
            position: fixed; inset: 0; z-index: 9000;
            background: rgba(13,36,72,0.9); backdrop-filter: blur(12px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s; padding: 20px;
        }
        .proj-modal-overlay.active { opacity: 1; visibility: visible; }
        .proj-modal {
            background: linear-gradient(160deg,#0d2448,#1a3a6e);
            border: 1.5px solid rgba(56,189,248,0.3); border-radius: 28px;
            padding: 36px; width: 100%; max-width: 720px; max-height: 88vh;
            overflow-y: auto; position: relative;
            transform: scale(0.93); transition: transform 0.35s ease;
            box-shadow: 0 24px 80px rgba(0,0,0,0.5);
        }
        .proj-modal-overlay.active .proj-modal { transform: scale(1); }
        .proj-modal-close {
            position: absolute; top: 16px; left: 16px;
            background: rgba(255,255,255,0.1); border: none; border-radius: 50%;
            width: 36px; height: 36px; cursor: pointer; color: rgba(255,255,255,0.7);
            font-size: 14px; display: flex; align-items: center; justify-content: center;
            transition: all 0.25s;
        }
        .proj-modal-close:hover { background: rgba(255,255,255,0.2); color: #fff; }
        /* mobile frame */
        .mobile-frame {
            width: 240px; margin: 0 auto 28px;
            background: #1e293b; border-radius: 36px;
            border: 6px solid rgba(56,189,248,0.4);
            box-shadow: 0 0 40px rgba(56,189,248,0.2), 0 16px 48px rgba(0,0,0,0.4);
            overflow: hidden; aspect-ratio: 9/18; position: relative;
        }
        .mobile-frame-notch {
            position: absolute; top: 0; left: 50%; transform: translateX(-50%);
            width: 80px; height: 20px; background: #1e293b;
            border-radius: 0 0 14px 14px; z-index: 2;
        }
        .mobile-frame-screen {
            width: 100%; height: 100%; overflow: hidden;
            display: flex; flex-direction: column;
        }
        .mobile-screen-top {
            height: 36px; display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 800; color: #fff; letter-spacing: 0.5px;
            flex-shrink: 0;
        }
        .mobile-screen-body { flex: 1; overflow: hidden; position: relative; }
        .proj-modal-content { display: grid; grid-template-columns: auto 1fr; gap: 36px; align-items: start; }
        .proj-modal-info h2 { font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 8px; }
        .proj-modal-info .proj-tag { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; padding: 4px 14px; border-radius: 20px; margin-bottom: 14px; }
        .proj-modal-info p { font-size: 14px; color: rgba(255,255,255,0.72); line-height: 1.85; margin-bottom: 16px; }
        .proj-detail-list { list-style: none; margin-bottom: 20px; }
        .proj-detail-list li { display: flex; align-items: center; gap: 10px; font-size: 13.5px; color: rgba(255,255,255,0.75); margin-bottom: 10px; padding: 8px 12px; background: rgba(56,189,248,0.07); border-radius: 10px; border: 1px solid rgba(56,189,248,0.12); }
        .proj-detail-list li i { color: #38bdf8; min-width: 16px; }
        .proj-modal-btn { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg,#0ea5e9,#7c3aed); color: #fff; text-decoration: none; font-family: 'Cairo',sans-serif; font-size: 14px; font-weight: 700; padding: 11px 24px; border-radius: 12px; border: none; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 16px rgba(14,165,233,0.35); }
        .proj-modal-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(14,165,233,0.5); }
        /* animated screen content */
        .app-screen { width: 100%; height: 100%; padding: 22px 10px 10px; display: flex; flex-direction: column; gap: 6px; }
        .app-screen-row { height: 28px; border-radius: 6px; animation: shimmer 2.5s infinite; }
        @keyframes shimmer { 0%,100%{opacity:0.5} 50%{opacity:1} }
        .app-screen-header { height: 36px; border-radius: 10px; margin-bottom: 8px; display: flex; align-items: center; padding: 0 10px; font-size: 9px; font-weight: 800; color: rgba(255,255,255,0.9); letter-spacing: 0.3px; flex-shrink: 0; }
        .app-card-mini { background: rgba(255,255,255,0.12); border-radius: 8px; padding: 8px; margin-bottom: 5px; }
        .app-card-mini-line { height: 6px; border-radius: 3px; background: rgba(255,255,255,0.2); margin-bottom: 4px; }
        @media (max-width: 600px) { .proj-modal-content { grid-template-columns: 1fr; } .mobile-frame { width: 180px; } }
    </style>
</head>
<body class="inner-page">

<canvas id="bg-canvas" class="page-canvas" data-color="7c3aed" data-linecolor="a78bfa"></canvas>
@include('partials.public_nav')

<section class="page-hero">
    <div class="page-hero-content">
        <div class="page-hero-badge"><i class="fa fa-layer-group"></i> مشاريعنا</div>
        <h1 class="page-hero-title">ما حققناه حتى الآن<br><span class="gradient-text">يُلهم ما هو قادم</span></h1>
        <p class="page-hero-sub">مشاريع حقيقية بأثر ملموس على المجتمع السعودي وقطاع الأعمال</p>
    </div>
</section>

<section class="content-section" style="padding-bottom:0; padding-top: 20px;">
    <div class="container">
        <div class="filter-tabs reveal" id="filterTabs">
            <button class="filter-tab active" data-cat="all"><i class="fa fa-th-large"></i> الكل</button>
            <button class="filter-tab" data-cat="tech"><i class="fa fa-laptop-code"></i> تقنية</button>
            <button class="filter-tab" data-cat="real-estate"><i class="fa fa-building"></i> عقارات</button>
            <button class="filter-tab" data-cat="franchise"><i class="fa fa-store"></i> امتياز</button>
            <button class="filter-tab" data-cat="services"><i class="fa fa-hands-helping"></i> خدمات</button>
        </div>
    </div>
</section>

<section class="content-section" style="padding-top: 32px;">
    <div class="container">
        <div class="projects-grid" id="projectsGrid">

            <div class="project-card reveal" data-cat="tech" style="cursor:pointer;"
                 onclick="openProjModal('app')">
                <div class="project-card-img" style="background:linear-gradient(135deg,#0ea5e9,#38bdf8);">
                    <i class="fa fa-mobile-alt" style="color:rgba(255,255,255,0.9);"></i>
                </div>
                <div class="project-card-body">
                    <span class="project-tag" style="background:rgba(14,165,233,0.15);color:#38bdf8;border:1px solid rgba(56,189,248,0.3);">تقنية</span>
                    <h3>تطبيق أمر تم للجوال</h3>
                    <p>تطبيق ذكي يتيح للمستخدمين إدارة حجوزاتهم وطلباتهم والتواصل مع مقدمي الخدمات.</p>
                    <div class="project-meta">
                        <span class="project-meta-item"><i class="fa fa-calendar"></i> 2024</span>
                        <span class="project-meta-item"><i class="fa fa-users"></i> +3,200 مستخدم</span>
                        <span class="project-meta-item"><i class="fa fa-star" style="color:#f59e0b;"></i> 4.8</span>
                    </div>
                </div>
            </div>

            <div class="project-card reveal" data-cat="real-estate" style="cursor:pointer;"
                 onclick="openProjModal('halls')">
                <div class="project-card-img" style="background:linear-gradient(135deg,#059669,#34d399);">
                    <i class="fa fa-building" style="color:rgba(255,255,255,0.9);"></i>
                </div>
                <div class="project-card-body">
                    <span class="project-tag" style="background:rgba(5,150,105,0.15);color:#34d399;border:1px solid rgba(52,211,153,0.3);">عقارات</span>
                    <h3>منصة حجز القاعات الذكية</h3>
                    <p>نظام متكامل لحجز قاعات المناسبات يشمل أكثر من 150 قاعة في مناطق المملكة.</p>
                    <div class="project-meta">
                        <span class="project-meta-item"><i class="fa fa-calendar"></i> 2023</span>
                        <span class="project-meta-item"><i class="fa fa-home"></i> +150 قاعة</span>
                        <span class="project-meta-item"><i class="fa fa-handshake"></i> +900 حجز</span>
                    </div>
                </div>
            </div>

            <div class="project-card reveal" data-cat="franchise" style="cursor:pointer;"
                 onclick="openProjModal('franchise')">
                <div class="project-card-img" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);">
                    <i class="fa fa-store" style="color:rgba(255,255,255,0.9);"></i>
                </div>
                <div class="project-card-body">
                    <span class="project-tag" style="background:rgba(124,58,237,0.15);color:#a78bfa;border:1px solid rgba(167,139,250,0.3);">امتياز</span>
                    <h3>سوق الامتياز والوكالات</h3>
                    <p>منصة تربط أصحاب العلامات بالمستثمرين الراغبين في حقوق الامتياز.</p>
                    <div class="project-meta">
                        <span class="project-meta-item"><i class="fa fa-calendar"></i> 2025</span>
                        <span class="project-meta-item"><i class="fa fa-tag"></i> +40 علامة</span>
                        <span class="project-meta-item"><i class="fa fa-chart-line"></i> نمو 35%</span>
                    </div>
                </div>
            </div>

            <div class="project-card reveal" data-cat="services" style="cursor:pointer;"
                 onclick="openProjModal('consultants')">
                <div class="project-card-img" style="background:linear-gradient(135deg,#f59e0b,#fbbf24);">
                    <i class="fa fa-hands-helping" style="color:rgba(255,255,255,0.9);"></i>
                </div>
                <div class="project-card-body">
                    <span class="project-tag" style="background:rgba(245,158,11,0.15);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">خدمات</span>
                    <h3>شبكة المستشارين المتخصصين</h3>
                    <p>منصة تربط أصحاب الأعمال بنخبة من المستشارين في مجالات المال والقانون.</p>
                    <div class="project-meta">
                        <span class="project-meta-item"><i class="fa fa-calendar"></i> 2023</span>
                        <span class="project-meta-item"><i class="fa fa-user-tie"></i> +80 مستشار</span>
                        <span class="project-meta-item"><i class="fa fa-comments"></i> +500 جلسة</span>
                    </div>
                </div>
            </div>

            <div class="project-card reveal" data-cat="tech" style="cursor:pointer;"
                 onclick="openProjModal('analytics')">
                <div class="project-card-img" style="background:linear-gradient(135deg,#1d6fa8,#38bdf8);">
                    <i class="fa fa-chart-bar" style="color:rgba(255,255,255,0.9);"></i>
                </div>
                <div class="project-card-body">
                    <span class="project-tag" style="background:rgba(14,165,233,0.15);color:#38bdf8;border:1px solid rgba(56,189,248,0.3);">تقنية</span>
                    <h3>لوحة تحليلات الأعمال</h3>
                    <p>نظام تحليلي متقدم يوفر رؤى عميقة حول أداء المشاريع واتجاهات السوق.</p>
                    <div class="project-meta">
                        <span class="project-meta-item"><i class="fa fa-calendar"></i> 2025</span>
                        <span class="project-meta-item"><i class="fa fa-database"></i> +200 مؤشر</span>
                        <span class="project-meta-item"><i class="fa fa-clock"></i> لحظي</span>
                    </div>
                </div>
            </div>

            <div class="project-card reveal" data-cat="services" style="cursor:pointer;"
                 onclick="openProjModal('training')">
                <div class="project-card-img" style="background:linear-gradient(135deg,#be185d,#f472b6);">
                    <i class="fa fa-award" style="color:rgba(255,255,255,0.9);"></i>
                </div>
                <div class="project-card-body">
                    <span class="project-tag" style="background:rgba(190,24,93,0.15);color:#f472b6;border:1px solid rgba(244,114,182,0.3);">خدمات</span>
                    <h3>برنامج تطوير رواد الأعمال</h3>
                    <p>برنامج تدريبي وإرشادي لدعم رواد الأعمال السعوديين وتمكينهم من بناء مشاريع ناجحة.</p>
                    <div class="project-meta">
                        <span class="project-meta-item"><i class="fa fa-calendar"></i> 2024</span>
                        <span class="project-meta-item"><i class="fa fa-graduation-cap"></i> +120 رائد</span>
                        <span class="project-meta-item"><i class="fa fa-trophy"></i> جائزة التميز</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="content-section alt-bg" style="text-align:center;">
    <div class="container">
        <div class="reveal">
            <h2 class="section-title" style="margin-bottom:16px;">هل لديك مشروع تريد تطويره؟</h2>
            <p style="color:rgba(255,255,255,0.65);font-size:16px;margin-bottom:32px;">فريقنا مستعد لمساعدتك في تحقيق رؤيتك</p>
            <a href="/contact" class="cta-btn-primary">تواصل معنا <i class="fa fa-arrow-left" style="margin-right:8px;"></i></a>
        </div>
    </div>
</section>

@include('partials.public_footer')

<!-- PROJECT POPUP MODAL -->
<div class="proj-modal-overlay" id="projModal">
    <div class="proj-modal">
        <button class="proj-modal-close" onclick="closeProjModal()"><i class="fa fa-times"></i></button>
        <div class="proj-modal-content" id="projModalContent"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/three@0.158.0/build/three.min.js"></script>
<script src="/js/particles.js"></script>
<script>
// Project data
const projects = {
    app: {
        title: 'تطبيق أمر تم للجوال',
        tag: 'تقنية', tagColor: '#38bdf8', tagBg: 'rgba(14,165,233,0.15)',
        desc: 'تطبيق ذكي يتيح للمستخدمين إدارة حجوزاتهم وطلباتهم والتواصل مع مقدمي الخدمات بكل سهولة وأمان. يدعم الإشعارات اللحظية وتتبع الطلبات في الوقت الفعلي.',
        details: [
            { icon: 'fa-users', text: '+3,200 مستخدم نشط' },
            { icon: 'fa-star', text: 'تقييم 4.8/5 على متاجر التطبيقات' },
            { icon: 'fa-mobile-alt', text: 'متاح على iOS و Android' },
            { icon: 'fa-calendar', text: 'أُطلق عام 2024' },
        ],
        screenBg: 'linear-gradient(135deg,#0ea5e9,#1e3a6e)',
        screenIcon: 'fa-mobile-alt',
        screenColor: '#38bdf8',
        screenTitle: 'أمر تم',
        link: '#',
    },
    halls: {
        title: 'منصة حجز القاعات الذكية',
        tag: 'عقارات', tagColor: '#34d399', tagBg: 'rgba(5,150,105,0.15)',
        desc: 'نظام متكامل لحجز قاعات المناسبات يضم أكثر من 150 قاعة موثقة في جميع مناطق المملكة، مع نظام تقييم ومراجعة متقدم وإدارة كاملة للمواعيد.',
        details: [
            { icon: 'fa-building', text: '+150 قاعة موثقة' },
            { icon: 'fa-handshake', text: '+900 حجز منجز' },
            { icon: 'fa-map-marker-alt', text: 'يغطي 12 منطقة في المملكة' },
            { icon: 'fa-calendar', text: 'يعمل منذ 2023' },
        ],
        screenBg: 'linear-gradient(135deg,#059669,#0d2448)',
        screenIcon: 'fa-building',
        screenColor: '#34d399',
        screenTitle: 'القاعات',
        link: '/halls_list',
    },
    franchise: {
        title: 'سوق الامتياز والوكالات',
        tag: 'امتياز', tagColor: '#a78bfa', tagBg: 'rgba(124,58,237,0.15)',
        desc: 'منصة متخصصة تربط أصحاب العلامات التجارية بالمستثمرين الراغبين في حقوق الامتياز، مع دعم قانوني وتدريبي كامل.',
        details: [
            { icon: 'fa-store', text: '+40 علامة تجارية مرخصة' },
            { icon: 'fa-chart-line', text: 'نمو 35% سنوياً' },
            { icon: 'fa-handshake', text: '+67 صفقة منجزة' },
            { icon: 'fa-calendar', text: 'أُطلق عام 2025' },
        ],
        screenBg: 'linear-gradient(135deg,#7c3aed,#1a3a6e)',
        screenIcon: 'fa-store',
        screenColor: '#a78bfa',
        screenTitle: 'الامتياز',
        link: '/agencies',
    },
    consultants: {
        title: 'شبكة المستشارين المتخصصين',
        tag: 'خدمات', tagColor: '#fbbf24', tagBg: 'rgba(245,158,11,0.15)',
        desc: 'منصة تربط أصحاب الأعمال بنخبة من المستشارين المعتمدين في مجالات المال، القانون، التسويق، والتقنية. جلسات مباشرة أو عن بُعد.',
        details: [
            { icon: 'fa-user-tie', text: '+80 مستشار معتمد' },
            { icon: 'fa-comments', text: '+500 جلسة استشارية' },
            { icon: 'fa-star', text: 'رضا العملاء 96%' },
            { icon: 'fa-calendar', text: 'يعمل منذ 2023' },
        ],
        screenBg: 'linear-gradient(135deg,#d97706,#1a3a6e)',
        screenIcon: 'fa-users',
        screenColor: '#fbbf24',
        screenTitle: 'المستشارون',
        link: '/consultants',
    },
    analytics: {
        title: 'لوحة تحليلات الأعمال',
        tag: 'تقنية', tagColor: '#38bdf8', tagBg: 'rgba(14,165,233,0.15)',
        desc: 'نظام تحليلي متقدم يوفر لأصحاب الأعمال رؤى عميقة حول أداء مشاريعهم، واتجاهات السوق، وتوقعات النمو بتحديث لحظي.',
        details: [
            { icon: 'fa-chart-bar', text: '+200 مؤشر قياس' },
            { icon: 'fa-clock', text: 'تحديث في الوقت الفعلي' },
            { icon: 'fa-file-export', text: 'تصدير تقارير PDF وExcel' },
            { icon: 'fa-calendar', text: 'أُطلق عام 2025' },
        ],
        screenBg: 'linear-gradient(135deg,#1d6fa8,#0d2448)',
        screenIcon: 'fa-chart-bar',
        screenColor: '#38bdf8',
        screenTitle: 'التحليلات',
        link: '#',
    },
    training: {
        title: 'برنامج تطوير رواد الأعمال',
        tag: 'خدمات', tagColor: '#f472b6', tagBg: 'rgba(190,24,93,0.15)',
        desc: 'برنامج تدريبي وإرشادي متكامل لدعم رواد الأعمال السعوديين، يتضمن ورش عمل، إرشاداً فردياً، وربطاً بالمستثمرين.',
        details: [
            { icon: 'fa-graduation-cap', text: '+120 رائد أعمال خريج' },
            { icon: 'fa-trophy', text: 'حاصل على جائزة التميز 2024' },
            { icon: 'fa-handshake', text: '+30 شراكة استثمارية' },
            { icon: 'fa-calendar', text: 'يعمل منذ 2024' },
        ],
        screenBg: 'linear-gradient(135deg,#be185d,#1a3a6e)',
        screenIcon: 'fa-award',
        screenColor: '#f472b6',
        screenTitle: 'التطوير',
        link: '/contact',
    },
};

function buildScreen(p) {
    return `
        <div class="mobile-frame-screen">
            <div class="app-screen-header" style="background:${p.screenBg};">
                <i class="fa ${p.screenIcon}" style="color:${p.screenColor};margin-left:6px;"></i>
                ${p.screenTitle}
            </div>
            <div class="mobile-frame-notch"></div>
            <div class="app-screen" style="background:linear-gradient(180deg,#0d2448,#1a3a6e);">
                <div class="app-screen-row" style="background:${p.screenColor};opacity:0.18;height:14px;width:60%;margin-bottom:6px;border-radius:4px;"></div>
                ${[1,2,3,4].map(()=>`<div class="app-card-mini"><div class="app-card-mini-line" style="width:80%;"></div><div class="app-card-mini-line" style="width:55%;"></div></div>`).join('')}
            </div>
        </div>
    `;
}

function openProjModal(key) {
    const p = projects[key];
    if (!p) return;
    document.getElementById('projModalContent').innerHTML = `
        <div>
            <div class="mobile-frame">${buildScreen(p)}</div>
            <a href="${p.link}" class="proj-modal-btn" style="width:100%;justify-content:center;">
                استعرض المشروع <i class="fa fa-external-link-alt"></i>
            </a>
        </div>
        <div class="proj-modal-info">
            <span class="proj-tag" style="background:${p.tagBg};color:${p.tagColor};border:1px solid ${p.tagColor}44;">${p.tag}</span>
            <h2>${p.title}</h2>
            <p>${p.desc}</p>
            <ul class="proj-detail-list">
                ${p.details.map(d=>`<li><i class="fa ${d.icon}"></i> ${d.text}</li>`).join('')}
            </ul>
        </div>
    `;
    document.getElementById('projModal').classList.add('active');
}
function closeProjModal() {
    document.getElementById('projModal').classList.remove('active');
}
document.getElementById('projModal').addEventListener('click', function(e) {
    if (e.target === this) closeProjModal();
});

// Filter tabs
document.querySelectorAll('.filter-tab').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const cat = btn.dataset.cat;
        document.querySelectorAll('#projectsGrid .project-card').forEach(card => {
            const show = cat === 'all' || card.dataset.cat === cat;
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            card.style.opacity = show ? '1' : '0.12';
            card.style.transform = show ? '' : 'scale(0.96)';
            card.style.pointerEvents = show ? '' : 'none';
        });
    });
});

// Reveal
const obs = new IntersectionObserver(e => e.forEach(x => { if(x.isIntersecting) x.target.classList.add('visible'); }), { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
</script>
</body>
</html>
