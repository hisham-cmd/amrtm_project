<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مزاد {{ $auction->brand->name }} — أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body.inner-page { background: linear-gradient(160deg,#0d2448 0%,#0f2d5a 60%,#0d2448 100%) !important; background-attachment:fixed !important; }
        .detail-wrap { max-width:1100px; margin:0 auto; padding:96px 24px 60px; position:relative; z-index:10; }

        /* HEADER */
        .brand-header { display:grid; grid-template-columns:auto 1fr auto; gap:28px; align-items:center; background:rgba(255,255,255,.06); backdrop-filter:blur(14px); border:1px solid rgba(255,255,255,.12); border-radius:24px; padding:28px 32px; margin-bottom:32px; }
        .brand-logo-big { width:100px; height:100px; border-radius:20px; background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.2); display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:900; color:#f59e0b; flex-shrink:0; overflow:hidden; }
        .brand-logo-big img { width:100%; height:100%; object-fit:contain; }
        .brand-header-info h1 { font-size:clamp(20px,3vw,32px); font-weight:900; color:#fff; margin:0 0 6px; }
        .brand-header-info .en { font-size:13px; color:rgba(255,255,255,.45); letter-spacing:1px; margin-bottom:10px; }
        .brand-header-tags { display:flex; gap:8px; flex-wrap:wrap; }
        .htag { padding:4px 12px; border-radius:10px; font-size:12px; font-weight:700; background:rgba(56,189,248,.12); border:1px solid rgba(56,189,248,.2); color:#7dd3fc; }
        .htag.gold { background:rgba(245,158,11,.12); border-color:rgba(245,158,11,.25); color:#f59e0b; }
        .htag.green { background:rgba(16,185,129,.12); border-color:rgba(16,185,129,.25); color:#34d399; }

        /* COUNTDOWN */
        .auction-timer { text-align:center; }
        .timer-box { display:flex; gap:8px; justify-content:center; }
        .tunit { background:rgba(245,158,11,.1); border:1px solid rgba(245,158,11,.2); border-radius:10px; padding:8px 14px; min-width:52px; }
        .tnum { font-size:22px; font-weight:900; color:#f59e0b; display:block; line-height:1; }
        .tlbl { font-size:10px; color:rgba(255,255,255,.4); margin-top:3px; }
        .timer-ended { color:#ef4444; font-weight:800; font-size:1.1rem; }

        /* MAIN GRID */
        .main-grid { display:grid; grid-template-columns:1fr 380px; gap:24px; align-items:start; }

        /* PANELS */
        .panel { background:rgba(255,255,255,.06); backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,.1); border-radius:20px; padding:24px; margin-bottom:20px; }
        .panel-title { font-size:15px; font-weight:800; color:#fff; margin:0 0 18px; display:flex; align-items:center; gap:8px; }
        .panel-title i { color:#f59e0b; }

        /* PRICE ROW */
        .price-big { font-size:38px; font-weight:900; color:#f59e0b; direction:ltr; display:inline-block; }
        .price-big span { font-size:16px; color:rgba(255,255,255,.5); font-weight:600; }
        .price-meta { display:flex; gap:14px; flex-wrap:wrap; margin-top:10px; }
        .pmeta { font-size:12px; color:rgba(255,255,255,.55); }
        .pmeta strong { color:rgba(255,255,255,.8); }

        /* BID FORM */
        .bid-form { }
        .bid-input-wrap { position:relative; margin-bottom:14px; }
        .bid-input { width:100%; padding:14px 16px 14px 60px; border:2px solid rgba(245,158,11,.3); border-radius:14px; background:rgba(255,255,255,.06); color:#fff; font-size:18px; font-weight:700; font-family:'Cairo',sans-serif; box-sizing:border-box; direction:ltr; }
        .bid-input:focus { outline:none; border-color:#f59e0b; }
        .bid-currency { position:absolute; left:16px; top:50%; transform:translateY(-50%); color:rgba(255,255,255,.5); font-size:14px; font-weight:700; }
        .bid-quick { display:flex; gap:8px; margin-bottom:16px; flex-wrap:wrap; }
        .quick-btn { padding:6px 14px; border-radius:10px; border:1px solid rgba(245,158,11,.3); background:rgba(245,158,11,.08); color:#f59e0b; font-size:13px; font-weight:700; cursor:pointer; font-family:'Cairo',sans-serif; transition:all .2s; }
        .quick-btn:hover { background:rgba(245,158,11,.2); }
        .submit-bid { width:100%; padding:15px; background:linear-gradient(135deg,#f59e0b,#d97706); color:#1a1100; font-weight:900; font-size:16px; border:none; border-radius:14px; cursor:pointer; font-family:'Cairo',sans-serif; transition:transform .2s,box-shadow .2s; }
        .submit-bid:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(245,158,11,.45); }
        .deposit-note { background:rgba(245,158,11,.07); border:1px solid rgba(245,158,11,.15); border-radius:12px; padding:12px 14px; font-size:12px; color:rgba(255,255,255,.65); line-height:1.7; margin-top:12px; }
        .deposit-note strong { color:#f59e0b; }

        /* BIDS HISTORY */
        .bid-row { display:flex; align-items:center; justify-content:space-between; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.06); }
        .bid-row:last-child { border-bottom:none; }
        .bid-user { display:flex; align-items:center; gap:10px; }
        .bid-avatar { width:34px; height:34px; border-radius:50%; background:rgba(56,189,248,.15); border:1px solid rgba(56,189,248,.25); display:flex; align-items:center; justify-content:center; color:#38bdf8; font-size:14px; flex-shrink:0; }
        .bid-name { font-size:13px; color:rgba(255,255,255,.8); font-weight:600; }
        .bid-time { font-size:11px; color:rgba(255,255,255,.35); margin-top:2px; }
        .bid-amount { font-size:16px; font-weight:900; color:#f59e0b; direction:ltr; }
        .bid-amount.top { font-size:18px; }
        .badge-top { font-size:10px; font-weight:700; background:rgba(245,158,11,.15); border:1px solid rgba(245,158,11,.25); color:#f59e0b; padding:2px 8px; border-radius:6px; margin-top:3px; display:block; text-align:center; }

        /* STEPS */
        .steps-list { display:flex; flex-direction:column; gap:12px; }
        .step-item { display:flex; gap:14px; align-items:flex-start; }
        .step-num-sm { width:28px; height:28px; border-radius:50%; background:rgba(245,158,11,.15); border:1px solid rgba(245,158,11,.25); color:#f59e0b; font-size:12px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px; }
        .step-item h5 { font-size:13px; font-weight:700; color:#fff; margin:0 0 2px; }
        .step-item p { font-size:12px; color:rgba(255,255,255,.55); margin:0; line-height:1.6; }

        /* SUCCESS/ERROR ALERTS */
        .alert-success { background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.25); border-radius:14px; padding:14px 18px; color:#34d399; font-weight:700; margin-bottom:20px; }
        .alert-error   { background:rgba(239,68,68,.1);  border:1px solid rgba(239,68,68,.25);  border-radius:14px; padding:14px 18px; color:#f87171; font-weight:700; margin-bottom:20px; }

        @media(max-width:860px){ .main-grid{grid-template-columns:1fr;} .brand-header{grid-template-columns:auto 1fr;} .auction-timer{grid-column:1/-1;} }
    </style>
</head>
<body class="inner-page">
<canvas id="bg-canvas" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none;opacity:0.45;"></canvas>

@include('partials.public_nav')

<div class="detail-wrap">

    {{-- BACK --}}
    <a href="{{ route('brands.auction') }}" style="display:inline-flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);text-decoration:none;font-size:13px;margin-bottom:20px;transition:color .2s;" onmouseover="this.style.color='#f59e0b'" onmouseout="this.style.color='rgba(255,255,255,.5)'">
        <i class="fa fa-arrow-right"></i> العودة للمزادات
    </a>

    {{-- ALERTS --}}
    @if(session('bid_success'))
    <div class="alert-success"><i class="fa fa-check-circle"></i> {{ session('bid_success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert-error"><i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    {{-- BRAND HEADER --}}
    <div class="brand-header">
        <div class="brand-logo-big">
            @if($auction->brand->logo_url)
                <img src="{{ $auction->brand->logo_url }}" alt="{{ $auction->brand->name }}">
            @else
                {{ mb_substr($auction->brand->name, 0, 2) }}
            @endif
        </div>
        <div class="brand-header-info">
            <h1>{{ $auction->brand->name }}</h1>
            @if($auction->brand->name_en)<div class="en">{{ $auction->brand->name_en }}</div>@endif
            <div class="brand-header-tags">
                <span class="htag gold"><i class="fa fa-gavel"></i> مزاد نشط</span>
                <span class="htag">{{ $auction->brand->category }}</span>
                @if($auction->brand->is_featured)<span class="htag green"><i class="fa fa-star"></i> مميز</span>@endif
                @foreach(array_slice($auction->brand->available_regions ?? [], 0, 2) as $r)
                <span class="htag"><i class="fa fa-map-marker-alt"></i> {{ $r }}</span>
                @endforeach
            </div>
        </div>
        <div class="auction-timer">
            @if($auction->isActive())
            <div style="font-size:11px;color:rgba(255,255,255,.45);margin-bottom:8px;text-align:center;">ينتهي المزاد بعد</div>
            <div class="timer-box" data-end="{{ $auction->ends_at->toIso8601String() }}">
                <div class="tunit"><span class="tnum day">--</span><span class="tlbl">يوم</span></div>
                <div class="tunit"><span class="tnum hour">--</span><span class="tlbl">ساعة</span></div>
                <div class="tunit"><span class="tnum min">--</span><span class="tlbl">دقيقة</span></div>
                <div class="tunit"><span class="tnum sec">--</span><span class="tlbl">ثانية</span></div>
            </div>
            @else
            <div class="timer-ended"><i class="fa fa-flag-checkered"></i> انتهى المزاد</div>
            @endif
        </div>
    </div>

    <div class="main-grid">

        {{-- LEFT: info + history --}}
        <div>

            {{-- CURRENT PRICE --}}
            <div class="panel">
                <div class="panel-title"><i class="fa fa-chart-line"></i> حالة المزاد</div>
                <div class="price-big">{{ number_format($auction->current_bid) }} <span>ريال</span></div>
                <div class="price-meta">
                    <span class="pmeta">سعر البداية: <strong>{{ number_format($auction->starting_bid) }} ر.س</strong></span>
                    <span class="pmeta">إجمالي المزايدات: <strong>{{ $auction->bids_count }}</strong></span>
                    <span class="pmeta">الحد الأدنى التالي: <strong>{{ number_format($auction->minNextBid()) }} ر.س</strong></span>
                </div>
            </div>

            {{-- ABOUT --}}
            @if($auction->brand->description)
            <div class="panel">
                <div class="panel-title"><i class="fa fa-info-circle"></i> عن العلامة التجارية</div>
                <p style="color:rgba(255,255,255,.7);font-size:14px;line-height:1.8;margin:0;">{{ $auction->brand->description }}</p>
                @if(!empty($auction->brand->requirements))
                <div style="margin-top:16px;">
                    <div style="font-size:13px;font-weight:700;color:rgba(255,255,255,.8);margin-bottom:10px;">المتطلبات</div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach($auction->brand->requirements as $req)
                        <span style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.2);color:#34d399;padding:4px 12px;border-radius:8px;font-size:12px;font-weight:700;">
                            <i class="fa fa-check"></i> {{ $req }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

            {{-- GALLERY --}}
            @if($auction->brand->images->isNotEmpty())
            <div class="panel">
                <div class="panel-title"><i class="fa fa-images"></i> معرض الصور</div>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;">
                    @foreach($auction->brand->images as $img)
                    <div style="border-radius:12px;overflow:hidden;aspect-ratio:16/9;background:rgba(255,255,255,.05);">
                        <img src="{{ $img->url }}" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- BID HISTORY --}}
            <div class="panel">
                <div class="panel-title"><i class="fa fa-history"></i> سجل المزايدات ({{ $auction->bids_count }})</div>
                @forelse($auction->bids->take(10) as $i => $bid)
                <div class="bid-row">
                    <div class="bid-user">
                        <div class="bid-avatar"><i class="fa fa-user"></i></div>
                        <div>
                            <div class="bid-name">
                                {{ $i === 0 ? $bid->user->name : mb_substr($bid->user->name,0,1).'***' }}
                                @if($i === 0)<span style="font-size:10px;color:#f59e0b;font-weight:700;margin-right:6px;">المتقدم</span>@endif
                            </div>
                            <div class="bid-time">{{ $bid->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div style="text-align:left;">
                        <div class="bid-amount {{ $i===0?'top':'' }}">{{ number_format($bid->amount) }} ر.س</div>
                        @if($i===0)<span class="badge-top">الأعلى</span>@endif
                    </div>
                </div>
                @empty
                <div style="text-align:center;color:rgba(255,255,255,.35);padding:24px;font-size:14px;">
                    <i class="fa fa-gavel" style="font-size:2rem;margin-bottom:8px;display:block;"></i>
                    لا توجد مزايدات بعد. كن أول من يزايد!
                </div>
                @endforelse
            </div>

        </div>

        {{-- RIGHT: bid form + steps --}}
        <div>

            {{-- BID FORM --}}
            <div class="panel" style="position:sticky;top:90px;">
                @if($auction->isActive())
                    @auth
                    <div class="panel-title"><i class="fa fa-gavel"></i> قدّم مزايدتك</div>
                    <form method="POST" action="{{ route('brands.auction.bid', $auction) }}" class="bid-form" id="bidForm">
                        @csrf
                        <div style="font-size:12px;color:rgba(255,255,255,.5);margin-bottom:8px;">الحد الأدنى: <strong style="color:#f59e0b;">{{ number_format($auction->minNextBid()) }} ريال</strong></div>
                        <div class="bid-input-wrap">
                            <input type="number" name="amount" id="bidAmount" class="bid-input"
                                   min="{{ $auction->minNextBid() }}" step="500"
                                   value="{{ old('amount', $auction->minNextBid()) }}"
                                   placeholder="{{ number_format($auction->minNextBid()) }}" required>
                            <span class="bid-currency">ر.س</span>
                        </div>
                        <div class="bid-quick">
                            @foreach([0, 5000, 10000, 25000] as $add)
                            <button type="button" class="quick-btn" onclick="addAmount({{ $auction->minNextBid() + $add }})">
                                {{ $add === 0 ? 'الحد الأدنى' : '+'.number_format($add) }}
                            </button>
                            @endforeach
                        </div>
                        <button type="button" class="submit-bid" onclick="openPaymentModal()">
                            <i class="fa fa-gavel"></i> تقديم المزايدة
                        </button>
                        <div class="deposit-note">
                            <strong><i class="fa fa-info-circle"></i> وديعة المزايدة:</strong>
                            {{ number_format($auction->deposit_amount) }} ريال — محجوزة في حساب ضمان ومستردة إن لم تفز.
                            <br><strong>تنبيه:</strong> مزايدتك ملزمة قانونياً عند الفوز. عند الفوز لديك 72 ساعة لإتمام الدفع.
                        </div>
                    </form>

                    {{-- Payment Modal --}}
                    <div id="paymentModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
                        <div style="background:linear-gradient(180deg,#0d1f3c,#0f2850);border:1px solid rgba(255,255,255,.12);border-radius:20px;padding:32px 30px;width:460px;max-width:95vw;direction:rtl;box-shadow:0 30px 80px rgba(0,0,0,.6);">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                                <h3 style="margin:0;font-size:1.1rem;font-weight:900;color:#fff;"><i class="fa fa-lock" style="color:#f59e0b;margin-left:8px;"></i> تأكيد الوديعة والمزايدة</h3>
                                <button onclick="closePaymentModal()" style="background:rgba(255,255,255,.08);border:none;color:rgba(255,255,255,.6);width:32px;height:32px;border-radius:8px;cursor:pointer;font-size:1rem;">✕</button>
                            </div>

                            {{-- Amount summary --}}
                            <div style="background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.2);border-radius:14px;padding:16px;margin-bottom:20px;">
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                                    <span style="font-size:.85rem;color:rgba(255,255,255,.6);">قيمة مزايدتك</span>
                                    <span id="payModalBidAmt" style="font-size:1.3rem;font-weight:900;color:#f59e0b;direction:ltr;">— ر.س</span>
                                </div>
                                <div style="display:flex;justify-content:space-between;align-items:center;">
                                    <span style="font-size:.85rem;color:rgba(255,255,255,.6);">وديعة الضمان المطلوبة</span>
                                    <span style="font-size:1rem;font-weight:800;color:#fff;direction:ltr;">{{ number_format($auction->deposit_amount) }} ر.س</span>
                                </div>
                            </div>

                            {{-- Bank transfer info --}}
                            <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:16px;margin-bottom:20px;">
                                <div style="font-size:.82rem;font-weight:800;color:#f59e0b;margin-bottom:12px;"><i class="fa fa-university"></i> بيانات التحويل البنكي</div>
                                <div style="display:grid;gap:8px;">
                                    <div style="display:flex;justify-content:space-between;font-size:.83rem;">
                                        <span style="color:rgba(255,255,255,.5);">اسم المستفيد</span>
                                        <span style="color:#fff;font-weight:700;">شركة أمر تم للخدمات</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:.83rem;">
                                        <span style="color:rgba(255,255,255,.5);">رقم الآيبان</span>
                                        <span style="color:#fff;font-weight:700;direction:ltr;font-family:monospace;">SA12 1000 0001 2345 6789 1234</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:.83rem;">
                                        <span style="color:rgba(255,255,255,.5);">البنك</span>
                                        <span style="color:#fff;font-weight:700;">البنك الأهلي السعودي</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:.83rem;">
                                        <span style="color:rgba(255,255,255,.5);">المبلغ</span>
                                        <span style="color:#f59e0b;font-weight:900;direction:ltr;">{{ number_format($auction->deposit_amount) }} ر.س</span>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;font-size:.83rem;">
                                        <span style="color:rgba(255,255,255,.5);">رقم المرجع</span>
                                        <span style="color:#38bdf8;font-weight:700;direction:ltr;font-family:monospace;" id="payRefNum">AUC-{{ $auction->id }}-{{ auth()->id() }}</span>
                                    </div>
                                </div>
                            </div>

                            <div style="background:rgba(239,68,68,.07);border:1px solid rgba(239,68,68,.15);border-radius:10px;padding:10px 14px;margin-bottom:20px;font-size:.8rem;color:rgba(255,255,255,.6);line-height:1.6;">
                                <i class="fa fa-exclamation-triangle" style="color:#f59e0b;"></i>
                                بعد التحويل سيتم مراجعة الوديعة خلال <strong style="color:#fff;">ساعتين</strong>. مزايدتك ستُسجَّل فور التحقق. الوديعة مستردة بالكامل إن لم تفز.
                            </div>

                            <div style="display:flex;gap:10px;">
                                <button type="button" onclick="closePaymentModal()" style="flex:1;padding:12px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.7);border-radius:12px;cursor:pointer;font-family:'Cairo',sans-serif;font-weight:700;">إلغاء</button>
                                <button type="button" onclick="confirmBidSubmit()" style="flex:2;padding:12px;background:linear-gradient(135deg,#f59e0b,#d97706);color:#1a1100;font-weight:900;font-size:.95rem;border:none;border-radius:12px;cursor:pointer;font-family:'Cairo',sans-serif;">
                                    <i class="fa fa-check-circle"></i> أكدت التحويل — سجّل مزايدتي
                                </button>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="panel-title"><i class="fa fa-gavel"></i> للمزايدة سجّل الدخول</div>
                    <a href="{{ route('brands.auction.intent', ['brand'=>$auction->brand->name,'bid'=>$auction->current_bid,'start'=>$auction->starting_bid,'class'=>'auction']) }}"
                       style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px;background:linear-gradient(135deg,#f59e0b,#d97706);color:#1a1100;font-weight:900;font-size:16px;border-radius:14px;text-decoration:none;box-sizing:border-box;">
                        <i class="fa fa-sign-in-alt"></i> سجّل الدخول للمزايدة
                    </a>
                    <div style="text-align:center;margin-top:12px;font-size:13px;color:rgba(255,255,255,.4);">
                        ليس لديك حساب؟ <a href="/register" style="color:#38bdf8;font-weight:700;">سجّل الآن</a>
                    </div>
                    @endauth

                @else
                <div style="text-align:center;padding:20px 0;">
                    <i class="fa fa-flag-checkered" style="font-size:2.5rem;color:#f59e0b;margin-bottom:12px;display:block;"></i>
                    <div style="font-size:16px;font-weight:800;color:#fff;margin-bottom:8px;">انتهى هذا المزاد</div>
                    @if($auction->winner)
                    <div style="font-size:13px;color:rgba(255,255,255,.55);">
                        الفائز: <strong style="color:#f59e0b;">{{ mb_substr($auction->winner->name,0,1).'***' }}</strong>
                        بمبلغ {{ number_format($auction->current_bid) }} ريال
                    </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- AUCTION STEPS --}}
            <div class="panel">
                <div class="panel-title"><i class="fa fa-list-ol"></i> خطوات المزاد</div>
                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-num-sm">١</div>
                        <div><h5>ادفع الوديعة</h5><p>{{ number_format($auction->deposit_amount) }} ريال محجوزة في حساب ضمان ومستردة إن لم تفز.</p></div>
                    </div>
                    <div class="step-item">
                        <div class="step-num-sm">٢</div>
                        <div><h5>زايد بثقة</h5><p>الحد الأدنى للزيادة {{ number_format($auction->increment_amount) }} ريال. تمديد تلقائي 15 دقيقة آخر ساعة.</p></div>
                    </div>
                    <div class="step-item">
                        <div class="step-num-sm">٣</div>
                        <div><h5>إشعار الفوز</h5><p>يصلك إشعار فوري عند انتهاء المزاد مع ملخص الصفقة.</p></div>
                    </div>
                    <div class="step-item">
                        <div class="step-num-sm">٤</div>
                        <div><h5>أتمم الدفع</h5><p>72 ساعة لإتمام الدفع الكامل عبر التحويل البنكي أو بطاقة الائتمان.</p></div>
                    </div>
                    <div class="step-item">
                        <div class="step-num-sm">٥</div>
                        <div><h5>نقل الملكية SAIP</h5><p>نرفع طلب نقل العلامة لـ SAIP بعد إتمام الدفع. رسوم 575 ريال.</p></div>
                    </div>
                    <div class="step-item">
                        <div class="step-num-sm">٦</div>
                        <div><h5>استلم شهادة الملكية</h5><p>تستلم شهادة التسجيل الجديدة بعد قبول SAIP ونشره رسمياً.</p></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('partials.public_footer')

<script src="https://cdn.jsdelivr.net/npm/three@0.158.0/build/three.min.js"></script>
<script>
/* Three.js background */
(function(){
    const c=document.getElementById('bg-canvas'); if(!c||!window.THREE)return;
    const scene=new THREE.Scene(), cam=new THREE.PerspectiveCamera(60,innerWidth/innerHeight,.1,1000);
    cam.position.z=14;
    const rdr=new THREE.WebGLRenderer({canvas:c,alpha:true,antialias:true});
    rdr.setSize(innerWidth,innerHeight); rdr.setClearColor(0,0);
    const N=80,g=new THREE.BufferGeometry(),pos=new Float32Array(N*3),vel=[];
    for(let i=0;i<N;i++){pos[i*3]=(Math.random()-.5)*28;pos[i*3+1]=(Math.random()-.5)*28;pos[i*3+2]=0;vel.push({x:(Math.random()-.5)*.01,y:(Math.random()-.5)*.01});}
    g.setAttribute('position',new THREE.BufferAttribute(pos,3));
    scene.add(new THREE.Points(g,new THREE.PointsMaterial({color:0xf59e0b,size:.08,transparent:true,opacity:.35})));
    (function loop(){requestAnimationFrame(loop);for(let i=0;i<N;i++){pos[i*3]+=vel[i].x;pos[i*3+1]+=vel[i].y;if(Math.abs(pos[i*3])>14)vel[i].x*=-1;if(Math.abs(pos[i*3+1])>14)vel[i].y*=-1;}g.attributes.position.needsUpdate=true;rdr.render(scene,cam);})();
    window.addEventListener('resize',()=>{cam.aspect=innerWidth/innerHeight;cam.updateProjectionMatrix();rdr.setSize(innerWidth,innerHeight);});
})();

/* Countdown */
const timerEl = document.querySelector('.timer-box[data-end]');
if (timerEl) {
    const end = new Date(timerEl.dataset.end).getTime();
    function tick() {
        const diff = end - Date.now();
        if (diff <= 0) { timerEl.innerHTML = '<span class="timer-ended">انتهى المزاد</span>'; return; }
        const d=Math.floor(diff/86400000), h=Math.floor(diff%86400000/3600000), m=Math.floor(diff%3600000/60000), s=Math.floor(diff%60000/1000);
        timerEl.querySelector('.day').textContent  = String(d).padStart(2,'0');
        timerEl.querySelector('.hour').textContent = String(h).padStart(2,'0');
        timerEl.querySelector('.min').textContent  = String(m).padStart(2,'0');
        timerEl.querySelector('.sec').textContent  = String(s).padStart(2,'0');
    }
    tick(); setInterval(tick, 1000);
}

/* Quick amount buttons */
function addAmount(val) {
    const inp = document.getElementById('bidAmount');
    if (inp) inp.value = val;
}

/* Payment modal */
function openPaymentModal() {
    const inp = document.getElementById('bidAmount');
    const min = {{ $auction->minNextBid() }};
    const val = parseFloat(inp?.value) || min;
    if (val < min) { inp.focus(); inp.style.borderColor='#ef4444'; return; }
    inp.style.borderColor = '';
    const display = val.toLocaleString('ar-SA') + ' ر.س';
    document.getElementById('payModalBidAmt').textContent = display;
    document.getElementById('paymentModal').style.display = 'flex';
}
function closePaymentModal() {
    document.getElementById('paymentModal').style.display = 'none';
}
function confirmBidSubmit() {
    const btn = document.querySelector('#paymentModal button[onclick="confirmBidSubmit()"]');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> جارٍ التسجيل...';
    document.getElementById('bidForm').submit();
}
document.getElementById('paymentModal')?.addEventListener('click', function(e) {
    if (e.target === this) closePaymentModal();
});
</script>
</body>
</html>
