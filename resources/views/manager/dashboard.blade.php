@extends('layouts.dashboard')

@section('title', 'لوحة المدير')
@section('page-title', 'لوحة تحكم مدير المشروع')

@section('sidebar-nav')
    <a href="{{ route('manager.dashboard') }}" class="nav-item active"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('manager.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات</a>
    <a href="{{ route('manager.agents') }}" class="nav-item"><i class="fas fa-users"></i> المناديب</a>
    <a href="{{ route('manager.agents.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مندوب</a>
    <a href="{{ route('manager.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('manager.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('manager.halls.create') }}" class="nav-item"><i class="fas fa-plus-circle"></i> تسجيل قاعة</a>
    <a href="{{ route('manager.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('manager.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
    <a href="{{ route('amrtm.user.dashboard') }}" class="nav-item {{ request()->routeIs('amrtm.user*') ? 'active' : '' }}"><i class="fas fa-file-certificate"></i> خدمات الأعمال</a>
@endsection

@section('content')

{{-- Stats --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
@php
$cards = [
    ['icon'=>'fa-users',          'color'=>'#7c3aed', 'num'=>$stats['total_agents'],      'label'=>'المناديب'],
    ['icon'=>'fa-building',       'color'=>'#0284c7', 'num'=>$stats['total_halls'],        'label'=>'القاعات'],
    ['icon'=>'fa-calendar-check', 'color'=>'#16a34a', 'num'=>$stats['total_bookings'],     'label'=>'الحجوزات'],
    ['icon'=>'fa-coins',          'color'=>'#0f766e', 'num'=>number_format($stats['total_commissions'],2).' ر.س', 'label'=>'العمولات المؤكدة'],
    ['icon'=>'fa-clock',          'color'=>'#d97706', 'num'=>$stats['pending_refs'],       'label'=>'إحالات معلقة'],
    ['icon'=>'fa-hourglass-half', 'color'=>'#b45309', 'num'=>$stats['pending_halls'],      'label'=>'قاعات تنتظر موافقة'],
    ['icon'=>'fa-check-double',   'color'=>'#1a5c38', 'num'=>$stats['confirmed_today'],    'label'=>'تأكيدات اليوم'],
    ['icon'=>'fa-chart-line',     'color'=>'#9333ea', 'num'=>$stats['total_agents'],       'label'=>'إجمالي المناديب'],
];
@endphp
@foreach($cards as $card)
<div style="background:#fff;border-radius:14px;padding:18px 20px;box-shadow:0 2px 10px rgba(0,0,0,.06);display:flex;align-items:center;gap:14px;">
    <div style="width:46px;height:46px;border-radius:12px;background:{{ $card['color'] }}1a;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <i class="fas {{ $card['icon'] }}" style="font-size:1.1rem;color:{{ $card['color'] }};"></i>
    </div>
    <div>
        <div style="font-size:1.4rem;font-weight:800;color:#0f3d24;line-height:1;">{{ $card['num'] }}</div>
        <div style="font-size:.78rem;color:#6c7a72;font-weight:600;margin-top:2px;">{{ $card['label'] }}</div>
    </div>
</div>
@endforeach
</div>

@if(session('success'))
<div class="alert alert-success" style="margin-bottom:16px;"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
@endif

{{-- Pending hall requests alert --}}
@if($stats['pending_halls'] > 0)
<div style="background:#fffbeb;border:1.5px solid #fcd34d;border-radius:12px;padding:14px 20px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <div style="display:flex;align-items:center;gap:10px;">
        <i class="fas fa-building" style="color:#d97706;font-size:1.2rem;"></i>
        <div>
            <strong style="color:#b45309;">طلبات قاعات تنتظر المراجعة</strong>
            <div style="font-size:.82rem;color:#92400e;margin-top:2px;">يوجد <strong>{{ $stats['pending_halls'] }}</strong> طلب إضافة قاعة ينتظر قرارك</div>
        </div>
    </div>
    <a href="{{ route('manager.hall-requests') }}"
       style="background:#d97706;color:#fff;border-radius:8px;padding:9px 18px;font-size:.85rem;font-weight:800;text-decoration:none;white-space:nowrap;">
        <i class="fas fa-eye"></i> مراجعة الطلبات
    </a>
</div>
@endif

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

{{-- Pending hall requests --}}
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-building" style="color:#d97706;"></i> أحدث طلبات القاعات</span>
        <a href="{{ route('manager.hall-requests') }}" style="font-size:.82rem;color:#1a5c38;font-weight:700;text-decoration:none;">عرض الكل <i class="fas fa-arrow-left"></i></a>
    </div>
    @if($pendingHalls->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:24px 0;">لا توجد طلبات معلقة</div>
    @else
    <div class="table-wrap">
        <table>
            <thead><tr><th>اسم القاعة</th><th>المالك</th><th>المدينة</th><th>الإجراء</th></tr></thead>
            <tbody>
                @foreach($pendingHalls as $hall)
                <tr>
                    <td><strong>{{ $hall->name }}</strong></td>
                    <td>{{ $hall->owner?->name ?? '—' }}</td>
                    <td>{{ $hall->city }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <form method="POST" action="{{ route('manager.halls.decide', $hall->id) }}">
                                @csrf <input type="hidden" name="decision" value="active">
                                <button type="submit" style="background:#16a34a;color:#fff;border:none;border-radius:7px;padding:5px 11px;font-size:.8rem;font-weight:700;cursor:pointer;"><i class="fas fa-check"></i></button>
                            </form>
                            <form method="POST" action="{{ route('manager.halls.decide', $hall->id) }}" onsubmit="return confirm('رفض الطلب؟')">
                                @csrf <input type="hidden" name="decision" value="rejected">
                                <button type="submit" style="background:#dc2626;color:#fff;border:none;border-radius:7px;padding:5px 11px;font-size:.8rem;font-weight:700;cursor:pointer;"><i class="fas fa-times"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

{{-- Pending manual referrals --}}
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-clock" style="color:#d97706;"></i> الإحالات اليدوية المعلقة</span>
        <a href="{{ route('manager.referrals', ['status'=>'pending','source'=>'manual']) }}" style="font-size:.82rem;color:#1a5c38;font-weight:700;text-decoration:none;">عرض الكل <i class="fas fa-arrow-left"></i></a>
    </div>
    @if($pendingManual->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:24px 0;">لا توجد إحالات معلقة</div>
    @else
    <div class="table-wrap">
        <table>
            <thead><tr><th>المندوب</th><th>العميل</th><th>القاعة</th><th>الملاحظات</th><th>الإجراء</th></tr></thead>
            <tbody>
                @foreach($pendingManual as $ref)
                <tr>
                    <td><strong>{{ $ref->agent?->name ?? '—' }}</strong></td>
                    <td>{{ $ref->user?->name ?? '—' }}<br><small style="color:#6c7a72;">{{ $ref->user?->phone }}</small></td>
                    <td>{{ $ref->hall?->name ?? '—' }}</td>
                    <td style="font-size:.8rem;color:#6c7a72;max-width:180px;">{{ $ref->notes ? Str::limit($ref->notes,60) : '—' }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <form method="POST" action="{{ route('manager.referrals.decide', $ref->id) }}">
                                @csrf <input type="hidden" name="action" value="confirmed">
                                <button type="submit" onclick="return confirm('تأكيد هذه الإحالة؟')" style="background:#16a34a;color:#fff;border:none;border-radius:7px;padding:5px 11px;font-size:.8rem;font-weight:700;cursor:pointer;"><i class="fas fa-check"></i> تأكيد</button>
                            </form>
                            <button type="button" onclick="openRejectModalDash({{ $ref->id }})" style="background:#dc2626;color:#fff;border:none;border-radius:7px;padding:5px 11px;font-size:.8rem;font-weight:700;cursor:pointer;"><i class="fas fa-times"></i> رفض</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

</div>

{{-- Reject Modal (dashboard) --}}
<div id="rejectModalDash" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:14px;padding:28px 30px;width:420px;max-width:95vw;direction:rtl;">
        <h3 style="margin:0 0 16px;font-size:1rem;color:#dc2626;"><i class="fas fa-triangle-exclamation"></i> رفض الإحالة</h3>
        <form id="rejectFormDash" method="POST">
            @csrf
            <input type="hidden" name="action" value="rejected">
            <div style="margin-bottom:14px;">
                <label style="font-size:.88rem;font-weight:600;color:#374151;display:block;margin-bottom:6px;">سبب الرفض (اختياري)</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="اكتب سبب الرفض هنا..."></textarea>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="closeRejectModalDash()" class="btn btn-outline">إلغاء</button>
                <button type="submit" style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;">
                    <i class="fas fa-times"></i> تأكيد الرفض
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function openRejectModalDash(id) {
    document.getElementById('rejectFormDash').action = '{{ url("manager/referrals") }}/' + id + '/decide';
    document.getElementById('rejectModalDash').style.display = 'flex';
}
function closeRejectModalDash() {
    document.getElementById('rejectModalDash').style.display = 'none';
    document.getElementById('rejectModalDash').querySelector('textarea').value = '';
}
document.getElementById('rejectModalDash').addEventListener('click', function(e) {
    if (e.target === this) closeRejectModalDash();
});
</script>

@endsection
