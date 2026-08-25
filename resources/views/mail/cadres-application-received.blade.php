<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تم استلام طلبك</title>
<style>
  body { margin:0; padding:0; background:#f4f6f8; font-family:'Segoe UI', Tahoma, Arial, sans-serif; direction:rtl; }
  .wrapper { max-width:580px; margin:32px auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }
  .header  { background: linear-gradient(135deg, #1a5c38 0%, #27a85a 100%); padding:40px 36px 32px; text-align:center; }
  .header .icon { width:64px; height:64px; background:rgba(255,255,255,.2); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px; }
  .header h1 { color:#fff; margin:0; font-size:1.5rem; font-weight:800; }
  .header p  { color:rgba(255,255,255,.85); margin:6px 0 0; font-size:.9rem; }
  .body   { padding:36px 36px 24px; }
  .body p { color:#374151; font-size:.95rem; line-height:1.8; margin:0 0 14px; }
  .info-box { background:#f0fdf4; border:1.5px solid #86efac; border-radius:12px; padding:18px 22px; margin:20px 0; }
  .info-box .row { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #d1fae5; font-size:.88rem; }
  .info-box .row:last-child { border-bottom:none; }
  .info-box .label { color:#6b7280; font-weight:600; }
  .info-box .value { color:#0f3d24; font-weight:700; }
  .notice { background:#fffbeb; border:1.5px solid #fcd34d; border-radius:10px; padding:14px 18px; margin:20px 0; font-size:.88rem; color:#92400e; line-height:1.7; }
  .footer { background:#f4f6f8; padding:20px 36px; text-align:center; }
  .footer p { color:#9ca3af; font-size:.78rem; margin:0; line-height:1.7; }
</style>
</head>
<body>
<div class="wrapper">

  <!-- Header -->
  <div class="header">
    <div class="icon">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"/>
      </svg>
    </div>
    <h1>تم استلام طلبك بنجاح ✅</h1>
    <p>منصة أمر تم — الكوادر البشرية</p>
  </div>

  <!-- Body -->
  <div class="body">
    <p>مرحباً <strong>{{ $application->full_name }}</strong>،</p>
    <p>
      شكراً لتقديمك طلب الانضمام إلى قاعدة الكوادر البشرية في منصة <strong>أمر تم</strong>.
      لقد تم استلام طلبك بنجاح وهو قيد المراجعة من قِبل فريقنا المختص.
    </p>

    <div class="info-box">
      <div class="row">
        <span class="label">الاسم الكامل</span>
        <span class="value">{{ $application->full_name }}</span>
      </div>
      <div class="row">
        <span class="label">البريد الإلكتروني</span>
        <span class="value">{{ $application->email }}</span>
      </div>
      <div class="row">
        <span class="label">رقم الجوال</span>
        <span class="value">{{ $application->phone }}</span>
      </div>
      <div class="row">
        <span class="label">المسمى الوظيفي المطلوب</span>
        <span class="value">{{ $application->job_title_desired }}</span>
      </div>
      <div class="row">
        <span class="label">تاريخ التقديم</span>
        <span class="value">{{ $application->created_at->format('Y/m/d') }}</span>
      </div>
      <div class="row">
        <span class="label">حالة الطلب</span>
        <span class="value">قيد المراجعة</span>
      </div>
    </div>

    <div class="notice">
      📋 <strong>الخطوات التالية:</strong><br>
      سيقوم فريقنا بمراجعة بياناتك خلال <strong>3–5 أيام عمل</strong>، وسيتواصل معك عبر البريد الإلكتروني أو الجوال المسجّل في حال الموافقة أو طلب معلومات إضافية.
    </div>

    <p style="font-size:.85rem; color:#6b7280; margin-top:16px;">
      إذا لم تتقدم بهذا الطلب أو كان لديك استفسار، تواصل معنا عبر
      <a href="{{ url('/contact') }}" style="color:#1a5c38;">صفحة التواصل</a>.
    </p>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>منصة <strong>أمر تم</strong> — جميع الحقوق محفوظة {{ now()->year }}<br>
    هذا البريد آلي، يرجى عدم الرد عليه مباشرةً.</p>
  </div>

</div>
</body>
</html>
