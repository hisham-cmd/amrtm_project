@extends('layouts.dashboard')

@section('title', 'وثائق التوثيق')
@section('page-title', 'وثائق التوثيق')

@section('sidebar-nav')
    <a href="{{ route('owner.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
    <a href="{{ route('owner.hall-info') }}" class="nav-item"><i class="fas fa-info-circle"></i> معلومات القاعة</a>
    <a href="{{ route('owner.media') }}" class="nav-item"><i class="fas fa-images"></i> ميديا القاعة</a>
    <a href="{{ route('owner.features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات القاعة</a>
    <a href="{{ route('owner.additional-features') }}" class="nav-item"><i class="fas fa-star"></i> مميزات إضافية في القاعة</a>
    <a href="{{ route('owner.seasonal-prices') }}" class="nav-item"><i class="fas fa-tags"></i> الأسعار الموسمية</a>
    <a href="{{ route('owner.offers') }}" class="nav-item"><i class="fas fa-gift"></i> العروض الخاصة</a>
    <a href="{{ route('owner.busy-dates') }}" class="nav-item"><i class="fas fa-calendar-times"></i> الأيام المشغولة</a>
    <a href="{{ route('owner.bookings') }}" class="nav-item"><i class="fas fa-calendar-check"></i> الحجوزات</a>
    <a href="{{ route('owner.documents') }}" class="nav-item active"><i class="fas fa-file-alt"></i> وثائق التوثيق</a>
    <a href="{{ route('owner.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> الشركاء</a>
@endsection

@section('content')

@unless($hall)
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        يجب إنشاء القاعة أولاً. <a href="{{ route('owner.hall-info') }}" style="font-weight:700;">أنشئ القاعة ←</a>
    </div>
@else

<div class="alert" style="background:#e8f5ee; border:1px solid #b8dbc8; color:#1a5c38; padding:14px 18px; border-radius:8px; margin-bottom:20px;">
    <i class="fas fa-info-circle"></i>
    <span>
        لتفعيل قاعتك على المنصة، يجب رفع الوثائق الرسمية المطلوبة. سيتم مراجعتها خلال 24-48 ساعة.
    </span>
</div>

<!-- Upload Document -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-upload"></i> رفع وثيقة جديدة</span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('owner.documents.upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">نوع الوثيقة *</label>
                    <select name="document_type" class="form-control @error('document_type') is-invalid @enderror" required>
                        <option value="">-- اختر نوع الوثيقة --</option>
                        <option value="سجل تجاري" {{ old('document_type') === 'سجل تجاري' ? 'selected' : '' }}>سجل تجاري</option>
                        <option value="رخصة البلدية" {{ old('document_type') === 'رخصة البلدية' ? 'selected' : '' }}>رخصة البلدية</option>
                        <option value="هوية المالك" {{ old('document_type') === 'هوية المالك' ? 'selected' : '' }}>هوية المالك</option>
                        <option value="عقد الإيجار" {{ old('document_type') === 'عقد الإيجار' ? 'selected' : '' }}>عقد الإيجار</option>
                        <option value="صور القاعة الرسمية" {{ old('document_type') === 'صور القاعة الرسمية' ? 'selected' : '' }}>صور القاعة الرسمية</option>
                        <option value="أخرى" {{ old('document_type') === 'أخرى' ? 'selected' : '' }}>أخرى</option>
                    </select>
                    @error('document_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">الملف *</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                           accept=".pdf,.jpg,.jpeg,.png" required>
                    <div style="font-size:.78rem; color:#6c7a72; margin-top:5px;">PDF, JPG, PNG — حجم أقصى 5 ميجابايت</div>
                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> رفع الوثيقة
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Documents List -->
<div class="card">
    <div class="card-header">
        <span class="card-title"><i class="fas fa-folder-open"></i> الوثائق المرفوعة</span>
    </div>
    @if($documents->isEmpty())
        <div class="card-body" style="text-align:center; color:#6c7a72; padding:40px 0;">
            <i class="fas fa-file-alt" style="font-size:2.5rem; opacity:.4; display:block; margin-bottom:10px;"></i>
            لم يتم رفع أي وثائق بعد
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>نوع الوثيقة</th>
                        <th>تاريخ الرفع</th>
                        <th>الحالة</th>
                        <th>ملاحظات الإدارة</th>
                        <th>الملف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $doc)
                        @php
                            $dv = $doc->status->value;
                            $dc = ['pending'=>'badge-warning','approved'=>'badge-success','rejected'=>'badge-danger'];
                            $dl = ['pending'=>'قيد المراجعة','approved'=>'مقبولة','rejected'=>'مرفوضة'];
                        @endphp
                        <tr>
                            <td><strong>{{ $doc->document_type }}</strong></td>
                            <td>{{ $doc->created_at->format('Y/m/d') }}</td>
                            <td><span class="badge {{ $dc[$dv] ?? 'badge-secondary' }}">{{ $dl[$dv] ?? $dv }}</span></td>
                            <td style="color:#6c7a72; font-size:.85rem;">{{ $doc->notes ?? '—' }}</td>
                            <td>
                                <a href="{{ route('public.storage', ['path' => $doc->file_path]) }}" target="_blank" class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endunless

@endsection
