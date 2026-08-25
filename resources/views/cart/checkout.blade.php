<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الدفع | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Cairo', sans-serif; background: #f0f4f2; min-height: 100vh; color: #1e293b; }
        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }

        .page-hero {
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 60%, #2d8a5a 100%);
            padding: 36px 5% 44px; text-align: center;
        }
        .page-hero h1 { font-size: 26px; font-weight: 800; color: #fff; margin-bottom: 6px; }
        .page-hero p  { font-size: 13px; color: rgba(255,255,255,.72); }

        /* Steps */
        .steps-bar {
            background: #fff; border-bottom: 1px solid #e5e7eb;
            padding: 14px 5%; display: flex; align-items: center;
            justify-content: center; gap: 0; flex-wrap: wrap;
        }
        .step { display: flex; align-items: center; gap: 7px; font-size: 13px; font-weight: 600; color: #9ca3af; }
        .step.done  { color: #1a5c38; }
        .step.active { color: #1a5c38; font-weight: 800; }
        .step-num {
            width: 26px; height: 26px; border-radius: 50%;
            background: #e5e7eb; color: #9ca3af;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 800; flex-shrink: 0;
        }
        .step.done  .step-num { background: #d1fae5; color: #1a5c38; }
        .step.active .step-num { background: #1a5c38; color: #fff; }
        .step-arrow { color: #d1d5db; font-size: 11px; margin: 0 12px; }

        .main-wrap { max-width: 1000px; margin: 0 auto; padding: 30px 20px 60px; }
        .grid { display: grid; grid-template-columns: 1fr 300px; gap: 24px; }

        /* ===== Payment Methods ===== */
        .section-card {
            background: #fff; border-radius: 16px; padding: 24px;
            border: 1.5px solid #e2ede7; margin-bottom: 20px;
        }
        .section-card-title {
            font-size: 15px; font-weight: 800; color: #0f3d24; margin-bottom: 18px;
            display: flex; align-items: center; gap: 9px;
        }
        .section-card-title i { color: #2d6a4f; font-size: 16px; }

        .methods-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 12px; margin-bottom: 4px;
        }
        .method-card {
            border: 2px solid #e5e7eb; border-radius: 14px; padding: 16px 10px;
            text-align: center; cursor: pointer; transition: all .2s; position: relative;
            background: #fafafa; user-select: none;
        }
        .method-card:hover { border-color: #a8c9a4; background: #f0fdf4; }
        .method-card.selected { border-color: #1a5c38; background: #f0fdf4; box-shadow: 0 0 0 3px rgba(26,92,56,.12); }
        .method-card input[type=radio] { position: absolute; opacity: 0; pointer-events: none; }
        .method-logo { height: 34px; display: flex; align-items: center; justify-content: center; margin-bottom: 8px; }
        .method-logo img { max-height: 32px; max-width: 90px; object-fit: contain; }
        .method-logo i { font-size: 28px; }
        .method-label { font-size: 12px; font-weight: 700; color: #374151; line-height: 1.3; }
        .method-badge {
            position: absolute; top: 7px; left: 7px;
            background: #fbbf24; color: #78350f;
            font-size: 9px; font-weight: 800; padding: 2px 7px;
            border-radius: 20px; letter-spacing: .03em;
        }

        /* ===== Payment Layout (Sidebar) ===== */
        .payment-layout {
            display: grid;
            grid-template-columns: 195px 1fr;
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e2ede7;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .methods-sidebar {
            background: #f8fdf9;
            border-left: 1.5px solid #e2ede7;
            padding: 18px 12px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .sidebar-heading {
            font-size: 11px; font-weight: 800; color: #9ca3af;
            letter-spacing: .05em; text-transform: uppercase;
            margin-bottom: 10px;
            display: flex; align-items: center; gap: 6px;
        }
        .method-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            cursor: pointer; font-size: 13px; font-weight: 700; color: #374151;
            border: 2px solid transparent; transition: all .2s; user-select: none;
            position: relative;
        }
        .method-item:hover { background: #f0fdf4; border-color: #a8c9a4; }
        .method-item.selected { background: #e8f5e9; border-color: #1a5c38; color: #0f3d24; }
        .method-item input[type=radio] { position: absolute; opacity: 0; pointer-events: none; }
        .method-item .item-icon { font-size: 16px; width: 20px; text-align: center; flex-shrink: 0; }
        .method-item .item-text { flex: 1; }
        .method-item .item-badge {
            font-size: 8px; font-weight: 800;
            background: #fbbf24; color: #78350f;
            padding: 1px 5px; border-radius: 20px; white-space: nowrap;
        }
        .sidebar-divider { border: none; border-top: 1px solid #e5e7eb; margin: 4px 0; }
        .sidebar-secure {
            margin-top: auto; padding-top: 14px;
            font-size: 10px; color: #9ca3af;
            text-align: center; line-height: 1.7;
        }
        .panel-area { padding: 22px; }

        /* ===== Bank Transfer Panel ===== */
        .bank-panel { display: none; }
        .bank-panel.active { display: block; animation: fadeIn .25s; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }

        .bank-card {
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 60%, #2d6a4f 100%);
            border-radius: 16px; padding: 24px; margin-bottom: 18px; color: #fff;
        }
        .bank-card-title {
            font-size: 15px; font-weight: 800; margin-bottom: 18px;
            display: flex; align-items: center; gap: 8px;
        }
        .bank-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,.15);
            font-size: 13px;
        }
        .bank-row:last-child { border-bottom: none; }
        .bank-key { color: rgba(255,255,255,.68); font-weight: 600; }
        .bank-val { font-weight: 800; color: #fff; display: flex; align-items: center; gap: 8px; }
        .copy-btn {
            background: rgba(255,255,255,.15); border: none; border-radius: 6px;
            padding: 3px 8px; color: #a7f3d0; font-size: 11px; cursor: pointer;
            font-family: 'Cairo', sans-serif; font-weight: 700;
        }
        .copy-btn:hover { background: rgba(255,255,255,.25); }

        /* ===== Upload ===== */
        .upload-card { background: #f8fdf9; border-radius: 14px; padding: 20px; border: 1.5px dashed #a8c9a4; }
        .upload-card-title { font-size: 14px; font-weight: 800; color: #0f3d24; margin-bottom: 14px; }
        .upload-zone {
            border: 2px dashed #c5dfbf; border-radius: 12px; padding: 30px 20px;
            text-align: center; cursor: pointer; transition: border-color .2s, background .2s;
            background: #fff; position: relative;
        }
        .upload-zone:hover { border-color: #1a5c38; background: #f0faf4; }
        .upload-zone input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
        .upload-icon { font-size: 32px; color: #a8c9a4; margin-bottom: 8px; }
        .upload-text { font-size: 13px; color: #6c7a72; font-weight: 700; }
        .upload-hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }
        .file-preview {
            display: none; background: #d1fae5; border-radius: 10px;
            padding: 12px 16px; margin-top: 12px;
            font-size: 13px; font-weight: 700; color: #065f46;
            align-items: center; gap: 8px;
        }

        /* ===== Coming Soon Panel ===== */
        .soon-panel { display: none; }
        .soon-panel.active { display: flex; flex-direction: column; align-items: center; padding: 40px 20px; animation: fadeIn .25s; }
        .soon-icon { font-size: 52px; color: #d1d5db; margin-bottom: 16px; }
        .soon-title { font-size: 16px; font-weight: 800; color: #6b7280; margin-bottom: 8px; }
        .soon-sub { font-size: 13px; color: #9ca3af; text-align: center; line-height: 1.7; }

        /* ===== Submit ===== */
        .btn-submit {
            display: flex; align-items: center; justify-content: center; gap: 10px;
            width: 100%; padding: 15px; border-radius: 12px;
            background: #1a5c38; color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 15px; font-weight: 800; border: none; cursor: pointer;
            margin-top: 18px; transition: background .2s;
        }
        .btn-submit:hover { background: #155230; }
        .btn-submit:disabled { background: #9ca3af; cursor: not-allowed; }

        /* ===== Summary sidebar ===== */
        .summary-card {
            background: #fff; border-radius: 16px; padding: 22px;
            border: 1.5px solid #e2ede7; position: sticky; top: 20px;
        }
        .summary-title { font-size: 15px; font-weight: 800; color: #0f3d24; margin-bottom: 16px; }
        .s-row {
            display: flex; justify-content: space-between; padding: 9px 0;
            border-bottom: 1px solid #f0f4f2; font-size: 12.5px;
        }
        .s-row:last-of-type { border-bottom: none; }
        .s-label { color: #6c7a72; font-weight: 600; max-width: 160px; line-height: 1.4; }
        .s-val { font-weight: 700; color: #0f3d24; white-space: nowrap; }
        .total-box {
            background: #f0faf4; border-radius: 12px; padding: 14px 16px;
            display: flex; justify-content: space-between; align-items: center; margin-top: 14px;
        }
        .total-label { font-size: 14px; font-weight: 700; color: #0f3d24; }
        .total-val { font-size: 22px; font-weight: 800; color: #1a5c38; }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 700; color: #1a5c38;
            text-decoration: none; margin-bottom: 20px;
        }
        .back-link:hover { text-decoration: underline; }

        @media (max-width: 800px) {
            .grid { grid-template-columns: 1fr; }
            .summary-card { position: static; }
            .payment-layout { grid-template-columns: 1fr; }
            .methods-sidebar {
                flex-direction: row; flex-wrap: wrap;
                border-left: none; border-bottom: 1.5px solid #e2ede7;
            }
        }
        @media (max-width: 480px) {
            .method-item { padding: 8px 10px; font-size: 12px; }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

<div class="steps-bar">
    <span class="step done">
        <span class="step-num"><i class="fa fa-check" style="font-size:9px;"></i></span>
        <span>السلة</span>
    </span>
    <i class="fa fa-angle-left step-arrow"></i>
    <span class="step active">
        <span class="step-num">2</span>
        <span>الدفع</span>
    </span>
    <i class="fa fa-angle-left step-arrow"></i>
    <span class="step">
        <span class="step-num">3</span>
        <span>تأكيد الطلب</span>
    </span>
</div>

<div class="page-hero">
    <h1><i class="fa fa-shield-halved" style="margin-left:10px;"></i> الدفع الآمن</h1>
    <p>اختر طريقة الدفع المناسبة لإتمام طلبك</p>
</div>

<div class="main-wrap">
    <a href="{{ route('cart.index') }}" class="back-link">
        <i class="fa fa-arrow-right"></i> العودة للسلة
    </a>

    <div class="grid">

        {{-- ===== RIGHT: Payment ===== --}}
        <div>

            {{-- Payment Layout: Sidebar + Content --}}
            <div class="payment-layout">

                {{-- Methods Sidebar --}}
                <div class="methods-sidebar">
                    <div class="sidebar-heading">
                        <i class="fa fa-credit-card"></i>
                        طريقة الدفع
                    </div>

                    <label class="method-item" data-method="bank_transfer" id="bankMethodCard" onclick="selectMethod('bank_transfer')">
                        <input type="radio" name="payment_method" value="bank_transfer">
                        <span class="item-icon"><i class="fa fa-building-columns" style="color:#1a5c38;"></i></span>
                        <span class="item-text">تحويل بنكي</span>
                    </label>

                    <hr class="sidebar-divider">

                    <label class="method-item" data-method="applepay" onclick="selectMethod('applepay')">
                        <input type="radio" name="payment_method" value="applepay">
                        <span class="item-icon"><i class="fa-brands fa-apple-pay" style="color:#000;"></i></span>
                        <span class="item-text">Apple Pay</span>
                        <span class="item-badge">قريباً</span>
                    </label>

                    <label class="method-item" data-method="mastercard" onclick="selectMethod('mastercard')">
                        <input type="radio" name="payment_method" value="mastercard">
                        <span class="item-icon"><i class="fa-brands fa-cc-mastercard" style="color:#eb001b;"></i></span>
                        <span class="item-text">MasterCard</span>
                        <span class="item-badge">قريباً</span>
                    </label>

                    <label class="method-item" data-method="visa" onclick="selectMethod('visa')">
                        <input type="radio" name="payment_method" value="visa">
                        <span class="item-icon"><i class="fa-brands fa-cc-visa" style="color:#1a1f71;"></i></span>
                        <span class="item-text">Visa</span>
                        <span class="item-badge">قريباً</span>
                    </label>

                    <label class="method-item" data-method="mada" onclick="selectMethod('mada')">
                        <input type="radio" name="payment_method" value="mada">
                        <span class="item-icon"><i class="fa fa-credit-card" style="color:#007a5e;"></i></span>
                        <span class="item-text">مدى</span>
                        <span class="item-badge">قريباً</span>
                    </label>

                    <label class="method-item" data-method="paypal" onclick="selectMethod('paypal')">
                        <input type="radio" name="payment_method" value="paypal">
                        <span class="item-icon"><i class="fa-brands fa-paypal" style="color:#003087;"></i></span>
                        <span class="item-text">PayPal</span>
                        <span class="item-badge">قريباً</span>
                    </label>

                    <div class="sidebar-secure">
                        <i class="fa fa-lock" style="color:#16a34a;"></i><br>
                        مدفوعات مشفرة وآمنة
                    </div>
                </div>

                {{-- Panel Area --}}
                <div class="panel-area">

                {{-- 2a. Bank Transfer Panel --}}
                <div class="bank-panel active" id="bankPanel">

                @if($errors->any())
                <div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:10px;font-size:13px;font-weight:700;margin-bottom:14px;">
                    {{ $errors->first() }}
                </div>
                @endif

                <div class="bank-card">
                    <div class="bank-card-title">
                        <i class="fa fa-building-columns"></i>
                        بيانات الحساب البنكي
                    </div>
                    <div class="bank-row">
                        <span class="bank-key">البنك</span>
                        <span class="bank-val">{{ $bankInfo['bank_name'] }}</span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-key">اسم الحساب</span>
                        <span class="bank-val">{{ $bankInfo['account_name'] }}</span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-key">رقم الحساب</span>
                        <span class="bank-val">
                            <span id="acc-num">{{ $bankInfo['account_number'] }}</span>
                            <button class="copy-btn" onclick="copyText('acc-num')">نسخ</button>
                        </span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-key">رقم الآيبان</span>
                        <span class="bank-val">
                            <span id="iban-num" dir="ltr">{{ $bankInfo['iban'] }}</span>
                            <button class="copy-btn" onclick="copyText('iban-num')">نسخ</button>
                        </span>
                    </div>
                    <div class="bank-row">
                        <span class="bank-key">المبلغ المطلوب</span>
                        <span class="bank-val" style="font-size:20px;color:#a7f3d0;">
                            {{ number_format($cart->total(), 2) }} ريال
                        </span>
                    </div>
                </div>

                <form action="{{ route('cart.place-order') }}" method="POST" enctype="multipart/form-data" id="orderForm">
                    @csrf
                    <input type="hidden" name="payment_method" value="bank_transfer">

                    <div class="upload-card">
                        <div class="upload-card-title">
                            <i class="fa fa-upload" style="color:#2d6a4f;margin-left:7px;"></i>
                            ارفع إيصال التحويل
                        </div>
                        <p style="font-size:12.5px;color:#6c7a72;margin-bottom:14px;line-height:1.7;">
                            بعد إتمام التحويل البنكي، ارفع صورة الإيصال أو ملف PDF.
                            سيتم تأكيد حجزك وتحديد التاريخ فور مراجعة الإيصال من فريقنا.
                        </p>

                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="receipt" id="receiptInput"
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   onchange="previewFile(this)">
                            <div class="upload-icon"><i class="fa fa-file-arrow-up"></i></div>
                            <div class="upload-text">اضغط لاختيار الإيصال أو اسحبه هنا</div>
                            <div class="upload-hint">JPG, PNG, PDF - الحد الأقصى 5MB</div>
                        </div>

                        <div class="file-preview" id="filePreview">
                            <i class="fa fa-check-circle"></i>
                            <span id="fileName"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn" disabled>
                        <i class="fa fa-lock"></i>
                        تأكيد الطلب وإرسال الإيصال
                    </button>
                    <p style="font-size:11px;color:#9ca3af;text-align:center;margin-top:10px;">
                        <i class="fa fa-calendar-check" style="color:#16a34a;margin-left:4px;"></i>
                        سيتم تثبيت التواريخ المحجوزة عند تأكيد الإيصال من الفريق
                    </p>
                </form>
            </div>


            {{-- 2b. Coming Soon Panel --}}
            <div class="soon-panel" id="soonPanel">
                <div class="soon-icon"><i class="fa fa-satellite-dish"></i></div>
                <div class="soon-title">هذه الطريقة قيد التطوير</div>
                <div class="soon-sub">
                    نعمل على إضافة خيارات الدفع الإلكتروني قريباً.<br>
                    يرجى استخدام التحويل البنكي في الوقت الحالي.
                </div>
            </div>

                </div>{{-- /panel-area --}}
            </div>{{-- /payment-layout --}}

        </div>

        {{-- ===== LEFT: Order Summary ===== --}}
        <div>
            <div class="summary-card">
                <div class="summary-title">
                    <i class="fa fa-receipt" style="margin-left:8px;color:#2d6a4f;"></i>
                    ملخص طلبك
                </div>

                @foreach($cart->items as $item)
                <div class="s-row">
                    <span class="s-label">
                        <span style="font-size:10px;background:#e8f5e9;color:#1a5c38;padding:1px 7px;border-radius:20px;font-weight:800;margin-left:4px;">{{ $item->type_label }}</span>
                        {{ $item->label }}
                        @if($item->event_date)
                        <br><span style="font-size:11px;color:#9ca3af;"><i class="fa fa-calendar" style="margin-left:3px;"></i>{{ $item->event_date->format('Y/m/d') }}</span>
                        @endif
                    </span>
                    <span class="s-val">{{ number_format((float)$item->price_snapshot, 2) }}</span>
                </div>
                @endforeach

                <div class="total-box">
                    <span class="total-label">الإجمالي</span>
                    <span class="total-val">{{ number_format($cart->total(), 2) }} ريال</span>
                </div>

                <p style="font-size:11px;color:#9ca3af;text-align:center;margin-top:14px;line-height:1.7;">
                    <i class="fa fa-shield-halved" style="color:#16a34a;margin-left:4px;"></i>
                    طلبك آمن ومحمي بالكامل
                </p>
            </div>
        </div>

    </div>
</div>

@include('partials.footer')

<script>
// Auto-select bank_transfer on page load
window.addEventListener('DOMContentLoaded', () => selectMethod('bank_transfer'));

function selectMethod(method) {
    // Update card UI
    document.querySelectorAll('.method-item, .method-card').forEach(c => c.classList.remove('selected'));
    const card = document.querySelector('[data-method="' + method + '"]');
    if (card) card.classList.add('selected');

    // Show/hide panels
    const bankPanel = document.getElementById('bankPanel');
    const soonPanel = document.getElementById('soonPanel');

    if (method === 'bank_transfer') {
        bankPanel.classList.add('active');
        soonPanel.classList.remove('active');
    } else {
        bankPanel.classList.remove('active');
        soonPanel.classList.add('active');
    }
}

function previewFile(input) {
    const preview = document.getElementById('filePreview');
    const name    = document.getElementById('fileName');
    const btn     = document.getElementById('submitBtn');
    if (input.files && input.files[0]) {
        name.textContent = input.files[0].name;
        preview.style.display = 'flex';
        btn.disabled = false;
        btn.style.background = '';
    }
}

function copyText(elId) {
    const text = document.getElementById(elId).textContent.trim();
    navigator.clipboard.writeText(text).then(() => {
        const btn = event.target;
        btn.textContent = 'تم النسخ ✓';
        setTimeout(() => btn.textContent = 'نسخ', 2000);
    });
}

// Drag & drop
const zone = document.getElementById('uploadZone');
if (zone) {
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor = '#1a5c38'; });
    zone.addEventListener('dragleave', () => { zone.style.borderColor = '#c5dfbf'; });
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.style.borderColor = '#c5dfbf';
        const input = document.getElementById('receiptInput');
        input.files = e.dataTransfer.files;
        previewFile(input);
    });
}
</script>
</body>
</html>
