@extends('layouts.dashboard')

@section('title', 'طلبات القاعات')
@section('page-title', 'طلبات إضافة القاعات')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item active"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-hourglass-half" style="color:#d97706;"></i>
            طلبات القاعات المعلقة
        </span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $halls->total() }} طلب</span>
    </div>

    @if($halls->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:48px 0;">
            <i class="fas fa-check-circle" style="color:#16a34a; font-size:3rem; display:block; margin-bottom:14px;"></i>
            <strong style="font-size:1rem;">لا توجد طلبات معلقة</strong>
            <p style="margin:6px 0 0; font-size:.88rem;">جميع طلبات القاعات تمت معالجتها — أحسنت!</p>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>القاعة</th>
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
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            @if($hall->profile_photo)
                                <img src="{{ route('public.storage', ['path' => $hall->profile_photo]) }}"
                                     alt="{{ $hall->name }}"
                                     style="width:40px; height:40px; border-radius:8px; object-fit:cover; flex-shrink:0;">
                            @endif
                            <div>
                                <strong>{{ $hall->name }}</strong>
                                <div style="font-size:.78rem; color:#6c7a72;">{{ $hall->location }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $hall->owner->name }}
                        <div style="font-size:.78rem; color:#6c7a72;">{{ $hall->owner->phone }}</div>
                    </td>
                    <td>{{ $hall->city }}</td>
                    <td>{{ number_format($hall->capacity) }} شخص</td>
                    <td>{{ number_format($hall->price_per_day, 0) }} ر.س</td>
                    <td>{{ $hall->created_at->format('Y/m/d') }}</td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap; align-items:center;">
                            {{-- Review --}}
                            <a href="{{ route('supervisor.halls.review', $hall->id) }}"
                               style="background:#f1f5f9; color:#374151; border-radius:7px; padding:6px 12px; font-size:.8rem; font-weight:700; text-decoration:none; border:1px solid #e2e8f0; white-space:nowrap;">
                                <i class="fas fa-eye"></i> مراجعة
                            </a>
                            {{-- Approve --}}
                            <form method="POST" action="{{ route('supervisor.halls.decide', $hall->id) }}">
                                @csrf
                                <input type="hidden" name="decision" value="active">
                                <button type="submit"
                                        style="background:#16a34a; color:#fff; border:none; border-radius:7px; padding:6px 14px; font-size:.82rem; font-weight:700; cursor:pointer; white-space:nowrap;">
                                    <i class="fas fa-check"></i> قبول
                                </button>
                            </form>
                            {{-- Reject --}}
                            <form method="POST" action="{{ route('supervisor.halls.decide', $hall->id) }}"
                                  onsubmit="return confirm('هل تريد رفض هذا الطلب؟')">
                                @csrf
                                <input type="hidden" name="decision" value="rejected">
                                <button type="submit"
                                        style="background:#dc2626; color:#fff; border:none; border-radius:7px; padding:6px 14px; font-size:.82rem; font-weight:700; cursor:pointer; white-space:nowrap;">
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
    <div class="card-body" style="padding-top:0;">
        {{ $halls->links() }}
    </div>
    @endif
</div>

@endsection
