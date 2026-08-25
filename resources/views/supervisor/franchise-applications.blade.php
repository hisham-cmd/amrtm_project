@extends('layouts.dashboard')

@section('title', 'طلبات الامتياز')
@section('page-title', 'طلبات الامتياز الواردة')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item active"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

<div class="section-header">
    <div class="section-title">
        <div class="section-title-bar"></div>
        <i class="fas fa-file-alt"></i> طلبات الامتياز
        <span class="badge badge-navy" style="font-size:.75rem;">{{ $apps->total() }}</span>
    </div>
    <form method="GET" style="display:flex;gap:8px;">
        <select name="status" class="form-control" style="width:auto;" onchange="this.form.submit()">
            <option value="">كل الطلبات</option>
            <option value="pending"   {{ request('status')==='pending'   ? 'selected' : '' }}>معلق</option>
            <option value="reviewing" {{ request('status')==='reviewing' ? 'selected' : '' }}>قيد المراجعة</option>
            <option value="approved"  {{ request('status')==='approved'  ? 'selected' : '' }}>مقبول</option>
            <option value="rejected"  {{ request('status')==='rejected'  ? 'selected' : '' }}>مرفوض</option>
        </select>
    </form>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>المتقدم</th>
                    <th>الامتياز</th>
                    <th>المنطقة</th>
                    <th>رأس المال</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @forelse($apps as $app)
                <tr>
                    <td style="color:var(--text-muted);">{{ $app->id }}</td>
                    <td>
                        <div style="font-weight:700;">{{ $app->full_name }}</div>
                        <div style="font-size:.78rem;color:var(--text-muted);">{{ $app->phone }}</div>
                        <div style="font-size:.77rem;color:var(--text-muted);">{{ $app->email }}</div>
                    </td>
                    <td>
                        @if($app->opportunity)
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,{{ $app->opportunity->gradient_from }},{{ $app->opportunity->gradient_to }});display:flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;flex-shrink:0;">
                                    <i class="fas {{ $app->opportunity->icon }}"></i>
                                </div>
                                <span style="font-weight:600;font-size:.88rem;">{{ $app->opportunity->name }}</span>
                            </div>
                        @else
                            <span style="color:var(--text-muted);font-size:.85rem;">{{ $app->brand_name ?: '—' }}</span>
                        @endif
                    </td>
                    <td style="color:var(--text-muted);">{{ $app->region ?: '—' }}</td>
                    <td style="font-size:.83rem;color:var(--text-muted);">{{ $app->capital_range ?: '—' }}</td>
                    <td>
                        <span class="badge {{ $app->statusBadge() }}">{{ $app->statusLabel() }}</span>
                    </td>
                    <td style="color:var(--text-muted);font-size:.82rem;">{{ $app->created_at->format('Y/m/d') }}</td>
                    <td>
                        <div class="action-btns">
                            <form method="POST" action="{{ route('supervisor.franchise-applications.status', $app) }}" style="display:contents;">
                                @csrf @method('PATCH')
                                <select name="status" class="form-control" style="padding:5px 8px;font-size:.78rem;width:110px;" onchange="this.form.submit()">
                                    <option value="pending"   {{ $app->status==='pending'   ?'selected':'' }}>معلق</option>
                                    <option value="reviewing" {{ $app->status==='reviewing' ?'selected':'' }}>مراجعة</option>
                                    <option value="approved"  {{ $app->status==='approved'  ?'selected':'' }}>مقبول</option>
                                    <option value="rejected"  {{ $app->status==='rejected'  ?'selected':'' }}>مرفوض</option>
                                </select>
                            </form>
                            <form method="POST" action="{{ route('supervisor.franchise-applications.destroy', $app) }}" style="display:contents;" onsubmit="return confirm('حذف الطلب؟')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn action-btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-file-alt"></i>
                            <h3>لا توجد طلبات بعد</h3>
                            <p>ستظهر هنا عندما يتقدم المستخدمون عبر الموقع</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($apps->hasPages())
    <div class="card-body" style="padding-top:0;">{{ $apps->links() }}</div>
    @endif
</div>

@endsection
