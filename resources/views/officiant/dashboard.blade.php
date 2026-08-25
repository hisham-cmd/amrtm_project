@extends('layouts.dashboard')

@section('title', 'لوحة التحكم — المأذون الشرعي')
@section('page-title', 'لوحة التحكم')

@section('sidebar-nav')
    <a href="{{ route('officiant.dashboard') }}" class="nav-item {{ request()->routeIs('officiant.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('officiant.profile-setup') }}" class="nav-item {{ request()->routeIs('officiant.profile-setup') ? 'active' : '' }}">
        <i class="fas fa-info-circle"></i> بيانات البروفايل
    </a>
    <a href="{{ route('officiant.media') }}" class="nav-item {{ request()->routeIs('officiant.media') ? 'active' : '' }}">
        <i class="fas fa-images"></i> معرض الصور
    </a>
    <a href="{{ route('officiant.services') }}" class="nav-item {{ request()->routeIs('officiant.services') ? 'active' : '' }}">
        <i class="fas fa-list-check"></i> خدماتي وأسعاري
    </a>
    <a href="{{ route('officiant.bookings') }}" class="nav-item {{ request()->routeIs('officiant.bookings') ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> طلبات الحجز
        @if($pendingCount > 0)
            <span style="background:#ef4444;color:#fff;font-size:10px;font-weight:800;padding:1px 7px;border-radius:20px;margin-right:auto;">{{ $pendingCount }}</span>
        @endif
    </a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-list-check"></i></div>
        <div class="stat-info">
            <h3>{{ $services->count() }}</h3>
            <p>خدماتي</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-images"></i></div>
        <div class="stat-info">
            <h3>{{ $media->count() }}</h3>
            <p>صور المعرض</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-calendar-check"></i></div>
        <div class="stat-info">
            <h3>{{ $pendingCount }}</h3>
            <p>طلبات جديدة</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon {{ $profile?->status === 'active' ? 'green' : ($profile?->status === 'rejected' ? 'red' : 'gold') }}">
            <i class="fas fa-circle-check"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $profile ? match($profile->status) { 'active' => 'نشط', 'rejected' => 'مرفوض', default => 'قيد المراجعة' } : '—' }}</h3>
            <p>حالة الحساب</p>
        </div>
    </div>
</div>

@if($profile)
<!-- Profile preview card -->
<div class="card" style="margin-top:20px;">
    <div class="card-header" style="justify-content: space-between;">
        <span class="card-title"><i class="fas fa-id-card" style="color:var(--green); margin-left:8px;"></i> بروفايلي</span>
        <a href="{{ route('officiant.profile-setup') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-edit"></i> تعديل
        </a>
    </div>
    <div class="card-body">
        <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
            @if($profile->profile_photo_url)
            <img src="{{ $profile->profile_photo_url }}" alt="صورة البروفايل" style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:2px solid #eef2ef;">
            @else
            <div style="width:80px; height:80px; border-radius:50%; background:#e8f5ee; display:flex; align-items:center; justify-content:center; font-size:2rem; color:#1a5c38;">
                <i class="fas fa-user-circle"></i>
            </div>
            @endif
            <div style="flex:1; min-width:0;">
                <div style="font-size:1.2rem; font-weight:800; color:#0f3d24;">{{ auth()->user()->name }}</div>
                <div style="font-size:0.9rem; color:#6c7a72; margin-top:4px;">مأذون شرعي &mdash; {{ $profile->city ?? '' }}</div>
                <div style="display:flex; gap:16px; margin-top:12px; flex-wrap:wrap; font-size:0.9rem;">
                    @if($profile->phone)
                    <span style="color:#6c7a72;"><i class="fas fa-phone" style="color:var(--green); margin-left:4px;"></i> {{ $profile->phone }}</span>
                    @endif
                    @if($profile->working_hours)
                    <span style="color:#6c7a72;"><i class="fas fa-clock" style="color:var(--green); margin-left:4px;"></i> {{ $profile->working_hours }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Card -->
@if($profile->status === 'active')
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-qrcode" style="color:var(--green);margin-left:8px;"></i> QR Code البروفايل</span>
    </div>
    <div class="card-body" style="display:flex;align-items:center;gap:24px;flex-wrap:wrap;">
        <div style="background:#f0f4f2;border-radius:12px;padding:10px;box-shadow:0 2px 8px rgba(0,0,0,.08);flex-shrink:0;">
            <img src="{{ route('officiants.qr', $profile) }}"
                 alt="QR Code"
                 style="width:140px;height:140px;display:block;">
        </div>
        <div style="flex:1;min-width:200px;">
            <p style="font-size:0.95rem;font-weight:700;color:#0f3d24;margin-bottom:6px;">شارك بروفايلك بسهولة!</p>
            <p style="font-size:0.85rem;color:#6c7a72;margin-bottom:16px;line-height:1.6;">يمكنك مشاركة هذا الكود مع عملائك ليصلوا لبروفايلك مباشرة عن طريق مسحه بكاميرا الهاتف.</p>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('officiants.qr', $profile) }}"
                   download="officiant-{{ $profile->id }}-qr.svg"
                   class="btn btn-primary btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="fas fa-download"></i> تحميل QR Code
                </a>
                <a href="{{ route('officiants.profile', $profile) }}" target="_blank"
                   class="btn btn-outline btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="fas fa-external-link-alt"></i> عرض البروفايل
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Services preview -->
@if($services->isNotEmpty())
<div class="card" style="margin-top:20px;">
    <div class="card-header" style="justify-content: space-between;">
        <span class="card-title"><i class="fas fa-list-check" style="color:var(--green); margin-left:8px;"></i> خدماتي</span>
        <a href="{{ route('officiant.services') }}" class="btn btn-outline btn-sm">إدارة الخدمات</a>
    </div>
    <div class="table-wrap">
        <table class="data-table">
            <thead><tr><th>الخدمة</th><th>السعر</th></tr></thead>
            <tbody>
                @foreach($services->take(5) as $svc)
                <tr>
                    <td style="font-weight:600;">{{ $svc->title }}</td>
                    <td>{{ $svc->price ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Recent bookings --}}
@if($recentBookings->isNotEmpty())
<div class="card" style="margin-top:20px;">
    <div class="card-header" style="justify-content: space-between;">
        <span class="card-title">
            <i class="fas fa-calendar-check" style="color:var(--green);margin-left:8px;"></i> آخر طلبات الحجز
            @if($pendingCount > 0)
                <span style="background:#ef4444;color:#fff;font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;margin-right:6px;">{{ $pendingCount }} جديد</span>
            @endif
        </span>
        <a href="{{ route('officiant.bookings') }}" class="btn btn-outline btn-sm">عرض الكل</a>
    </div>
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>العميل</th>
                    <th>الخدمة</th>
                    <th>تاريخ المناسبة</th>
                    <th>الحالة</th>
                    <th>إجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBookings as $booking)
                @php
                    $statusMap = [
                        'pending'   => ['label'=>'قيد الانتظار','bg'=>'#fef9c3','color'=>'#92400e'],
                        'confirmed' => ['label'=>'مؤكد',        'bg'=>'#d1fae5','color'=>'#065f46'],
                        'cancelled' => ['label'=>'ملغي',         'bg'=>'#fee2e2','color'=>'#991b1b'],
                    ];
                    $s = $statusMap[$booking->status] ?? ['label'=>$booking->status,'bg'=>'#f3f4f6','color'=>'#374151'];
                @endphp
                <tr>
                    <td>
                        <div style="font-weight:700;color:#0f3d24;font-size:13px;">{{ $booking->user->name }}</div>
                    </td>
                    <td style="font-size:13px;color:#334155;">{{ $booking->service?->title ?? '—' }}</td>
                    <td style="font-weight:700;color:#1a5c38;font-size:13px;white-space:nowrap;">
                        {{ $booking->event_date?->format('Y/m/d') ?? '—' }}
                    </td>
                    <td>
                        <span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:{{ $s['bg'] }};color:{{ $s['color'] }};">
                            {{ $s['label'] }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('officiant.bookings.status', $booking->id) }}">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                    style="padding:4px 8px;border-radius:8px;border:1.5px solid #d1e8d8;font-family:'Cairo',sans-serif;font-size:11px;color:#0f3d24;outline:none;cursor:pointer;background:#f8fdf9;">
                                <option value="pending"   {{ $booking->status==='pending'   ?'selected':'' }}>قيد الانتظار</option>
                                <option value="confirmed" {{ $booking->status==='confirmed' ?'selected':'' }}>مؤكد</option>
                                <option value="cancelled" {{ $booking->status==='cancelled' ?'selected':'' }}>ملغي</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endif

@endsection
