<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تم تفعيل حسابك</title>
<style>
  body { margin:0; padding:0; background:#f4f6f8; font-family:'Segoe UI', Tahoma, Arial, sans-serif; direction:rtl; }
  .wrapper { max-width:580px; margin:32px auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }
  .header  { background: linear-gradient(135deg, #1a5c38 0%, #27a85a 100%); padding:40px 36px 32px; text-align:center; }
  .header .check { width:64px; height:64px; background:rgba(255,255,255,.2); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px; }
  .header h1 { color:#fff; margin:0; font-size:1.5rem; font-weight:800; }
  .header p  { color:rgba(255,255,255,.85); margin:6px 0 0; font-size:.9rem; }
  .body   { padding:36px 36px 24px; }
  .body p { color:#374151; font-size:.95rem; line-height:1.8; margin:0 0 14px; }
  .info-box { background:#f0fdf4; border:1.5px solid #86efac; border-radius:12px; padding:18px 22px; margin:20px 0; }
  .info-box .row { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #d1fae5; font-size:.88rem; }
  .info-box .row:last-child { border-bottom:none; }
  .info-box .label { color:#6b7280; font-weight:600; }
  .info-box .value { color:#0f3d24; font-weight:700; }
  .btn-wrap { text-align:center; margin:28px 0 8px; }
  .btn { background:#1a5c38; color:#fff; text-decoration:none; padding:14px 40px; border-radius:10px; font-size:1rem; font-weight:700; display:inline-block; }
  .footer { background:#f4f6f8; padding:20px 36px; text-align:center; }
  .footer p { color:#9ca3af; font-size:.78rem; margin:0; line-height:1.7; }
</style>
</head>
<body>
<div class="wrapper">

  <!-- Header -->
  <div class="header">
    <div class="check">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"/>
      </svg>
    </div>
    <h1>تهانينا! تم قبول طلبك 🎉</h1>
    <p>منصة أمر تم — حجوزات القاعات والمناسبات</p>
  </div>

  <!-- Body -->
  <div class="body">
    <p>مرحباً <strong>{{ $hall->owner?->name }}</strong>،</p>
    <p>يسعدنا إبلاغك بأن طلب تسجيل منشأتك في منصة <strong>أمر تم</strong> قد تم مراجعته والموافقة عليه. أصبح حسابك نشطاً الآن ومنشأتك تظهر للمستخدمين.</p>

    <div class="info-box">
      <div class="row">
        <span class="label">اسم المنشأة</span>
        <span class="value">{{ $hall->name }}</span>
      </div>
      <div class="row">
        <span class="label">المدينة</span>
        <span class="value">{{ $hall->city }}</span>
      </div>
      <div class="row">
        <span class="label">رقم الحساب</span>
        <span class="value">#{{ $hall->id }}</span>
      </div>
      <div class="row">
        <span class="label">تاريخ التفعيل</span>
        <span class="value">{{ now()->format('Y/m/d') }}</span>
      </div>
    </div>

    <p>يمكنك الآن تسجيل الدخول إلى لوحة التحكم الخاصة بك، واستكمال بيانات المنشأة وتفعيل الحجوزات.</p>

    <div class="btn-wrap">
      <a href="{{ url('/owner/dashboard') }}" class="btn">الدخول إلى لوحة التحكم</a>
    </div>

    <p style="font-size:.85rem; color:#6b7280; margin-top:24px;">إذا واجهتك أي مشكلة أو كان لديك استفسار، تواصل معنا عبر صفحة اتصل بنا على المنصة.</p>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>منصة <strong>أمر تم</strong> — جميع الحقوق محفوظة {{ now()->year }}<br>
    هذا البريد آلي، يرجى عدم الرد عليه مباشرةً.</p>
  </div>

</div>
</body>
</html>
