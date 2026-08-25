@extends('layouts.dashboard')

@section('title', 'لوحة التحكم — مالك قاعة')
@section('page-title', 'لوحة التحكم')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item {{ request()->routeIs('owner.hall-info') ? 'active' : '' }}">
        <i class="fas fa-info-circle"></i> معلومات القاعة
    </a>
    <a href="{{ route('owner.media') }}" class="nav-item {{ request()->routeIs('owner.media') ? 'active' : '' }}">
        <i class="fas fa-images"></i> ميديا القاعة
    </a>
    <a href="{{ route('owner.features') }}" class="nav-item {{ request()->routeIs('owner.features') ? 'active' : '' }}">
        <i class="fas fa-star"></i> مميزات القاعة
    </a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item {{ request()->routeIs('owner.additional-features') ? 'active' : '' }}">
        <i class="fas fa-star"></i> مميزات إضافية في القاعة
    </a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item {{ request()->routeIs('owner.seasonal-prices') ? 'active' : '' }}">
        <i class="fas fa-tags"></i> الأسعار الموسمية
    </a>
    <a href="{{ route('owner.offers') }}" class="nav-item {{ request()->routeIs('owner.offers') ? 'active' : '' }}">
        <i class="fas fa-gift"></i> العروض الخاصة
    </a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item {{ request()->routeIs('owner.busy-dates') ? 'active' : '' }}">
        <i class="fas fa-calendar-times"></i> الأيام المشغولة
    </a>
    <a href="{{ route('owner.bookings') }}" class="nav-item {{ request()->routeIs('owner.bookings') ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> الحجوزات
    </a>
    <a href="{{ route('owner.documents') }}" class="nav-item {{ request()->routeIs('owner.documents') ? 'active' : '' }}">
        <i class="fas fa-file-alt"></i> وثائق التوثيق
    </a>
    <a href="{{ route('owner.partners') }}" class="nav-item {{ request()->routeIs('owner.partners') ? 'active' : '' }}">
        <i class="fas fa-handshake"></i> الشركاء
    </a>
@endsection

@section('content')

    @unless($hall)
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            لم تقم بإنشاء قاعتك بعد. &nbsp;
            <a href="{{ route('owner.hall-info') }}" style="font-weight:700; color: inherit;">ابدأ الآن ←</a>
        </div>
    @endunless

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['total_bookings'] }}</h3>
                <p>إجمالي الحجوزات</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['pending_bookings'] }}</h3>
                <p>حجوزات معلقة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['confirmed_bookings'] }}</h3>
                <p>حجوزات مؤكدة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-calendar-times"></i></div>
            <div class="stat-info">
                <h3>{{ $stats['busy_dates'] }}</h3>
                <p>أيام مشغولة</p>
            </div>
        </div>
    </div>

    @if($hall)
        <!-- Hall Status -->
        <div class="card">
            <div class="card-header">
                <span class="card-title"><i class="fas fa-building"></i> معلومات القاعة</span>
                <a href="{{ route('owner.hall-info') }}" class="btn btn-outline btn-sm">
                    <i class="fas fa-edit"></i> تعديل
                </a>
            </div>
            <div class="card-body">
                <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
                    @if($hall->profile_photo)
                        <img src="{{ route('public.storage', ['path' => $hall->profile_photo]) }}" alt="{{ $hall->name }}"
                             style="width:80px; height:80px; border-radius:10px; object-fit:cover;">
                    @else
                        <div style="width:80px; height:80px; border-radius:10px; background:#e8f5ee; display:flex; align-items:center; justify-content:center; font-size:2rem; color:#1a5c38;">
                            <i class="fas fa-building"></i>
                        </div>
                    @endif
                    <div>
                        <h3 style="font-size:1.2rem; font-weight:700; margin-bottom:6px;">{{ $hall->name }}</h3>
                        <div style="color:#6c7a72; font-size:.88rem; display:flex; gap:16px; flex-wrap:wrap;">
                            <span><i class="fas fa-map-marker-alt"></i> {{ $hall->city }}</span>
                            <span><i class="fas fa-users"></i> {{ $hall->capacity }} شخص</span>
                            <span><i class="fas fa-money-bill-alt"></i> {{ number_format($hall->price_per_day) }} ريال/يوم</span>
                        </div>
                    </div>
                    <div style="margin-right:auto;">
                        @php
                            $statusLabels = ['pending'=>'قيد المراجعة','under_review'=>'تحت المراجعة','active'=>'نشط','inactive'=>'غير نشط'];
                            $statusClasses = ['pending'=>'badge-warning','under_review'=>'badge-info','active'=>'badge-success','inactive'=>'badge-secondary'];
                            $sv = $hall->status->value;
                        @endphp
                        <span class="badge {{ $statusClasses[$sv] ?? 'badge-secondary' }}">
                            {{ $statusLabels[$sv] ?? $sv }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        @if($bookings->count() > 0)
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><i class="fas fa-calendar-alt"></i> آخر الحجوزات</span>
                    <a href="{{ route('owner.bookings') }}" class="btn btn-outline btn-sm">عرض الكل</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>العميل</th>
                                <th>تاريخ الحجز</th>
                                <th>المناسبة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name ?? '—' }}</td>
                                <td>{{ $booking->booking_date->format('Y/m/d') }}</td>
                                <td>{{ $booking->occasion_type->label() }}</td>
                                <td>
                                    @php
                                        $bc = ['pending'=>'badge-warning','confirmed'=>'badge-success','cancelled'=>'badge-danger'];
                                        $bl = ['pending'=>'معلق','confirmed'=>'مؤكد','cancelled'=>'ملغي'];
                                        $bv = $booking->status->value;
                                    @endphp
                                    <span class="badge {{ $bc[$bv] ?? 'badge-secondary' }}">{{ $bl[$bv] ?? $bv }}</span>
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
