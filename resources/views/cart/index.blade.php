<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلتي | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Cairo', sans-serif; background: #f0f4f2; min-height: 100vh; color: #1e293b; }
        .top-bar { clip-path: none !important; padding-bottom: 10px !important; }

        .cart-hero {
            background: linear-gradient(135deg, #0f3d24 0%, #1a5c38 60%, #2d8a5a 100%);
            padding: 40px 5% 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cart-hero::before {
            content: ''; position: absolute; width: 340px; height: 340px;
            border-radius: 50%; background: rgba(255,255,255,.05);
            top: -120px; left: -60px;
        }
        .cart-hero h1 { font-size: 28px; font-weight: 800; color: #fff; margin-bottom: 6px; }
        .cart-hero p  { font-size: 14px; color: rgba(255,255,255,.72); }

        .main-wrap { max-width: 1100px; margin: 0 auto; padding: 30px 20px 60px; }
        .cart-grid { display: grid; grid-template-columns: 1fr 320px; gap: 24px; }

        /* Items */
        .cart-item {
            background: #fff; border-radius: 16px;
            border: 1.5px solid #e2ede7; padding: 18px 20px;
            display: flex; align-items: flex-start; gap: 16px;
            margin-bottom: 12px;
        }
        .item-icon {
            width: 48px; height: 48px; border-radius: 12px;
            background: linear-gradient(135deg, #1a5c38, #2d8a5a);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 20px; flex-shrink: 0;
        }
        .item-body { flex: 1; }
        .item-type-badge {
            display: inline-block; font-size: 10px; font-weight: 800;
            color: #1a5c38; background: #e8f5e9; padding: 2px 9px;
            border-radius: 20px; margin-bottom: 5px;
        }
        .item-label { font-size: 15px; font-weight: 800; color: #0f3d24; }
        .item-meta { font-size: 12px; color: #6c7a72; margin-top: 4px; }
        .item-price { font-size: 18px; font-weight: 800; color: #1a5c38; white-space: nowrap; }
        .item-remove {
            background: none; border: none; cursor: pointer;
            color: #dc2626; font-size: 14px; padding: 6px;
            border-radius: 8px; transition: background .15s;
        }
        .item-remove:hover { background: #fee2e2; }

        /* Summary card */
        .summary-card {
            background: #fff; border-radius: 16px;
            border: 1.5px solid #e2ede7; padding: 22px;
            position: sticky; top: 20px;
        }
        .summary-title { font-size: 16px; font-weight: 800; color: #0f3d24; margin-bottom: 18px; }
        .summary-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 9px 0; border-bottom: 1px solid #f0f4f2; font-size: 13px;
        }
        .summary-row:last-of-type { border-bottom: none; }
        .summary-label { color: #6c7a72; font-weight: 600; }
        .summary-value { font-weight: 700; color: #0f3d24; }
        .summary-total {
            background: #f0faf4; border-radius: 12px; padding: 14px 16px;
            display: flex; justify-content: space-between; align-items: center;
            margin: 16px 0;
        }
        .summary-total-label { font-size: 14px; font-weight: 700; color: #0f3d24; }
        .summary-total-value { font-size: 22px; font-weight: 800; color: #1a5c38; }

        .btn-checkout {
            display: flex; align-items: center; justify-content: center; gap: 9px;
            width: 100%; padding: 14px; border-radius: 12px;
            background: #1a5c38; color: #fff; font-family: 'Cairo', sans-serif;
            font-size: 15px; font-weight: 800; border: none; cursor: pointer;
            text-decoration: none; transition: background .2s; margin-bottom: 10px;
        }
        .btn-checkout:hover { background: #155230; }
        .btn-clear {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 11px; border-radius: 12px;
            background: #fff; color: #dc2626; font-family: 'Cairo', sans-serif;
            font-size: 13px; font-weight: 700; border: 1.5px solid #fecaca;
            cursor: pointer; transition: background .2s;
        }
        .btn-clear:hover { background: #fee2e2; }

        /* Empty state */
        .empty-cart {
            text-align: center; padding: 60px 20px;
            background: #fff; border-radius: 16px; border: 1.5px solid #e2ede7;
        }
        .empty-cart i { font-size: 56px; color: #d1d5db; display: block; margin-bottom: 16px; }
        .empty-cart h2 { font-size: 20px; font-weight: 800; color: #374151; margin-bottom: 8px; }
        .empty-cart p  { font-size: 13px; color: #9ca3af; margin-bottom: 24px; }
        .btn-browse {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 24px; border-radius: 12px;
            background: #1a5c38; color: #fff; text-decoration: none;
            font-weight: 800; font-size: 14px;
        }

        /* Flash messages */
        .flash { padding: 12px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; margin-bottom: 16px; }
        .flash-success { background: #d1fae5; color: #065f46; }
        .flash-error   { background: #fee2e2; color: #991b1b; }

        @media (max-width: 800px) {
            .cart-grid { grid-template-columns: 1fr; }
            .summary-card { position: static; }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

<div class="cart-hero">
    <h1><i class="fa fa-shopping-cart" style="margin-left:10px;"></i> سلتي</h1>
    <p>راجع طلباتك قبل إتمام الدفع</p>
</div>

<div class="main-wrap">

    @if(session('success'))
    <div class="flash flash-success"><i class="fa fa-check-circle" style="margin-left:6px;"></i>{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="flash flash-error"><i class="fa fa-triangle-exclamation" style="margin-left:6px;"></i>{{ session('error') }}</div>
    @endif

    @if($cart->items->isEmpty())
    <div class="empty-cart">
        <i class="fa fa-cart-shopping"></i>
        <h2>سلتك فارغة</h2>
        <p>لم تقم بإضافة أي قاعة أو خدمة حتى الآن</p>
        <a href="{{ route('halls.list') }}" class="btn-browse">
            <i class="fa fa-search"></i> تصفح القاعات والخدمات
        </a>
    </div>
    @else
    <div class="cart-grid">

        {{-- ===== ITEMS LIST ===== --}}
        <div>
            <p style="font-size:13px;color:#6c7a72;font-weight:600;margin-bottom:16px;">
                {{ $cart->items->count() }} عنصر في السلة
            </p>

            @foreach($cart->items as $item)
            <div class="cart-item">
                <div class="item-icon">
                    <i class="fa {{ $item->type_icon }}"></i>
                </div>
                <div class="item-body">
                    <span class="item-type-badge">{{ $item->type_label }}</span>
                    <div class="item-label">{{ $item->label }}</div>
                    <div class="item-meta">
                        @if($item->event_date)
                        <i class="fa fa-calendar" style="margin-left:4px;"></i>
                        {{ $item->event_date->format('Y/m/d') }}
                        @endif
                        @if($item->notes)
                        <span style="margin-right:10px;"><i class="fa fa-note-sticky" style="margin-left:4px;"></i>{{ Str::limit($item->notes, 40) }}</span>
                        @endif
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">
                    <span class="item-price">{{ number_format((float)$item->price_snapshot, 2) }} ريال</span>
                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="item-remove" title="حذف">
                            <i class="fa fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ===== SUMMARY ===== --}}
        <div>
            <div class="summary-card">
                <div class="summary-title"><i class="fa fa-receipt" style="margin-left:8px;color:#2d6a4f;"></i> ملخص الطلب</div>

                @foreach($cart->items as $item)
                <div class="summary-row">
                    <span class="summary-label">{{ Str::limit($item->label, 28) }}</span>
                    <span class="summary-value">{{ number_format((float)$item->price_snapshot, 2) }} ر</span>
                </div>
                @endforeach

                <div class="summary-total">
                    <span class="summary-total-label">الإجمالي الكلي</span>
                    <span class="summary-total-value">{{ number_format($cart->total(), 2) }} ريال</span>
                </div>

                @auth
                <a href="{{ route('cart.checkout') }}" class="btn-checkout">
                    <i class="fa fa-credit-card"></i> إتمام الطلب والدفع
                </a>
                @else
                <a href="{{ route('login') }}" class="btn-checkout">
                    <i class="fa fa-right-to-bracket"></i> سجّل دخولك لإتمام الطلب
                </a>
                @endauth

                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-clear">
                        <i class="fa fa-trash"></i> تفريغ السلة
                    </button>
                </form>
            </div>
        </div>

    </div>
    @endif
</div>

@include('partials.footer')
</body>
</html>
