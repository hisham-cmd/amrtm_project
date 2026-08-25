@extends('layouts.dashboard')

@section('title', 'القاعات')
@section('page-title', 'إدارة القاعات')

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
    <a href="{{ route('supervisor.halls') }}" class="nav-item active"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@php $pendingCount = \App\Models\Hall::where('status', \App\Enums\HallStatus::Pending)->count(); @endphp

@if($pendingCount > 0)
<div class="alert alert-warning" style="justify-content:space-between;margin-bottom:18px;">
    <div style="display:flex;align-items:center;gap:10px;">
        <i class="fas fa-clock"></i>
        <div>
            <strong>طلبات قاعات جديدة في انتظار المراجعة</strong>
            <div style="font-size:.82rem;margin-top:2px;">يوجد <strong>{{ $pendingCount }}</strong> طلب قيد المراجعة يحتاج إلى قرار منك</div>
        </div>
    </div>
    <a href="{{ route('supervisor.halls', ['status' => 'pending']) }}" class="btn btn-gold btn-sm" style="flex-shrink:0;">
        <i class="fas fa-eye"></i> عرض الطلبات
    </a>
</div>
@endif

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
            <div style="flex:1; min-width:200px;">
                <input type="text" name="search" class="form-control" placeholder="ابحث عن قاعة..." value="{{ request('search') }}">
            </div>
            <div>
                <select name="country" class="form-control">
                    <option value="">كل الدول</option>
                    @foreach(\App\Models\Hall::select('country')->whereNotNull('country')->where('country','!=','')->distinct()->orderBy('country')->pluck('country') as $c)
                        <option value="{{ $c }}" {{ request('country') === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="status" class="form-control">
                    <option value="">كل الحالات</option>
                    <option value="pending"      {{ request('status') === 'pending'      ? 'selected' : '' }}>قيد المراجعة</option>
                    <option value="active"       {{ request('status') === 'active'       ? 'selected' : '' }}>نشط</option>
                    <option value="inactive"     {{ request('status') === 'inactive'     ? 'selected' : '' }}>غير نشط</option>
                    <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>تحت المراجعة</option>
                    <option value="rejected"     {{ request('status') === 'rejected'     ? 'selected' : '' }}>مرفوض</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            @if(request()->hasAny(['search', 'status', 'country']))
                <a href="{{ route('supervisor.halls') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-building"></i> القاعات</span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $halls->total() }} قاعة</span>
    </div>
    @if($halls->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-building" style="font-size:3rem; opacity:.3; display:block; margin-bottom:12px;"></i>
            لا توجد قاعات مطابقة
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th><th>القاعة</th><th>مقدِّم الطلب</th><th>المدينة</th><th>السعر/يوم</th><th>الحالة</th><th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($halls as $hall)
                        @php
                            $hv = $hall->status->value;
                            $hc = ['pending'=>'badge-warning','under_review'=>'badge-info','active'=>'badge-success','inactive'=>'badge-secondary','rejected'=>'badge-danger'];
                            $hl = ['pending'=>'قيد المراجعة','under_review'=>'تحت المراجعة','active'=>'نشط','inactive'=>'غير نشط','rejected'=>'مرفوض'];
                        @endphp
                        <tr style="{{ $hv === 'pending' ? 'background:#fffdf0;' : '' }}">
                            <td>{{ $hall->id }}</td>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    @if($hall->profile_photo)
                                        <img src="{{ route('public.storage', ['path' => $hall->profile_photo]) }}" alt="{{ $hall->name }}"
                                             style="width:40px; height:40px; border-radius:8px; object-fit:cover;">
                                    @endif
                                    <div>
                                        <strong>{{ $hall->name }}</strong><br>
                                        <small style="color:#6c7a72;">{{ $hall->location }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $hall->owner?->name ?? '—' }}</td>
                            <td>{{ $hall->city }}</td>
                            <td>{{ number_format($hall->price_per_day) }} ريال</td>
                            <td><span class="badge {{ $hc[$hv] ?? 'badge-secondary' }}">{{ $hl[$hv] ?? $hv }}</span></td>
                            <td>
                                <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                    @if($hv === 'pending')
                                        <a href="{{ route('supervisor.halls.review', $hall->id) }}"
                                           style="display:inline-flex; align-items:center; gap:5px; background:#d97706; color:#fff; border:none; border-radius:8px; padding:7px 14px; font-size:.82rem; font-weight:700; text-decoration:none;">
                                            <i class="fas fa-eye"></i> مراجعة الطلب
                                        </a>
                                    @else
                                        <form method="POST" action="{{ route('supervisor.halls.status', $hall->id) }}" style="display:flex; gap:6px;">
                                            @csrf
                                            <select name="status" class="form-control" style="width:auto; padding:6px 10px; font-size:.82rem;">
                                                <option value="pending"      {{ $hv === 'pending'      ? 'selected' : '' }}>قيد المراجعة</option>
                                                <option value="under_review" {{ $hv === 'under_review' ? 'selected' : '' }}>تحت المراجعة</option>
                                                <option value="active"       {{ $hv === 'active'       ? 'selected' : '' }}>نشط</option>
                                                <option value="inactive"     {{ $hv === 'inactive'     ? 'selected' : '' }}>غير نشط</option>
                                                <option value="rejected"     {{ $hv === 'rejected'     ? 'selected' : '' }}>مرفوض</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">حفظ</button>
                                        </form>
                                        <a href="{{ route('supervisor.halls.review', $hall->id) }}"
                                           style="display:inline-flex; align-items:center; background:#f1f5f9; color:#374151; border-radius:8px; padding:7px 12px; font-size:.82rem; font-weight:700; text-decoration:none; border:1px solid #e2e8f0;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
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
