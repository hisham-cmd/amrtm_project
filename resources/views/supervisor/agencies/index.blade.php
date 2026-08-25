@extends('layouts.dashboard')

@section('title', 'الوكالات التجارية')
@section('page-title', 'الوكالات التجارية')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item active"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')
<style>
.tbl { width:100%; border-collapse:collapse; }
.tbl th { background:#f8fafc; font-size:12px; font-weight:700; color:#64748b; padding:12px 14px; text-align:right; border-bottom:2px solid #e2e8f0; }
.tbl td { padding:12px 14px; border-bottom:1px solid #f1f5f9; font-size:13px; vertical-align:middle; }
.tbl tr:hover td { background:#fafbfc; }
.badge-active   { background:#dcfce7; color:#15803d; }
.badge-inactive { background:#fef2f2; color:#991b1b; }
.badge-draft    { background:#fef9c3; color:#854d0e; }
.badge-type { background:#dbeafe; color:#1d4ed8; font-size:11px; font-weight:700; padding:3px 10px; border-radius:6px; }
.action-btn { padding:6px 14px; border-radius:8px; font-size:12px; font-weight:700; border:none; cursor:pointer; font-family:'Cairo',sans-serif; text-decoration:none; display:inline-flex; align-items:center; gap:5px; }
.action-btn-primary { background:#dbeafe; color:#1d4ed8; }
.action-btn-danger  { background:#fee2e2; color:#991b1b; }
</style>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
    <h2 style="font-size:1.1rem;font-weight:800;color:#0f2d5a;margin:0;">الوكالات التجارية ({{ $agencies->count() }})</h2>
    <a href="{{ route('supervisor.agencies.create') }}" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#0d2448,#1a4a8a);color:#fff;padding:10px 22px;border-radius:12px;font-size:.9rem;font-weight:800;text-decoration:none;">
        <i class="fas fa-plus"></i> إضافة وكالة
    </a>
</div>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:12px 18px;margin-bottom:18px;color:#15803d;font-weight:700;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.07);overflow:hidden;">
    @if($agencies->isEmpty())
    <div style="padding:60px;text-align:center;color:#94a3b8;">
        <i class="fas fa-building" style="font-size:2.5rem;margin-bottom:12px;display:block;color:#cbd5e1;"></i>
        <p style="font-weight:700;color:#64748b;">لا توجد وكالات بعد</p>
        <a href="{{ route('supervisor.agencies.create') }}" style="display:inline-flex;align-items:center;gap:6px;background:#0d2448;color:#fff;padding:10px 22px;border-radius:10px;font-size:.9rem;font-weight:700;text-decoration:none;margin-top:12px;">
            <i class="fas fa-plus"></i> أضف أول وكالة
        </a>
    </div>
    @else
    <table class="tbl">
        <thead>
            <tr>
                <th>الوكالة</th>
                <th>الفئة</th>
                <th>النوع</th>
                <th>الاستثمار</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agencies as $agency)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:12px;">
                        @if($agency->logo_url)
                            <img src="{{ $agency->logo_url }}" alt="{{ $agency->name }}" style="width:44px;height:44px;border-radius:10px;object-fit:contain;border:1.5px solid #e2e8f0;background:#f8fafc;padding:3px;">
                        @else
                            <div style="width:44px;height:44px;border-radius:10px;background:#eef2f9;display:flex;align-items:center;justify-content:center;font-weight:900;color:#0d2448;font-size:1.1rem;">{{ mb_substr($agency->name,0,1) }}</div>
                        @endif
                        <div>
                            <div style="font-weight:800;color:#0f172a;">{{ $agency->name }}</div>
                            @if($agency->name_en)<div style="font-size:11px;color:#94a3b8;">{{ $agency->name_en }}</div>@endif
                            @if($agency->is_featured)<span style="font-size:10px;background:#fef9c3;color:#854d0e;padding:2px 8px;border-radius:6px;font-weight:700;">مميز</span>@endif
                        </div>
                    </div>
                </td>
                <td>{{ \App\Models\CommercialAgency::$categories[$agency->category] ?? $agency->category }}</td>
                <td><span class="badge-type">{{ $agency->agency_type_label }}</span></td>
                <td style="direction:ltr;text-align:right;">
                    {{ number_format($agency->investment_min/1000) }}K — {{ number_format($agency->investment_max/1000) }}K ر.س
                </td>
                <td>
                    <span class="action-btn badge-{{ $agency->status }}">
                        {{ $agency->status === 'active' ? 'نشط' : ($agency->status === 'draft' ? 'مسودة' : 'معطل') }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        <a href="{{ route('supervisor.agencies.edit', $agency) }}" class="action-btn action-btn-primary"><i class="fas fa-edit"></i> تعديل</a>
                        <form method="POST" action="{{ route('supervisor.agencies.toggle', $agency) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="action-btn" style="background:#f1f5f9;color:#374151;">
                                <i class="fas fa-{{ $agency->status === 'active' ? 'eye-slash' : 'eye' }}"></i>
                                {{ $agency->status === 'active' ? 'إخفاء' : 'تفعيل' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('supervisor.agencies.destroy', $agency) }}" style="display:inline;" onsubmit="return confirm('حذف الوكالة؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn action-btn-danger"><i class="fas fa-trash"></i> حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
