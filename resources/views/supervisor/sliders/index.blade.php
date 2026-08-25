@extends('layouts.dashboard')

@section('title', 'إدارة السلايدر')
@section('page-title', 'صور السلايدر')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> المستخدمون</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item active"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> التوثيق</a>
@endsection

@push('styles')
<style>
    .slider-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:18px; }
    .slider-card {
        background:#fff; border-radius:16px; overflow:hidden;
        box-shadow:0 1px 6px rgba(13,36,72,.07); border:1.5px solid #e8edf5;
        transition:transform .2s,box-shadow .2s;
    }
    .slider-card:hover { transform:translateY(-3px); box-shadow:0 6px 22px rgba(13,36,72,.1); }
    .slider-card.inactive { border-color:#fecaca; }
    .slider-thumb { position:relative; height:168px; background:var(--navy-pale); overflow:hidden; }
    .slider-thumb img { width:100%;height:100%;object-fit:cover; }
    .slider-badge { position:absolute;top:10px;right:10px; }
    .slider-order { position:absolute;top:10px;left:10px;background:rgba(0,0,0,.55);color:#fff;padding:3px 10px;border-radius:8px;font-size:.74rem;font-weight:700; }
    .slider-body { padding:14px 16px; }
    .slider-title { font-weight:700;color:var(--text-dark);font-size:.93rem;margin-bottom:2px; }
    .slider-sub { font-size:.78rem;color:var(--text-muted);margin-bottom:8px; }
    .slider-link { font-size:.74rem;color:var(--navy);margin-bottom:12px;display:flex;align-items:center;gap:4px; word-break:break-all; }
    .slider-actions { display:flex;gap:8px; }
</style>
@endpush

@section('content')

<div class="section-header">
    <div class="section-title">
        <div class="section-title-bar"></div>
        <i class="fas fa-images"></i> صور السلايدر
        <span class="badge badge-navy" style="font-size:.75rem;">{{ $sliders->count() }}</span>
    </div>
    <a href="{{ route('supervisor.sliders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> إضافة صورة
    </a>
</div>

<div class="alert alert-info" style="margin-bottom:20px;">
    <i class="fas fa-info-circle"></i>
    <span>تظهر هذه الصور كسلايدر متحرك في صفحة العلامات التجارية والامتيازات. الترتيب الأصغر يظهر أولاً.</span>
</div>

@if($sliders->isEmpty())
<div class="card">
    <div class="empty-state" style="padding:60px;">
        <i class="fas fa-images"></i>
        <h3>لا توجد صور بعد</h3>
        <p><a href="{{ route('supervisor.sliders.create') }}" style="color:var(--navy);font-weight:700;">أضف أولى الصور</a></p>
    </div>
</div>
@else
<div class="slider-grid">
    @foreach($sliders as $slider)
    <div class="slider-card {{ !$slider->is_active ? 'inactive' : '' }}">
        <div class="slider-thumb">
            <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}">
            <div class="slider-badge">
                <span class="badge {{ $slider->is_active ? 'badge-success' : 'badge-danger' }}">
                    {{ $slider->is_active ? 'نشطة' : 'مخفية' }}
                </span>
            </div>
            <div class="slider-order">ترتيب: {{ $slider->sort_order }}</div>
        </div>
        <div class="slider-body">
            <div class="slider-title">{{ $slider->title ?: '(بدون عنوان)' }}</div>
            @if($slider->subtitle)
                <div class="slider-sub">{{ $slider->subtitle }}</div>
            @endif
            @if($slider->link_url)
                <div class="slider-link"><i class="fas fa-link" style="font-size:10px;opacity:.6;flex-shrink:0;"></i> {{ Str::limit($slider->link_url, 42) }}</div>
            @endif
            <div class="slider-actions">
                <a href="{{ route('supervisor.sliders.edit', $slider) }}" class="action-btn action-btn-edit" style="flex:1;justify-content:center;">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                <form method="POST" action="{{ route('supervisor.sliders.toggle', $slider) }}" style="flex:1;">
                    @csrf
                    <button type="submit" class="action-btn {{ $slider->is_active ? 'action-btn-warning' : 'action-btn-success' }}" style="width:100%;justify-content:center;">
                        <i class="fas fa-{{ $slider->is_active ? 'eye-slash' : 'eye' }}"></i>
                        {{ $slider->is_active ? 'إخفاء' : 'إظهار' }}
                    </button>
                </form>
                <form method="POST" action="{{ route('supervisor.sliders.destroy', $slider) }}" onsubmit="return confirm('حذف هذه الصورة نهائياً؟')">
                    @csrf @method('DELETE')
                    <button type="submit" class="action-btn action-btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
