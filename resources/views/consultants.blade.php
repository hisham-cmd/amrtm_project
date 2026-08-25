<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاستشارات المتخصصة | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <style>

   /* ===========================
   GLOBAL
=========================== */

*,*::before,*::after{
    box-sizing:border-box;
    margin:0;
    padding:0;
}

body.inner-page{
    font-family:'Cairo',sans-serif;
    background:#f4f6fb !important;
    color:#0d2448;
    min-height:100vh;
    overflow-x:hidden;
    padding-top:72px;
}

.page-canvas{
    position:fixed;
    inset:0;
    width:100%;
    height:100%;
    pointer-events:none;
    z-index:0;
    opacity:.15;
}

.page-content{
    position:relative;
    z-index:2;
}


/* ===========================
   HERO
=========================== */

.consultants-hero{
    padding:120px 24px 70px;
    text-align:center;
    background:linear-gradient(135deg,#0d2448 0%,#173d74 100%);
    color:#fff;
    border-radius:0 0 40px 40px;
}

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 20px;
    border-radius:50px;
    background:rgba(255,255,255,.12);
    color:#fff;
    font-weight:700;
    margin-bottom:22px;
}

.hero-badge i{
    font-size:13px;
}

.consultants-hero h1{
    font-size:clamp(2rem,5vw,3.4rem);
    font-weight:900;
    margin-bottom:18px;
    color:#fff;
}

.grad-text{
    color:#f5b58c;
}

.consultants-hero p{
    max-width:720px;
    margin:auto;
    color:#d8e4f7;
    line-height:1.9;
    font-size:1.05rem;
}


/* ===========================
   STATS
=========================== */

.stats-row{
    display:flex;
    justify-content:center;
    gap:18px;
    flex-wrap:wrap;
    margin-top:45px;
}

.stat-card{
    width:170px;
    background:#fff;
    border-radius:22px;
    padding:24px;
    box-shadow:0 10px 35px rgba(13,36,72,.08);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-6px);
}

.stat-number{
    font-size:2rem;
    font-weight:900;
    color:#0d2448;
}

.stat-label{
    margin-top:8px;
    color:#68778d;
    font-weight:700;
}


/* ===========================
   SECTION
=========================== */

.section-container{
    max-width:1320px;
    margin:auto;
    padding:80px 24px;
}

.section-header{
    text-align:center;
    margin-bottom:60px;
}

.section-header h2{
    font-size:2.4rem;
    color:#0d2448;
    font-weight:900;
    margin-bottom:15px;
}

.section-header p{
    color:#68778d;
    line-height:1.9;
    max-width:700px;
    margin:auto;
}
 
/* ===========================
   SEARCH
=========================== */

.services-search{

    max-width:700px;
    margin:0 auto 45px;

}

.search-box{

    position:relative;

}

.search-box input{

    width:100%;
    height:58px;

    border-radius:18px;

    border:1px solid #dbe6f7;

    background:#fff;

    padding:0 60px;

    font-size:16px;

    transition:.3s;

    box-shadow:0 8px 25px rgba(13,36,72,.05);

}

.search-box input:focus{

    outline:none;

    border-color:#1565c0;

    box-shadow:0 0 0 5px rgba(21,101,192,.12);

}

.search-icon{

    position:absolute;

    right:22px;
    top:50%;

    transform:translateY(-50%);

    color:#1565c0;

    font-size:20px;

}

#clearSearch{

    position:absolute;

    left:15px;
    top:50%;

    transform:translateY(-50%);

    width:34px;
    height:34px;

    border:none;

    border-radius:50%;

    background:#eef5ff;

    color:#1565c0;

    cursor:pointer;

    display:none;

}

#clearSearch:hover{

    background:#1565c0;
    color:#fff;

}

/* suggestions */

.search-suggestions{

    position:absolute;

    top:65px;

    width:100%;

    background:#fff;

    border-radius:18px;

    box-shadow:0 18px 40px rgba(0,0,0,.15);

    overflow:hidden;

    display:none;

    z-index:999;

}

.search-item{

    padding:14px 18px;

    cursor:pointer;

    transition:.25s;

    border-bottom:1px solid #eef2f8;

}

.search-item:hover{

    background:#f4f8ff;

}

.search-item strong{

    display:block;

    color:#16245E;

    margin-bottom:5px;

}

.search-item span{

    color:#7c88a4;

    font-size:13px;

}


/* ===========================
   GRID
=========================== */

.categories-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:28px;
}

@media(max-width:1100px){
    .categories-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:650px){
    .categories-grid{
        grid-template-columns:1fr;
    }
}


/* ===========================
   CARD
=========================== */

.category-card{
    background:#fff;
    border-radius:24px;
    padding:34px 26px;
    text-align:center;
    border:1px solid #edf2f8;
    box-shadow:0 12px 35px rgba(13,36,72,.07);
      position: relative;
    transition: all .35s ease;
    transform-style: preserve-3d;
}
    

.category-card:hover{
    z-index: 100;
    transform: perspective(1000px) translateY(-12px) scale(1.06);
    box-shadow:
        0 20px 40px rgba(13,36,72,.18),
        0 40px 80px rgba(13,36,72,.25);
}
.category-icon{
    width:78px;
    height:78px;
    border-radius:22px;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto auto 22px;
    font-size:30px;
}

.category-card h3{
    color:#0d2448;
    font-size:1.25rem;
    font-weight:900;
    margin-bottom:12px;
}

.category-card p{
    color:#68778d;
    line-height:1.8;
    min-height:58px;
    margin-bottom:24px;
}


/* ===========================
   BUTTONS
=========================== */

.card-actions{
    display:flex;
    justify-content:center;
    gap:12px;
    flex-wrap:wrap;
}

.btn-primary{
    background:#0d2448;
    background:linear-gradient(135deg, #1a237e, #1565c0);
    color:#fff;
    text-decoration:none;
    border:none;
    border-radius:14px;
    padding:11px 20px;
    display:inline-flex;
    align-items:center;
    gap:7px;
    font-weight:700;
    transition:.3s;
}

.btn-primary:hover{
    background:#fff;
    color:#1a237e;
  border:1px solid rgba(13,36,72,.12);
      transform:translateY(-2px);
}

.btn-outline{
    background:#fff;
    color:#0d2448;
    border:2px solid #0d2448;
    text-decoration:none;
    border-radius:14px;
    padding:11px 20px;
    display:inline-flex;
    align-items:center;
    gap:7px;
    font-weight:700;
    transition:.3s;
}

.btn-outline:hover{
    background:#0d2448;
    color:#fff;
}


/* ===========================
   ICON COLORS
=========================== */

.icon-strategy{
    background:#e8f0ff;
    color:#2563eb;
}

.icon-finance{
    background:#e8faf2;
    color:#10b981;
}

.icon-technology{
    background:#f3ebff;
    color:#7c3aed;
}

.icon-hr{
    background:#e7fbfb;
    color:#14b8a6;
}

.icon-marketing{
    background:#fff2e8;
    color:#f97316;
}

.icon-legal{
    background:#fff8dc;
    color:#d97706;
}

.icon-realestate{
    background:#ffe9ef;
    color:#e11d48;
}

.icon-operations{
    background:#e8f8ff;
    color:#0284c7;
}
        /* WHY SECTION */
        .why-section { background: rgba(13,36,72,0.4); }
        .value-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        @media (max-width: 1000px) { .value-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 550px) { .value-grid { grid-template-columns: 1fr; } }
        .value-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(14px);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 32px 24px;
            text-align: center;
        }
        .value-icon {
            width: 64px; height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(14,165,233,0.2), rgba(124,58,237,0.2));
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 18px;
            font-size: 26px;
            color: #38bdf8;
        }
        .value-card h3 { font-size: 1.1rem; font-weight: 800; color: #fff; margin-bottom: 10px; }
        .value-card p { font-size: 13px; color: #94a3b8; line-height: 1.7; }

        /* CTA */
        .cta-section {
            text-align: center;
            padding: 80px 24px;
            background: linear-gradient(135deg, rgba(13,36,72,0.6) 0%, rgba(26,58,110,0.4) 100%);
        }
        .cta-section h2 { font-size: clamp(1.8rem,3.5vw,2.6rem); font-weight: 900; color: #fff; margin-bottom: 16px; }
        .cta-section p { color: #94a3b8; font-size: 1.05rem; margin-bottom: 36px; max-width: 500px; margin-left: auto; margin-right: auto; }
        .cta-buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-lg { padding: 16px 40px; font-size: 16px; border-radius: 16px; }

        /* REVEAL */
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }
/*==============================
            FOOTER
==============================*/

.ft-dark{
    background:#0d2448;
    border-top:1px solid rgba(255,255,255,.08);
    padding:24px 0 16px;
}

.ft-wrap{
    max-width:1200px;
    margin:auto;
    padding:0 20px;

    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    gap:14px;
}

.ft-logo{
    height:42px;
    width:auto;
    object-fit:contain;

    /* يجعل اللوجو الغامق أوضح */
    filter:brightness(0) invert(1);
}

.ft-text{
    max-width:650px;
    color:rgba(255,255,255,.85);
    font-size:14px;
    line-height:1.8;
    font-weight:500;
    margin:0;
}

.ft-social{
    display:flex;
    gap:10px;
}

.ft-social a{
    width:38px;
    height:38px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:12px;

    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.15);

    color:#d8e4f7;
    text-decoration:none;

    transition:.3s ease;
}

.ft-social a:hover{
    background:#ffffff;
    color:#0d2448;
    border-color:#ffffff;
    transform:translateY(-5px) scale(1.08);
    box-shadow:0 14px 30px rgba(0,0,0,.25);
}

.ft-copy{
    color:rgba(255,255,255,.7);
    font-size:13px;
}

.ft-copy a{
    color:#d8e4f7;
    font-weight:700;
    text-decoration:none;
    transition:.25s;
}

.ft-copy a:hover{
    color:#ffffff;
}

@media(max-width:768px){

    .ft-dark{
        padding:20px 0 14px;
    }

    .ft-logo{
        height:36px;
    }

    .ft-text{
        font-size:13px;
    }

    .ft-social a{
        width:34px;
        height:34px;
    }
}
    </style>
</head>
<body class="inner-page">
    <canvas class="page-canvas" id="bg-canvas"></canvas>
<!-- @include('partials.public_nav')-->

    <div class="page-content">
         <div class="services-search">

    <div class="search-box">

        <i class="fas fa-search search-icon"></i>

        <input
            type="text"
            id="searchInput"
            placeholder="ابحث عن تخصص أو خدمة..."
        >

        <button id="clearSearch" type="button">
            <i class="fas fa-times"></i>
        </button>

        <div class="search-suggestions" id="searchSuggestions"></div>

    </div>

</div>


        <!-- CATEGORIES -->
        <section class="section-container">
            <div class="section-header reveal">
                <h2>تخصصاتنا الاستشارية</h2>
                <p>اختر التخصص الذي يناسب احتياجاتك واطلع على تفاصيل الخدمة وقائمة المستشارين</p>
            </div>

      


            <div class="categories-grid">
                <div class="category-card reveal"
     data-name-ar="الاستراتيجية"
     data-name-en="strategy"
     data-desc-ar="تخطيط استراتيجي ودراسات جدوى وتحليل أسواق"
     data-desc-en="strategic planning feasibility studies market analysis">

    <div class="category-icon icon-strategy">
        <i class="fas fa-chess"></i>
    </div>

    <h3>الاستراتيجية</h3>

    <p>تخطيط استراتيجي ودراسات جدوى وتحليل أسواق</p>

    <div class="card-actions">
        <a href="/service-details?id=strategy" class="btn-primary">
            <i class="fas fa-info-circle"></i> تفاصيل
        </a>

        <a href="/consultants-list?category=strategy" class="btn-outline">
            <i class="fas fa-users"></i> المستشارون
        </a>
    </div>
        </div>
                <div class="category-card reveal reveal-delay-1"
                data-name-ar="التمويل والمحاسبة"
                data-name-en="finance accounting"
                data-desc-ar="تدقيق مالي ضرائب إدارة ثروات"
                data-desc-en="audit taxes wealth management">
                    <div class="category-icon icon-finance"><i class="fas fa-coins"></i></div>
                    <h3>التمويل والمحاسبة</h3>
                    <p>تدقيق مالي، ضرائب، إدارة ثروات</p>
                    <div class="card-actions">
                        <a href="/service-details?id=finance" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=finance" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
                <div class="category-card reveal reveal-delay-2"
                     data-name-ar="التحول الرقمي"
                     data-name-en="digital transformation"
                     data-desc-ar="حلول الذكاء الاصطناعي الأمن السيبراني تطوير الأنظمة"
                     data-desc-en="ai cybersecurity digital systems">
                    <div class="category-icon icon-technology"><i class="fas fa-microchip"></i></div>
                    <h3>التحول الرقمي</h3>
                    <p>حلول AI، أمن سيبراني، تطوير منظومات رقمية</p>
                    <div class="card-actions">
                        <a href="/service-details?id=technology" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=technology" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
                <div class="category-card reveal reveal-delay-3"
                     data-name-ar="الموارد البشرية"
                     data-name-en="human resources"
                     data-desc-ar="استقطاب تطوير مواهب هياكل تنظيمية"
                     data-desc-en="recruitment talent development" >
                    <div class="category-icon icon-hr"><i class="fas fa-users"></i></div>
                    <h3>الموارد البشرية</h3>
                    <p>استقطاب، تطوير مواهب، هياكل تنظيمية</p>
                    <div class="card-actions">
                        <a href="/service-details?id=hr" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=hr" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
                <div class="category-card reveal"
                   data-name-ar="التسويق والعلاقات العامة"
                   data-name-en="marketing public relations"
                   data-desc-ar="بناء علامة تجارية، تسويق رقمي، حملات"
                   data-desc-en="Brand building, digital marketing, campaigns">
                    <div class="category-icon icon-marketing"><i class="fas fa-bullhorn"></i></div>
                    <h3>التسويق والعلاقات العامة</h3>
                    <p>بناء علامة تجارية، تسويق رقمي، حملات</p>
                    <div class="card-actions">
                        <a href="/service-details?id=marketing" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=marketing" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
                <div class="category-card reveal reveal-delay-1"
                  data-name-ar="الشؤون القانونية"
                     data-name-en="legal affairs"
                     data-desc-ar="عقود تجارية، حوكمة، تأسيس شركات"
                     data-desc-en="Business contracts, governance, company formation" >
                    <div class="category-icon icon-legal"><i class="fas fa-scale-balanced"></i></div>
                    <h3>الشؤون القانونية</h3>
                    <p>عقود تجارية، حوكمة، تأسيس شركات</p>
                    <div class="card-actions">
                        <a href="/service-details?id=legal" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=legal" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
                <div class="category-card reveal reveal-delay-2"
                    data-name-ar="العقارات والاستثمار"
                    data-name-en="real estate investment"            
                    data-desc-ar="تقييم عقاري، محافظ استثمارية، صناديق ريت"
                     data-desc-en="Real estate appraisal, investment portfolios, REITs" >
                    <div class="category-icon icon-realestate"><i class="fas fa-building"></i></div>
                    <h3>العقارات والاستثمار</h3>
                    <p>تقييم عقاري، محافظ استثمارية، صناديق ريت</p>
                    <div class="card-actions">
                        <a href="/service-details?id=realestate" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=realestate" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
                <div class="category-card reveal reveal-delay-3"
                    data-name-ar="التشغيل والإدارة"
                    data-name-en="operations management"
                    data-desc-ar="سلاسل إمداد، جودة عمليات، تحسين إنتاجية"
                     data-desc-en="Supply chains, process quality, productivity improvement" >
                    <div class="category-icon icon-operations"><i class="fas fa-gears"></i></div>
                    <h3>التشغيل والإدارة</h3>
                    <p>سلاسل إمداد، جودة عمليات، تحسين إنتاجية</p>
                    <div class="card-actions">
                        <a href="/service-details?id=operations" class="btn-primary"><i class="fas fa-info-circle"></i> تفاصيل</a>
                        <a href="/consultants-list?category=operations" class="btn-outline"><i class="fas fa-users"></i> المستشارون</a>
                    </div>
                </div>
            </div>
        </section>

     
    </div>


<footer class="ft-dark">
    <div class="ft-wrap">

        <img src="/images/new-logo1.png"
             alt="آمر تم"
             class="ft-logo">

        <p class="ft-text">
            {{ __('footer.tagline') }}
        </p>

        <div class="ft-social">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>

        <div class="ft-copy">
            {{ __('footer.copyright', ['year' => date('Y')]) }}
            &nbsp;|&nbsp;
            <a href="/privacy">{{ __('footer.privacy') }}</a>
        </div>

    </div>
</footer>

<!--@include('partials.public_footer')-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r158/three.min.js"></script>
    <script>
    // Particle background
    (function(){
        const canvas = document.getElementById('bg-canvas');
        if (!canvas || !window.THREE) return;
        const W = window.innerWidth, H = window.innerHeight;
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, W/H, 0.1, 1000);
        camera.position.z = 14;
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        renderer.setSize(W, H); renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.setClearColor(0x000000, 0);
        const COUNT = 100, geo = new THREE.BufferGeometry();
        const pos = new Float32Array(COUNT * 3), vel = [];
        for (let i = 0; i < COUNT; i++) {
            pos[i*3]=(Math.random()-.5)*28; pos[i*3+1]=(Math.random()-.5)*28; pos[i*3+2]=(Math.random()-.5)*4;
            vel.push({ x:(Math.random()-.5)*0.01, y:(Math.random()-.5)*0.01 });
        }
        geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
        scene.add(new THREE.Points(geo, new THREE.PointsMaterial({ color:0x38bdf8, size:0.09, transparent:true, opacity:0.5 })));
        const MAX_L=250, lPos=new Float32Array(MAX_L*6), lGeo=new THREE.BufferGeometry();
        lGeo.setAttribute('position', new THREE.BufferAttribute(lPos, 3)); lGeo.setDrawRange(0,0);
        scene.add(new THREE.LineSegments(lGeo, new THREE.LineBasicMaterial({ color:0x7dd3fc, transparent:true, opacity:0.12 })));
        (function animate(){
            requestAnimationFrame(animate);
            for(let i=0;i<COUNT;i++){
                pos[i*3]+=vel[i].x; pos[i*3+1]+=vel[i].y;
                if(Math.abs(pos[i*3])>14)vel[i].x*=-1; if(Math.abs(pos[i*3+1])>14)vel[i].y*=-1;
            }
            geo.attributes.position.needsUpdate=true;
            let li=0;
            for(let i=0;i<COUNT&&li<MAX_L;i++) for(let j=i+1;j<COUNT&&li<MAX_L;j++){
                const dx=pos[i*3]-pos[j*3],dy=pos[i*3+1]-pos[j*3+1];
                if(Math.sqrt(dx*dx+dy*dy)<5.5){ lPos[li*6]=pos[i*3];lPos[li*6+1]=pos[i*3+1];lPos[li*6+2]=0;lPos[li*6+3]=pos[j*3];lPos[li*6+4]=pos[j*3+1];lPos[li*6+5]=0;li++; }
            }
            lGeo.setDrawRange(0,li*2); lGeo.attributes.position.needsUpdate=true;
            renderer.render(scene,camera);
        })();
        window.addEventListener('resize',()=>{ camera.aspect=window.innerWidth/window.innerHeight; camera.updateProjectionMatrix(); renderer.setSize(window.innerWidth,window.innerHeight); });
    })();

    // Reveal on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Counter animation
    function animateCounter(el, target, suffix) {
        let start = 0;
        const duration = 2000;
        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target) + (suffix || '');
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    }
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const target = parseInt(e.target.dataset.target);
                const suffix = e.target.parentElement.querySelector('.stat-label').textContent.startsWith('%') ? '%' : '+';
                animateCounter(e.target, target, suffix);
                statObserver.unobserve(e.target);
            }
        });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-number[data-target]').forEach(el => statObserver.observe(el));
    const searchInput = document.getElementById("searchInput");
const clearSearch = document.getElementById("clearSearch");
const suggestions = document.getElementById("searchSuggestions");

const cards = document.querySelectorAll(".category-card");

function normalize(text){
    return text
        .toLowerCase()
        .replace(/[أإآ]/g,"ا")
        .replace(/ة/g,"ه")
        .replace(/ى/g,"ي")
        .replace(/[ًٌٍَُِّْـ]/g,"");
}

searchInput.addEventListener("keyup",function(){

    let value=normalize(this.value);

    suggestions.innerHTML="";

    if(value==""){

        cards.forEach(card=>card.style.display="block");

        suggestions.style.display="none";

        clearSearch.style.display="none";

        return;
    }

    clearSearch.style.display="block";

    let count=0;

    cards.forEach(card=>{

        let txt=normalize(
            card.dataset.nameAr+" "+
            card.dataset.nameEn+" "+
            card.dataset.descAr+" "+
            card.dataset.descEn
        );

        if(txt.includes(value)){

            card.style.display="block";

            count++;

            suggestions.innerHTML+=`
                <div class="search-item"
                onclick="location.href='${card.querySelector('.btn-outline').href}'">

                    <strong>${card.querySelector('h3').innerText}</strong>

                    <span>${card.querySelector('p').innerText}</span>

                </div>
            `;

        }else{

            card.style.display="none";

        }

    });

    suggestions.style.display="block";

});

clearSearch.onclick=function(){

    searchInput.value="";

    cards.forEach(card=>card.style.display="block");

    suggestions.style.display="none";

    clearSearch.style.display="none";

}
    </script>
</body>
</html>
