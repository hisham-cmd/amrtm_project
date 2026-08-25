<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تواصل معنا | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ---- CONTACT PAGE ---- */
        .contact-layout {
            position: relative; z-index: 10;
            padding: 0 5% 80px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
            max-width: 1200px; margin: 0 auto;
        }

        /* ---- INFO CARDS ROW ---- */
        .contact-info-row {
            position: relative; z-index: 10;
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 20px; padding: 0 5% 48px;
            max-width: 1200px; margin: 0 auto;
        }
        .contact-info-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 20px; padding: 28px 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .contact-info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(56,189,248,0.15);
            border-color: rgba(56,189,248,0.3);
        }
        .contact-info-icon {
            width: 54px; height: 54px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(14,165,233,0.2), rgba(124,58,237,0.2));
            border: 1px solid rgba(56,189,248,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px; font-size: 20px; color: #38bdf8;
        }
        .contact-info-label { font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.5); margin-bottom: 7px; text-transform: uppercase; letter-spacing: 0.08em; }
        .contact-info-value { font-size: 14px; font-weight: 700; color: #fff; line-height: 1.6; }
        .contact-info-value a { color: #38bdf8; text-decoration: none; }
        .contact-info-value a:hover { text-decoration: underline; }

        /* ---- FORM CARD ---- */
        .contact-form-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 24px; padding: 36px 32px;
        }
        .contact-form-card h2 {
            font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 6px;
            display: flex; align-items: center; gap: 10px;
        }
        .contact-form-card h2 i { color: #38bdf8; font-size: 18px; }
        .contact-form-sub { font-size: 13.5px; color: rgba(255,255,255,0.5); margin-bottom: 28px; }

        .cform-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .cform-group { margin-bottom: 16px; }
        .cform-group label { display: block; font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
        .cform-group input,
        .cform-group select,
        .cform-group textarea {
            width: 100%; background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,255,255,0.12);
            border-radius: 12px; padding: 12px 16px;
            color: #fff; font-family: 'Cairo', sans-serif; font-size: 14px;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        .cform-group input::placeholder,
        .cform-group textarea::placeholder { color: rgba(255,255,255,0.25); }
        .cform-group input:focus,
        .cform-group select:focus,
        .cform-group textarea:focus {
            border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56,189,248,0.1);
        }
        .cform-group textarea { resize: vertical; min-height: 130px; }
        .cform-group select option { background: #0d2448; color: #fff; }
        .cform-full { grid-column: 1 / -1; }
        .cform-error { color: #fca5a5; font-size: 12px; margin-top: 4px; }

        .contact-submit-btn {
            width: 100%; padding: 15px; border: none; border-radius: 14px;
            background: linear-gradient(135deg, #0ea5e9, #7c3aed);
            color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 16px; font-weight: 800; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 8px 24px rgba(14,165,233,0.3); margin-top: 8px;
        }
        .contact-submit-btn:hover { opacity: 0.88; transform: translateY(-1px); }

        .alert {
            padding: 13px 16px; border-radius: 12px; font-size: 13px; font-weight: 600;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: rgba(74,222,128,0.12); color: #86efac; border: 1px solid rgba(74,222,128,0.25); }
        .alert-danger  { background: rgba(239,68,68,0.12); color: #fca5a5; border: 1px solid rgba(239,68,68,0.25); }

        /* ---- SIDEBAR ---- */
        .contact-sidebar { display: flex; flex-direction: column; gap: 20px; }
        .sidebar-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 22px; padding: 26px 22px;
        }
        .sidebar-card-title {
            font-size: 14px; font-weight: 800; color: #fff; margin-bottom: 18px;
            display: flex; align-items: center; justify-content: flex-end; gap: 8px;
        }
        .sidebar-card-title i { color: #38bdf8; }

        /* Hours */
        .hours-list { list-style: none; }
        .hours-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.07);
            font-size: 13px;
        }
        .hours-item:last-child { border-bottom: none; }
        .hours-day { font-weight: 700; color: rgba(255,255,255,0.75); }
        .hours-time {
            color: #38bdf8; font-weight: 700;
            background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2);
            padding: 3px 12px; border-radius: 20px; font-size: 12px;
        }
        .hours-time.closed { color: #f87171; background: rgba(248,113,113,0.1); border-color: rgba(248,113,113,0.2); }

        /* Social */
        .social-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .social-link {
            display: flex; align-items: center; gap: 9px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; padding: 11px 14px;
            text-decoration: none; font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,0.75);
            transition: all 0.2s;
        }
        .social-link:hover { background: rgba(56,189,248,0.1); border-color: rgba(56,189,248,0.3); color: #fff; }
        .social-link i { font-size: 16px; flex-shrink: 0; }
        .social-link.whatsapp i  { color: #4ade80; }
        .social-link.instagram i { color: #f472b6; }
        .social-link.twitter i   { color: #38bdf8; }
        .social-link.snapchat i  { color: #fbbf24; }
        .social-link.linkedin i  { color: #60a5fa; }
        .social-link.tiktok i    { color: rgba(255,255,255,0.7); }
        .social-link.email i     { color: #a78bfa; }

        /* Map */
        .map-box {
            background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(124,58,237,0.1));
            border: 1.5px dashed rgba(56,189,248,0.3);
            border-radius: 16px; height: 150px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 10px;
        }
        .map-box i { font-size: 32px; color: #38bdf8; }
        .map-box span { font-size: 14px; font-weight: 700; color: rgba(255,255,255,0.75); }
        .map-box a { font-size: 12.5px; color: #38bdf8; text-decoration: none; }
        .map-box a:hover { text-decoration: underline; }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 1024px) {
            .contact-layout { grid-template-columns: 1fr; }
            .contact-info-row { grid-template-columns: repeat(2, 1fr); }
            .contact-sidebar { display: grid; grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .contact-info-row { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .cform-row { grid-template-columns: 1fr; }
            .contact-form-card { padding: 24px 18px; }
            .contact-sidebar { grid-template-columns: 1fr; }
            .social-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body class="inner-page">

<canvas class="page-canvas" id="bg-canvas"></canvas>

@include('partials.public_nav')

<!-- ===== HERO ===== -->
<section class="page-hero reveal">
    <div class="page-hero-content">
        <div class="page-hero-badge">
            <i class="fa fa-headset"></i>
            تواصل معنا
        </div>
        <h1 class="page-hero-title">
            نحن هنا <span class="gradient-text">لمساعدتك</span>
        </h1>
        <p class="page-hero-sub">
            فريقنا متاح للرد على جميع استفساراتك ومساعدتك في تجربة مميزة. تواصل معنا بأي طريقة تناسبك.
        </p>
    </div>
</section>

<!-- ===== INFO CARDS ===== -->
<div class="contact-info-row reveal">
    <div class="contact-info-card">
        <div class="contact-info-icon"><i class="fa fa-phone"></i></div>
        <div class="contact-info-label">الهاتف</div>
        <div class="contact-info-value">
            <a href="tel:+966504915222">+966 50 491 5222</a>
        </div>
    </div>
    <div class="contact-info-card">
        <div class="contact-info-icon"><i class="fab fa-whatsapp"></i></div>
        <div class="contact-info-label">واتساب</div>
        <div class="contact-info-value">
            <a href="https://wa.me/966504915222" target="_blank" rel="noopener">+966 50 491 5222</a>
        </div>
    </div>
    <div class="contact-info-card">
        <div class="contact-info-icon"><i class="fa fa-envelope"></i></div>
        <div class="contact-info-label">البريد الإلكتروني</div>
        <div class="contact-info-value">
            <a href="mailto:info@amrtm.com.sa">info@amrtm.com.sa</a>
        </div>
    </div>
    <div class="contact-info-card">
        <div class="contact-info-icon"><i class="fa fa-location-dot"></i></div>
        <div class="contact-info-label">العنوان</div>
        <div class="contact-info-value">المملكة العربية السعودية<br>جدة — حي الحمراء</div>
    </div>
</div>

<!-- ===== MAIN LAYOUT ===== -->
<div class="contact-layout">

    <!-- FORM -->
    <div class="contact-form-card reveal">
        <h2><i class="fa fa-paper-plane"></i> أرسل لنا رسالة</h2>
        <p class="contact-form-sub">نرد خلال 24 ساعة عمل. جميع الرسائل تصل مباشرة لفريقنا.</p>

        @if(session('contact_success'))
            <div class="alert alert-success">
                <i class="fa fa-circle-check"></i>
                {{ session('contact_success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fa fa-circle-exclamation"></i>
                يرجى تصحيح الأخطاء أدناه.
            </div>
        @endif

        <form method="POST" action="{{ route('contact.send') }}" novalidate>
            @csrf

            <div class="cform-row">
                <div class="cform-group">
                    <label for="name">الاسم الكامل <span style="color:#f87171;">*</span></label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}" placeholder="أدخل اسمك الكامل" required
                           style="{{ $errors->has('name') ? 'border-color:#f87171;' : '' }}">
                    @error('name')<div class="cform-error">{{ $message }}</div>@enderror
                </div>
                <div class="cform-group">
                    <label for="phone">رقم الجوال</label>
                    <input type="tel" id="phone" name="phone"
                           value="{{ old('phone') }}" placeholder="05XXXXXXXX" dir="ltr">
                </div>
            </div>

            <div class="cform-row">
                <div class="cform-group">
                    <label for="email">البريد الإلكتروني <span style="color:#f87171;">*</span></label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}" placeholder="example@email.com"
                           required dir="ltr"
                           style="{{ $errors->has('email') ? 'border-color:#f87171;' : '' }}">
                    @error('email')<div class="cform-error">{{ $message }}</div>@enderror
                </div>
                <div class="cform-group">
                    <label for="subject">موضوع الرسالة <span style="color:#f87171;">*</span></label>
                    <select id="subject" name="subject" required
                            style="{{ $errors->has('subject') ? 'border-color:#f87171;' : '' }}">
                        <option value="" disabled {{ old('subject') ? '' : 'selected' }}>اختر الموضوع</option>
                        <option value="استفسار عام"       {{ old('subject') === 'استفسار عام'       ? 'selected' : '' }}>استفسار عام</option>
                        <option value="مشكلة تقنية"       {{ old('subject') === 'مشكلة تقنية'       ? 'selected' : '' }}>مشكلة تقنية</option>
                        <option value="طلب شراكة"         {{ old('subject') === 'طلب شراكة'         ? 'selected' : '' }}>طلب شراكة</option>
                        <option value="اقتراح أو ملاحظة" {{ old('subject') === 'اقتراح أو ملاحظة' ? 'selected' : '' }}>اقتراح أو ملاحظة</option>
                        <option value="شكوى"              {{ old('subject') === 'شكوى'              ? 'selected' : '' }}>شكوى</option>
                        <option value="أخرى"              {{ old('subject') === 'أخرى'              ? 'selected' : '' }}>أخرى</option>
                    </select>
                    @error('subject')<div class="cform-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="cform-row">
                <div class="cform-group cform-full">
                    <label for="message">الرسالة <span style="color:#f87171;">*</span></label>
                    <textarea id="message" name="message"
                              placeholder="اكتب رسالتك هنا..." required
                              style="{{ $errors->has('message') ? 'border-color:#f87171;' : '' }}">{{ old('message') }}</textarea>
                    @error('message')<div class="cform-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <button type="submit" class="contact-submit-btn">
                <i class="fa fa-paper-plane"></i>
                إرسال الرسالة
            </button>
        </form>
    </div>

    <!-- SIDEBAR -->
    <div class="contact-sidebar">

        <!-- Working Hours -->
        <div class="sidebar-card reveal">
            <div class="sidebar-card-title">
                ساعات العمل
                <i class="fa fa-clock"></i>
            </div>
            <ul class="hours-list">
                <li class="hours-item">
                    <span class="hours-time">9:00 ص — 10:00 م</span>
                    <span class="hours-day">الأحد — الخميس</span>
                </li>
                <li class="hours-item">
                    <span class="hours-time">10:00 ص — 6:00 م</span>
                    <span class="hours-day">السبت</span>
                </li>
                <li class="hours-item">
                    <span class="hours-time closed">مغلق</span>
                    <span class="hours-day">الجمعة</span>
                </li>
            </ul>
        </div>

        <!-- Social Links -->
        <div class="sidebar-card reveal">
            <div class="sidebar-card-title">
                تابعنا على
                <i class="fa fa-share-nodes"></i>
            </div>
            <div class="social-grid">
                <a href="https://wa.me/966504915222" target="_blank" rel="noopener" class="social-link whatsapp">
                    <i class="fab fa-whatsapp"></i> واتساب
                </a>
                <a href="https://www.instagram.com/amrtm.com.sa/" target="_blank" rel="noopener" class="social-link instagram">
                    <i class="fab fa-instagram"></i> إنستقرام
                </a>
                <a href="https://x.com/amrtmcomsa" target="_blank" rel="noopener" class="social-link twitter">
                    <i class="fab fa-x-twitter"></i> تويتر
                </a>
                <a href="https://www.snapchat.com/add/amrtm.com" target="_blank" rel="noopener" class="social-link snapchat">
                    <i class="fab fa-snapchat-ghost"></i> سناب شات
                </a>
                <a href="https://www.linkedin.com/in/amrtm-com-sa/" target="_blank" rel="noopener" class="social-link linkedin">
                    <i class="fab fa-linkedin-in"></i> لينكدإن
                </a>
                <a href="#" target="_blank" rel="noopener" class="social-link tiktok">
                    <i class="fab fa-tiktok"></i> تيك توك
                </a>
                <a href="mailto:info@amrtm.com.sa" class="social-link email" style="grid-column: 1/-1;">
                    <i class="fa fa-envelope"></i> info@amrtm.com.sa
                </a>
            </div>
        </div>

        <!-- Location -->
        <div class="sidebar-card reveal">
            <div class="sidebar-card-title">
                موقعنا
                <i class="fa fa-map-location-dot"></i>
            </div>
            <div class="map-box">
                <i class="fa fa-map-pin"></i>
                <span>جدة — حي الحمراء</span>
                <a href="https://www.google.com/maps/search/حي+الحمراء+جدة" target="_blank" rel="noopener">
                    <i class="fa fa-arrow-up-right-from-square"></i> عرض على خرائط جوجل
                </a>
            </div>
        </div>

    </div>

</div>

@include('partials.public_footer')

<script src="https://cdn.jsdelivr.net/npm/three@0.158.0/build/three.min.js"></script>
<script>
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
    scene.add(new THREE.LineSegments(lGeo, new THREE.LineBasicMaterial({ color:0x7dd3fc, transparent:true, opacity:0.11 })));
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

/* Reveal on scroll */
const revealObs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 80);
            revealObs.unobserve(e.target);
        }
    });
}, { threshold: 0.08 });
document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));
</script>

</body>
</html>
