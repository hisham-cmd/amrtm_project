@extends('layouts.dashboard')

@section('title', 'لوحة المندوب')
@section('page-title', 'لوحة تحكم المندوب')

@section('sidebar-nav')
    <a href="{{ route('agent.dashboard') }}" class="nav-item active"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('agent.hall-owner-registration.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مالك قاعة</a>
    <a href="{{ route('agent.referrals') }}" class="nav-item"><i class="fas fa-link"></i> إحالاتي</a>
    <a href="{{ route('agent.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات المتاحة</a>
@endsection

@section('content')

{{-- Ref code card --}}
@if($refCode)
<div style="background:linear-gradient(135deg,#1a5c38 0%,#2d7a4a 100%); border-radius:16px; padding:24px 28px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden;">
    <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-30px;left:20px;width:90px;height:90px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
    <div style="position:relative;">
        <div style="font-size:.9rem; opacity:.8; margin-bottom:8px;"><i class="fas fa-link"></i> كود الإحالة الخاص بك</div>
        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
            <div id="refCodeText" style="font-size:2rem; font-weight:900; letter-spacing:4px; font-family:monospace;">{{ $refCode->code }}</div>
            <button onclick="copyCode()" id="copyBtn"
                style="background:rgba(255,255,255,.15); border:1.5px solid rgba(255,255,255,.3); color:#fff; border-radius:10px;
                       padding:10px 20px; font-size:.88rem; font-weight:700; cursor:pointer; backdrop-filter:blur(4px);">
                <i class="fas fa-copy"></i> نسخ الكود
            </button>
        </div>
        <div style="margin-top:10px; font-size:.82rem; opacity:.75;">
            رابط الإحالة:
            <span id="refLink" style="direction:ltr; display:inline-block; background:rgba(255,255,255,.1); padding:4px 10px; border-radius:6px;">
                {{ url('/halls_list') }}?ref={{ $refCode->code }}
            </span>
            <button onclick="copyLink()" style="background:transparent; border:none; color:#fff; cursor:pointer; font-size:.85rem; margin-right:4px;">
                <i class="fas fa-copy"></i>
            </button>
        </div>
    </div>
</div>
@endif

{{-- Stats --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
    @php
    $cards = [
        ['icon'=>'fa-link',       'color'=>'#0284c7', 'num'=>$stats['total'],     'label'=>'إجمالي الإحالات'],
        ['icon'=>'fa-clock',      'color'=>'#d97706', 'num'=>$stats['pending'],   'label'=>'معلقة'],
        ['icon'=>'fa-check',      'color'=>'#16a34a', 'num'=>$stats['confirmed'], 'label'=>'مؤكدة'],
        ['icon'=>'fa-coins',      'color'=>'#7c3aed', 'num'=>number_format($stats['earned'],2).' ر.س', 'label'=>'إجمالي العمولات'],
    ];
    @endphp
    @foreach($cards as $card)
    <div style="background:#fff; border-radius:14px; padding:18px 20px; box-shadow:0 2px 10px rgba(0,0,0,.06); display:flex; align-items:center; gap:14px;">
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

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-link"></i> آخر الإحالات</span>
        <a href="{{ route('agent.referrals') }}" style="font-size:.82rem;color:#1a5c38;font-weight:700;text-decoration:none;">عرض الكل <i class="fas fa-arrow-left"></i></a>
    </div>
    @if($recentReferrals->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:30px 0;">لا توجد إحالات بعد</div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>العميل</th>
                    <th>القاعة</th>
                    <th>المصدر</th>
                    <th>العمولة</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentReferrals as $ref)
                @php $sc=['pending'=>['badge-warning','معلقة'],'confirmed'=>['badge-success','مؤكدة'],'paid'=>['badge-info','مدفوعة'],'rejected'=>['badge-danger','مرفوضة']]; [$bc,$bl]=$sc[$ref->status]??['badge-secondary',$ref->status]; @endphp
                <tr>
                    <td><strong>{{ $ref->user->name }}</strong></td>
                    <td>{{ $ref->hall->name }}</td>
                    <td><span style="font-size:.8rem;font-weight:700;color:{{ $ref->source==='link'?'#0284c7':'#7c3aed' }};"><i class="fas {{ $ref->source==='link'?'fa-link':'fa-pen' }}"></i> {{ $ref->source==='link'?'رابط':'يدوي' }}</span></td>
                    <td>{{ $ref->commission_amount ? number_format($ref->commission_amount,2).' ر.س' : '—' }}</td>
                    <td><span class="badge {{ $bc }}">{{ $bl }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

</div>

<script>
function copyCode() {
    navigator.clipboard.writeText('{{ $refCode?->code }}').then(() => {
        const btn = document.getElementById('copyBtn');
        btn.innerHTML = '<i class="fas fa-check"></i> تم النسخ!';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy"></i> نسخ الكود', 2000);
    });
}
function copyLink() {
    navigator.clipboard.writeText('{{ url("/halls_list") }}?ref={{ $refCode?->code }}').then(() => {
        alert('تم نسخ رابط الإحالة!');
    });
}
</script>

@endsection
