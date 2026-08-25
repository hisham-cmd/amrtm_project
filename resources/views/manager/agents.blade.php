@extends('layouts.dashboard')

@section('title', 'المناديب')
@section('page-title', 'المناديب')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item active"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-users"></i> المناديب</span>
        <span style="color:#6c7a72;font-size:.88rem;">{{ $agents->total() }} مندوب</span>
    </div>
    @if($agents->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:40px 0;">
            <i class="fas fa-users" style="font-size:3rem;opacity:.3;display:block;margin-bottom:12px;"></i>
            لا يوجد مناديب مسجلون
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الجوال</th>
                    <th>البريد</th>
                    <th>كود الإحالة</th>
                    <th>عدد الإحالات</th>
                    <th>تاريخ التسجيل</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agents as $agent)
                <tr>
                    <td>{{ $agent->id }}</td>
                    <td><strong>{{ $agent->name }}</strong></td>
                    <td>{{ $agent->phone }}</td>
                    <td style="font-size:.84rem;">{{ $agent->email }}</td>
                    <td>
                        @if($agent->refCode)
                            <code style="background:#f0fdf4;color:#166534;padding:3px 8px;border-radius:6px;font-size:.82rem;font-weight:700;">{{ $agent->refCode->code }}</code>
                        @else
                            <span style="color:#d1d5db;">—</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('manager.referrals', ['agent'=>$agent->id]) }}"
                           style="font-weight:700; color:#1a5c38; text-decoration:none;">
                            {{ $agent->referrals_count }}
                        </a>
                    </td>
                    <td>{{ $agent->created_at->format('Y/m/d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body" style="padding-top:0;">{{ $agents->links() }}</div>
    @endif
</div>

@endsection
