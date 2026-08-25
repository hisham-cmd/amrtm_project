<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول — أمر تم</title>
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

        /* ---- AUTH CARD ---- */
        .auth-card {
            position: relative; z-index: 10;
            display: flex; width: 100%; max-width: 900px;
            border-radius: 28px; overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            border: 1.5px solid rgba(56,189,248,0.2);
        }

        /* ---- BRAND PANEL (right) ---- */
        .brand-panel {
            flex: 1; min-width: 260px;
            background: linear-gradient(160deg, rgba(14,165,233,0.15) 0%, rgba(124,58,237,0.15) 100%),
                        rgba(13,36,72,0.92);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 52px 36px; position: relative; overflow: hidden;
        }
        .brand-panel::before {
            content: '';
            position: absolute; top: -100px; right: -100px;
            width: 350px; height: 350px; border-radius: 50%;
            background: rgba(56,189,248,0.06); pointer-events: none;
        }
        .brand-panel::after {
            content: '';
            position: absolute; bottom: -80px; left: -80px;
            width: 250px; height: 250px; border-radius: 50%;
            background: rgba(124,58,237,0.08); pointer-events: none;
        }
        .brand-logo-wrap {
            position: relative; z-index: 1;
            width: 110px; height: 110px; border-radius: 50%;
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(56,189,248,0.3);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 28px; backdrop-filter: blur(8px);
        }
        .brand-logo-wrap img { width: 80px; height: 80px; object-fit: contain; }
        .brand-panel h2 {
            position: relative; z-index: 1;
            color: #fff; font-size: 26px; font-weight: 800;
            text-align: center; line-height: 1.4; margin-bottom: 10px;
        }
        .brand-panel h2 span {
            background: linear-gradient(135deg, #38bdf8, #a78bfa);
            -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-panel p {
            position: relative; z-index: 1;
            color: rgba(255,255,255,0.6); font-size: 13px;
            text-align: center; line-height: 1.8; max-width: 220px;
        }
        .brand-badge {
            position: relative; z-index: 1;
            margin-top: 32px;
            background: rgba(56,189,248,0.12);
            border: 1px solid rgba(56,189,248,0.3);
            color: #38bdf8; font-size: 12px; font-weight: 700;
            padding: 7px 20px; border-radius: 30px;
            display: flex; align-items: center; gap: 7px;
        }
        .brand-features {
            position: relative; z-index: 1;
            margin-top: 24px; display: flex; flex-direction: column; gap: 10px;
            width: 100%;
        }
        .brand-feat {
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; color: rgba(255,255,255,0.65);
        }
        .brand-feat i { color: #38bdf8; width: 16px; text-align: center; }

        /* ---- FORM PANEL (left) ---- */
        .form-panel {
            width: 420px; flex-shrink: 0;
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            border-right: 1.5px solid rgba(56,189,248,0.15);
            display: flex; flex-direction: column;
            padding: 48px 40px;
        }

        /* Auth tabs */
        .auth-tabs {
            display: flex; border-radius: 50px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 4px; margin-bottom: 32px; gap: 4px;
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

        .form-title { font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 6px; }
        .form-subtitle { font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 26px; }

        /* Alerts */
        .alert {
            padding: 12px 14px; border-radius: 12px; font-size: 13px; font-weight: 600;
            margin-bottom: 18px; display: flex; align-items: center; gap: 9px;
        }
        .alert-danger  { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .alert-success { background: rgba(74,222,128,0.12); color: #86efac; border: 1px solid rgba(74,222,128,0.25); }

        /* Form groups */
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.75); margin-bottom: 7px; }
        .input-wrap { position: relative; }
        .input-wrap > i {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); color: rgba(255,255,255,0.35);
            font-size: 14px; pointer-events: none;
        }
        .form-control {
            width: 100%; padding: 12px 42px 12px 14px;
            background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            font-family: 'Cairo', sans-serif; font-size: 14px;
            color: #fff; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.3); }
        .form-control:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56,189,248,0.12);
        }
        .form-control.is-invalid { border-color: #f87171; }
        .invalid-feedback {
            color: #fca5a5; font-size: 12px; margin-top: 5px;
            display: flex; align-items: center; gap: 5px;
        }

        /* Password toggle */
        .toggle-pw {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%); background: none; border: none;
            cursor: pointer; color: rgba(255,255,255,0.35); font-size: 14px;
            padding: 2px; transition: color 0.2s;
        }
        .toggle-pw:hover { color: #38bdf8; }

        /* Remember row */
        .pw-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 22px;
        }
        .remember-label {
            display: flex; align-items: center; gap: 6px;
            font-size: 12.5px; color: rgba(255,255,255,0.55);
            cursor: pointer; user-select: none;
        }
        .remember-label input[type="checkbox"] {
            accent-color: #38bdf8; width: 15px; height: 15px; cursor: pointer;
        }
        .forgot-link {
            font-size: 12.5px; color: #38bdf8; font-weight: 700; text-decoration: none;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* Submit */
        .btn-submit {
            width: 100%; padding: 14px; border: none; border-radius: 14px;
            background: linear-gradient(135deg, #0ea5e9, #7c3aed);
            color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 15px; font-weight: 800; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 8px 24px rgba(14,165,233,0.3);
        }
        .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }

        /* Divider */
        .divider {
            text-align: center; position: relative;
            margin: 20px 0; color: rgba(255,255,255,0.3);
            font-size: 12px; font-weight: 600;
        }
        .divider::before, .divider::after {
            content: ''; position: absolute; top: 50%;
            width: 40%; height: 1px; background: rgba(255,255,255,0.1);
        }
        .divider::before { right: 0; }
        .divider::after  { left: 0; }

        /* Footer */
        .form-footer {
            text-align: center; margin-top: 18px;
            font-size: 13px; color: rgba(255,255,255,0.45);
        }
        .form-footer a { color: #38bdf8; font-weight: 700; text-decoration: none; }
        .form-footer a:hover { text-decoration: underline; }

        /* Back link */
        .back-home {
            position: fixed; top: 20px; right: 24px; z-index: 100;
            display: flex; align-items: center; gap: 7px;
            color: rgba(255,255,255,0.6); font-size: 13px; font-weight: 700;
            text-decoration: none; transition: color 0.2s;
            font-family: 'Cairo', sans-serif;
        }
        .back-home:hover { color: #38bdf8; }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 720px) {
            .auth-card { flex-direction: column-reverse; }
            .brand-panel {
                padding: 28px 24px; flex-direction: row;
                justify-content: center; gap: 16px; min-width: 0;
            }
            .brand-logo-wrap { width: 64px; height: 64px; margin-bottom: 0; }
            .brand-logo-wrap img { width: 46px; height: 46px; }
            .brand-panel h2 { font-size: 18px; margin-bottom: 0; }
            .brand-panel p, .brand-badge, .brand-features { display: none; }
            .brand-panel::before, .brand-panel::after { display: none; }
            .form-panel { width: 100%; padding: 32px 24px; border-right: none; border-bottom: 1.5px solid rgba(56,189,248,0.15); }
        }
        @media (max-width: 400px) {
            .form-panel { padding: 28px 18px; }
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
            <a href="{{ route('login') }}" class="auth-tab active">تسجيل الدخول</a>
            <a href="{{ route('register') }}" class="auth-tab">حساب جديد</a>
        </div>

        <h1 class="form-title">مرحباً بعودتك</h1>
        <p class="form-subtitle">أدخل بياناتك للوصول إلى حسابك</p>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">البريد الإلكتروني</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="example@email.com"
                           required autofocus autocomplete="email">
                </div>
                @error('email')
                    <div class="invalid-feedback"><i class="fa fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">كلمة المرور</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••" required autocomplete="current-password">
                    <button type="button" class="toggle-pw" onclick="togglePw()">
                        <i id="pw-icon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback"><i class="fa fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="pw-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    تذكرني
                </label>
                <a href="#" class="forgot-link">نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-right-to-bracket"></i>
                تسجيل الدخول
            </button>
        </form>

        <div class="divider">أو</div>

        <div class="form-footer">
            ليس لديك حساب؟
            <a href="{{ route('register') }}">إنشاء حساب جديد</a>
        </div>
    </div>

    <!-- BRAND PANEL -->
    <div class="brand-panel">
        <div class="brand-logo-wrap">
            <img src="/images/new-logo1.png" alt="أمر تم">
        </div>
        <h2>أهلاً بك في<br><span>أمر تم</span></h2>
        <p>منصة متكاملة لإدارة الطلبات والخدمات في المملكة</p>
        <div class="brand-badge">
            <i class="fa fa-shield-halved"></i>
            دخول آمن وموثوق
        </div>
        <div class="brand-features">
            <div class="brand-feat"><i class="fa fa-check-circle"></i> احجز قاعات المناسبات بسهولة</div>
            <div class="brand-feat"><i class="fa fa-check-circle"></i> تواصل مع مستشارين معتمدين</div>
            <div class="brand-feat"><i class="fa fa-check-circle"></i> استكشف فرص الوكالات والامتياز</div>
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

function togglePw() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('pw-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

</body>
</html>
