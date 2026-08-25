@extends('layouts.dashboard')

@section('title', 'الحجوزات')
@section('page-title', 'إدارة الحجوزات')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item active"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

<div class="card">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
            <div>
                <select name="status" class="form-control">
                    <option value="">كل الحالات</option>
                    <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>معلق</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>ملغي</option>
                </select>
            </div>
            <div>
                <select name="hall" class="form-control">
                    <option value="">جميع القاعات</option>
                    @foreach($halls as $h)
                        <option value="{{ $h->id }}" {{ request('hall') == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            @if(request()->hasAny(['status','hall']))
                <a href="{{ route('supervisor.bookings') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-calendar-alt"></i> الحجوزات</span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $bookings->total() }} حجز</span>
    </div>
    @if($bookings->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-calendar-times" style="font-size:3rem; opacity:.3; display:block; margin-bottom:12px;"></i>
            لا توجد حجوزات مطابقة
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th><th>العميل</th><th>القاعة</th><th>تاريخ الحجز</th>
                        <th>المناسبة</th><th>الضيوف</th><th>المبلغ</th><th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                        @php
                            $bv = $b->status->value;
                            $bc = ['pending'=>'badge-warning','confirmed'=>'badge-success','cancelled'=>'badge-danger'];
                            $bl = ['pending'=>'معلق','confirmed'=>'مؤكد','cancelled'=>'ملغي'];
                        @endphp
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td><strong>{{ $b->user?->name ?? '—' }}</strong><br><small style="color:#6c7a72;">{{ $b->user?->phone }}</small></td>
                            <td>{{ $b->hall?->name ?? '—' }}</td>
                            <td>{{ $b->booking_date->format('Y/m/d') }}</td>
                            <td>{{ $b->occasion_type->label() }}</td>
                            <td>{{ number_format($b->guests_count) }}</td>
                            <td><strong>{{ number_format($b->total_price, 0) }} ر.س</strong></td>
                            <td><span class="badge {{ $bc[$bv] ?? 'badge-secondary' }}">{{ $bl[$bv] ?? $bv }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body" style="padding-top:0;">{{ $bookings->links() }}</div>
    @endif
</div>

@endsection
