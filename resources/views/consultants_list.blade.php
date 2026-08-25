<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فريق المستشارين | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <style>
     /* ================= GENERAL ================= */

*,
*::before,
*::after{
    box-sizing:border-box;
    margin:0;
    padding:0;
}

body.inner-page{
    font-family:'Cairo',sans-serif;
    background:#f4f6fb;
    color:#0d2448;
    min-height:100vh;
    overflow-x:hidden;
}

.page-canvas{
    position:fixed;
    inset:0;
    width:100%;
    height:100%;
    pointer-events:none;
    z-index:0;
}

.page-content{
    position:relative;
    z-index:1;
}

.grad-text{
    color:#0d2448;
}

/* ================= HERO ================= */

.list-hero{
    padding:120px 24px 55px;
    text-align:center;
}

.list-hero h1{
    font-size:clamp(2rem,4.5vw,3.2rem);
    font-weight:900;
    color:#0d2448;
    margin-bottom:14px;
}

.list-hero p{
    max-width:620px;
    margin:auto;
    color:#66768d;
    line-height:1.8;
}

.active-filter-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:20px;
    padding:9px 18px;
    border-radius:40px;
    background:#fff;
    border:1px solid #d9e2ee;
    color:#0d2448;
    font-weight:700;
    box-shadow:0 8px 20px rgba(13,36,72,.05);
}

/* ================= FILTER ================= */

.filter-section{
    max-width:1280px;
    margin:auto;
    padding:0 24px 32px;
}

.filter-group{
    background:#fff;
    border:1px solid #dbe4ef;
    border-radius:18px;
    padding:20px;
    margin-bottom:18px;
    box-shadow:0 10px 25px rgba(13,36,72,.05);
}

.filter-group-label{
    color:#0d2448;
    font-weight:800;
    margin-bottom:12px;
}

.filter-tabs{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.filter-tab{
    background:#fff;
    border:1px solid #d6dfeb;
    border-radius:40px;
    padding:9px 18px;
    color:#0d2448;
    font-family:Cairo;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.filter-tab:hover{
    background:#0d2448;
    color:#fff;
    border-color:#0d2448;
}

.filter-tab.active{
    background:#0d2448;
    color:#fff;
    border-color:#0d2448;
}

/* ================= RESULTS ================= */

.results-bar{
    max-width:1280px;
    margin:auto;
    padding:0 24px 20px;
}

.results-count{
    color:#66768d;
    font-weight:700;
}

.results-count strong{
    color:#0d2448;
}

/* ================= GRID ================= */

.consultants-grid{
    max-width:1280px;
    margin:auto;
    padding:0 24px 80px;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
}

@media(max-width:1024px){
    .consultants-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:640px){
    .consultants-grid{
        grid-template-columns:1fr;
    }
}

/* ================= CARD ================= */

.consultant-card{
    background:#fff;
    border:1px solid #dce4ef;
    border-radius:24px;
    padding:28px;
    display:flex;
    flex-direction:column;
    position:relative;
    transition:.35s;
    box-shadow:0 8px 25px rgba(13,36,72,.05);
}

.consultant-card:hover{
    transform:translateY(-12px) scale(1.03);
    border-color:#0d2448;
    box-shadow:
        0 35px 70px rgba(13,36,72,.16),
        0 10px 25px rgba(13,36,72,.08);
    z-index:10;
}

.consultant-card.hidden{
    display:none;
}

.available-badge{
    position:absolute;
    top:18px;
    left:18px;
    background:#eaf8f1;
    color:#14834d;
    border:1px solid #bde8d0;
    border-radius:40px;
    padding:5px 12px;
    font-size:11px;
    font-weight:700;
}

.card-avatar-wrap{
    display:flex;
    justify-content:center;
    margin-bottom:18px;
}

.avatar-circle{
    width:76px;
    height:76px;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#fff;
    font-size:22px;
    font-weight:900;
}

.card-name{
    text-align:center;
    font-size:1.05rem;
    font-weight:900;
    color:#0d2448;
    margin-bottom:6px;
}

.card-title-text{
    text-align:center;
    color:#35527e;
    font-size:13px;
    font-weight:700;
    margin-bottom:12px;
}

.card-meta{
    display:flex;
    justify-content:center;
    gap:15px;
    flex-wrap:wrap;
    margin-bottom:14px;
}

.meta-item{
    color:#66768d;
    font-size:12px;
}

.meta-item i{
    color:#0d2448;
}

.card-rating{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:4px;
    margin-bottom:15px;
}

.stars{
    color:#f5b301;
}

.rating-val{
    color:#0d2448;
    font-weight:800;
}

.card-tags{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:8px;
    margin-bottom:22px;
}

.card-tag{
    background:#f4f6fb;
    border:1px solid #dbe3ee;
    color:#66768d;
    border-radius:40px;
    padding:5px 12px;
    font-size:11px;
}

.card-actions{
    margin-top:auto;
}

.btn-view{
    width:100%;
    background:#0d2448;
    color:#fff;
    border:none;
    border-radius:14px;
    padding:12px;
    font-family:Cairo;
    font-weight:800;
    text-decoration:none;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-view:hover{
    background:#08162e;
    transform:translateY(-2px);
}

/* ================= NO RESULTS ================= */

.no-results{
    grid-column:1/-1;
    background:#fff;
    border:1px solid #dde5ef;
    border-radius:22px;
    padding:60px;
    text-align:center;
    display:none;
}

.no-results i{
    font-size:48px;
    color:#0d2448;
    margin-bottom:15px;
}

.no-results h3{
    color:#0d2448;
    margin-bottom:8px;
}

.no-results p{
    color:#66768d;
}

/* ================= ANIMATION ================= */

.reveal{
    opacity:0;
    transform:translateY(28px);
    transition:.6s;
}

.reveal.visible{
    opacity:1;
    transform:none;
}
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
        <!-- HERO -->
        <section class="list-hero">
            <h1>فريق <span class="grad-text">المستشارين</span></h1>
            <p>تعرّف على نخبة المستشارين المعتمدين في المملكة وابدأ رحلتك نحو النجاح</p>
            <div id="activeCategoryBadge" style="display:none;" class="active-filter-badge">
                <i class="fas fa-filter"></i>
                <span id="activeCategoryLabel"></span>
            </div>
        </section>

        <!-- FILTERS -->
        <div class="filter-section">
            <div class="filter-group reveal">
                <div class="filter-group-label">التخصص</div>
                <div class="filter-tabs" id="categoryTabs">
                    <button class="filter-tab active" data-filter="category" data-val="all">الكل</button>
                    <button class="filter-tab" data-filter="category" data-val="strategy">الاستراتيجية</button>
                    <button class="filter-tab" data-filter="category" data-val="finance">التمويل</button>
                    <button class="filter-tab" data-filter="category" data-val="technology">التحول الرقمي</button>
                    <button class="filter-tab" data-filter="category" data-val="hr">الموارد البشرية</button>
                    <button class="filter-tab" data-filter="category" data-val="marketing">التسويق</button>
                    <button class="filter-tab" data-filter="category" data-val="legal">الشؤون القانونية</button>
                    <button class="filter-tab" data-filter="category" data-val="realestate">العقارات</button>
                    <button class="filter-tab" data-filter="category" data-val="operations">التشغيل</button>
                </div>
            </div>
            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                <div class="filter-group reveal" style="flex:1;min-width:220px;">
                    <div class="filter-group-label">التوفر</div>
                    <div class="filter-tabs" id="availTabs">
                        <button class="filter-tab active" data-filter="avail" data-val="all">الكل</button>
                        <button class="filter-tab" data-filter="avail" data-val="available">متاح الآن</button>
                        <button class="filter-tab" data-filter="avail" data-val="thisweek">هذا الأسبوع</button>
                    </div>
                </div>
                <div class="filter-group reveal" style="flex:1;min-width:220px;">
                    <div class="filter-group-label">المدينة</div>
                    <div class="filter-tabs" id="cityTabs">
                        <button class="filter-tab active" data-filter="city" data-val="all">الكل</button>
                        <button class="filter-tab" data-filter="city" data-val="الرياض">الرياض</button>
                        <button class="filter-tab" data-filter="city" data-val="جدة">جدة</button>
                        <button class="filter-tab" data-filter="city" data-val="الدمام">الدمام</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESULTS BAR -->
        <div class="results-bar">
            <div class="results-count">عرض <strong id="visibleCount">12</strong> من أصل <strong>12</strong> مستشار</div>
        </div>

        <!-- GRID -->
        <div class="consultants-grid" id="consultantsGrid">
            <!-- Cards injected by JS -->
            <div class="no-results" id="noResults">
                <i class="fas fa-users-slash"></i>
                <h3>لا توجد نتائج</h3>
                <p>حاول تغيير معايير الفلترة</p>
            </div>
        </div>
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
   <!-- @include('partials.public_footer')-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r158/three.min.js"></script>
    <script>
    const CONSULTANTS = [
        {id:1,name:'أحمد بن محمد الغامدي',initials:'أغ',title:'مستشار استراتيجي أول',category:'strategy',city:'الرياض',exp:18,rating:4.9,tags:['استراتيجية الأعمال','رؤية 2030','نماذج الأعمال'],available:true},
        {id:2,name:'سارة بنت خالد العتيبي',initials:'سع',title:'خبيرة مالية ومحاسبية',category:'finance',city:'جدة',exp:14,rating:4.8,tags:['تدقيق مالي','IFRS','إدارة الثروات'],available:true},
        {id:3,name:'عبدالرحمن بن سعد الحربي',initials:'عح',title:'مستشار التحول الرقمي',category:'technology',city:'الرياض',exp:12,rating:4.9,tags:['ذكاء اصطناعي','أمن سيبراني','سحابة'],available:false},
        {id:4,name:'نورة بنت فهد الشمري',initials:'نش',title:'مستشارة الموارد البشرية',category:'hr',city:'الرياض',exp:16,rating:4.7,tags:['استقطاب المواهب','سعودة','تطوير الكوادر'],available:true},
        {id:5,name:'محمد بن علي القحطاني',initials:'مق',title:'خبير التسويق الرقمي',category:'marketing',city:'جدة',exp:10,rating:4.8,tags:['SEO','سوشيال ميديا','العلامة التجارية'],available:true},
        {id:6,name:'فاطمة بنت يوسف السهلي',initials:'فس',title:'مستشارة قانونية تجارية',category:'legal',city:'الرياض',exp:20,rating:5.0,tags:['قانون تجاري','عقود','حوكمة الشركات'],available:false},
        {id:7,name:'خالد بن عبدالله المالكي',initials:'خم',title:'خبير العقارات والاستثمار',category:'realestate',city:'الدمام',exp:22,rating:4.9,tags:['تقييم عقاري','صناديق ريت','استثمار عقاري'],available:true},
        {id:8,name:'ريم بنت أحمد الدوسري',initials:'رد',title:'مستشارة التشغيل والجودة',category:'operations',city:'جدة',exp:11,rating:4.6,tags:['سلاسل الإمداد','ISO','تحسين العمليات'],available:true},
        {id:9,name:'عمر بن تركي الزهراني',initials:'عز',title:'مستشار أعمال استراتيجي',category:'strategy',city:'جدة',exp:15,rating:4.7,tags:['التوسع الخليجي','دراسات الجدوى','M&A'],available:true},
        {id:10,name:'هند بنت سلمان العمري',initials:'هع',title:'مديرة تسويق وعلاقات عامة',category:'marketing',city:'الرياض',exp:9,rating:4.8,tags:['PR','إدارة حملات','محتوى إبداعي'],available:false},
        {id:11,name:'بندر بن ناصر الرشيدي',initials:'بر',title:'خبير التمويل والاستثمار',category:'finance',city:'الرياض',exp:17,rating:4.9,tags:['استثمار','تقييم شركات','IPO'],available:true},
        {id:12,name:'مي بنت إبراهيم المهنا',initials:'مم',title:'مستشارة تطوير مؤسسي',category:'hr',city:'الدمام',exp:13,rating:4.7,tags:['ثقافة مؤسسية','تطوير القيادات','أداء الموظفين'],available:true}
    ];

    const AV_COLOR = { strategy:'av-strategy', finance:'av-finance', technology:'av-technology', hr:'av-hr', marketing:'av-marketing', legal:'av-legal', realestate:'av-realestate', operations:'av-operations' };

    function stars(r){ const full=Math.floor(r); const half=r%1>=0.5?1:0; let s=''; for(let i=0;i<full;i++)s+='<i class="fas fa-star"></i>'; if(half)s+='<i class="fas fa-star-half-stroke"></i>'; for(let i=full+half;i<5;i++)s+='<i class="far fa-star"></i>'; return s; }

    function renderCards(){
        const grid = document.getElementById('consultantsGrid');
        // Remove old cards (keep no-results div)
        Array.from(grid.querySelectorAll('.consultant-card')).forEach(c=>c.remove());

        CONSULTANTS.forEach(c=>{
            const div = document.createElement('div');
            div.className = 'consultant-card reveal';
            div.dataset.category = c.category;
            div.dataset.city = c.city;
            div.dataset.available = c.available ? 'true' : 'false';
            div.innerHTML = `
                ${c.available ? '<div class="available-badge"><i class="fas fa-circle" style="font-size:7px;margin-left:3px;"></i> متاح الآن</div>' : ''}
                <div class="card-avatar-wrap">
                    <div class="avatar-circle ${AV_COLOR[c.category]}">${c.initials}</div>
                </div>
                <div class="card-name">${c.name}</div>
                <div class="card-title-text">${c.title}</div>
                <div class="card-meta">
                    <span class="meta-item"><i class="fas fa-location-dot"></i> ${c.city}</span>
                    <span class="meta-item"><i class="fas fa-briefcase"></i> ${c.exp} سنة</span>
                </div>
                <div class="card-rating">
                    <div class="stars">${stars(c.rating)}</div>
                    <span class="rating-val">${c.rating}</span>
                </div>
                <div class="card-tags">
                    ${c.tags.map(t=>`<span class="card-tag">${t}</span>`).join('')}
                </div>
                <div class="card-actions">
                    <a href="/consultant-profile?id=${c.id}" class="btn-view"><i class="fas fa-user"></i> عرض الملف</a>
                </div>`;
            grid.insertBefore(div, document.getElementById('noResults'));
        });

        // Re-observe
        document.querySelectorAll('.consultant-card.reveal').forEach(el=>revObs.observe(el));
    }

    let activeFilters = { category:'all', avail:'all', city:'all' };

    function applyFilters(){
        const cards = document.querySelectorAll('.consultant-card');
        let visible = 0;
        cards.forEach(card=>{
            const cat = activeFilters.category === 'all' || card.dataset.category === activeFilters.category;
            const avl = activeFilters.avail === 'all' ||
                        (activeFilters.avail === 'available' && card.dataset.available === 'true') ||
                        (activeFilters.avail === 'thisweek' && true);
            const cty = activeFilters.city === 'all' || card.dataset.city === activeFilters.city;
            if(cat && avl && cty){ card.classList.remove('hidden'); visible++; }
            else card.classList.add('hidden');
        });
        document.getElementById('visibleCount').textContent = visible;
        document.getElementById('noResults').style.display = visible === 0 ? 'block' : 'none';
    }

    document.querySelectorAll('.filter-tab').forEach(btn=>{
        btn.addEventListener('click', function(){
            const filterType = this.dataset.filter;
            const val = this.dataset.val;
            // Deactivate siblings
            document.querySelectorAll(`.filter-tab[data-filter="${filterType}"]`).forEach(b=>b.classList.remove('active'));
            this.classList.add('active');
            activeFilters[filterType] = val;
            applyFilters();
        });
    });

    // Handle URL param
    function init(){
        const urlCat = new URLSearchParams(window.location.search).get('category');
        if(urlCat){
            const catLabels = {strategy:'الاستراتيجية',finance:'التمويل',technology:'التحول الرقمي',hr:'الموارد البشرية',marketing:'التسويق',legal:'الشؤون القانونية',realestate:'العقارات',operations:'التشغيل'};
            document.getElementById('activeCategoryBadge').style.display='inline-flex';
            document.getElementById('activeCategoryLabel').textContent = catLabels[urlCat] || urlCat;
            activeFilters.category = urlCat;
            const matchBtn = document.querySelector(`.filter-tab[data-filter="category"][data-val="${urlCat}"]`);
            if(matchBtn){
                document.querySelectorAll('.filter-tab[data-filter="category"]').forEach(b=>b.classList.remove('active'));
                matchBtn.classList.add('active');
            }
        }
        applyFilters();
    }

    // Reveal observer
    const revObs = new IntersectionObserver(entries=>{
        entries.forEach(e=>{ if(e.isIntersecting) e.target.classList.add('visible'); });
    }, {threshold:0.08});

    renderCards();
    init();
    document.querySelectorAll('.reveal').forEach(el=>revObs.observe(el));

    // Particles
    (function(){
        const canvas=document.getElementById('bg-canvas');
        if(!canvas||!window.THREE)return;
        const W=window.innerWidth,H=window.innerHeight;
        const scene=new THREE.Scene();
        const camera=new THREE.PerspectiveCamera(60,W/H,0.1,1000);
        camera.position.z=14;
        const renderer=new THREE.WebGLRenderer({canvas,alpha:true,antialias:true});
        renderer.setSize(W,H);renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));
        renderer.setClearColor(0x000000,0);
        const COUNT=100,geo=new THREE.BufferGeometry();
        const pos=new Float32Array(COUNT*3),vel=[];
        for(let i=0;i<COUNT;i++){pos[i*3]=(Math.random()-.5)*28;pos[i*3+1]=(Math.random()-.5)*28;pos[i*3+2]=(Math.random()-.5)*4;vel.push({x:(Math.random()-.5)*0.01,y:(Math.random()-.5)*0.01});}
        geo.setAttribute('position',new THREE.BufferAttribute(pos,3));
        scene.add(new THREE.Points(geo,new THREE.PointsMaterial({color:0x38bdf8,size:0.09,transparent:true,opacity:0.5})));
        const MAX_L=250,lPos=new Float32Array(MAX_L*6),lGeo=new THREE.BufferGeometry();
        lGeo.setAttribute('position',new THREE.BufferAttribute(lPos,3));lGeo.setDrawRange(0,0);
        scene.add(new THREE.LineSegments(lGeo,new THREE.LineBasicMaterial({color:0x7dd3fc,transparent:true,opacity:0.12})));
        (function animate(){
            requestAnimationFrame(animate);
            for(let i=0;i<COUNT;i++){pos[i*3]+=vel[i].x;pos[i*3+1]+=vel[i].y;if(Math.abs(pos[i*3])>14)vel[i].x*=-1;if(Math.abs(pos[i*3+1])>14)vel[i].y*=-1;}
            geo.attributes.position.needsUpdate=true;
            let li=0;
            for(let i=0;i<COUNT&&li<MAX_L;i++)for(let j=i+1;j<COUNT&&li<MAX_L;j++){const dx=pos[i*3]-pos[j*3],dy=pos[i*3+1]-pos[j*3+1];if(Math.sqrt(dx*dx+dy*dy)<5.5){lPos[li*6]=pos[i*3];lPos[li*6+1]=pos[i*3+1];lPos[li*6+2]=0;lPos[li*6+3]=pos[j*3];lPos[li*6+4]=pos[j*3+1];lPos[li*6+5]=0;li++;}}
            lGeo.setDrawRange(0,li*2);lGeo.attributes.position.needsUpdate=true;
            renderer.render(scene,camera);
        })();
        window.addEventListener('resize',()=>{camera.aspect=window.innerWidth/window.innerHeight;camera.updateProjectionMatrix();renderer.setSize(window.innerWidth,window.innerHeight);});
    })();
    </script>
</body>
</html>
