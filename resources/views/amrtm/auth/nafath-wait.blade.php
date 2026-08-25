@php
    $authType = old('_auth_type', request()->query('type', 'client'));
    $authMode = old('_auth_mode', request()->query('mode', 'login'));
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدخول — آمر تم للأعمال</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            padding: 24px 20px;
        }

        .auth-card {
            position: relative; z-index: 10;
            display: flex; width: 100%; max-width: 980px;
            border-radius: 28px; overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.55);
            border: 1.5px solid rgba(56,189,248,0.18);
        }

        /* ---- BRAND PANEL ---- */
        .brand-panel {
            width: 280px; flex-shrink: 0;
            background: linear-gradient(160deg, rgba(14,165,233,0.18) 0%, rgba(59,130,246,0.18) 100%),
                        rgba(10,25,55,0.95);
            backdrop-filter: blur(20px);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 48px 32px; position: relative; overflow: hidden;
        }
        .brand-panel::before {
            content: ''; position: absolute; top: -100px; right: -100px;
            width: 320px; height: 320px; border-radius: 50%;
            background: rgba(56,189,248,0.07); pointer-events: none;
        }
        .brand-panel::after {
            content: ''; position: absolute; bottom: -80px; left: -80px;
            width: 240px; height: 240px; border-radius: 50%;
            background: rgba(59,130,246,0.08); pointer-events: none;
        }
        .brand-logo-wrap {
            position: relative; z-index: 1;
            width: 100px; height: 100px; border-radius: 50%;
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(56,189,248,0.3);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 22px; backdrop-filter: blur(8px);
        }
        .brand-logo-wrap img { width: 72px; height: 72px; object-fit: contain; }
        .brand-panel h2 {
            position: relative; z-index: 1;
            color: #fff; font-size: 22px; font-weight: 800;
            text-align: center; line-height: 1.4; margin-bottom: 8px;
        }
        .brand-panel h2 span {
            background: linear-gradient(135deg, #38bdf8, #60a5fa);
            -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand-panel p {
            position: relative; z-index: 1;
            color: rgba(255,255,255,0.5); font-size: 13px;
            text-align: center; line-height: 1.8; max-width: 200px;
        }
        .brand-badge {
            position: relative; z-index: 1; margin-top: 22px;
            background: rgba(56,189,248,0.12); border: 1px solid rgba(56,189,248,0.3);
            color: #38bdf8; font-size: 12px; font-weight: 700;
            padding: 6px 18px; border-radius: 30px;
            display: flex; align-items: center; gap: 7px;
        }
        .brand-features { position: relative; z-index: 1; margin-top: 20px; display: flex; flex-direction: column; gap: 10px; width: 100%; }
        .brand-feat { display: flex; align-items: center; gap: 10px; font-size: 13px; color: rgba(255,255,255,0.6); }
        .brand-feat i { color: #38bdf8; width: 16px; text-align: center; flex-shrink: 0; }

        /* ---- FORM PANEL ---- */
        .form-panel {
            flex: 1; min-width: 0;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(24px);
            border-right: 1.5px solid rgba(56,189,248,0.12);
            display: flex; flex-direction: column;
            padding: 36px 38px;
            overflow-y: auto; max-height: 95vh;
        }

        /* ---- TYPE SELECTOR ---- */
        .type-sel {
            display: grid; grid-template-columns: 1fr 1fr; gap: 10px;
            margin-bottom: 22px;
        }
        .type-card {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 16px; border-radius: 14px; cursor: pointer;
            border: 1.5px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            transition: all 0.22s; user-select: none;
        }
        .type-card:hover { border-color: rgba(56,189,248,0.35); background: rgba(56,189,248,0.07); }
        .type-card.active {
            border-color: #38bdf8;
            background: rgba(56,189,248,0.12);
            box-shadow: 0 0 0 2px rgba(56,189,248,0.2);
        }
        .type-card-icon {
            width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
            background: rgba(255,255,255,0.07);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: rgba(255,255,255,0.5);
            transition: all 0.22s;
        }
        .type-card.active .type-card-icon { background: rgba(56,189,248,0.2); color: #38bdf8; }
        .type-card-text strong {
            display: block; font-size: 14px; font-weight: 700; color: rgba(255,255,255,0.85);
        }
        .type-card-text small { font-size: 11.5px; color: rgba(255,255,255,0.4); }
        .type-card.active .type-card-text strong { color: #fff; }
        .type-card.active .type-card-text small  { color: rgba(56,189,248,0.8); }

        /* ---- MODE TABS ---- */
        .auth-tabs {
            display: flex; border-radius: 50px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 4px; margin-bottom: 24px; gap: 4px;
        }
        .auth-tab {
            flex: 1; text-align: center; padding: 9px 10px;
            border-radius: 50px; font-size: 14px; font-weight: 700;
            cursor: pointer; border: none; background: none;
            color: rgba(255,255,255,0.5); transition: all 0.25s;
            font-family: 'Cairo', sans-serif;
        }
        .auth-tab.active {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: #fff; box-shadow: 0 4px 14px rgba(14,165,233,0.3);
        }
        .auth-tab:not(.active):hover { color: #fff; background: rgba(255,255,255,0.08); }

        .form-title { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 4px; min-height: 28px; }
        .form-subtitle { font-size: 13px; color: rgba(255,255,255,0.45); margin-bottom: 20px; min-height: 20px; }

        /* ---- ALERTS ---- */
        .alert {
            padding: 12px 14px; border-radius: 12px; font-size: 13px; font-weight: 600;
            margin-bottom: 16px; display: flex; align-items: center; gap: 9px;
        }
        .alert-danger  { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .alert-success { background: rgba(74,222,128,0.12); color: #86efac; border: 1px solid rgba(74,222,128,0.25); }

        /* ---- FORM FIELDS ---- */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .form-group { margin-bottom: 14px; }
        .form-label { display: block; font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap > .fi {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); color: rgba(255,255,255,0.3);
            font-size: 14px; pointer-events: none;
        }
        .form-control {
            width: 100%; padding: 11px 42px 11px 14px;
            background: rgba(255,255,255,0.06);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            font-family: 'Cairo', sans-serif; font-size: 14px;
            color: #fff; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }
        .form-control::placeholder { color: rgba(255,255,255,0.25); }
        .form-control:focus { border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56,189,248,0.12); }
        .form-control.is-invalid { border-color: #f87171; }
        .form-control option { background: #1a3460; color: #fff; }
        .invalid-feedback { color: #fca5a5; font-size: 12px; margin-top: 5px; display: flex; align-items: center; gap: 5px; }
        .form-control.no-icon { padding-right: 14px; }

        .toggle-pw {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%); background: none; border: none;
            cursor: pointer; color: rgba(255,255,255,0.3); font-size: 14px;
            padding: 2px; transition: color 0.2s;
        }
        .toggle-pw:hover { color: #38bdf8; }

        .pw-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 18px;
        }
        .remember-label {
            display: flex; align-items: center; gap: 6px;
            font-size: 12.5px; color: rgba(255,255,255,0.5);
            cursor: pointer; user-select: none;
        }
        .remember-label input[type="checkbox"] { accent-color: #38bdf8; width: 15px; height: 15px; }

        .btn-submit {
            width: 100%; padding: 13px; border: none; border-radius: 14px;
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 15px; font-weight: 800; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 8px 24px rgba(14,165,233,0.3);
            margin-top: 4px;
        }
        .btn-submit:hover { opacity: 0.88; transform: translateY(-1px); }

        .sec-note {
            display: flex; align-items: center; gap: 7px; justify-content: center;
            font-size: 11.5px; color: rgba(255,255,255,0.3); margin-top: 10px;
        }
        .sec-note i { color: rgba(56,189,248,0.6); }

        .form-section-title {
            font-size: 12px; font-weight: 700; color: rgba(56,189,248,0.8);
            text-transform: uppercase; letter-spacing: 0.5px;
            margin: 16px 0 10px; padding-bottom: 6px;
            border-bottom: 1px solid rgba(56,189,248,0.15);
        }

        .back-home {
            position: fixed; top: 20px; right: 24px; z-index: 100;
            display: flex; align-items: center; gap: 7px;
            color: rgba(255,255,255,0.5); font-size: 13px; font-weight: 700;
            text-decoration: none; transition: color 0.2s;
            font-family: 'Cairo', sans-serif;
        }
        .back-home:hover { color: #38bdf8; }

        @media (max-width: 820px) {
            .auth-card { flex-direction: column-reverse; }
            .brand-panel {
                width: 100%; padding: 24px 20px; flex-direction: row;
                justify-content: center; gap: 16px; min-width: 0;
            }
            .brand-logo-wrap { width: 60px; height: 60px; margin-bottom: 0; }
            .brand-logo-wrap img { width: 42px; height: 42px; }
            .brand-panel h2 { font-size: 17px; margin-bottom: 0; }
            .brand-panel p, .brand-badge, .brand-features,
            .brand-panel::before, .brand-panel::after { display: none; }
            .form-panel {
                max-height: none; border-right: none;
                border-bottom: 1.5px solid rgba(56,189,248,0.12);
                padding: 28px 20px;
            }
            .form-row { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .type-card-text strong { font-size: 13px; }
            .form-panel { padding: 24px 16px; }
        }




.nf-icon{

    width:90px;
    height:90px;

    border-radius:50%;

    background:#eef8f2;

    display:flex;

    align-items:center;

    justify-content:center;
}

.nf-icon i{

    font-size:42px;

    color:#1b8354;

}

.verify-number{

    font-size:56px;

    font-weight:800;

    color:#1b8354;

    letter-spacing:8px;

    margin:30px 0;

}

    </style>
</head>
<body>

<a href="{{ route('amrtm.index') }}" class="back-home">
    <i class="fa fa-arrow-right"></i>
    العودة للمنصة
</a>

<div>


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card border-0 shadow rounded-4">

                <div class="card-body p-5 text-center">

                    <div class="mb-4">

                        <div class="nf-icon mx-auto">

                            <i class="ti ti-device-mobile"></i>

                        </div>

                    </div>

                    <h3 class="fw-bold mb-3">

                        تم إرسال طلب التحقق

                    </h3>

                    <p class="text-muted">

                        الرجاء فتح تطبيق <strong>نفاذ</strong> على جوالك ثم مطابقة رمز التحقق التالي.

                    </p>

                    <div class="verify-number">

                        {{ $nafath['verification'] }}

                    </div>

                    <div class="badge bg-warning text-dark px-3 py-2">

                        بانتظار الموافقة...

                    </div>

                    <hr class="my-4">

                    {{-- أزرار المحاكاة (سنحذفها لاحقاً) --}}

                    <div class="d-grid gap-3">

                        <a href="{{ route('amrtm.nafath.callback',['status'=>'approved']) }}"
                           class="btn btn-success">

                            ✅ تمت الموافقة

                        </a>

                        <a href="{{ route('amrtm.nafath.callback',['status'=>'rejected']) }}"
                           class="btn btn-danger">

                            ❌ تم الرفض

                        </a>

                        <a href="{{ route('amrtm.nafath.callback',['status'=>'expired']) }}"
                           class="btn btn-secondary">

                            ⏰ انتهت المهلة

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



</div>
</body>
</html>