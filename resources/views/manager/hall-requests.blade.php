@extends('layouts.dashboard')

@section('title', 'طلبات القاعات')
@section('page-title', 'طلبات إضافة القاعات')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item active"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-hourglass-half" style="color:#d97706;"></i> طلبات القاعات المعلقة</span>
        <span style="color:#6c7a72;font-size:.88rem;">{{ $halls->total() }} طلب</span>
    </div>
    @if($halls->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:40px 0;">
            <i class="fas fa-check-circle" style="color:#16a34a;font-size:3rem;display:block;margin-bottom:12px;"></i>
            لا توجد طلبات معلقة — أحسنت!
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم القاعة</th>
                    <th>مالك القاعة</th>
                    <th>المدينة</th>
                    <th>السعة</th>
                    <th>السعر / يوم</th>
                    <th>تاريخ الطلب</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($halls as $hall)
                <tr>
                    <td>{{ $hall->id }}</td>
                    <td><strong>{{ $hall->name }}</strong><br><small style="color:#6c7a72;">{{ $hall->location }}</small></td>
                    <td>{{ $hall->owner->name }}<br><small style="color:#6c7a72;">{{ $hall->owner->phone }}</small></td>
                    <td>{{ $hall->city }}</td>
                    <td>{{ number_format($hall->capacity) }} شخص</td>
                    <td>{{ number_format($hall->price_per_day, 0) }} ر.س</td>
                    <td>{{ $hall->created_at->format('Y/m/d') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <a href="{{ route('manager.halls.review', $hall->id) }}"
                               style="background:#f1f5f9; color:#374151; border-radius:7px; padding:6px 12px; font-size:.8rem; font-weight:700; text-decoration:none; border:1px solid #e2e8f0; white-space:nowrap;">
                                <i class="fas fa-eye"></i> مراجعة
                            </a>
                            <form method="POST" action="{{ route('manager.halls.decide', $hall->id) }}">
                                @csrf
                                <input type="hidden" name="decision" value="active">
                                <button type="submit" style="background:#16a34a;color:#fff;border:none;border-radius:7px;padding:6px 14px;font-size:.82rem;font-weight:700;cursor:pointer;">
                                    <i class="fas fa-check"></i> قبول
                                </button>
                            </form>
                            <form method="POST" action="{{ route('manager.halls.decide', $hall->id) }}" onsubmit="return confirm('هل تريد رفض هذا الطلب؟')">
                                @csrf
                                <input type="hidden" name="decision" value="rejected">
                                <button type="submit" style="background:#dc2626;color:#fff;border:none;border-radius:7px;padding:6px 14px;font-size:.82rem;font-weight:700;cursor:pointer;">
                                    <i class="fas fa-times"></i> رفض
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body" style="padding-top:0;">{{ $halls->links() }}</div>
    @endif
</div>

@endsection
