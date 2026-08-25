@extends('layouts.dashboard')

@section('title', 'إحالاتي')
@section('page-title', 'إحالاتي')

@section('sidebar-nav')
    <a href="{{ route('agent.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('agent.hall-owner-registration.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مالك قاعة</a>
    <a href="{{ route('agent.referrals') }}" class="nav-item active"><i class="fas fa-link"></i> إحالاتي</a>
    <a href="{{ route('agent.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات المتاحة</a>
@endsection

@section('content')

{{-- Filter --}}
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
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            @if(request()->hasAny(['status']))
                <a href="{{ route('agent.referrals') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-link"></i> قائمة الإحالات</span>
        <span style="color:#6c7a72;font-size:.88rem;">{{ $referrals->total() }} إحالة</span>
    </div>
    @if($referrals->isEmpty())
        <div class="card-body" style="text-align:center;color:#6c7a72;padding:40px 0;">
            <i class="fas fa-link" style="font-size:3rem;opacity:.3;display:block;margin-bottom:12px;"></i>
            لا توجد إحالات مطابقة
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>العميل</th>
                    <th>الجوال</th>
                    <th>القاعة</th>
                    <th>المصدر</th>
                    <th>نسبة العمولة</th>
                    <th>مبلغ العمولة</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $ref)
                @php $sc=['pending'=>['badge-warning','معلقة'],'confirmed'=>['badge-success','مؤكدة'],'paid'=>['badge-info','مدفوعة'],'rejected'=>['badge-danger','مرفوضة']]; [$bc,$bl]=$sc[$ref->status]??['badge-secondary',$ref->status]; @endphp
                <tr>
                    <td>{{ $ref->id }}</td>
                    <td><strong>{{ $ref->user->name }}</strong></td>
                    <td>{{ $ref->user->phone }}</td>
                    <td>{{ $ref->hall->name }}</td>
                    <td><span style="font-size:.8rem;font-weight:700;color:{{ $ref->source==='link'?'#0284c7':'#7c3aed' }};"><i class="fas {{ $ref->source==='link'?'fa-link':'fa-pen' }}"></i> {{ $ref->source==='link'?'رابط':'يدوي' }}</span></td>
                    <td>{{ $ref->commission_rate }}%</td>
                    <td>{{ $ref->commission_amount ? number_format($ref->commission_amount,2).' ر.س' : '—' }}</td>
                    <td><span class="badge {{ $bc }}">{{ $bl }}</span></td>
                    <td>{{ $ref->created_at->format('Y/m/d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body" style="padding-top:0;">{{ $referrals->links() }}</div>
    @endif
</div>

@endsection
