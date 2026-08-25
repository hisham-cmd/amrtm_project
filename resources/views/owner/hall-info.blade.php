@extends('layouts.dashboard')

@section('title', 'معلومات القاعة')
@section('page-title', 'معلومات القاعة')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item">
        <i class="fas fa-tachometer-alt"></i> لوحة التحكم
    </a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item active">
        <i class="fas fa-info-circle"></i> معلومات القاعة
    </a>
    <a href="{{ route('owner.media') }}" class="nav-item">
        <i class="fas fa-images"></i> ميديا القاعة
    </a>
    <a href="{{ route('owner.features') }}" class="nav-item">
        <i class="fas fa-star"></i> مميزات القاعة
    </a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item">
        <i class="fas fa-star"></i> مميزات إضافية في القاعة
    </a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item">
        <i class="fas fa-tags"></i> الأسعار الموسمية
    </a>
    <a href="{{ route('owner.offers') }}" class="nav-item">
        <i class="fas fa-gift"></i> العروض الخاصة
    </a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item">
        <i class="fas fa-calendar-times"></i> الأيام المشغولة
    </a>
    <a href="{{ route('owner.bookings') }}" class="nav-item">
        <i class="fas fa-calendar-check"></i> الحجوزات
    </a>
    <a href="{{ route('owner.documents') }}" class="nav-item">
        <i class="fas fa-file-alt"></i> وثائق التوثيق
    </a>
    <a href="{{ route('owner.partners') }}" class="nav-item">
        <i class="fas fa-handshake"></i> الشركاء
    </a>
@endsection

@section('content')

{{-- Onboarding required notice --}}
@if(session('onboarding_required'))
<div style="background:linear-gradient(135deg,#fff5e6,#fff0d9);border:2px solid #e67e22;border-radius:14px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:flex-start;gap:14px;">
    <i class="fas fa-exclamation-triangle" style="font-size:22px;color:#e67e22;flex-shrink:0;margin-top:2px;"></i>
    <div>
        <strong style="font-size:1rem;color:#c0392b;display:block;margin-bottom:4px;">يجب إكمال إعداد المنشأة أولاً</strong>
        <span style="font-size:.88rem;color:#7a4e20;">لا يمكنك الوصول إلى لوحة التحكم قبل تعبئة معلومات قاعتك الأساسية. يرجى إكمال البيانات أدناه ثم الحفظ.</span>
    </div>
</div>
@endif

{{-- Success flash --}}
@if(session('success'))
<div style="background:#e8f5ee;border:1.5px solid #2a7a4e;border-radius:10px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#1a5c38;font-size:.9rem;font-weight:600;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-info-circle"></i> معلومات القاعة الأساسية</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('owner.hall-info.save') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">اسم القاعة *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $hall?->name) }}" placeholder="مثال: قاعة لمسات" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">المدينة *</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                           value="{{ old('city', $hall?->city) }}" placeholder="الرياض" required>
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">الموقع / العنوان *</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                       value="{{ old('location', $hall?->location) }}" placeholder="حي النزهة، شارع الملك فهد" required>
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-row form-row-3">
                <div class="form-group">
                    <label class="form-label">السعة (عدد الأشخاص) *</label>
                    <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                           value="{{ old('capacity', $hall?->capacity) }}" min="1" required>
                    @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">عدد الطاولات *</label>
                    <input type="number" name="max_tables" class="form-control @error('max_tables') is-invalid @enderror"
                           value="{{ old('max_tables', $hall?->max_tables) }}" min="1" required>
                    @error('max_tables') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">السعر اليومي (ريال) *</label>
                    <input type="number" name="price_per_day" class="form-control @error('price_per_day') is-invalid @enderror"
                           value="{{ old('price_per_day', $hall?->price_per_day) }}" min="0" step="0.01" required>
                    @error('price_per_day') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">رقم الواتساب</label>
                <input type="text" name="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror"
                       value="{{ old('whatsapp_number', $hall?->whatsapp_number) }}" placeholder="966501234567">
                @error('whatsapp_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">وصف القاعة</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          placeholder="اكتب وصفاً تفصيلياً للقاعة...">{{ old('description', $hall?->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">صورة البروفايل</label>
                    @if($hall?->profile_photo)
                        <div style="margin-bottom:8px;">
                            <img src="{{ route('public.storage', ['path' => $hall->profile_photo]) }}" alt="صورة البروفايل"
                                 style="height:80px; border-radius:8px; object-fit:cover;">
                        </div>
                    @endif
                    <input type="file" name="profile_photo" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label class="form-label">صورة الغلاف</label>
                    @if($hall?->cover_photo)
                        <div style="margin-bottom:8px;">
                            <img src="{{ route('public.storage', ['path' => $hall->cover_photo]) }}" alt="صورة الغلاف"
                                 style="height:80px; border-radius:8px; object-fit:cover; width:100%; object-fit:cover;">
                        </div>
                    @endif
                    <input type="file" name="cover_photo" class="form-control" accept="image/*">
                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    حفظ المعلومات
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
