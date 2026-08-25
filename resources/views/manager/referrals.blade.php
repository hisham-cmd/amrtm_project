@extends('layouts.dashboard')

@section('title', 'الإحالات')
@section('page-title', 'إدارة الإحالات')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item active"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger" style="margin-bottom:16px;"><i class="fas fa-circle-xmark"></i> {{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
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
                <select name="source" class="form-control">
                    <option value="">جميع المصادر</option>
                    <option value="link"   {{ request('source')==='link'  ?'selected':'' }}>رابط</option>
                    <option value="manual" {{ request('source')==='manual'?'selected':'' }}>يدوي</option>
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
            @if(request()->hasAny(['status','source','agent']))
                <a href="{{ route('manager.referrals') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-link"></i> الإحالات</span>
        <span style="color:#6c7a72;font-size:.88rem;">{{ $referrals->total() }} إحالة</span>
    </div>
    @if($referrals->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:40px 0;">لا توجد إحالات مطابقة</div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>المندوب</th>
                    <th>العميل</th>
                    <th>القاعة</th>
                    <th>المصدر</th>
                    <th>الحجز</th>
                    <th>العمولة</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $ref)
                @php $sc=['pending'=>['badge-warning','معلقة'],'confirmed'=>['badge-success','مؤكدة'],'paid'=>['badge-info','مدفوعة'],'rejected'=>['badge-danger','مرفوضة']]; [$bc,$bl]=$sc[$ref->status]??['badge-secondary',$ref->status]; @endphp
                <tr>
                    <td>{{ $ref->id }}</td>
                    <td><strong>{{ $ref->agent?->name ?? '—' }}</strong><br><small style="color:#6c7a72;">{{ $ref->ref_code }}</small></td>
                    <td>{{ $ref->user?->name ?? '—' }}<br><small style="color:#6c7a72;">{{ $ref->user?->phone }}</small></td>
                    <td>{{ $ref->hall?->name ?? '—' }}</td>
                    <td><span style="font-size:.8rem;font-weight:700;color:{{ $ref->source==='link'?'#0284c7':'#7c3aed' }};"><i class="fas {{ $ref->source==='link'?'fa-link':'fa-pen' }}"></i> {{ $ref->source==='link'?'رابط':'يدوي' }}</span></td>
                    <td>
                        @if($ref->booking)
                            <span style="font-size:.8rem;">
                                <i class="fas fa-calendar-day" style="color:#0284c7;"></i>
                                {{ $ref->booking->booking_date->format('Y/m/d') }}<br>
                                <strong style="color:#1a5c38;">{{ number_format($ref->booking->total_price,0) }} ر.س</strong>
                            </span>
                        @else
                            <span style="color:#d1d5db;font-size:.8rem;">لم يُحجز بعد</span>
                        @endif
                    </td>
                    <td>{{ $ref->commission_amount ? number_format($ref->commission_amount,2).' ر.س' : $ref->commission_rate.'%' }}</td>
                    <td><span class="badge {{ $bc }}">{{ $bl }}</span></td>
                    <td>
                        @if($ref->status === 'pending')
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <form method="POST" action="{{ route('manager.referrals.decide', $ref->id) }}">
                                @csrf <input type="hidden" name="action" value="confirmed">
                                <button type="submit"
                                    onclick="return confirm('تأكيد هذه الإحالة؟{{ $ref->booking ? " عمولة: ".number_format($ref->booking->total_price*$ref->commission_rate/100,2)." ر.س" : " لا يوجد حجز بعد" }}')"
                                    style="background:#16a34a;color:#fff;border:none;border-radius:7px;padding:5px 12px;font-size:.8rem;font-weight:700;cursor:pointer;">
                                    <i class="fas fa-check"></i> تأكيد
                                </button>
                            </form>
                            <button type="button" onclick="openRejectModal({{ $ref->id }})"
                                style="background:#dc2626;color:#fff;border:none;border-radius:7px;padding:5px 12px;font-size:.8rem;font-weight:700;cursor:pointer;">
                                <i class="fas fa-times"></i> رفض
                            </button>
                        </div>
                        @else
                            <div style="font-size:.78rem;color:#6c7a72;line-height:1.6;">
                                @if($ref->confirmed_at)<i class="fas fa-clock"></i> {{ $ref->confirmed_at->format('Y/m/d') }}<br>@endif
                                @if($ref->confirmedBy)<span style="color:#7c3aed;">{{ $ref->confirmedBy->name }}</span>@endif
                                @if($ref->notes)<div style="color:#6c7a72;font-style:italic;margin-top:2px;" title="{{ $ref->notes }}">{{ Str::limit($ref->notes,40) }}</div>@endif
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

{{-- Reject Modal --}}
<div id="rejectModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:14px;padding:28px 30px;width:420px;max-width:95vw;direction:rtl;">
        <h3 style="margin:0 0 16px;font-size:1rem;color:#dc2626;"><i class="fas fa-triangle-exclamation"></i> رفض الإحالة</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <input type="hidden" name="action" value="rejected">
            <div style="margin-bottom:14px;">
                <label style="font-size:.88rem;font-weight:600;color:#374151;display:block;margin-bottom:6px;">سبب الرفض (اختياري)</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="اكتب سبب الرفض هنا..."></textarea>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="closeRejectModal()" class="btn btn-outline">إلغاء</button>
                <button type="submit" style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;">
                    <i class="fas fa-times"></i> تأكيد الرفض
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function openRejectModal(id) {
    document.getElementById('rejectForm').action = '{{ url("manager/referrals") }}/' + id + '/decide';
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
