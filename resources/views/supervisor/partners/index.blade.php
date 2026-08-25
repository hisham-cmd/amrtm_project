@extends('layouts.dashboard')

@section('title', 'إدارة الشركاء')
@section('page-title', 'إدارة الشركاء')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item active"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="section-card">
<div class="section-header">
        <h2><i class="fas fa-handshake text-green-600 ml-2"></i> قائمة الشركاء</h2>
        <div style="display:flex;gap:10px;align-items:center;">
            <form method="GET" style="display:flex;gap:8px;align-items:center;">
                <select name="status" onchange="this.form.submit()" style="border:1.5px solid #e2e8f0;border-radius:8px;padding:7px 12px;font-size:.85rem;font-family:'Cairo',sans-serif;">
                    <option value="">كل الحالات</option>
                    <option value="pending"  {{ ($statusFilter??'')==='pending'  ? 'selected' : '' }}>قيد المراجعة</option>
                    <option value="active"   {{ ($statusFilter??'')==='active'   ? 'selected' : '' }}>نشط</option>
                    <option value="rejected" {{ ($statusFilter??'')==='rejected' ? 'selected' : '' }}>مرفوض</option>
                </select>
            </form>
            <a href="{{ route($routePrefix . '.create') }}" class="btn-primary btn-sm">
                <i class="fas fa-plus"></i> إضافة شريك جديد
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الشركة</th>
                    <th>المستخدم</th>
                    <th>التصنيف</th>
                    <th>المدينة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                <tr>
                    <td>{{ $partner->id }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" class="w-8 h-8 rounded-full object-cover border">
                            @endif
                            <span class="font-bold">{{ $partner->company_name }}</span>
                        </div>
                    </td>
                    <td>
                        <div>{{ $partner->user?->name }}</div>
                        <div class="text-xs text-gray-400">{{ $partner->user?->email }}</div>
                    </td>
                    <td>{{ $partner->category?->name ?? '—' }}</td>
                    <td>{{ $partner->city ?? '—' }}</td>
                    <td>
                        @php
                            $statusColors = ['active' => 'green', 'pending' => 'gold', 'rejected' => 'red'];
                            $statusLabels = ['active' => 'نشط', 'pending' => 'قيد المراجعة', 'rejected' => 'مرفوض'];
                            $color = $statusColors[$partner->status] ?? 'gray';
                            $label = $statusLabels[$partner->status] ?? $partner->status;
                        @endphp
                        <span class="status-badge status-{{ $color }}">{{ $label }}</span>
                    </td>
                    <td>
                        <div class="flex gap-2 flex-wrap">
                            <a href="{{ route($routePrefix . '.show', $partner) }}" class="btn-secondary btn-xs">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($partner->status !== 'active')
                            <form method="POST" action="{{ route($routePrefix . '.status', $partner) }}" class="inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="active">
                                <button type="submit" class="btn-success btn-xs">قبول</button>
                            </form>
                            @endif
                            @if($partner->status !== 'rejected')
                            <button onclick="openRejectModal({{ $partner->id }})" class="btn-danger btn-xs">رفض</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-8 text-gray-400">لا يوجد شركاء بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4">{{ $partners->links() }}</div>
</div>

{{-- Reject modal --}}
<div id="rejectModal" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px;max-width:460px;width:90%;font-family:'Cairo',sans-serif;">
        <h3 style="font-size:1.1rem;font-weight:800;color:#0f3d24;margin-bottom:16px;">سبب الرفض</h3>
        <form id="rejectForm" method="POST">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="rejected">
            <textarea name="admin_note" rows="3" style="width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:10px;font-family:'Cairo',sans-serif;font-size:13px;" placeholder="اكتب سبب الرفض (اختياري)..."></textarea>
            <div style="display:flex;gap:10px;margin-top:16px;">
                <button type="submit" style="flex:1;background:#dc2626;color:#fff;border:none;border-radius:10px;padding:11px;font-weight:700;font-size:13px;cursor:pointer;">تأكيد الرفض</button>
                <button type="button" onclick="document.getElementById('rejectModal').style.display='none'"
                        style="flex:1;background:#f1f5f9;color:#0f3d24;border:none;border-radius:10px;padding:11px;font-weight:700;font-size:13px;cursor:pointer;">إلغاء</button>
            </div>
        </form>
    </div>
</div>

<script>
var partnerStatusBase = '{{ rtrim(route($routePrefix . '.status', ['partner' => '__ID__']), '') }}';
function openRejectModal(id) {
    document.getElementById('rejectForm').action = partnerStatusBase.replace('__ID__', id);
    document.getElementById('rejectModal').style.display = 'flex';
}
</script>

@endsection
