<!DOCTYPE html>
@php $locale = app()->getLocale(); $dir = $locale === 'ar' ? 'rtl' : 'ltr'; @endphp
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلباتي | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
        $appCss = $manifest['resources/css/app.css']['file'] ?? null;
        $useDevVite = app()->environment(['local','development']) && file_exists(public_path('hot'));
    @endphp
    @if($useDevVite)
        @vite(['resources/css/app.css','resources/js/app.js'])
    @elseif($appCss)
        <link rel="stylesheet" href="{{ asset('build/'.$appCss) }}">
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
    <style>
        body { font-family:'Cairo',sans-serif; background:#f0f4f2; }

        .page-hero {
            background: linear-gradient(135deg,#0f3d24 0%,#1a5c38 60%,#2d8a5a 100%);
            padding: 48px 5% 36px;
            text-align: center;
        }
        .page-hero h1 { font-size:26px; font-weight:800; color:#fff; margin-bottom:8px; }
        .page-hero p  { font-size:14px; color:rgba(255,255,255,.75); }

        .container { max-width:1000px; margin:0 auto; padding:28px 5% 60px; }

        .stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:24px; }
        .stat-box {
            background:#fff; border-radius:14px; padding:16px 18px;
            display:flex; align-items:center; gap:14px;
            box-shadow:0 2px 8px rgba(0,0,0,.06);
        }
        .stat-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
        .stat-icon.blue  { background:#eff6ff; color:#3b82f6; }
        .stat-icon.gold  { background:#fefce8; color:#d97706; }
        .stat-icon.green { background:#f0fdf4; color:#16a34a; }
        .stat-icon.red   { background:#fef2f2; color:#dc2626; }
        .stat-num  { font-size:22px; font-weight:800; color:#0f3d24; line-height:1; }
        .stat-lbl  { font-size:12px; color:#6c7a72; margin-top:2px; }

        .card { background:#fff; border-radius:18px; box-shadow:0 2px 12px rgba(0,0,0,.07); overflow:hidden; }
        .card-head {
            padding:16px 22px; border-bottom:1px solid #f0f4f2;
            display:flex; align-items:center; justify-content:space-between;
        }
        .card-head-title { font-size:16px; font-weight:800; color:#0f3d24; display:flex; align-items:center; gap:8px; }

        .booking-list { display:flex; flex-direction:column; gap:0; }
        .booking-row {
            padding:18px 22px; border-bottom:1px solid #f0f4f2;
            display:grid; grid-template-columns:1fr auto; gap:16px; align-items:start;
        }
        .booking-row:last-child { border-bottom:none; }

        .booking-officiant { font-size:15px; font-weight:800; color:#0f3d24; margin-bottom:4px; }
        .booking-service   { font-size:13px; color:#1a5c38; font-weight:600; margin-bottom:8px; }
        .booking-meta      { display:flex; flex-wrap:wrap; gap:14px; }
        .booking-meta-item { display:flex; align-items:center; gap:5px; font-size:12.5px; color:#6c7a72; }
        .booking-meta-item i { color:#a8c9a4; font-size:11px; }
        .booking-notes { font-size:12px; color:#94a3b8; margin-top:8px; font-style:italic; }

        .status-badge {
            display:inline-flex; align-items:center; gap:5px;
            padding:5px 14px; border-radius:20px; font-size:12px; font-weight:700;
            white-space:nowrap;
        }
        .status-pending   { background:#fef9c3; color:#92400e; }
        .status-confirmed { background:#d1fae5; color:#065f46; }
        .status-cancelled { background:#fee2e2; color:#991b1b; }

        .empty-state { text-align:center; padding:60px 20px; color:#9ca3af; }
        .empty-state i { font-size:3.5rem; opacity:.25; display:block; margin-bottom:16px; }
        .empty-state p { font-size:15px; margin-bottom:20px; }

        @media (max-width:640px) {
            .stats-row { grid-template-columns:repeat(2,1fr); }
            .booking-row { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

@include('partials.header')
@include('partials.sidebar_nav')

{{-- Hero --}}
<div class="page-hero">
    <h1><i class="fa fa-calendar-check" style="margin-left:10px;opacity:.8;"></i>طلباتي</h1>
    <p>متابعة طلبات الحجز التي قدّمتها لمقدمي الخدمات</p>
</div>

<div class="container" dir="rtl">

    @php
        $allItems     = $bookings->getCollection();
        $pendingCount   = $allItems->where('status','pending')->count();
        $confirmedCount = $allItems->where('status','confirmed')->count();
        $cancelledCount = $allItems->where('status','cancelled')->count();
        $totalCount     = $bookings->total();
    @endphp

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-icon blue"><i class="fa fa-inbox"></i></div>
            <div><div class="stat-num">{{ $totalCount }}</div><div class="stat-lbl">إجمالي الطلبات</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon gold"><i class="fa fa-clock"></i></div>
            <div><div class="stat-num">{{ $pendingCount }}</div><div class="stat-lbl">قيد الانتظار</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon green"><i class="fa fa-circle-check"></i></div>
            <div><div class="stat-num">{{ $confirmedCount }}</div><div class="stat-lbl">مؤكدة</div></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon red"><i class="fa fa-circle-xmark"></i></div>
            <div><div class="stat-num">{{ $cancelledCount }}</div><div class="stat-lbl">ملغاة</div></div>
        </div>
    </div>

    {{-- Bookings card --}}
    <div class="card">
        <div class="card-head">
            <div class="card-head-title">
                <i class="fa fa-list-check" style="color:#1a5c38;"></i>
                جميع طلباتك
            </div>
            <a href="{{ route('services.list') }}"
               style="display:inline-flex;align-items:center;gap:6px;padding:7px 16px;border-radius:10px;background:#f0faf4;color:#1a5c38;border:1.5px solid #a8c9a4;font-size:13px;font-weight:700;text-decoration:none;">
                <i class="fa fa-plus" style="font-size:11px;"></i> طلب جديد
            </a>
        </div>

        @if($bookings->isEmpty())
        <div class="empty-state">
            <i class="fa fa-calendar-xmark"></i>
            <p>لم تقدّم أي طلب حجز بعد</p>
            <a href="{{ route('services.list') }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:11px 24px;background:#1a5c38;color:#fff;border-radius:12px;font-size:14px;font-weight:800;text-decoration:none;">
                <i class="fa fa-search"></i> تصفح مقدمي الخدمات
            </a>
        </div>
        @else
        <div class="booking-list">
            @foreach($bookings as $booking)
            @php
                $statusClass = match($booking->status) {
                    'confirmed' => 'status-confirmed',
                    'cancelled' => 'status-cancelled',
                    default     => 'status-pending',
                };
                $statusLabel = match($booking->status) {
                    'confirmed' => 'مؤكد ✓',
                    'cancelled' => 'ملغي',
                    default     => 'قيد الانتظار',
                };
                $statusIcon = match($booking->status) {
                    'confirmed' => 'fa-circle-check',
                    'cancelled' => 'fa-circle-xmark',
                    default     => 'fa-clock',
                };
            @endphp
            <div class="booking-row">
                <div>
                    {{-- Officiant name --}}
                    <div class="booking-officiant">
                        <i class="fa fa-user-tie" style="color:#1a5c38;margin-left:6px;font-size:13px;"></i>
                        {{ $booking->officiant->user->name ?? '—' }}
                    </div>

                    {{-- Service --}}
                    @if($booking->service)
                    <div class="booking-service">
                        <i class="fa fa-tag" style="font-size:11px;margin-left:4px;"></i>
                        {{ $booking->service->title }}
                        @if($booking->service->price)
                            &mdash; {{ $booking->service->price }} ريال
                        @endif
                    </div>
                    @endif

                    {{-- Meta --}}
                    <div class="booking-meta">
                        <span class="booking-meta-item">
                            <i class="fa fa-calendar"></i>
                            تاريخ المناسبة: <strong style="color:#0f3d24;">{{ $booking->event_date?->format('Y/m/d') ?? '—' }}</strong>
                        </span>
                        <span class="booking-meta-item">
                            <i class="fa fa-phone"></i>
                            {{ $booking->phone ?? '—' }}
                        </span>
                        <span class="booking-meta-item">
                            <i class="fa fa-clock"></i>
                            قُدِّم: {{ $booking->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Notes --}}
                    @if($booking->notes)
                    <div class="booking-notes">
                        <i class="fa fa-note-sticky" style="margin-left:4px;"></i>{{ $booking->notes }}
                    </div>
                    @endif
                </div>

                {{-- Status + profile link --}}
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:10px;">
                    <span class="status-badge {{ $statusClass }}">
                        <i class="fa {{ $statusIcon }}"></i>
                        {{ $statusLabel }}
                    </span>
                    <a href="{{ route('officiants.profile', $booking->officiant_id) }}"
                       style="font-size:11.5px;color:#1a5c38;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:4px;">
                        <i class="fa fa-eye" style="font-size:10px;"></i> عرض الملف
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($bookings->hasPages())
        <div style="padding:16px 22px;border-top:1px solid #f0f4f2;">
            {{ $bookings->links() }}
        </div>
        @endif
        @endif
    </div>

</div>

@include('partials.footer')
</body>
</html>
