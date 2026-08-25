<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد الطلب #{{ $order->order_number }} | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Cairo', sans-serif; background: #f0f4f2; min-height: 100vh; color: #1e293b; }
        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }

        .confirm-wrap { max-width: 680px; margin: 48px auto; padding: 0 20px 60px; }

        .confirm-card {
            background: #fff; border-radius: 20px;
            border: 1.5px solid #e2ede7; overflow: hidden;
            box-shadow: 0 4px 30px rgba(0,0,0,.06);
        }

        /* Green header */
        .confirm-header {
            background: linear-gradient(135deg, #0f3d24, #1a5c38);
            padding: 36px 30px; text-align: center;
        }
        .confirm-icon {
            width: 72px; height: 72px; border-radius: 50%;
            background: rgba(255,255,255,.15); border: 3px solid rgba(255,255,255,.4);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px; font-size: 30px; color: #a7f3d0;
        }
        .confirm-header h1 { font-size: 22px; font-weight: 800; color: #fff; margin-bottom: 6px; }
        .confirm-header p  { font-size: 13px; color: rgba(255,255,255,.72); }
        .order-num {
            display: inline-block; margin-top: 14px;
            background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
            color: #a7f3d0; font-size: 13px; font-weight: 800;
            padding: 6px 18px; border-radius: 30px;
        }

        /* Body */
        .confirm-body { padding: 28px 30px; }
        .section-label {
            font-size: 13px; font-weight: 800; color: #2d6a4f;
            margin-bottom: 12px; display: flex; align-items: center; gap: 6px;
        }
        .item-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 11px 0; border-bottom: 1px solid #f0f4f2; font-size: 13px;
        }
        .item-row:last-of-type { border-bottom: none; }
        .item-name { font-weight: 700; color: #0f3d24; }
        .item-date { font-size: 11px; color: #9ca3af; margin-top: 2px; }
        .item-price { font-weight: 800; color: #1a5c38; white-space: nowrap; }
        .total-line {
            background: #f0faf4; border-radius: 12px; padding: 14px 16px;
            display: flex; justify-content: space-between; margin-top: 16px;
        }
        .total-line-label { font-size: 14px; font-weight: 700; color: #0f3d24; }
        .total-line-value { font-size: 22px; font-weight: 800; color: #1a5c38; }

        /* Status badge */
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 800; padding: 8px 18px;
            border-radius: 30px; margin: 20px 0;
        }
        .status-receipt { background: #dbeafe; color: #1d4ed8; }

        /* Info box */
        .info-box {
            background: #f8fdf9; border: 1px solid #d1e8d8; border-radius: 12px;
            padding: 16px; margin-top: 20px; font-size: 13px; color: #334155; line-height: 1.8;
        }
        .info-box i { color: #1a5c38; margin-left: 6px; }

        .btn-home {
            display: flex; align-items: center; justify-content: center; gap: 9px;
            width: 100%; padding: 14px; border-radius: 12px;
            background: #1a5c38; color: #fff; text-decoration: none;
            font-size: 14px; font-weight: 800; margin-top: 20px;
        }
        .btn-home:hover { background: #155230; }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

<div class="confirm-wrap">
    <div class="confirm-card">

        <div class="confirm-header">
            <div class="confirm-icon"><i class="fa fa-check"></i></div>
            <h1>تم استلام طلبك!</h1>
            <p>جاري مراجعة إيصال التحويل من قِبل الفريق</p>
            <div class="order-num"># {{ $order->order_number }}</div>
        </div>

        <div class="confirm-body">

            {{-- Status --}}
            <div style="text-align:center;">
                <span class="status-badge status-receipt">
                    <i class="fa fa-clock"></i> {{ $order->status_label }}
                </span>
            </div>

            {{-- Items --}}
            <div class="section-label"><i class="fa fa-list-check"></i> تفاصيل الطلب</div>
            @foreach($order->items as $item)
            <div class="item-row">
                <div>
                    <span style="font-size:10px;background:#e8f5e9;color:#1a5c38;padding:1px 7px;border-radius:20px;font-weight:800;margin-left:4px;">{{ $item->type_label }}</span>
                    <span class="item-name">{{ $item->label }}</span>
                    @if($item->event_date)
                    <div class="item-date"><i class="fa fa-calendar" style="margin-left:3px;"></i>{{ $item->event_date->format('Y/m/d') }}</div>
                    @endif
                </div>
                <span class="item-price">{{ number_format((float)$item->price_snapshot, 2) }} ريال</span>
            </div>
            @endforeach

            <div class="total-line">
                <span class="total-line-label">الإجمالي الكلي</span>
                <span class="total-line-value">{{ number_format((float)$order->total_amount, 2) }} ريال</span>
            </div>

            {{-- Info --}}
            <div class="info-box">
                <i class="fa fa-circle-info"></i><strong>ماذا بعد؟</strong><br>
                سيقوم فريق أمر تم بمراجعة إيصال التحويل خلال <strong>24 ساعة</strong>.
                سيتم التواصل معك عبر البريد الإلكتروني أو الهاتف لتأكيد الحجوزات.<br><br>
                <i class="fa fa-envelope"></i> في حال وجود أي استفسار، تواصل معنا مباشرة.
            </div>

            <a href="{{ route('halls.list') }}" class="btn-home">
                <i class="fa fa-home"></i> العودة للصفحة الرئيسية
            </a>
        </div>
    </div>
</div>

@include('partials.footer')
</body>
</html>
