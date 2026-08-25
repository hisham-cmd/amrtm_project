@extends('layouts.dashboard')

@section('title', 'الحجوزات')
@section('page-title', 'الحجوزات')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item"><i class="fas fa-calendar-times"></i> الأيام المشغولة</a>
    <a href="{{ route('owner.bookings') }}" class="nav-item active"><i class="fas fa-calendar-check"></i> الحجوزات</a>
    <a href="{{ route('owner.documents') }}" class="nav-item"><i class="fas fa-file-alt"></i> وثائق التوثيق</a>
    <a href="{{ route('owner.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@unless($hall)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        يجب إنشاء القاعة أولاً. <a href="{{ route('owner.hall-info') }}" style="font-weight:700;">أنشئ القاعة ←</a>
    </div>
@else

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-calendar-alt"></i> جميع الحجوزات</span>
    </div>
    @if($bookings->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-calendar-check" style="font-size:2.5rem; opacity:.4; display:block; margin-bottom:10px;"></i>
            لا توجد حجوزات بعد
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العميل</th>
                        <th>رقم الجوال</th>
                        <th>تاريخ الحجز</th>
                        <th>المناسبة</th>
                        <th>عدد الضيوف</th>
                        <th>الحالة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        @php
                            $bv = $booking->status->value;
                            $bc = ['pending'=>'badge-warning','confirmed'=>'badge-success','cancelled'=>'badge-danger'];
                            $bl = ['pending'=>'معلق','confirmed'=>'مؤكد','cancelled'=>'ملغي'];
                        @endphp
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>
                                <strong>{{ $booking->user->name ?? '—' }}</strong><br>
                                <small style="color:#6c7a72;">{{ $booking->user->email ?? '' }}</small>
                            </td>
                            <td>{{ $booking->user->phone ?? '—' }}</td>
                            <td>{{ $booking->booking_date->format('Y/m/d') }}</td>
                            <td>{{ $booking->occasion_type->label() }}</td>
                            <td>{{ $booking->guests_count ?? '—' }}</td>
                            <td><span class="badge {{ $bc[$bv] ?? 'badge-secondary' }}">{{ $bl[$bv] ?? $bv }}</span></td>
                            <td>
                                @if($bv === 'pending')
                                    <div style="display:flex; gap:6px;">
                                        <form method="POST" action="{{ route('owner.bookings.status', $booking->id) }}">
                                            @csrf
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check"></i> قبول
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('owner.bookings.status', $booking->id) }}"
                                              onsubmit="return confirm('هل تريد رفض هذا الحجز؟')">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> رفض
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span style="color:#6c7a72; font-size:.82rem;">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body" style="padding-top:0;">
            {{ $bookings->links() }}
        </div>
    @endif
</div>

@endunless

@endsection
