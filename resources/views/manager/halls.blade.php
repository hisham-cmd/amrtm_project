@extends('layouts.dashboard')

@section('title', 'القاعات')
@section('page-title', 'إدارة القاعات')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item active"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@php
$statusMap = [
    'pending'    => ['badge-warning','قيد الانتظار'],
    'under_review'=>['badge-info','تحت المراجعة'],
    'active'     => ['badge-success','نشطة'],
    'inactive'   => ['badge-secondary','غير نشطة'],
    'rejected'   => ['badge-danger','مرفوضة'],
];
@endphp

<div class="card">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <input type="text" name="search" class="form-control" placeholder="ابحث باسم القاعة أو المدينة..." value="{{ request('search') }}">
            </div>
            <div>
                <select name="status" class="form-control">
                    <option value="">جميع الحالات</option>
                    <option value="pending"     {{ request('status')==='pending'    ?'selected':'' }}>قيد الانتظار</option>
                    <option value="active"      {{ request('status')==='active'     ?'selected':'' }}>نشطة</option>
                    <option value="inactive"    {{ request('status')==='inactive'   ?'selected':'' }}>غير نشطة</option>
                    <option value="rejected"    {{ request('status')==='rejected'   ?'selected':'' }}>مرفوضة</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            <a href="{{ route('manager.halls.create') }}" class="btn btn-primary" style="background:#16a34a;border-color:#16a34a;">
                <i class="fas fa-plus"></i> تسجيل قاعة جديدة
            </a>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-building"></i> القاعات</span>
        <span style="color:#6c7a72;font-size:.88rem;">{{ $halls->total() }} قاعة</span>
    </div>
    @if($halls->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:40px 0;">لا توجد قاعات مطابقة</div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>القاعة</th><th>المالك</th><th>المدينة</th><th>السعة</th><th>السعر/يوم</th><th>الحالة</th><th>سُجّل بواسطة</th><th>تاريخ الإضافة</th></tr>
            </thead>
            <tbody>
                @foreach($halls as $hall)
                @php [$bc,$bl] = $statusMap[$hall->status->value] ?? ['badge-secondary','—']; @endphp
                <tr>
                    <td>{{ $hall->id }}</td>
                    <td><strong>{{ $hall->name }}</strong></td>
                    <td>{{ $hall->owner->name }}</td>
                    <td>{{ $hall->city }}</td>
                    <td>{{ number_format($hall->capacity) }}</td>
                    <td>{{ number_format($hall->price_per_day,0) }} ر.س</td>
                    <td><span class="badge {{ $bc }}">{{ $bl }}</span></td>
                    <td>
                        @if($hall->registeredBy)
                            <span style="font-size:.82rem;color:#7c3aed;font-weight:600;">{{ $hall->registeredBy->name }}</span>
                        @else
                            <span style="color:#d1d5db;">—</span>
                        @endif
                    </td>
                    <td>{{ $hall->created_at->format('Y/m/d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body" style="padding-top:0;">{{ $halls->links() }}</div>
    @endif
</div>

@endsection
