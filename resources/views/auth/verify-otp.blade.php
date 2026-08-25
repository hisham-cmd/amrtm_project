<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>التحقق من الهوية — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Cairo', sans-serif;
    background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 50%, #27a85a 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
  }

  .card {
    background: #fff;
    border-radius: 20px;
    padding: 44px 40px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);
    text-align: center;
  }

  .icon {
    width: 72px; height: 72px;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
    border: 2px solid #86efac;
    font-size: 2rem;
  }

  h1 { color: #0f3d24; font-size: 1.45rem; font-weight: 800; margin-bottom: 8px; }
  .subtitle { color: #6b7280; font-size: .88rem; line-height: 1.7; margin-bottom: 28px; }
  .subtitle strong { color: #0f3d24; }

  /* ── OTP inputs ── */
  .otp-row {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-bottom: 8px;
    direction: ltr;
  }

  .otp-box {
    width: 50px; height: 58px;
    border: 2px solid #d1fae5;
    border-radius: 12px;
    font-size: 1.5rem;
    font-weight: 800;
    color: #0f3d24;
    text-align: center;
    background: #f9fafb;
    transition: border-color .2s, box-shadow .2s;
    outline: none;
    caret-color: #1a5c38;
  }
  .otp-box:focus {
    border-color: #1a5c38;
    box-shadow: 0 0 0 3px rgba(26,92,56,.12);
    background: #fff;
  }
  .otp-box.filled { border-color: #27a85a; background: #f0fdf4; }

  /* hidden real input */
  #code-input { display: none; }

  .error-msg {
    color: #dc2626;
    font-size: .82rem;
    margin-bottom: 16px;
    background: #fef2f2;
    border: 1px solid #fca5a5;
    border-radius: 8px;
    padding: 8px 12px;
  }

  .alert-success {
    color: #065f46;
    font-size: .82rem;
    background: #d1fae5;
    border: 1px solid #6ee7b7;
    border-radius: 8px;
    padding: 8px 12px;
    margin-bottom: 16px;
  }
  .alert-error {
    color: #92400e;
    font-size: .82rem;
    background: #fffbeb;
    border: 1px solid #fcd34d;
    border-radius: 8px;
    padding: 8px 12px;
    margin-bottom: 16px;
  }

  .btn-verify {
    width: 100%;
    background: linear-gradient(135deg, #1a5c38, #27a85a);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 14px;
    font-family: 'Cairo', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 8px;
    transition: opacity .2s, transform .1s;
  }
  .btn-verify:hover { opacity: .92; }
  .btn-verify:active { transform: scale(.98); }
  .btn-verify:disabled { opacity: .5; cursor: default; }

  .timer-row {
    margin-top: 20px;
    font-size: .83rem;
    color: #6b7280;
  }
  #countdown { font-weight: 700; color: #1a5c38; }

  .resend-form { display: inline; }
  .btn-resend {
    background: none; border: none; cursor: pointer;
    color: #1a5c38; font-weight: 700; font-family: 'Cairo', sans-serif;
    font-size: .83rem; padding: 0; text-decoration: underline;
  }
  .btn-resend:disabled { color: #9ca3af; cursor: default; text-decoration: none; }

  .back-link {
    display: block;
    margin-top: 20px;
    color: #9ca3af;
    font-size: .8rem;
    text-decoration: none;
  }
  .back-link:hover { color: #6b7280; }
</style>
</head>
<body>

<div class="card">
  <div class="icon">🔐</div>
  <h1>التحقق من هويتك</h1>
  <p class="subtitle">
    تم إرسال كود مكوّن من <strong>6 أرقام</strong> إلى بريدك الإلكتروني.<br>
    أدخله أدناه للمتابعة.
  </p>

  {{-- رسائل الحالة --}}
  @if(session('resend_success'))
    <div class="alert-success">✅ {{ session('resend_success') }}</div>
  @endif
  @if(session('resend_error'))
    <div class="alert-error">⚠️ {{ session('resend_error') }}</div>
  @endif
  @error('code')
    <div class="error-msg">{{ $message }}</div>
  @enderror

  {{-- OTP Form --}}
  <form method="POST" action="{{ route('otp.verify') }}" id="otp-form">
    @csrf

    <div class="otp-row" id="otp-row">
      @for($i = 0; $i < 6; $i++)
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" data-index="{{ $i }}" autocomplete="off">
      @endfor
    </div>

    {{-- hidden input يُرسَل للسيرفر --}}
    <input type="hidden" name="code" id="code-input">

    <button type="submit" class="btn-verify" id="btn-verify" disabled>
      تحقق والمتابعة
    </button>
  </form>

  {{-- Resend --}}
  <div class="timer-row">
    إعادة الإرسال بعد <span id="countdown">02:00</span> &nbsp;|&nbsp;
    <form class="resend-form" method="POST" action="{{ route('otp.resend') }}">
      @csrf
      <button type="submit" class="btn-resend" id="btn-resend" disabled>
        إرسال كود جديد
      </button>
    </form>
  </div>

  <a href="{{ route('login') }}" class="back-link">← العودة لصفحة الدخول</a>
</div>

<script>
(function () {
  const boxes     = document.querySelectorAll('.otp-box');
  const hidden    = document.getElementById('code-input');
  const btnVerify = document.getElementById('btn-verify');
  const btnResend = document.getElementById('btn-resend');
  const cdEl      = document.getElementById('countdown');

  // ── OTP boxes logic ────────────────────────────────────────────────
  boxes.forEach((box, i) => {
    box.addEventListener('input', () => {
      box.value = box.value.replace(/\D/g, '').slice(-1);
      box.classList.toggle('filled', box.value !== '');
      if (box.value && i < boxes.length - 1) boxes[i + 1].focus();
      syncHidden();
    });

    box.addEventListener('keydown', e => {
      if (e.key === 'Backspace' && !box.value && i > 0) boxes[i - 1].focus();
    });

    box.addEventListener('paste', e => {
      e.preventDefault();
      const pasted = (e.clipboardData || window.clipboardData)
        .getData('text').replace(/\D/g, '').slice(0, 6);
      pasted.split('').forEach((ch, j) => {
        if (boxes[j]) { boxes[j].value = ch; boxes[j].classList.add('filled'); }
      });
      if (boxes[Math.min(pasted.length, boxes.length - 1)]) {
        boxes[Math.min(pasted.length, boxes.length - 1)].focus();
      }
      syncHidden();
    });
  });

  function syncHidden() {
    const val = [...boxes].map(b => b.value).join('');
    hidden.value = val;
    btnVerify.disabled = val.length < 6;
  }

  boxes[0]?.focus();

  // ── Countdown ─────────────────────────────────────────────────────
  let secs = 120;

  function tick() {
    const m = String(Math.floor(secs / 60)).padStart(2, '0');
    const s = String(secs % 60).padStart(2, '0');
    cdEl.textContent = `${m}:${s}`;
    if (secs <= 0) {
      btnResend.disabled = false;
      cdEl.textContent = '00:00';
      return;
    }
    secs--;
    setTimeout(tick, 1000);
  }
  tick();
})();
</script>

</body>
</html>
