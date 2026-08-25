@extends('layouts.dashboard')

@section('title', 'الإحالات والعمولات')
@section('page-title', 'إدارة الإحالات والعمولات')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.franchise-applications.index') }}" class="nav-item"><i class="fas fa-file-alt"></i> طلبات الامتياز</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item active"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger" style="margin-bottom:16px;"><i class="fas fa-circle-xmark"></i> {{ session('error') }}</div>
@endif

{{-- Filter --}}
<div class="card">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" style="display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end;">
            <div>
                <select name="status" class="form-control">
                    <option value="">جميع الحالات</option>
                    <option value="pending"   {{ request('status')==='pending'   ?'selected':'' }}>معلقة</option>
                    <option value="confirmed" {{ request('status')==='confirmed' ?'selected':'' }}>مؤكدة</option>
                    <option value="paid"      {{ request('status')==='paid'      ?'selected':'' }}>مدفوعة</option>
                    <option value="rejected"  {{ request('status')==='rejected'  ?'selected':'' }}>مرفوضة</option>
                </select>
            </div>
            <div>
                <select name="agent" class="form-control">
                    <option value="">جميع المناديب</option>
                    @foreach($agents as $a)
                        <option value="{{ $a->id }}" {{ request('agent')==$a->id?'selected':'' }}>{{ $a->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            @if(request()->hasAny(['status','agent']))
                <a href="{{ route('supervisor.referrals') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-link"></i> الإحالات</span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $referrals->total() }} إحالة</span>
    </div>
    @if($referrals->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-link" style="font-size:3rem; opacity:.3; display:block; margin-bottom:12px;"></i>
            لا توجد إحالات مطابقة
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>المندوب</th>
                    <th>العميل</th>
                    <th>القاعة</th>
                    <th>الحجز</th>
                    <th>المصدر</th>
                    <th>نسبة العمولة</th>
                    <th>مبلغ العمولة</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $ref)
                @php
                $sc = ['pending'=>['badge-warning','معلقة'],'confirmed'=>['badge-success','مؤكدة'],'paid'=>['badge-info','مدفوعة'],'rejected'=>['badge-danger','مرفوضة']];
                [$bc,$bl] = $sc[$ref->status] ?? ['badge-secondary',$ref->status];
                @endphp
                <tr>
                    <td>{{ $ref->id }}</td>
                    <td><strong>{{ $ref->agent?->name ?? '—' }}</strong><br><small style="color:#6c7a72;">{{ $ref->ref_code }}</small></td>
                    <td>{{ $ref->user?->name ?? '—' }}<br><small style="color:#6c7a72;">{{ $ref->user?->phone }}</small></td>
                    <td>{{ $ref->hall?->name ?? '—' }}</td>
                    <td>
                        @if($ref->booking)
                            <span style="font-size:.8rem;">
                                <i class="fas fa-calendar-day" style="color:#0284c7;"></i>
                                {{ $ref->booking->booking_date->format('Y/m/d') }}<br>
                                <strong style="color:var(--navy);">{{ number_format($ref->booking->total_price,0) }} ر.س</strong>
                            </span>
                        @else
                            <span style="color:#d1d5db;font-size:.8rem;">لم يُحجز بعد</span>
                        @endif
                    </td>
                    <td>
                        <span style="font-size:.8rem; font-weight:700; color:{{ $ref->source==='link'?'#0284c7':'#7c3aed' }};">
                            <i class="fas {{ $ref->source==='link'?'fa-link':'fa-pen' }}"></i>
                            {{ $ref->source==='link'?'رابط':'يدوي' }}
                        </span>
                    </td>
                    <td>{{ $ref->commission_rate }}%</td>
                    <td>
                        @if($ref->commission_amount)
                            <strong style="color:var(--navy);">{{ number_format($ref->commission_amount,2) }} ر.س</strong>
                        @else
                            <span style="color:#d1d5db;">—</span>
                        @endif
                    </td>
                    <td><span class="badge {{ $bc }}">{{ $bl }}</span></td>
                    <td>
                        @if($ref->status === 'pending')
                        <div class="action-btns">
                            <form method="POST" action="{{ route('supervisor.referrals.confirm', $ref->id) }}" style="display:contents;">
                                @csrf
                                <input type="hidden" name="action" value="confirmed">
                                <button type="submit" class="action-btn action-btn-success"
                                    onclick="return confirm('تأكيد هذه الإحالة؟{{ $ref->booking ? " سيتم احتساب عمولة " . number_format($ref->booking->total_price * $ref->commission_rate / 100, 2) . " ر.س" : " لا يوجد حجز مرتبط" }}')" title="تأكيد">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <button type="button" class="action-btn action-btn-danger"
                                onclick="openRejectModal({{ $ref->id }})" title="رفض">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @else
                            <div style="font-size:.78rem;color:var(--text-muted);line-height:1.6;">
                                @if($ref->confirmed_at)<i class="fas fa-clock"></i> {{ $ref->confirmed_at->format('Y/m/d') }}<br>@endif
                                @if($ref->confirmedBy)<span style="color:#7c3aed;">{{ $ref->confirmedBy->name }}</span>@endif
                                @if($ref->notes)<div style="font-style:italic;margin-top:2px;" title="{{ $ref->notes }}">{{ Str::limit($ref->notes,40) }}</div>@endif
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body" style="padding-top:0;">{{ $referrals->links() }}</div>
    @endif
</div>

{{-- ── Reject Modal ──────────────────────────────────────────────────────── --}}
<div id="rejectModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px 30px;width:420px;max-width:95vw;direction:rtl;box-shadow:0 20px 60px rgba(0,0,0,.2);">
        <h3 style="margin:0 0 16px;font-size:1rem;font-weight:800;color:#dc2626;"><i class="fas fa-triangle-exclamation"></i> رفض الإحالة</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <input type="hidden" name="action" value="rejected">
            <div style="margin-bottom:14px;">
                <label class="form-label">سبب الرفض (اختياري)</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="اكتب سبب الرفض هنا..."></textarea>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="closeRejectModal()" class="btn btn-light">إلغاء</button>
                <button type="submit" class="btn" style="background:#dc2626;color:#fff;border:none;">
                    <i class="fas fa-times"></i> تأكيد الرفض
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(id) {
    document.getElementById('rejectForm').action = '{{ url("supervisor/referrals") }}/' + id + '/confirm';
    document.getElementById('rejectModal').style.display = 'flex';
}
function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
    document.getElementById('rejectModal').querySelector('textarea').value = '';
}
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});
</script>

@endsection
