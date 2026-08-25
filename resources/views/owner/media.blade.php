@extends('layouts.dashboard')

@section('title', 'ميديا القاعة')
@section('page-title', 'ميديا القاعة')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item active"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item"><i class="fas fa-calendar-times"></i> الأيام المشغولة</a>
    <a href="{{ route('owner.bookings') }}" class="nav-item"><i class="fas fa-calendar-check"></i> الحجوزات</a>
    <a href="{{ route('owner.documents') }}" class="nav-item"><i class="fas fa-file-alt"></i> وثائق التوثيق</a>
    <a href="{{ route('owner.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@unless($hall)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        يجب إنشاء القاعة أولاً. <a href="{{ route('owner.hall-info') }}" style="font-weight:700;">أنشئ القاعة ←</a>
    </div>
@else

<!-- Upload Form -->
@php $remaining = 10 - $media->count(); @endphp
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-cloud-upload-alt"></i> رفع صور جديدة</span>
        <small style="color:#6c7a72;">{{ $media->count() }} / 10 صور</small>
    </div>
    <div class="card-body">
        @if($remaining <= 0)
            <div class="alert alert-warning" style="margin:0;">
                <i class="fas fa-exclamation-triangle"></i>
                وصلت للحد الأقصى (10 صور). احذف بعض الصور لإضافة صور جديدة.
            </div>
        @else
            @if($errors->has('photos') || $errors->has('photos.*'))
                <div class="alert alert-danger" style="margin-bottom:14px;">
                    <ul style="margin:0; padding-right:18px;">
                        @foreach($errors->get('photos') as $msg)
                            <li>{{ $msg }}</li>
                        @endforeach
                        @foreach($errors->get('photos.*') as $msgs)
                            @foreach((array)$msgs as $msg)
                                <li>{{ $msg }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('owner.media.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">اختر الصور (متبقي {{ $remaining }} صورة)</label>
                    <input type="file" name="photos[]" class="form-control"
                           accept="image/jpeg,image/png,image/webp" multiple required>
                    <div style="font-size:.8rem; color:#6c7a72; margin-top:6px;">
                        <i class="fas fa-info-circle"></i>
                        JPG, PNG, WEBP &mdash; حجم بين 200 كيلوبايت و 8 ميجابايت &mdash; دقة لا تقل عن 1280&times;720 (HD)
                    </div>
                </div>
                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> رفع الصور
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- Media Grid -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-photo-video"></i> صور القاعة</span>
        <span style="color:#6c7a72; font-size:.88rem;">{{ $media->count() }} صورة</span>
    </div>
    <div class="card-body">
        @if($media->isEmpty())
            <div style="text-align:center; color:#6c7a72; padding:40px 0;">
                <i class="fas fa-images" style="font-size:3rem; margin-bottom:12px; display:block; opacity:.4;"></i>
                لا توجد صور مرفوعة بعد
            </div>
        @else
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap:16px;">
                @foreach($media as $item)
                    <div style="position:relative; border-radius:10px; overflow:hidden; aspect-ratio:4/3; background:#f0f4f2;">
                        <img src="{{ route('public.storage', ['path' => $item->file_path]) }}" alt="صورة {{ $item->sort_order }}"
                             style="width:100%; height:100%; object-fit:cover;">
                        <form method="POST" action="{{ route('owner.media.delete', $item->id) }}"
                              style="position:absolute; top:6px; left:6px;"
                              onsubmit="return confirm('هل تريد حذف هذه الصورة؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="background:rgba(220,53,69,.85); color:#fff; border:none; border-radius:6px;
                                           width:30px; height:30px; cursor:pointer; font-size:.85rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endunless

@endsection
