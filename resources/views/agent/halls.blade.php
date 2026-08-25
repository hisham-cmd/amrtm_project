@extends('layouts.dashboard')

@section('title', 'القاعات المتاحة')
@section('page-title', 'القاعات المتاحة للإحالة')

@section('sidebar-nav')
    <a href="{{ route('agent.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('agent.hall-owner-registration.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> تسجيل مالك قاعة</a>
    <a href="{{ route('agent.referrals') }}" class="nav-item"><i class="fas fa-link"></i> إحالاتي</a>
    <a href="{{ route('agent.halls') }}" class="nav-item active"><i class="fas fa-building"></i> القاعات المتاحة</a>
@endsection

@section('content')

{{-- Search --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:14px 20px;">
        <form method="GET" style="display:flex;gap:12px;align-items:flex-end;">
            <div style="flex:1;">
                <input type="text" name="search" class="form-control" placeholder="ابحث باسم القاعة أو المدينة..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> بحث</button>
            @if(request('search'))
                <a href="{{ route('agent.halls') }}" class="btn btn-outline">إعادة تعيين</a>
            @endif
        </form>
    </div>
</div>

@if($halls->isEmpty())
    <div class="card"><div class="card-body" style="text-align:center;color:#6c7a72;padding:50px 0;"><i class="fas fa-building" style="font-size:2rem;opacity:.3;"></i><p style="margin-top:10px;">لا توجد قاعات متاحة</p></div></div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px;">
    @foreach($halls as $hall)
    <div class="card" style="overflow:hidden;display:flex;flex-direction:column;">
        @if($hall->profile_photo)
            <img src="{{ route('public.storage', ['path' => $hall->profile_photo]) }}" alt="{{ $hall->name }}" style="width:100%;height:160px;object-fit:cover;">
        @else
            <div style="width:100%;height:100px;background:linear-gradient(135deg,#1a5c38,#2d8c5e);display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-building" style="color:rgba(255,255,255,.4);font-size:2.5rem;"></i>
            </div>
        @endif

        <div style="padding:14px 16px;flex:1;display:flex;flex-direction:column;gap:8px;">
            <h3 style="font-size:1rem;font-weight:700;color:#1a1a1a;margin:0;">{{ $hall->name }}</h3>
            <div style="font-size:.82rem;color:#6c7a72;display:flex;gap:14px;flex-wrap:wrap;">
                <span><i class="fas fa-location-dot"></i> {{ $hall->city }}</span>
                <span><i class="fas fa-users"></i> {{ number_format($hall->capacity) }} شخص</span>
                <span><i class="fas fa-tag"></i> {{ number_format($hall->price_per_day,0) }} ر.س/يوم</span>
            </div>
            @if($hall->description)
                <p style="font-size:.8rem;color:#6c7a72;margin:0;line-height:1.5;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $hall->description }}</p>
            @endif

            <div style="margin-top:auto;padding-top:10px;">
                <a href="{{ route('agent.dashboard') }}?select_hall={{ $hall->id }}"
                   onclick="selectHall({{ $hall->id }}, '{{ addslashes($hall->name) }}')"
                   class="btn btn-primary" style="width:100%;font-size:.85rem;padding:9px;">
                    <i class="fas fa-hand-pointer"></i> اختر هذه القاعة للإحالة
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="margin-top:18px;">{{ $halls->links() }}</div>
@endif

<script>
function selectHall(id, name) {
    // Store in sessionStorage so dashboard picks it up on load
    sessionStorage.setItem('preselect_hall_id', id);
    sessionStorage.setItem('preselect_hall_name', name);
}
</script>

@endsection
