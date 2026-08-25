<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>بخصوص طلبك</title>
<style>
  body { margin:0; padding:0; background:#f4f6f8; font-family:'Segoe UI', Tahoma, Arial, sans-serif; direction:rtl; }
  .wrapper { max-width:580px; margin:32px auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }
  .header  { background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%); padding:40px 36px 32px; text-align:center; }
  .header .icon { width:64px; height:64px; background:rgba(255,255,255,.2); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px; }
  .header h1 { color:#fff; margin:0; font-size:1.45rem; font-weight:800; }
  .header p  { color:rgba(255,255,255,.85); margin:6px 0 0; font-size:.9rem; }
  .body   { padding:36px 36px 24px; }
  .body p { color:#374151; font-size:.95rem; line-height:1.8; margin:0 0 14px; }
  .info-box { background:#fef2f2; border:1.5px solid #fca5a5; border-radius:12px; padding:18px 22px; margin:20px 0; }
  .info-box .row { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #fee2e2; font-size:.88rem; }
  .info-box .row:last-child { border-bottom:none; }
  .info-box .label { color:#6b7280; font-weight:600; }
  .info-box .value { color:#7f1d1d; font-weight:700; }
  .note-box { background:#fffbeb; border:1.5px solid #fcd34d; border-radius:12px; padding:16px 20px; margin:18px 0; }
  .note-box .title { color:#b45309; font-weight:700; font-size:.88rem; margin-bottom:8px; }
  .note-box p { color:#92400e; font-size:.88rem; margin:0; line-height:1.7; }
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
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </div>
    <h1>بخصوص طلب تسجيل منشأتك</h1>
    <p>منصة أمر تم — حجوزات القاعات والمناسبات</p>
  </div>

  <!-- Body -->
  <div class="body">
    <p>مرحباً <strong>{{ $hall->owner?->name }}</strong>،</p>
    <p>شكراً لاهتمامك بالانضمام إلى منصة <strong>أمر تم</strong>. بعد مراجعة طلب تسجيل منشأتك من قِبَل فريقنا المختص، نأسف لإبلاغك بأنه لم يتم قبول الطلب في الوقت الحالي.</p>

    <div class="info-box">
      <div class="row">
        <span class="label">اسم المنشأة</span>
        <span class="value">{{ $hall->name }}</span>
      </div>
      <div class="row">
        <span class="label">رقم الطلب</span>
        <span class="value">#{{ $hall->id }}</span>
      </div>
      <div class="row">
        <span class="label">تاريخ المراجعة</span>
        <span class="value">{{ now()->format('Y/m/d') }}</span>
      </div>
    </div>

    @if($note)
    <div class="note-box">
      <div class="title"><svg style="width:14px;height:14px;margin-left:4px;vertical-align:middle;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> سبب الرفض</div>
      <p>{{ $note }}</p>
    </div>
    @else
    <p>لمزيد من التفاصيل حول أسباب الرفض أو لإعادة تقديم الطلب بعد تصحيح المعلومات، يُرجى التواصل مع فريق الدعم.</p>
    @endif

    <p style="font-size:.85rem; color:#6b7280; margin-top:20px;">إذا كنت تعتقد أن هناك خطأً أو تريد إعادة تقديم الطلب، تواصل معنا عبر صفحة اتصل بنا على المنصة.</p>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>منصة <strong>أمر تم</strong> — جميع الحقوق محفوظة {{ now()->year }}<br>
    هذا البريد آلي، يرجى عدم الرد عليه مباشرةً.</p>
  </div>

</div>
</body>
</html>
