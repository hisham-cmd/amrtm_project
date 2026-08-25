@extends('layouts.dashboard')

@section('title', 'طلبات الحجز — المأذون الشرعي')
@section('page-title', 'طلبات الحجز')

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
    </a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

{{-- Stats bar --}}
@php
    $allBookings    = $bookings instanceof \Illuminate\Pagination\LengthAwarePaginator ? $bookings->getCollection() : $bookings;
    $pendingCount   = $profile?->bookings()->where('status','pending')->count()   ?? 0;
    $confirmedCount = $profile?->bookings()->where('status','confirmed')->count() ?? 0;
    $cancelledCount = $profile?->bookings()->where('status','cancelled')->count() ?? 0;
    $totalCount     = $profile?->bookings()->count() ?? 0;
@endphp

<div class="stats-grid" style="margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-inbox"></i></div>
        <div class="stat-info"><h3>{{ $totalCount }}</h3><p>إجمالي الطلبات</p></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-clock"></i></div>
        <div class="stat-info"><h3>{{ $pendingCount }}</h3><p>قيد الانتظار</p></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-circle-check"></i></div>
        <div class="stat-info"><h3>{{ $confirmedCount }}</h3><p>مؤكدة</p></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-circle-xmark"></i></div>
        <div class="stat-info"><h3>{{ $cancelledCount }}</h3><p>ملغاة</p></div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-calendar-check" style="color:var(--green);margin-left:8px;"></i>جميع الطلبات</span>
    </div>

    @if($bookings->isEmpty())
        <div style="text-align:center;padding:60px 20px;color:#9ca3af;">
            <i class="fas fa-inbox" style="font-size:3rem;opacity:.3;display:block;margin-bottom:12px;"></i>
            <p style="font-size:15px;">لا توجد طلبات حجز حتى الآن</p>
        </div>
    @else
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العميل</th>
                    {{-- <th>الخدمة</th> --}}
                    <th>تاريخ المناسبة</th>
                    <th>التواصل</th>
                    <th>الوقت</th>
                    <th>رقم الهاتف </th>
                    {{-- <th>الملاحظات</th> --}}
                    <th>الحالة</th>
                    <th>إجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                @php
                    $statusMap = [
                        'pending'   => ['label'=>'قيد الانتظار','bg'=>'#fef9c3','color'=>'#92400e'],
                        'confirmed' => ['label'=>'مؤكد',        'bg'=>'#d1fae5','color'=>'#065f46'],
                        'cancelled' => ['label'=>'ملغي',         'bg'=>'#fee2e2','color'=>'#991b1b'],
                    ];
                    $s = $statusMap[$booking->status] ?? ['label'=>$booking->status,'bg'=>'#f3f4f6','color'=>'#374151'];
                    $waPhone = preg_replace('/\D/', '', $booking->phone ?? '');
                    $waLink  = $waPhone ? 'https://wa.me/' . $waPhone : null;
                @endphp
                <tr style="vertical-align:middle;">
                    {{-- # --}}
                    <td style="color:#9ca3af;font-size:12px;">{{ $booking->id }}</td>

                    {{-- العميل --}}
                    <td>
                        <div style="font-weight:700;color:#0f3d24;">{{ $booking->user->name }}</div>
                        <div style="font-size:11px;color:#9ca3af;">{{ $booking->created_at->format('Y/m/d') }}</div>
                    </td>

                    {{-- تاريخ المناسبة --}}
                    <td style="font-weight:700;color:#1a5c38;white-space:nowrap;">
                        {{ $booking->event_date?->format('Y/m/d') ?? '—' }}
                    </td>

                    {{-- التواصل --}}
                    <td style="white-space:nowrap;">
                        @if($booking->phone)
                        <div style="display:flex;gap:5px;">
                            <a href="tel:{{ $booking->phone }}"
                               style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;background:#e8f5e9;color:#1a5c38;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none;border:1px solid #a8c9a4;">
                                <i class="fas fa-phone" style="font-size:10px;"></i> اتصال
                            </a>
                            @if($waLink)
                            <a href="{{ $waLink }}" target="_blank" rel="noopener"
                               style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;background:#dcfce7;color:#15803d;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none;border:1px solid #86efac;">
                                <i class="fab fa-whatsapp" style="font-size:12px;"></i> واتساب
                            </a>
                            @endif
                        </div>
                        @else
                        <span style="color:#9ca3af;font-size:12px;">—</span>
                        @endif
                    </td>

                    {{-- الوقت --}}
                    <td style="font-size:12px;color:#6c7a72;white-space:nowrap;">
                        {{ $booking->created_at->format('H:i') }}
                    </td>

                    {{-- رقم الهاتف --}}
                    <td style="font-size:13px;font-weight:700;color:#0f3d24;text-align:center;direction:ltr;vertical-align:middle;">
                        {{ $booking->phone ?? '—' }}
                    </td>

                    {{-- الحالة --}}
                    <td>
                        <span style="display:inline-flex;align-items:center;padding:3px 12px;border-radius:20px;font-size:12px;font-weight:700;background:{{ $s['bg'] }};color:{{ $s['color'] }};">
                            {{ $s['label'] }}
                        </span>
                    </td>

                    {{-- إجراء --}}
                    <td>
                        <form method="POST" action="{{ route('officiant.bookings.status', $booking->id) }}" style="display:flex;gap:6px;">
                            @csrf @method('PATCH')
                            <select name="status"
                                    onchange="this.form.submit()"
                                    style="padding:5px 8px;border-radius:8px;border:1.5px solid #d1e8d8;font-family:'Cairo',sans-serif;font-size:12px;color:#0f3d24;outline:none;cursor:pointer;background:#f8fdf9;">
                                <option value="pending"   {{ $booking->status==='pending'   ? 'selected':'' }}>قيد الانتظار</option>
                                <option value="confirmed" {{ $booking->status==='confirmed' ? 'selected':'' }}>مؤكد</option>
                                <option value="cancelled" {{ $booking->status==='cancelled' ? 'selected':'' }}>ملغي</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #e8f0ec;">
        {{ $bookings->links() }}
    </div>
    @endif
    @endif
</div>

@endsection
