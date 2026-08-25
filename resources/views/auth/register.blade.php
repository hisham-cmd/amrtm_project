<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background: linear-gradient(160deg, #0d2448 0%, #1a3a6e 50%, #0d2448 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }

        canvas#bg-canvas {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0; pointer-events: none; opacity: 0.55;
        }

        /* ---- CARD ---- */
        .auth-card {
            position: relative; z-index: 10;
            display: flex; width: 100%; max-width: 960px;
            border-radius: 28px; overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            border: 1.5px solid rgba(56,189,248,0.2);
        }

        /* ---- BRAND PANEL ---- */
        .brand-panel {
            width: 300px; flex-shrink: 0;
            background: linear-gradient(160deg, rgba(14,165,233,0.15) 0%, rgba(124,58,237,0.15) 100%),
                        rgba(13,36,72,0.92);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 52px 32px; position: relative; overflow: hidden;
        }
        .brand-panel::before {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(56,189,248,0.06);
        }
        .brand-panel::after {
            content: ''; position: absolute; bottom: -60px; left: -60px;
            width: 220px; height: 220px; border-radius: 50%;
            background: rgba(124,58,237,0.08);
        }
        .brand-logo-wrap {
            position: relative; z-index: 1;
            width: 100px; height: 100px; border-radius: 50%;
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(56,189,248,0.3);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 24px;
        }
        .brand-logo-wrap img { width: 72px; height: 72px; object-fit: contain; }
        .brand-panel h2 {
            position: relative; z-index: 1;
            color: #fff; font-size: 24px; font-weight: 800;
            text-align: center; line-height: 1.4; margin-bottom: 10px;
        }
        .brand-panel h2 span {
            background: linear-gradient(135deg, #38bdf8, #a78bfa);
            -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-panel p {
            position: relative; z-index: 1;
            color: rgba(255,255,255,0.55); font-size: 12.5px;
            text-align: center; line-height: 1.8; max-width: 200px;
        }
        .brand-steps {
            position: relative; z-index: 1;
            margin-top: 28px; display: flex; flex-direction: column; gap: 14px;
            width: 100%;
        }
        .brand-step {
            display: flex; align-items: flex-start; gap: 10px;
        }
        .step-num {
            width: 26px; height: 26px; border-radius: 50%; flex-shrink: 0;
            background: linear-gradient(135deg, #0ea5e9, #7c3aed);
            color: #fff; font-size: 12px; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-step span { font-size: 12.5px; color: rgba(255,255,255,0.65); line-height: 1.5; padding-top: 3px; }

        /* ---- FORM PANEL ---- */
        .form-panel {
            flex: 1;
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border-right: 1.5px solid rgba(56,189,248,0.15);
            display: flex; flex-direction: column;
            padding: 40px 44px;
            overflow-y: auto; max-height: 100vh;
        }

        /* Auth tabs */
        .auth-tabs {
            display: flex; border-radius: 50px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 4px; margin-bottom: 28px; gap: 4px;
        }
        .auth-tab {
            flex: 1; text-align: center; padding: 9px 10px;
            border-radius: 50px; font-size: 14px; font-weight: 700;
            cursor: pointer; text-decoration: none;
            color: rgba(255,255,255,0.55); transition: all 0.25s;
        }
        .auth-tab.active {
            background: linear-gradient(135deg, #0ea5e9, #7c3aed);
            color: #fff; box-shadow: 0 4px 14px rgba(14,165,233,0.3);
        }
        .auth-tab:not(.active):hover { color: #fff; background: rgba(255,255,255,0.08); }

        .form-title { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 4px; }
        .form-subtitle { font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 22px; }

        /* Role toggle */
        .role-toggle {
            display: flex; gap: 10px; margin-bottom: 22px;
        }
        .role-btn {
            flex: 1; padding: 12px 10px; border-radius: 14px;
            background: rgba(255,255,255,0.06);
            border: 1.5px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.5); font-family: 'Cairo', sans-serif;
            font-size: 13px; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.25s; text-decoration: none;
        }
        .role-btn.active, .role-btn:hover {
            background: linear-gradient(135deg, rgba(14,165,233,0.2), rgba(124,58,237,0.2));
            border-color: rgba(56,189,248,0.4); color: #fff;
        }
        .role-btn.active { border-color: #38bdf8; box-shadow: 0 0 0 2px rgba(56,189,248,0.15); }

        /* Info notice */
        .info-notice {
            background: rgba(56,189,248,0.08);
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 12px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 12.5px; color: rgba(255,255,255,0.6);
            display: flex; align-items: flex-start; gap: 10px;
        }
        .info-notice i { color: #38bdf8; margin-top: 2px; flex-shrink: 0; }

        /* Form elements */
        .form-group { margin-bottom: 14px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 700; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap > i {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); color: rgba(255,255,255,0.3);
            font-size: 13px; pointer-events: none;
        }
        .form-control {
            width: 100%; padding: 11px 40px 11px 14px;
            background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            font-family: 'Cairo', sans-serif; font-size: 14px;
            color: #fff; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-control:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56,189,248,0.1);
        }
        .form-control.is-invalid { border-color: #f87171; }
        .invalid-feedback {
            color: #fca5a5; font-size: 12px; margin-top: 4px;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        /* Alert */
        .alert {
            padding: 12px 14px; border-radius: 12px; font-size: 13px; font-weight: 600;
            margin-bottom: 18px; display: flex; align-items: flex-start; gap: 9px;
        }
        .alert-danger { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }

        /* Submit */
        .btn-submit {
            width: 100%; padding: 13px; border: none; border-radius: 14px;
            background: linear-gradient(135deg, #0ea5e9, #7c3aed);
            color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 15px; font-weight: 800; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 8px 24px rgba(14,165,233,0.3); margin-top: 6px;
        }
        .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }

        /* Terms */
        .terms-label {
            display: flex; align-items: flex-start; gap: 10px;
            cursor: pointer; user-select: none; margin-top: 4px;
        }
        .terms-label input[type="checkbox"] { accent-color: #38bdf8; width: 15px; height: 15px; flex-shrink: 0; margin-top: 3px; }
        .terms-label span { font-size: 12px; color: rgba(255,255,255,0.5); line-height: 1.6; }
        .terms-label a { color: #38bdf8; font-weight: 700; text-decoration: none; }

        /* Divider */
        .divider {
            text-align: center; position: relative;
            margin: 18px 0; color: rgba(255,255,255,0.3); font-size: 12px; font-weight: 600;
        }
        .divider::before, .divider::after {
            content: ''; position: absolute; top: 50%;
            width: 40%; height: 1px; background: rgba(255,255,255,0.1);
        }
        .divider::before { right: 0; }
        .divider::after  { left: 0; }

        .form-footer { text-align: center; margin-top: 14px; font-size: 13px; color: rgba(255,255,255,0.45); }
        .form-footer a { color: #38bdf8; font-weight: 700; text-decoration: none; }

        /* Back link */
        .back-home {
            position: fixed; top: 20px; right: 24px; z-index: 100;
            display: flex; align-items: center; gap: 7px;
            color: rgba(255,255,255,0.6); font-size: 13px; font-weight: 700;
            text-decoration: none; transition: color 0.2s; font-family: 'Cairo', sans-serif;
        }
        .back-home:hover { color: #38bdf8; }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 800px) {
            .auth-card { flex-direction: column-reverse; }
            .brand-panel {
                width: 100%; padding: 24px;
                flex-direction: row; gap: 16px; justify-content: center;
            }
            .brand-logo-wrap { width: 60px; height: 60px; margin-bottom: 0; }
            .brand-logo-wrap img { width: 44px; height: 44px; }
            .brand-panel h2 { font-size: 18px; margin-bottom: 0; }
            .brand-panel p, .brand-steps, .brand-panel::before, .brand-panel::after { display: none; }
            .form-panel { max-height: none; border-right: none; border-bottom: 1.5px solid rgba(56,189,248,0.15); }
        }
        @media (max-width: 500px) {
            .form-panel { padding: 28px 18px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<canvas id="bg-canvas"></canvas>

<a href="/" class="back-home">
    <i class="fa fa-arrow-right"></i>
    العودة للرئيسية
</a>

<div class="auth-card">

    <!-- FORM PANEL -->
    <div class="form-panel">
        <div class="auth-tabs">
            <a href="{{ route('login') }}" class="auth-tab">تسجيل الدخول</a>
            <a href="{{ route('register') }}" class="auth-tab active">حساب جديد</a>
        </div>

        <h1 class="form-title">إنشاء حساب جديد</h1>
        <p class="form-subtitle">انضم إلى آلاف المستخدمين على منصة أمر تم</p>

        <!-- Role toggle -->
        <div class="role-toggle">
            <button type="button" class="role-btn active" id="btn-user">
                <i class="fas fa-user"></i>
                عميل
            </button>
            <a href="{{ route('register.owner') }}" class="role-btn" style="color:rgba(255,255,255,0.5);">
                <i class="fas fa-building"></i>
                مقدم خدمة
            </a>
        </div>

        <div class="info-notice">
            <i class="fas fa-info-circle"></i>
            <span>إذا كنت مقدم خدمة قاعة أفراح أو استراحة أو شاليه، اضغط على <strong style="color:#38bdf8;">مقدم خدمة</strong> أعلاه لتسجيل منشأتك.</span>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle" style="flex-shrink:0; margin-top:2px;"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'user') }}">

            <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
                <div class="form-group">
                    <label class="form-label" for="first_name">الاسم</label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" id="first_name" name="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               value="{{ old('first_name') }}" placeholder="محمد" required autofocus>
                    </div>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="father_name">اسم الأب</label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" id="father_name" name="father_name"
                               class="form-control @error('father_name') is-invalid @enderror"
                               value="{{ old('father_name') }}" placeholder="عبدالله" required>
                    </div>
                    @error('father_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="grandfather_name">اسم الجد</label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" id="grandfather_name" name="grandfather_name"
                               class="form-control @error('grandfather_name') is-invalid @enderror"
                               value="{{ old('grandfather_name') }}" placeholder="الأحمد" required>
                    </div>
                    @error('grandfather_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="email">البريد الإلكتروني</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="example@email.com" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">رقم الجوال</label>
                    <div class="input-wrap">
                        <i class="fas fa-mobile-alt"></i>
                        <input type="tel" id="phone" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" placeholder="05xxxxxxxx" required>
                    </div>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="country">الدولة</label>
                <div class="input-wrap">
                    <i class="fas fa-globe"></i>
                    <select id="country" name="country"
                            class="form-control @error('country') is-invalid @enderror"
                            style="font-family:'Cairo',sans-serif;">
                        <option value="">-- اختر دولتك --</option>
                        <option value="المملكة العربية السعودية" {{ old('country') == 'المملكة العربية السعودية' ? 'selected' : '' }}>المملكة العربية السعودية</option>
                        <option value="الإمارات العربية المتحدة" {{ old('country') == 'الإمارات العربية المتحدة' ? 'selected' : '' }}>الإمارات العربية المتحدة</option>
                        <option value="الكويت" {{ old('country') == 'الكويت' ? 'selected' : '' }}>الكويت</option>
                        <option value="البحرين" {{ old('country') == 'البحرين' ? 'selected' : '' }}>البحرين</option>
                        <option value="قطر" {{ old('country') == 'قطر' ? 'selected' : '' }}>قطر</option>
                        <option value="عُمان" {{ old('country') == 'عُمان' ? 'selected' : '' }}>عُمان</option>
                        <option value="الأردن" {{ old('country') == 'الأردن' ? 'selected' : '' }}>الأردن</option>
                        <option value="مصر" {{ old('country') == 'مصر' ? 'selected' : '' }}>مصر</option>
                        <option value="أخرى" {{ old('country') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                    </select>
                </div>
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="password">كلمة المرور</label>                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="terms-label">
                    <input type="checkbox" name="terms_agreed" id="terms_agreed" value="1"
                           {{ old('terms_agreed') ? 'checked' : '' }} required>
                    <span>
                        أوافق على
                        <a href="{{ route('privacy') }}" target="_blank">سياسة الخصوصية وشروط الاستخدام</a>
                        الخاصة بمنصة أمر تم.
                    </span>
                </label>
                @error('terms_agreed')
                    <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i>
                إنشاء الحساب
            </button>
        </form>

        <div class="divider">أو</div>

        <div class="form-footer">
            لديك حساب بالفعل؟
            <a href="{{ route('login') }}">تسجيل الدخول</a>
        </div>
    </div>

    <!-- BRAND PANEL -->
    <div class="brand-panel">
        <div class="brand-logo-wrap">
            <img src="/images/new-logo1.png" alt="أمر تم">
        </div>
        <h2>انضم إلى<br><span>أمر تم</span></h2>
        <p>منصة متكاملة لإدارة الطلبات والخدمات في المملكة</p>
        <div class="brand-steps">
            <div class="brand-step">
                <div class="step-num">1</div>
                <span>أنشئ حسابك في دقيقة واحدة</span>
            </div>
            <div class="brand-step">
                <div class="step-num">2</div>
                <span>تصفح الخدمات والشركاء المعتمدين</span>
            </div>
            <div class="brand-step">
                <div class="step-num">3</div>
                <span>احجز وأدر طلباتك بكل سهولة</span>
            </div>
        </div>
    </div>

</div>

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
    const COUNT = 80, geo = new THREE.BufferGeometry();
    const pos = new Float32Array(COUNT * 3), vel = [];
    for (let i = 0; i < COUNT; i++) {
        pos[i*3]=(Math.random()-.5)*28; pos[i*3+1]=(Math.random()-.5)*28; pos[i*3+2]=(Math.random()-.5)*4;
        vel.push({ x:(Math.random()-.5)*0.01, y:(Math.random()-.5)*0.01 });
    }
    geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
    scene.add(new THREE.Points(geo, new THREE.PointsMaterial({ color:0x38bdf8, size:0.09, transparent:true, opacity:0.45 })));
    const MAX_L=200, lPos=new Float32Array(MAX_L*6), lGeo=new THREE.BufferGeometry();
    lGeo.setAttribute('position', new THREE.BufferAttribute(lPos, 3)); lGeo.setDrawRange(0,0);
    scene.add(new THREE.LineSegments(lGeo, new THREE.LineBasicMaterial({ color:0x7dd3fc, transparent:true, opacity:0.1 })));
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
</script>

</body>
</html>
