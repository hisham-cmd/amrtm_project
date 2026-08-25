@extends('layouts.dashboard')

@section('title', 'لوحة المشرف')
@section('page-title', 'لوحة تحكم المشرف')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item active"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <div class="sidebar-divider"></div>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <div class="sidebar-divider"></div>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <div class="sidebar-divider"></div>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
    <a href="{{ route('amrtm.admin.dashboard') }}" class="nav-item {{ request()->routeIs('amrtm.admin*') ? 'active' : '' }}"><i class="fas fa-file-certificate"></i> خدمات الأعمال</a>
@endsection

@section('content')

{{-- Stats row --}}
@php
$cards = [
    ['icon'=>'fa-users',         'bg'=>'#dcf5e8', 'color'=>'#163d28', 'num'=>$stats['total_users'],    'label'=>'إجمالي المستخدمين'],
    ['icon'=>'fa-user-tie',      'bg'=>'#ede9fe', 'color'=>'#7c3aed', 'num'=>$stats['total_agents'],   'label'=>'المناديب'],
    ['icon'=>'fa-building',      'bg'=>'#fef3c7', 'color'=>'#d97706', 'num'=>$stats['total_halls'],    'label'=>'إجمالي القاعات'],
    ['icon'=>'fa-calendar-check','bg'=>'#dbeafe', 'color'=>'#0284c7', 'num'=>$stats['total_bookings'], 'label'=>'إجمالي الحجوزات'],
    ['icon'=>'fa-crown',         'bg'=>'#fef3c7', 'color'=>'#b45309', 'num'=>$stats['total_owners'],   'label'=>'ملاك القاعات'],
    ['icon'=>'fa-user-shield',   'bg'=>'#dbeafe', 'color'=>'#1d4ed8', 'num'=>$stats['total_managers'], 'label'=>'مدراء المشاريع'],
    ['icon'=>'fa-link',          'bg'=>'#ccfbf1', 'color'=>'#0f766e', 'num'=>$stats['pending_refs'],   'label'=>'إحالات معلقة'],
    ['icon'=>'fa-chart-bar',     'bg'=>'#ede9fe', 'color'=>'#9333ea', 'num'=>$stats['total_halls'],    'label'=>'قاعات نشطة'],
];
@endphp
<div class="stats-grid">
    @foreach($cards as $card)
    <div class="stat-card">
        <div class="stat-icon" style="background:{{ $card['bg'] }}; color:{{ $card['color'] }};">
            <i class="fas {{ $card['icon'] }}"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $card['num'] }}</h3>
            <p>{{ $card['label'] }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- Pending partners alert --}}
@if($stats['pending_partners'] > 0)
<div style="background:#fef2f2; border:1.5px solid #fca5a5; border-radius:12px; padding:14px 20px; margin-bottom:16px;
            display:flex; align-items:center; justify-content:space-between; gap:12px;">
    <div style="display:flex; align-items:center; gap:10px;">
        <i class="fas fa-user-clock" style="color:#dc2626; font-size:1.2rem;"></i>
        <div>
            <strong style="color:#991b1b;">شركاء جدد ينتظرون الموافقة</strong>
            <div style="font-size:.82rem; color:#b91c1c; margin-top:2px;">يوجد <strong>{{ $stats['pending_partners'] }}</strong> حساب شريك قيد المراجعة</div>
        </div>
    </div>
    <a href="{{ route('supervisor.partner-accounts.index', ['status'=>'pending']) }}"
       style="background:#dc2626; color:#fff; border-radius:8px; padding:9px 18px; font-size:.85rem; font-weight:800; text-decoration:none; white-space:nowrap;">
        <i class="fas fa-eye"></i> مراجعة الطلبات
    </a>
</div>
@endif

{{-- Pending referrals alert --}}
@if($stats['pending_refs'] > 0)
<div class="alert alert-warning" style="justify-content:space-between;">
    <div style="display:flex;align-items:center;gap:10px;">
        <i class="fas fa-clock"></i>
        <div>
            <strong>إحالات تحتاج مراجعة</strong>
            <div style="font-size:.82rem;margin-top:2px;">يوجد <strong>{{ $stats['pending_refs'] }}</strong> إحالة معلقة تنتظر قرارك</div>
        </div>
    </div>
    <a href="{{ route('supervisor.referrals', ['status'=>'pending']) }}" class="btn btn-gold btn-sm" style="flex-shrink:0;">
        <i class="fas fa-eye"></i> مراجعة
    </a>
</div>
@endif

{{-- Recent users --}}
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <div class="section-title-bar"></div>
            <i class="fas fa-users"></i> آخر المستخدمين المسجلين
        </span>
        <a href="{{ route('supervisor.users') }}" class="btn btn-light btn-sm">
            عرض الكل <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>الدور</th>
                    <th>تاريخ التسجيل</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $u)
                @php
                $rc = ['admin'=>'badge-danger','supervisor'=>'badge-danger','manager'=>'badge-info','agent'=>'badge-warning','owner'=>'badge-success','user'=>'badge-secondary'];
                @endphp
                <tr>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td style="color:var(--text-muted);">{{ $u->email }}</td>
                    <td style="color:var(--text-muted);">{{ $u->phone }}</td>
                    <td><span class="badge {{ $rc[$u->role->value] ?? 'badge-secondary' }}">{{ $u->role->label() }}</span></td>
                    <td style="color:var(--text-muted);">{{ $u->created_at->format('Y/m/d') }}</td>
                    <td>
                        <a href="{{ route('supervisor.users.edit', $u->id) }}" class="action-btn action-btn-edit">
                            <i class="fas fa-pen"></i> تعديل
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-state" style="padding:40px;"><i class="fas fa-users" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:10px;"></i>لا يوجد مستخدمون بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Quick actions --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;margin-top:8px;">
    @foreach([
        ['route'=>'supervisor.users.create',   'icon'=>'fa-user-plus',      'label'=>'إنشاء حساب جديد',       'color'=>'#0d2448'],
        ['route'=>'supervisor.halls.create',   'icon'=>'fa-building',       'label'=>'تسجيل قاعة جديدة',      'color'=>'#d97706'],
        ['route'=>'supervisor.brands.create',  'icon'=>'fa-trademark',      'label'=>'إضافة علامة تجارية',    'color'=>'#7c3aed'],
        ['route'=>'supervisor.franchise.create','icon'=>'fa-store',         'label'=>'إضافة امتياز جديد',     'color'=>'#0284c7'],
    ] as $qa)
    <a href="{{ route($qa['route']) }}" style="background:#fff;border:1.5px solid #e8edf5;border-radius:12px;padding:16px 18px;display:flex;align-items:center;gap:12px;text-decoration:none;transition:all .2s;box-shadow:0 1px 4px rgba(13,36,72,.05);"
       onmouseover="this.style.borderColor='{{ $qa['color'] }}';this.style.transform='translateY(-2px)'"
       onmouseout="this.style.borderColor='#e8edf5';this.style.transform=''">
        <div style="width:40px;height:40px;border-radius:10px;background:{{ $qa['color'] }}18;display:flex;align-items:center;justify-content:center;color:{{ $qa['color'] }};font-size:.95rem;flex-shrink:0;">
            <i class="fas {{ $qa['icon'] }}"></i>
        </div>
        <span style="font-size:.87rem;font-weight:700;color:var(--text-dark);">{{ $qa['label'] }}</span>
    </a>
    @endforeach
</div>

@endsection
