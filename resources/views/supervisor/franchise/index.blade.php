@extends('layouts.dashboard')

@section('title', 'إدارة الامتيازات')
@section('page-title', 'فرص الامتياز التجاري')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item active"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
@endsection

@section('content')

<div class="section-header">
    <div class="section-title">
        <div class="section-title-bar"></div>
        <i class="fas fa-store"></i> فرص الامتياز
        <span class="badge badge-navy" style="font-size:.75rem;">{{ $opportunities->count() }}</span>
    </div>
    <a href="{{ route('supervisor.franchise.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> إضافة امتياز
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>الامتياز</th>
                    <th>الفئة</th>
                    <th>الاستثمار (ريال)</th>
                    <th>العائد</th>
                    <th>الخطوات</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($opportunities as $opp)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:42px;height:42px;border-radius:11px;background:linear-gradient(135deg,{{ $opp->gradient_from }},{{ $opp->gradient_to }});display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;flex-shrink:0;">
                                <i class="fas {{ $opp->icon }}"></i>
                            </div>
                            <div>
                                <div style="font-weight:700;color:var(--text-dark);">{{ $opp->name }}</div>
                                <div style="font-size:.77rem;color:var(--text-muted);">{{ $opp->name_en }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-info">{{ $opp->category_label }}</span></td>
                    <td style="font-weight:600;">{{ number_format($opp->investment_min/1000) }}K — {{ number_format($opp->investment_max/1000) }}K</td>
                    <td style="color:var(--text-muted);">{{ $opp->roi_months_min }}–{{ $opp->roi_months_max }} شهر</td>
                    <td style="text-align:center;"><span class="badge badge-secondary">{{ $opp->steps_count }} خطوة</span></td>
                    <td>
                        @if($opp->status === 'active')
                            <span class="badge badge-success"><i class="fas fa-circle" style="font-size:7px;"></i> نشط</span>
                        @else
                            <span class="badge badge-danger">غير نشط</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('supervisor.franchise.edit', $opp) }}" class="action-btn action-btn-edit">
                                <i class="fas fa-edit"></i> تعديل
                            </a>
                            <form method="POST" action="{{ route('supervisor.franchise.toggle', $opp) }}" style="display:contents;">
                                @csrf
                                <button type="submit" class="action-btn {{ $opp->status==='active' ? 'action-btn-warning' : 'action-btn-success' }}">
                                    <i class="fas fa-{{ $opp->status==='active' ? 'pause' : 'play' }}"></i>
                                    {{ $opp->status==='active' ? 'إيقاف' : 'تفعيل' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('supervisor.franchise.destroy', $opp) }}" style="display:contents;"
                                  onsubmit="return confirm('حذف هذا الامتياز نهائياً؟')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-store"></i>
                            <h3>لا توجد فرص امتياز بعد</h3>
                            <p><a href="{{ route('supervisor.franchise.create') }}" style="color:var(--navy);font-weight:700;">أضف أول امتياز</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
