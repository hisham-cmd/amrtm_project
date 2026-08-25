<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $officiant->user->name }} | مأذون شرعي | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Cairo', sans-serif; background: #f0f4f2; min-height: 100vh; color: #1e293b; }
        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }

        /* ── Breadcrumb ── */
        .steps-trail { background:#fff; border-bottom:1px solid #e5e7eb; padding:14px 5%; display:flex; align-items:center; justify-content:center; gap:0; flex-wrap:wrap; }
        .trail-step { display:flex; align-items:center; gap:7px; font-size:13px; font-weight:600; color:#9ca3af; text-decoration:none; white-space:nowrap; }
        .trail-step.done { color:#1a5c38; }
        .trail-step.done:hover { text-decoration:underline; }
        .trail-step.active { color:#1a5c38; font-weight:800; }
        .trail-step .step-num { width:26px; height:26px; border-radius:50%; background:#e5e7eb; color:#9ca3af; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:800; flex-shrink:0; }
        .trail-step.done   .step-num { background:#d1fae5; color:#1a5c38; }
        .trail-step.active .step-num { background:#1a5c38; color:#fff; }
        .trail-arrow { color:#d1d5db; font-size:11px; margin:0 10px; flex-shrink:0; }

        /* ── Hero ── */
        .partner-hero { position:relative; width:100%; height:260px; overflow:hidden; background:#0f3d24; }
        .partner-hero-bg { position:absolute; inset:0; background:linear-gradient(135deg,#0f3d24 0%,#1a5c38 50%,#2d8a5a 100%); }
        .partner-hero-bg::before,.partner-hero-bg::after { content:''; position:absolute; border-radius:50%; opacity:.06; }
        .partner-hero-bg::before { width:420px; height:420px; background:#fff; top:-180px; left:-60px; }
        .partner-hero-bg::after  { width:300px; height:300px; background:#a7f3d0; bottom:-120px; right:-40px; }
        .partner-hero::after { content:''; position:absolute; inset:0; background:linear-gradient(to bottom,transparent 40%,rgba(0,0,0,.40) 100%); pointer-events:none; }
        .hero-center { position:absolute; inset:0; z-index:2; display:flex; flex-direction:column; align-items:center; justify-content:flex-end; padding-bottom:28px; gap:10px; }
        .hero-logo-ring { width:90px; height:90px; border-radius:50%; background:#fff; border:4px solid rgba(255,255,255,.90); box-shadow:0 6px 24px rgba(0,0,0,.35); display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0; }
        .hero-logo-ring img { width:100%; height:100%; object-fit:cover; }
        .hero-logo-ring .logo-placeholder { font-size:2.2rem; color:#1a5c38; opacity:.55; }
        .hero-partner-name { font-size:24px; font-weight:800; color:#fff; text-shadow:0 2px 10px rgba(0,0,0,.55); text-align:center; line-height:1.2; }
        .hero-category-badge { display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,.18); border:1.5px solid rgba(255,255,255,.30); color:#a7f3d0; font-size:12.5px; font-weight:700; padding:5px 14px; border-radius:30px; backdrop-filter:blur(4px); }
        .hero-top-badge { position:absolute; top:18px; right:5%; z-index:2; background:rgba(200,169,81,.92); color:#fff; font-size:11px; font-weight:800; padding:5px 14px; border-radius:20px; display:flex; align-items:center; gap:6px; box-shadow:0 2px 10px rgba(0,0,0,.25); }

        /* ── Layout ── */
        .main-area { background:#e8f5e9; padding:14px 5% 60px; }
        .content-grid { display:grid; grid-template-columns:1fr 340px; gap:20px; max-width:1200px; margin:0 auto; }
        .section-card { background:#c8ddc4; border-radius:16px; padding:18px 22px; border:1px solid #a8c9a4; margin-bottom:12px; }
        .section-card:last-child { margin-bottom:0; }
        .section-title { font-size:16px; font-weight:800; color:#0f3d24; margin-bottom:16px; display:flex; align-items:center; gap:8px; justify-content:flex-end; }
        .section-title i { color:#2d6a4f; font-size:15px; }
        .info-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }
        .info-cell { background:#fff; border-radius:10px; padding:12px 14px; text-align:center; }
        .info-cell-label { font-size:11px; font-weight:700; color:#2d6a4f; margin-bottom:4px; }
        .info-cell-value { font-size:14px; font-weight:700; color:#0f3d24; }

        /* ── CTA Card (sidebar) ── */
        .cta-card { background:linear-gradient(135deg,#0f3d24,#1a5c38); border-radius:16px; padding:22px; color:#fff; text-align:center; margin-bottom:12px; }
        .cta-card-logo { width:80px; height:80px; border-radius:50%; background:#fff; border:3px solid rgba(255,255,255,.8); margin:0 auto 14px; display:flex; align-items:center; justify-content:center; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,.25); }
        .cta-card-logo img { width:100%; height:100%; object-fit:cover; }
        .cta-card-name { font-size:16px; font-weight:800; color:#fff; margin-bottom:4px; }
        .cta-card-cat  { font-size:12px; color:#a7f3d0; font-weight:600; margin-bottom:18px; }
        .cta-btn { display:flex; align-items:center; justify-content:center; gap:9px; width:100%; padding:13px; border-radius:12px; font-family:'Cairo',sans-serif; font-size:14px; font-weight:800; text-decoration:none; border:none; cursor:pointer; transition:all .2s; margin-bottom:0; }
        .cta-btns-wrap { display:flex; flex-direction:column; gap:10px; }
        .cta-btn-phone  { background:rgba(255,255,255,.15); color:#fff; border:1.5px solid rgba(255,255,255,.3); }
        .cta-btn-phone:hover { background:rgba(255,255,255,.25); }
        .cta-btn-cart   { background:#f0fdf4; color:#1a5c38; border:1.5px solid #a8c9a4; }
        .cta-btn-cart:hover { background:#d1fae5; }
        .cta-btn-back   { background:#f0faf4; color:#1a5c38; }
        .cta-btn-back:hover { background:#d1fae5; }

        /* ── Hero QR ── */
        .hero-qr { position:absolute; top:18px; left:5%; background:#fff; border-radius:18px; padding:14px 14px 10px; width:164px; display:flex; flex-direction:column; align-items:center; box-shadow:0 8px 32px rgba(0,0,0,.30),0 2px 8px rgba(0,0,0,.12),0 0 0 3px #1a5c38,0 0 0 5px rgba(255,255,255,.9); z-index:3; text-decoration:none; }
        .hero-qr svg { width:132px; height:132px; display:block; border-radius:6px; background:#fff; }
        .hero-qr-divider { width:80%; height:1px; background:linear-gradient(to right,transparent,#c8ddc4,transparent); margin:8px 0 6px; }
        .hero-qr-label { font-size:10px; font-weight:700; color:#1a5c38; letter-spacing:.06em; text-align:center; font-family:'Cairo',sans-serif; margin-bottom:2px; }

        @media (max-width:900px) { .content-grid { grid-template-columns:1fr; } .info-grid { grid-template-columns:repeat(2,1fr); } .partner-hero { height:220px; } .hero-partner-name { font-size:20px; } .hero-qr { width:128px; padding:10px 10px 6px; } .hero-qr svg { width:104px; height:104px; } }
        @media (max-width:600px) { .partner-hero { height:200px; } .hero-logo-ring { width:72px; height:72px; } .hero-partner-name { font-size:17px; } .main-area { padding:14px 4% 40px; } .hero-qr { width:108px; padding:8px 8px 5px; top:10px; } .hero-qr svg { width:88px; height:88px; } }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

{{-- Breadcrumb --}}
<div class="steps-trail">
    <a href="{{ route('services.list') }}" class="trail-step done">
        <div class="step-num"><i class="fa fa-check" style="font-size:9px;"></i></div>
        <span>خدمات الشركاء</span>
    </a>
    <i class="fa fa-angle-left trail-arrow"></i>
    <span class="trail-step done" style="cursor:default;">
        <div class="step-num"><i class="fa fa-check" style="font-size:9px;"></i></div>
        <span>مأذون شرعي</span>
    </span>
    <i class="fa fa-angle-left trail-arrow"></i>
    <span class="trail-step active">
        <div class="step-num">3</div>
        <span>{{ $officiant->user->name }}</span>
    </span>
</div>

{{-- Hero --}}
<div class="partner-hero">
    <div class="partner-hero-bg"
         @if($officiant->cover_photo)
         style="background:url('{{ route('public.storage', ['path' => $officiant->cover_photo]) }}') center/cover no-repeat;"
         @endif
    ></div>
    <div class="hero-top-badge">
        <i class="fa fa-user-tie"></i>
        مأذون شرعي
    </div>

    <a href="{{ $qrCodeUrl }}" class="hero-qr" title="تحميل QR Code" download="officiant-{{ $officiant->id }}-qr.svg">
        {!! $qrCodeSvg !!}
        <div class="hero-qr-divider"></div>
        <span class="hero-qr-label">امسح للوصول للبروفايل</span>
    </a>

    <div class="hero-center">
        <div class="hero-logo-ring">
            @if($officiant->profile_photo)
                <img src="{{ route('public.storage', ['path' => $officiant->profile_photo]) }}" alt="{{ $officiant->user->name }}">
            @else
                <i class="fa fa-user-tie logo-placeholder"></i>
            @endif
        </div>
        <div class="hero-partner-name">{{ $officiant->user->name }}</div>
        <div class="hero-category-badge">
            <i class="fa fa-scroll"></i>
            مأذون شرعي معتمد
        </div>
    </div>
</div>

<div class="main-area">
    <div class="content-grid">

        {{-- ===== MAIN COLUMN ===== --}}
        <div>

            {{-- نبذة --}}
            <div class="section-card">
                <div class="section-title">نبذة عن مقدم الخدمة <i class="fa fa-circle-info"></i></div>
                @if($officiant->bio)
                    <p style="font-size:14px;color:#334155;line-height:1.9;text-align:right;">{{ $officiant->bio }}</p>
                @else
                    <p style="font-size:13px;color:#94a3b8;text-align:center;padding:20px 0;">مأذون شرعي لإتمام عقود النكاح</p>
                @endif
            </div>

            {{-- معلومات التواصل --}}
            <div class="section-card">
                <div class="section-title">معلومات التواصل <i class="fa fa-address-card"></i></div>
                <div class="info-grid">
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-user" style="margin-left:4px;"></i>الاسم</div>
                        <div class="info-cell-value">{{ $officiant->user->name }}</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-scroll" style="margin-left:4px;"></i>التصنيف</div>
                        <div class="info-cell-value">مأذون شرعي</div>
                    </div>
                    @if($officiant->city)
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-city" style="margin-left:4px;"></i>المدينة</div>
                        <div class="info-cell-value">{{ $officiant->city }}</div>
                    </div>
                    @endif
                    @if($officiant->neighborhood || $officiant->street)
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-location-dot" style="margin-left:4px;"></i>الشارع/الحي</div>
                        <div class="info-cell-value" style="font-size:12px;">
                            {{ implode(' — ', array_filter([$officiant->street, $officiant->neighborhood])) }}
                        </div>
                    </div>
                    @endif
                    @if($officiant->phone)
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-phone" style="margin-left:4px;"></i>الهاتف</div>
                        <div class="info-cell-value">
                            <a href="tel:{{ $officiant->phone }}" style="color:#1a5c38;text-decoration:none;">{{ $officiant->phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($officiant->working_hours)
                    <div class="info-cell">
                        <div class="info-cell-label"><i class="fa fa-clock" style="margin-left:4px;"></i>ساعات التوفر</div>
                        <div class="info-cell-value" style="font-size:12px;">{{ $officiant->working_hours }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Services --}}
            @if($officiant->services->isNotEmpty())
            @php $firstSvc = $officiant->services->first(); $restSvcs = $officiant->services->skip(1); @endphp
            <div class="section-card">
                <div class="section-title">السعر الرسمي للخدمة <i class="fa fa-tag"></i></div>
                <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;">
                    <div style="background:#fff;border-radius:10px;padding:10px 20px;display:flex;align-items:center;gap:10px;white-space:nowrap;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                        <i class="fa fa-money-bill-wave" style="color:#2d6a4f;font-size:18px;"></i>
                        <div>
                            <div style="font-size:11px;color:#2d6a4f;font-weight:700;">{{ $firstSvc->title }}</div>
                            <div style="font-size:18px;color:#0f3d24;font-weight:800;">
                                {{ $firstSvc->price ?? 'حسب الطلب' }}
                                @if($firstSvc->price) <span style="font-size:13px;color:#64748b;font-weight:600;">ريال</span> @endif
                            </div>
                        </div>
                    </div>
                    @if($firstSvc->description)
                    <div style="font-size:13px;color:#475569;font-weight:500;flex:1;text-align:right;">{{ $firstSvc->description }}</div>
                    @else
                    <div style="font-size:13px;color:#475569;font-weight:500;flex:1;text-align:right;">السعر الأساسي للخدمة المقدمة</div>
                    @endif
                </div>
            </div>

            @if($restSvcs->isNotEmpty())
            <div class="section-card">
                <div class="section-title">باقات الخدمة <i class="fa fa-tag"></i></div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
                    @foreach($restSvcs as $i => $svc)
                    <div style="background:linear-gradient(135deg,#0f3d24 0%,#1a5c38 60%,#2d6a4f 100%);border-radius:14px;overflow:hidden;box-shadow:0 4px 18px rgba(15,61,36,0.18);display:flex;flex-direction:column;">
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px 6px;gap:8px;">
                            <div style="background:rgba(255,255,255,0.15);border-radius:20px;padding:3px 10px;font-size:11px;font-weight:700;color:#a7f3d0;display:flex;align-items:center;gap:5px;">
                                <i class="fa fa-tag" style="font-size:10px;"></i> باقة
                            </div>
                            <span style="background:rgba(255,255,255,0.12);color:#fff;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">#{{ $i + 2 }}</span>
                        </div>
                        <div style="padding:6px 14px 14px;">
                            <div style="font-size:22px;font-weight:800;color:#fff;line-height:1.1;">
                                {{ $svc->price ?? '—' }}
                                @if($svc->price)<span style="font-size:13px;font-weight:600;color:rgba(255,255,255,0.75);"> ريال</span>@endif
                            </div>
                            <div style="font-size:13px;font-weight:700;color:rgba(255,255,255,0.85);margin-top:4px;">{{ $svc->title }}</div>
                            @if($svc->description)
                            <div style="font-size:12px;color:rgba(255,255,255,0.65);margin-top:6px;line-height:1.5;">{{ $svc->description }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endif

            {{-- Media gallery --}}
            @if($officiant->media->isNotEmpty())
            <div class="section-card">
                <div class="section-title">معرض الصور <i class="fa fa-images"></i></div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;">
                    @foreach($officiant->media as $img)
                    <img src="{{ route('public.storage', ['path' => $img->file_path]) }}" alt="صورة"
                         style="width:100%;height:120px;object-fit:cover;border-radius:12px;border:1px solid #dce8dc;">
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Booking Form --}}
            <div class="section-card">
                <div class="section-title">طلب خدمة <i class="fa fa-calendar-check"></i></div>
                @if(session('success'))
                    <div style="background:#d1fae5;color:#065f46;padding:12px;border-radius:8px;margin-bottom:15px;font-weight:700;font-size:13.5px;">
                        <i class="fa fa-check-circle" style="margin-left:5px;"></i> {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('officiant.book.store', $officiant->id) }}" method="POST" style="display:flex;flex-direction:column;gap:12px;">
                    @csrf

                    @if($officiant->services->isNotEmpty())
                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label style="font-size:12.5px;font-weight:700;color:#0f3d24;">حدد الخدمة الباقة المطلوبة (اختياري)</label>
                        <select name="officiant_service_id" style="width:100%;padding:10px;border-radius:8px;border:1px solid #a8c9a4;font-family:'Cairo';outline:none;">
                            <option value="">-- اضغط للاختيار --</option>
                            @foreach($officiant->services as $svc)
                                <option value="{{ $svc->id }}">{{ $svc->title }}@if($svc->price) - {{ $svc->price }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label style="font-size:12.5px;font-weight:700;color:#0f3d24;">رقم الجوال للتواصل <span style="color:#ef4444;">*</span></label>
                        <input type="tel" name="phone" required placeholder="05XXXXXXXX"
                               value="@auth{{ Auth::user()->phone ?? '' }}@endauth"
                               dir="ltr"
                               style="width:100%;padding:10px;border-radius:8px;border:1px solid #a8c9a4;font-family:'Cairo';outline:none;">
                        <span style="font-size:11px;color:#9ca3af;">سيتواصل معك المأذون على هذا الرقم مباشرة</span>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label style="font-size:12.5px;font-weight:700;color:#0f3d24;">موعد وتاريخ المناسبة <span style="color:#ef4444;">*</span></label>
                        <input type="date" name="event_date" required min="{{ date('Y-m-d') }}"
                               style="width:100%;padding:10px;border-radius:8px;border:1px solid #a8c9a4;font-family:'Cairo';outline:none;">
                    </div>

                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label style="font-size:12.5px;font-weight:700;color:#0f3d24;">تفاصيل إضافية وملاحظات</label>
                        <textarea name="notes" rows="3" placeholder="حدد متطلباتك كم عدد الضيوف، وغيرها من التفاصيل التي تهم البائع..."
                                  style="width:100%;padding:10px;border-radius:8px;border:1px solid #a8c9a4;font-family:'Cairo';outline:none;resize:none;"></textarea>
                    </div>

                    <button type="submit" class="cta-btn" style="background:#1a5c38;color:#fff;margin-top:5px;">
                        <i class="fa fa-paper-plane"></i> إرسال طلب الحجز
                    </button>
                    @if(!auth()->check())
                        <p style="font-size:11px;text-align:center;color:#e11d48;margin-top:-5px;">يجب تسجيل الدخول في منصة أمر تم لإتمام حجزك</p>
                    @endif
                </form>
            </div>

            {{-- Other officiants --}}
            @if($others->isNotEmpty())
            <div class="section-card">
                <div class="section-title">مأذونون آخرون <i class="fa fa-users"></i></div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px;">
                    @foreach($others as $other)
                    <a href="{{ route('officiants.profile', $other->id) }}"
                       style="display:flex;flex-direction:column;align-items:center;gap:8px;padding:14px 10px;background:#fff;border-radius:14px;border:1.5px solid #e2ede7;text-decoration:none;transition:all .2s;"
                       onmouseover="this.style.borderColor='#6ee7a8';this.style.transform='translateY(-2px)'"
                       onmouseout="this.style.borderColor='#e2ede7';this.style.transform='none'">
                        <div style="width:56px;height:56px;border-radius:50%;background:#f4f9f6;border:1px solid #e2ede7;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            @if($other->profile_photo)
                                <img src="{{ route('public.storage', ['path' => $other->profile_photo]) }}" alt="{{ $other->user->name }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <i class="fa fa-user-tie" style="color:#2d8a5a;opacity:.45;font-size:1.2rem;"></i>
                            @endif
                        </div>
                        <span style="font-size:12px;font-weight:700;color:#0f3d24;text-align:center;line-height:1.3;">{{ $other->user->name }}</span>
                        @if($other->city)
                        <span style="font-size:10px;color:#6c7a72;">{{ $other->city }}</span>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ===== SIDEBAR ===== --}}
        <div style="position:sticky;top:20px;align-self:start;">

            <div class="cta-card">
                <div class="cta-card-logo">
                    @if($officiant->profile_photo)
                        <img src="{{ route('public.storage', ['path' => $officiant->profile_photo]) }}" alt="{{ $officiant->user->name }}">
                    @else
                        <i class="fa fa-user-tie" style="font-size:2rem;color:#1a5c38;opacity:.6;"></i>
                    @endif
                </div>
                <div class="cta-card-name">{{ $officiant->user->name }}</div>
                <div class="cta-card-cat">مأذون شرعي{{ $officiant->city ? ' — ' . $officiant->city : '' }}</div>

                <div class="cta-btns-wrap">
                    @if($officiant->phone)
                    <a href="tel:{{ $officiant->phone }}" class="cta-btn cta-btn-phone">
                        <i class="fa fa-phone"></i> اتصل الآن
                    </a>
                    @endif

                    @php $firstSvc = $officiant->services->first(); @endphp
                    @if($firstSvc)
                        @auth
                        <button type="button" onclick="document.getElementById('cart-modal').style.display='flex'"
                                class="cta-btn cta-btn-cart">
                            <i class="fa fa-cart-plus"></i> أضف للسلة
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="cta-btn cta-btn-cart">
                            <i class="fa fa-cart-plus"></i> أضف للسلة
                        </a>
                        @endauth
                    @endif

                    <a href="{{ route('services.list') }}" class="cta-btn cta-btn-back">
                        <i class="fa fa-arrow-right"></i> العودة للقائمة
                    </a>
                </div>
            </div>

            {{-- Quick info card --}}
            <div class="section-card" style="margin-top:0;">
                <div class="section-title" style="font-size:14px;margin-bottom:12px;">معلومات سريعة <i class="fa fa-bolt"></i></div>
                <div style="display:flex;flex-direction:column;gap:0;">
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #b5cdb1;">
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;">{{ $officiant->user->name }}</span>
                        <span style="font-size:11px;color:#6c7a72;">الاسم</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #b5cdb1;">
                        <span style="font-size:13px;font-weight:700;color:#1a5c38;">مأذون شرعي</span>
                        <span style="font-size:11px;color:#6c7a72;">التصنيف</span>
                    </div>
                    @if($officiant->phone)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #b5cdb1;">
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;" dir="ltr">{{ $officiant->phone }}</span>
                        <span style="font-size:11px;color:#6c7a72;">الهاتف</span>
                    </div>
                    @endif
                    @if($officiant->license_number)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #b5cdb1;">
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;">{{ $officiant->license_number }}</span>
                        <span style="font-size:11px;color:#6c7a72;">رقم الرخصة</span>
                    </div>
                    @endif
                    @if($officiant->city)
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
                        <span style="font-size:13px;font-weight:700;color:#0f3d24;">{{ $officiant->city }}</span>
                        <span style="font-size:11px;color:#6c7a72;">المدينة</span>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@include('partials.footer')

{{-- Cart Modal --}}
@auth
@php $firstSvc = $officiant->services->first(); @endphp
@if($firstSvc)
<div id="cart-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:20px;padding:28px;max-width:400px;width:92%;font-family:'Cairo',sans-serif;direction:rtl;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <h3 style="font-size:16px;font-weight:800;color:#0f3d24;"><i class="fa fa-cart-plus" style="margin-left:8px;color:#2d6a4f;"></i>أضف للسلة</h3>
            <button onclick="document.getElementById('cart-modal').style.display='none'"
                    style="background:none;border:none;font-size:22px;cursor:pointer;color:#9ca3af;line-height:1;">×</button>
        </div>
        <div style="background:#f0faf4;border-radius:12px;padding:12px 14px;margin-bottom:18px;font-size:13px;font-weight:800;color:#0f3d24;">
            {{ $officiant->user->name }} — {{ $firstSvc->title }}
        </div>
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="item_type" value="service">
            <input type="hidden" name="item_id" value="{{ $firstSvc->id }}">
            <div style="margin-bottom:20px;">
                <label style="font-size:12.5px;font-weight:700;color:#0f3d24;display:block;margin-bottom:7px;">
                    <i class="fa fa-calendar" style="margin-left:5px;color:#2d6a4f;"></i>تاريخ المناسبة
                </label>
                <input type="date" name="event_date" min="{{ date('Y-m-d') }}"
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
@endif
@endauth

</body>
</html>
