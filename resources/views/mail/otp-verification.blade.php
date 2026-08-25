<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>كود التحقق</title>
<style>
  body { margin:0; padding:0; background:#f4f6f8; font-family:'Segoe UI',Tahoma,Arial,sans-serif; direction:rtl; }
  .wrapper { max-width:520px; margin:32px auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }
  .header  { background:linear-gradient(135deg,#1a5c38 0%,#27a85a 100%); padding:36px; text-align:center; }
  .header h1 { color:#fff; margin:0 0 6px; font-size:1.4rem; font-weight:800; }
  .header p  { color:rgba(255,255,255,.85); margin:0; font-size:.88rem; }
  .body   { padding:36px; text-align:center; }
  .body p { color:#374151; font-size:.95rem; line-height:1.8; margin:0 0 24px; text-align:right; }
  .code-box { display:inline-block; background:#f0fdf4; border:2px solid #86efac; border-radius:14px; padding:20px 40px; margin:8px 0 28px; }
  .code-box .digits { font-size:2.4rem; font-weight:900; letter-spacing:12px; color:#0f3d24; font-family:monospace; }
  .expire { font-size:.82rem; color:#6b7280; margin-top:4px; }
  .warning { background:#fffbeb; border:1.5px solid #fcd34d; border-radius:10px; padding:12px 16px; font-size:.83rem; color:#92400e; text-align:right; line-height:1.7; margin-top:16px; }
  .footer { background:#f4f6f8; padding:18px 36px; text-align:center; }
  .footer p { color:#9ca3af; font-size:.75rem; margin:0; line-height:1.7; }
</style>
</head>
<body>
<div class="wrapper">

  <div class="header">
    <h1>🔐 كود التحقق</h1>
    <p>منصة أمر تم — التحقق بخطوتين</p>
  </div>

  <div class="body">
    <p>مرحباً <strong>{{ $user->name }}</strong>،<br>
    استخدم الكود أدناه للتحقق من هويتك. صالح لمدة <strong>10 دقائق</strong> فقط.</p>

    <div class="code-box">
      <div class="digits">{{ $code }}</div>
      <div class="expire">ينتهي خلال 10 دقائق</div>
    </div>

    <div class="warning">
      ⚠️ <strong>تنبيه أمني:</strong> لا تشارك هذا الكود مع أي شخص آخر. فريق أمر تم لن يطلب منك هذا الكود أبداً.
    </div>
  </div>

  <div class="footer">
    <p>إذا لم تطلب هذا الكود، يمكنك تجاهل هذا البريد بأمان.<br>
    منصة <strong>أمر تم</strong> — {{ now()->year }}</p>
  </div>

</div>
</body>
</html>
