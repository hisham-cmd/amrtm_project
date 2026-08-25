<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'وظّفني')</title>
  <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand:   { 50:'#f0e6ff',100:'#e0ccff',500:'#b366d9',600:'#9d4db8',700:'#8633a0',800:'#6b2685',900:'#52206a' },
            surface: { 50:'#f8fafc',100:'#f1f5f9',200:'#e2e8f0',700:'#374151',800:'#1e293b',900:'#0f172a' }
          }
        }
      }
    }
  </script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script src="{{ route('jobs.i18n-script') }}"></script>

  <style>
    *{ font-family:'Segoe UI',Tahoma,Arial,sans-serif; box-sizing:border-box; }

    /* ═══ GLASS / BRAND HELPERS ═══ */
    .glass-card{ background:rgba(255,255,255,0.08); backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,0.15); }
    .gradient-text{ background:linear-gradient(135deg,#b366d9,#d699e6); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
    .service-icon-wrapper{ border-radius:18px; }

    /* ═══ NAVBAR ═══ */
    .nav-link{ position:relative; font-weight:500; text-decoration:none; color:#374151; font-size:15px; transition:color 0.2s; white-space:nowrap; }
    .nav-link::after{ content:''; position:absolute; bottom:-4px; right:0; width:0; height:2px; background:linear-gradient(90deg,#b366d9,#d699e6); transition:width 0.26s cubic-bezier(0.34,1.56,0.64,1); border-radius:99px; }
    .nav-link:hover{ color:#9d4db8; }
    .nav-link:hover::after{ width:100%; }

    /* ── Icon buttons (country / language) ── */
    .nav-icon-btn{
      display:inline-flex; align-items:center; gap:5px;
      height:37px; padding:0 11px;
      border-radius:10px; border:1.5px solid #e5e7eb;
      background:#fff; cursor:pointer; font-family:inherit;
      transition:border-color .2s, box-shadow .2s, background .2s;
      white-space:nowrap;
    }
    .nav-icon-btn:hover{ border-color:#9d4db8; box-shadow:0 0 0 3px rgba(157,77,184,.12); background:#fdf4ff; }
    .nav-icon-btn .chevron{ font-size:9px; color:#b0b7c3; }

    /* ── Auth buttons ── */
    .btn-login{
      display:inline-flex; align-items:center; height:35px; padding:0 16px;
      font-size:13px; font-weight:600; color:#9d4db8;
      border:1.5px solid #9d4db8; border-radius:8px; background:transparent;
      text-decoration:none; white-space:nowrap; transition:all .2s;
    
      display:inline-flex; align-items:center; height:35px; padding:0 16px;
      font-size:13px; font-weight:600; color:#9d4db8;
      border:1.5px solid #9d4db8; border-radius:8px; background:transparent;
      text-decoration:none; white-space:nowrap; transition:all .2s;
    }
    .btn-login:hover{ background:#9d4db8; color:#fff; }
    .btn-register{
      display:inline-flex; align-items:center; height:35px; padding:0 16px;
      font-size:13px; font-weight:600; color:#fff;
      background:linear-gradient(135deg,#9d4db8,#8633a0);
      border:none; border-radius:8px; text-decoration:none;
      white-space:nowrap; box-shadow:0 2px 8px rgba(157,77,184,.3); transition:all .2s;
    }
    .btn-register:hover{ background:linear-gradient(135deg,#8633a0,#6b2685); box-shadow:0 4px 14px rgba(157,77,184,.4); }

    /* ── Divider ── */
    .nav-sep{ width:1px; height:22px; background:#e5e7eb; flex-shrink:0; }

    /* ═══ MOBILE MENU — مخفي افتراضياً بـ CSS صريح ═══ */
    #mobile-menu{
      display:none;
      background:#fff;
      border-top:1px solid #f0e8ff;
      padding:12px 20px 18px;
    }
    #mobile-menu.open{ display:block; }

    /* إخفاء Burger على Desktop بـ CSS مباشر */
    @media(min-width:768px){
      #mobile-menu-btn{ display:none !important; }
      #mobile-menu{ display:none !important; }
      #desktop-nav{ display:flex !important; }
      #desktop-actions{ display:flex !important; }
    }
    @media(max-width:767px){
      #desktop-nav{ display:none !important; }
      #desktop-actions{ display:none !important; }
      #mobile-menu-btn{ display:flex !important; }
    }

    /* ── Mobile nav link ── */
    .mob-link{
      display:flex; align-items:center; gap:9px;
      padding:10px 0; font-size:16px; font-weight:500; color:#374151;
      border-bottom:1px solid #f1f5f9; text-decoration:none; transition:color .2s;
    }
    .mob-link:last-of-type{ border-bottom:none; }
    .mob-link:hover{ color:#9d4db8; }

    /* ═══ PAGE CARDS ═══ */
    .job-card{ transition:all .4s cubic-bezier(.34,1.56,.64,1); border:1px solid #e5e7eb; background:linear-gradient(135deg,#fff,#f9fafb); position:relative; overflow:hidden; }
    .job-card:hover{ border-color:#b366d9; box-shadow:0 20px 50px rgba(125,0,133,.15); transform:translateY(-8px) scale(1.01); }
    .service-card{ transition:all .4s cubic-bezier(.34,1.56,.64,1); }
    .service-card:hover{ transform:translateY(-8px); box-shadow:0 20px 40px rgba(157,77,184,.2); }
    .stat-card{ transition:all .4s cubic-bezier(.34,1.56,.64,1); background:linear-gradient(135deg,rgba(255,255,255,.1),rgba(255,255,255,.05)); border:1px solid rgba(255,255,255,.15); }
    .stat-card:hover{ transform:scale(1.08) translateY(-8px); }
    .filter-badge{ transition:all .3s ease; cursor:pointer; }
    .filter-badge:hover,.filter-badge.active{ background-color:#b366d9; color:white; transform:scale(1.05); }
    .hero-grid::before{ content:''; position:absolute; inset:0; background:radial-gradient(ellipse at 20% 50%,rgba(255,255,255,.08),transparent 60%),radial-gradient(ellipse at 80% 20%,rgba(255,255,255,.06),transparent 50%); }
  </style>

  @yield('extra-styles')
</head>
<body class="bg-white text-surface-800 overflow-x-hidden">

{{-- ══ شريط كوادر ══ --}}
<div style="background:linear-gradient(90deg,#f5f0ff,#fdf4ff);border-bottom:1px solid #ede9fe;padding:5px 20px;">
  <div style="display:flex;align-items:center;justify-content:flex-end;">
    <a href="{{ route('jobs.cadres.apply') }}" style="display:inline-flex;align-items:center;gap:6px;padding:3px 10px;border-radius:99px;text-decoration:none;transition:background .15s;"
       onmouseover="this.style.background='#f3e8ff'" onmouseout="this.style.background='transparent'">
      <div style="width:15px;height:15px;border-radius:4px;overflow:hidden;border:.5px solid #ddd6fe;flex-shrink:0;">
        <img src="{{ asset('images/cadres-logo.jpeg') }}" alt="كوادر" style="width:100%;height:100%;object-fit:cover;display:block;">
      </div>
      <span style="font-size:11px;font-weight:600;color:#7c3aed;">كوادر</span>
      <span style="font-size:10px;color:#c4b5fd;">·</span>
      <span style="font-size:10px;color:#a78bfa;" data-i18n="cadres.label">وظائف مهنية</span>
      <i class="ti ti-chevron-left" style="font-size:10px;color:#c4b5fd;" aria-hidden="true"></i>
    </a>
  </div>
</div>

<!-- ═══════════════════════════════════
     NAVBAR
═══════════════════════════════════ -->
<nav style="background:rgba(255,255,255,0.94);backdrop-filter:blur(20px);border-bottom:1px solid #f0e8ff;position:sticky;top:0;z-index:50;box-shadow:0 1px 10px rgba(157,77,184,0.07);">
  <div style="max-width:1280px;margin:0 auto;padding:0 20px;">
    <div style="display:flex;align-items:center;justify-content:space-between;height:60px;gap:12px;">

      {{-- ═══ LOGO ═══ --}}
      <a href="{{ route('jobs.index') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0;">
        <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#b366d9,#8633a0);display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(157,77,184,0.35);">
          <i class="ti ti-briefcase" style="font-size:16px;color:#fff;" aria-hidden="true"></i>
        </div>
        <span class="gradient-text" style="font-size:20px;font-weight:700;letter-spacing:-.3px;">وظّفني</span>
      </a>

      {{-- ═══ DESKTOP NAV LINKS ═══ --}}
      <div id="desktop-nav" style="align-items:center;gap:18px;flex:1;justify-content:center;">
        <a href="#jobs"      class="nav-link" data-i18n="nav.jobs">الوظائف</a>
        <a href="#companies" class="nav-link" data-i18n="nav.companies">الشركات</a>
        <a href="#insights"  class="nav-link" data-i18n="nav.insights">الإحصائيات</a>
        <a href="#reviews"   class="nav-link" data-i18n="nav.reviews">التقييمات</a>
        <a href="#blog"      class="nav-link" data-i18n="nav.blog">المدونة</a>
      </div>

      {{-- ═══ DESKTOP ACTIONS ═══ --}}
      <div id="desktop-actions" style="align-items:center;gap:6px;flex-shrink:0;">

        {{-- Country selector --}}
        @include('jobs.country-selector')

        {{-- Language selector --}}
        @include('jobs.language-selector')

        <div class="nav-sep"></div>

        @auth
          <div style="display:flex;align-items:center;gap:8px;">
            <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#b366d9,#8633a0);display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:700;flex-shrink:0;">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <span style="font-size:13px;color:#374151;font-weight:500;max-width:80px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
              @csrf
              <button type="submit"
                style="display:inline-flex;align-items:center;height:28px;padding:0 10px;font-size:12px;font-weight:600;color:#ef4444;background:transparent;border:1px solid #fecaca;border-radius:7px;cursor:pointer;font-family:inherit;white-space:nowrap;transition:all .2s;"
                onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'"
                data-i18n="nav.logout">تسجيل خروج</button>
            </form>
          </div>
        @else
          <a href="{{ route('login') }}"    class="btn-login"    data-i18n="nav.login">دخول</a>
          <a href="{{ route('register') }}" class="btn-register" data-i18n="nav.register">تسجيل</a>
        @endauth
      </div>

      {{-- ═══ MOBILE BURGER ═══ --}}
      <button id="mobile-menu-btn"
        style="width:37px;height:37px;border-radius:9px;border:1.5px solid #e5e7eb;background:#fff;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:border-color .2s;"
        aria-label="القائمة"
        onmouseover="this.style.borderColor='#9d4db8'" onmouseout="this.style.borderColor='#e5e7eb'">
        <i id="burger-icon" class="ti ti-menu-2" style="" aria-hidden="true"></i>;" aria-hidden="true"></i>
      </button>

    </div>
  </div>

  {{-- ═══ MOBILE MENU ═══ --}}
  <div id="mobile-menu">
    {{-- روابط --}}
    <a href="#jobs"      class="mob-link" data-i18n="nav.jobs">
      <i class="ti ti-briefcase" style="font-size:15px;color:#9d4db8;" aria-hidden="true"></i>الوظائف
    </a>
    <a href="#companies" class="mob-link" data-i18n="nav.companies">
      <i class="ti ti-building-2" style="font-size:15px;color:#9d4db8;" aria-hidden="true"></i>الشركات
    </a>
    <a href="#insights"  class="mob-link" data-i18n="nav.insights">
      <i class="ti ti-chart-bar" style="font-size:15px;color:#9d4db8;" aria-hidden="true"></i>الإحصائيات
    </a>
    <a href="#reviews"   class="mob-link" data-i18n="nav.reviews">
      <i class="ti ti-star" style="font-size:15px;color:#9d4db8;" aria-hidden="true"></i>التقييمات
    </a>
    <a href="#blog"      class="mob-link" data-i18n="nav.blog">
      <i class="ti ti-pencil" style="font-size:15px;color:#9d4db8;" aria-hidden="true"></i>المدونة
    </a>

    {{-- أدوات الاختيار --}}
    <div style="display:flex;align-items:center;gap:8px;padding:10px 0;flex-wrap:wrap;border-bottom:1px solid #f1f5f9;">
      @include('jobs.country-selector')
      @include('jobs.language-selector')
    </div>

    {{-- Auth --}}
    <div style="display:flex;gap:8px;padding-top:10px;">
      @auth
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
          @csrf
          <button type="submit" style="height:34px;padding:0 14px;font-size:13px;font-weight:600;color:#ef4444;background:transparent;border:1px solid #fecaca;border-radius:8px;cursor:pointer;font-family:inherit;" data-i18n="nav.logout">تسجيل خروج</button>
        </form>
      @else
        <a href="{{ route('login') }}"    class="btn-login"    data-i18n="nav.login">دخول</a>
        <a href="{{ route('register') }}" class="btn-register" data-i18n="nav.register">تسجيل</a>
      @endauth
    </div>
  </div>
</nav>

@yield('content')

<!-- ═══════════════════════════════════
     FOOTER
═══════════════════════════════════ -->
<footer style="background:#0f172a;padding-top:60px;padding-bottom:30px;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

    {{-- Grid --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:36px;margin-bottom:44px;">

      {{-- شعار --}}
      <div style="grid-column:span 2;min-width:0;">
        <div style="display:flex;align-items:center;gap:9px;margin-bottom:14px;">
          <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#b366d9,#8633a0);display:flex;align-items:center;justify-content:center;">
            <i class="ti ti-briefcase" style="font-size:17px;color:#fff;" aria-hidden="true"></i>
          </div>
          <span style="font-size:17px;font-weight:700;color:#fff;">وظّفني</span>
        </div>
        <p style="font-size:14px;color:#94a3b8;line-height:1.8;margin:0 0 18px;max-width:250px;" data-i18n="footer.desc">منصة التوظيف الأولى والأفضل في المنطقة.</p>
        <div style="display:flex;gap:7px;">
          <a href="#" style="width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;transition:background .2s;" onmouseover="this.style.background='#9d4db8'" onmouseout="this.style.background='rgba(255,255,255,.08)'" aria-label="Twitter">
            <svg style="width:13px;height:13px;" fill="#fff" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.261 5.635zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="#" style="width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;transition:background .2s;" onmouseover="this.style.background='#9d4db8'" onmouseout="this.style.background='rgba(255,255,255,.08)'" aria-label="LinkedIn">
            <svg style="width:13px;height:13px;" fill="#fff" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="#" style="width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;transition:background .2s;" onmouseover="this.style.background='#9d4db8'" onmouseout="this.style.background='rgba(255,255,255,.08)'" aria-label="Instagram">
            <i class="ti ti-brand-instagram" style="font-size:14px;color:#fff;" aria-hidden="true"></i>
          </a>
        </div>
      </div>

      {{-- روابط سريعة --}}
      <div>
        <h4 style="color:#fff;font-size:12px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;opacity:.65;margin:0 0 16px;" data-i18n="footer.col.quick">روابط سريعة</h4>
        <ul style="list-style:none;padding:0;margin:0;">
          @foreach([['#jobs','nav.jobs','الوظائف'],['#companies','nav.companies','الشركات'],['#insights','nav.insights','الإحصائيات'],['#blog','nav.blog','المدونة']] as [$href,$key,$txt])
          <li style="margin-bottom:9px;">
            <a href="{{ $href }}" style="font-size:14px;color:#94a3b8;text-decoration:none;display:flex;align-items:center;gap:5px;transition:color .2s;" onmouseover="this.style.color='#b366d9'" onmouseout="this.style.color='#94a3b8'" data-i18n="{{ $key }}">
              <i class="ti ti-chevron-left" style="font-size:10px;" aria-hidden="true"></i>{{ $txt }}
            </a>
          </li>
          @endforeach
          <li>
            <a href="{{ route('register') }}" style="font-size:14px;color:#94a3b8;text-decoration:none;display:flex;align-items:center;gap:5px;transition:color .2s;" onmouseover="this.style.color='#b366d9'" onmouseout="this.style.color='#94a3b8'" data-i18n="nav.register">
              <i class="ti ti-chevron-left" style="font-size:10px;" aria-hidden="true"></i>إنشاء حساب
            </a>
          </li>
        </ul>
      </div>

      {{-- خدماتنا --}}
      <div>
        <h4 style="color:#fff;font-size:12px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;opacity:.65;margin:0 0 16px;" data-i18n="footer.col.services">خدماتنا</h4>
        <ul style="list-style:none;padding:0;margin:0;">
          @foreach([
            [route('jobs.services.executive-jobs'),      'svc.executive.title',   'الوظائف القيادية'],
            [route('jobs.services.professional-jobs'),   'svc.professional.title','الوظائف المهنية'],
            [route('jobs.services.administrative-jobs'), 'svc.admin.title',       'الوظائف الإدارية'],
            [route('jobs.services.manpower-companies'),  'svc.manpower.title_short','التنازل عن العمالة'],
            [route('jobs.services.recruitment-companies'),'svc.recruitment.title','شركات التوظيف'],
            [route('jobs.services.staffing-companies'),  'svc.staffing.title',    'شركات تأجير العمالة'],
          ] as [$href,$key,$txt])
          <li style="margin-bottom:9px;">
            <a href="{{ $href }}" style="font-size:14px;color:#94a3b8;text-decoration:none;display:flex;align-items:center;gap:5px;transition:color .2s;" onmouseover="this.style.color='#b366d9'" onmouseout="this.style.color='#94a3b8'" data-i18n="{{ $key }}">
              <i class="ti ti-chevron-left" style="font-size:10px;" aria-hidden="true"></i>{{ $txt }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- تواصل + اللغة --}}
      <div>
        <h4 style="color:#fff;font-size:12px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;opacity:.65;margin:0 0 16px;" data-i18n="footer.col.contact">تواصل معنا</h4>
        <ul style="list-style:none;padding:0;margin:0 0 20px;">
          <li style="display:flex;align-items:center;gap:7px;margin-bottom:9px;"><i class="ti ti-mail"    style="font-size:14px;color:#9d4db8;" aria-hidden="true"></i><span style="font-size:13px;color:#94a3b8;">info@wazzifni.com</span></li>
          <li style="display:flex;align-items:center;gap:7px;margin-bottom:9px;"><i class="ti ti-phone"   style="font-size:14px;color:#9d4db8;" aria-hidden="true"></i><span style="font-size:13px;color:#94a3b8;">+966 50 000 0000</span></li>
          <li style="display:flex;align-items:center;gap:7px;">
            <i class="ti ti-map-pin" style="font-size:14px;color:#9d4db8;" aria-hidden="true"></i>
            <span style="font-size:13px;color:#94a3b8;" data-i18n="footer.address">المملكة العربية السعودية</span>
          </li>
        </ul>

        {{-- اختيار اللغة سريع --}}
        <p style="font-size:10px;color:#64748b;font-weight:600;letter-spacing:.04em;margin:0 0 8px;" data-i18n="nav.language">اللغة</p>
        <div style="display:flex;flex-wrap:wrap;gap:5px;">
          @foreach([
            ['ar','🇸🇦','العربية','Arabic','rtl','#006c35'],
            ['en','🇬🇧','English','English','ltr','#012169'],
            ['am','🇪🇹','አማርኛ','Amharic','ltr','#078930'],
            ['tl','🇵🇭','Filipino','Filipino','ltr','#0038a8'],
            ['ne','🇳🇵','नेपाली','Nepali','ltr','#003893'],
            ['bn','🇧🇩','বাংলা','Bengali','ltr','#006a4e'],
            ['ur','🇵🇰','اردو','Urdu','rtl','#115740'],
            ['id','🇮🇩','Indonesia','Indonesian','ltr','#ce1126'],
            ['fr','🇫🇷','Français','French','ltr','#002395'],
            ['sw','🇰🇪','Kiswahili','Swahili','ltr','#006600'],
            ['zh','🇨🇳','中文','Chinese','ltr','#de2910'],
          ] as [$code,$flag,$native,$english,$dir,$color])
          <button
            onclick="window._langPick({code:'{{ $code }}',flag:'{{ $flag }}',native:'{{ $native }}',english:'{{ $english }}',dir:'{{ $dir }}',label:'{{ $native }}',color:'{{ $color }}'})"
            style="font-size:17px;background:none;border:none;cursor:pointer;padding:1px;border-radius:4px;transition:transform .18s;line-height:1;"
            onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'"
            title="{{ $native }}">{{ $flag }}</button>
          @endforeach
        </div>
      </div>

    </div>

    {{-- Bottom bar --}}
    <div style="border-top:1px solid rgba(255,255,255,.07);padding-top:22px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px;">
      <p style="font-size:13px;color:#475569;margin:0;" data-i18n="footer.rights">© 2025 وظّفني. جميع الحقوق محفوظة</p>
      <div style="display:flex;gap:18px;flex-wrap:wrap;">
        <a href="#" style="font-size:13px;color:#475569;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#b366d9'" onmouseout="this.style.color='#475569'" data-i18n="footer.privacy">سياسة الخصوصية</a>
        <a href="#" style="font-size:13px;color:#475569;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#b366d9'" onmouseout="this.style.color='#475569'" data-i18n="footer.terms">الشروط والأحكام</a>
        <a href="#" style="font-size:13px;color:#475569;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#b366d9'" onmouseout="this.style.color='#475569'" data-i18n="footer.contact">اتصل بنا</a>
      </div>
    </div>

  </div>
</footer>

<script>
  lucide.createIcons();

  /* ═══ MOBILE MENU TOGGLE ═══ */
  (function(){
    const btn  = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('burger-icon');
    if (!btn || !menu) return;
    btn.addEventListener('click', function(){
      const isOpen = menu.classList.toggle('open');
      icon.className = isOpen
        ? 'ti ti-x'
        : 'ti ti-menu-2';
      icon.style.fontSize = '17px';
      icon.style.color    = '#374151';
    });
    /* إغلاق المنيو عند الضغط على رابط */
    menu.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        menu.classList.remove('open');
        icon.className = 'ti ti-menu-2';
        icon.style.fontSize = '17px';
      });
    });
  })();

  /* ═══ COUNTER ANIMATION ═══ */
  (function(){
    const obs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        const el = e.target, target = parseInt(el.dataset.target), step = target / 60;
        let cur = 0;
        const t = setInterval(() => {
          cur += step;
          if (cur >= target) { el.textContent = target.toLocaleString('ar-SA'); clearInterval(t); }
          else el.textContent = Math.floor(cur).toLocaleString('ar-SA');
        }, 30);
        obs.unobserve(el);
      });
    });
    document.querySelectorAll('.counter').forEach(c => obs.observe(c));
  })();

  /* ═══ COUNTER LOCALE ON LANG CHANGE ═══ */
  document.addEventListener('langChanged', function(e){
    document.querySelectorAll('.counter').forEach(el => {
      const v = parseInt(el.dataset.target);
      if (!isNaN(v)) el.textContent = v.toLocaleString(e.detail.code === 'ar' ? 'ar-SA' : 'en');
    });
  });
</script>

@yield('extra-scripts')
</body>
</html>
