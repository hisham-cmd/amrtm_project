@extends('layouts.dashboard')

@section('title', 'مراجعة الوثيقة')
@section('page-title', 'مراجعة الوثيقة')

@section('sidebar-nav')
    <a href="{{ route('supervisor.dashboard') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i> الرئيسية</a>
    <a href="{{ route('supervisor.users') }}" class="nav-item"><i class="fas fa-users"></i> إدارة المستخدمين</a>
    <a href="{{ route('supervisor.users.create') }}" class="nav-item"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
    <a href="{{ route('supervisor.brands.index') }}" class="nav-item"><i class="fas fa-trademark"></i> العلامات التجارية</a>
    <a href="{{ route('supervisor.franchise.index') }}" class="nav-item"><i class="fas fa-store"></i> الامتيازات</a>
    <a href="{{ route('supervisor.agencies.index') }}" class="nav-item"><i class="fas fa-building"></i> الوكالات</a>
    <a href="{{ route('supervisor.sliders.index') }}" class="nav-item"><i class="fas fa-images"></i> السلايدر</a>
    <a href="{{ route('supervisor.referrals') }}" class="nav-item"><i class="fas fa-link"></i> الإحالات والعمولات</a>
    <a href="{{ route('supervisor.financials') }}" class="nav-item"><i class="fas fa-chart-line"></i> الحركة المالية</a>
    <a href="{{ route('supervisor.halls') }}" class="nav-item active"><i class="fas fa-building"></i> القاعات</a>
    <a href="{{ route('supervisor.hall-requests') }}" class="nav-item"><i class="fas fa-file-circle-plus"></i> طلبات القاعات</a>
    <a href="{{ route('supervisor.bookings') }}" class="nav-item"><i class="fas fa-calendar-alt"></i> الحجوزات</a>
    <a href="{{ route('supervisor.approvals') }}" class="nav-item"><i class="fas fa-file-signature"></i> طلبات التوثيق</a>
    <a href="{{ route('supervisor.partners') }}" class="nav-item"><i class="fas fa-handshake"></i> فئات الشركاء</a>
    <a href="{{ route('supervisor.partner-accounts.index') }}" class="nav-item"><i class="fas fa-id-card-alt"></i> حسابات الشركاء</a>
@endsection

@section('content')

<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; align-items:start;">

    <!-- Document Preview -->
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-file-alt"></i> تفاصيل الوثيقة</span>
        </div>
        <div class="card-body">
            <table style="width:100%; font-size:.9rem;">
                <tr style="border-bottom:1px solid #f0f4f2;">
                      <td style="padding:10px 0; color:#6c7a72; width:140px;">النوع</td>
                      <td style="padding:10px 0;">
                          @if($document->officiant)
                              <span style="background:#6f42c1;color:#fff;padding:2px 10px;border-radius:20px;font-size:.78rem;">مأذون شرعي</span>
                          @elseif($document->hall)
                              <span style="background:#1a5c38;color:#fff;padding:2px 10px;border-radius:20px;font-size:.78rem;">قاعة</span>
                          @else
                              <span style="background:#0d6efd;color:#fff;padding:2px 10px;border-radius:20px;font-size:.78rem;">شريك خدمات</span>
                          @endif
                      </td>
                  </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                      <td style="padding:10px 0; color:#6c7a72; width:140px;">الاسم</td>
                      <td style="padding:10px 0; font-weight:700;">
                          {{ $document->officiant ? $document->owner?->name : ($document->partner?->company_name ?? $document->hall?->name ?? '—') }}
                      </td>
                  </tr>
                  <tr style="border-bottom:1px solid #f0f4f2;">
                      <td style="padding:10px 0; color:#6c7a72;">المالك</td>
                    <td style="padding:10px 0;">{{ $document->owner->name ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 0; color:#6c7a72;">البريد الإلكتروني</td>
                    <td style="padding:10px 0;">{{ $document->owner->email ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 0; color:#6c7a72;">رقم الجوال</td>
                    <td style="padding:10px 0;">{{ $document->owner->phone ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f0f4f2;">
                    <td style="padding:10px 0; color:#6c7a72;">نوع الوثيقة</td>
                    <td style="padding:10px 0;">{{ $document->document_type }}</td>
                </tr>
                <tr>
                    <td style="padding:10px 0; color:#6c7a72;">تاريخ الرفع</td>
                    <td style="padding:10px 0;">{{ $document->created_at->format('Y/m/d H:i') }}</td>
                </tr>
            </table>

            <div style="margin-top:20px;">
                <a href="{{ route('public.storage', ['path' => $document->file_path]) }}" target="_blank" class="btn btn-outline" style="width:100%; justify-content:center;">
                    <i class="fas fa-external-link-alt"></i> فتح الملف في نافذة جديدة
                </a>
            </div>

            @php $ext = pathinfo($document->file_path, PATHINFO_EXTENSION); @endphp
            @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                <div style="margin-top:16px; border-radius:10px; overflow:hidden;">
                    <img src="{{ route('public.storage', ['path' => $document->file_path]) }}" alt="الوثيقة"
                         style="width:100%; border-radius:10px;">
                </div>
            @elseif(strtolower($ext) === 'pdf')
                <div style="margin-top:16px;">
                    <iframe src="{{ route('public.storage', ['path' => $document->file_path]) }}"
                            style="width:100%; height:400px; border-radius:10px; border:1px solid #dde4e0;"></iframe>
                </div>
            @endif
        </div>
    </div>

    <!-- Approval Form -->
    <div class="card" style="margin-bottom:0;">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-gavel"></i> قرار المراجعة</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('supervisor.approvals.process', $document->id) }}">
                @csrf

                <div class="form-group" style="margin-bottom:24px;">
                    <label class="form-label">القرار *</label>
                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <label style="flex:1; cursor:pointer;">
                            <input type="radio" name="action" value="approved" style="display:none;" id="radio-approve">
                            <div class="approval-option" data-value="approved"
                                 style="border:2px solid #dde4e0; border-radius:10px; padding:16px; text-align:center;
                                        transition:all .2s; color:#6c7a72;">
                                <i class="fas fa-check-circle" style="font-size:1.8rem; display:block; margin-bottom:8px;"></i>
                                قبول الوثيقة
                            </div>
                        </label>
                        <label style="flex:1; cursor:pointer;">
                            <input type="radio" name="action" value="rejected" style="display:none;" id="radio-reject">
                            <div class="approval-option" data-value="rejected"
                                 style="border:2px solid #dde4e0; border-radius:10px; padding:16px; text-align:center;
                                        transition:all .2s; color:#6c7a72;">
                                <i class="fas fa-times-circle" style="font-size:1.8rem; display:block; margin-bottom:8px;"></i>
                                رفض الوثيقة
                            </div>
                        </label>
                    </div>
                    @error('action') <div class="invalid-feedback" style="display:block;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">ملاحظات للمالك (اختياري)</label>
                    <textarea name="note" class="form-control" rows="4"
                              placeholder="سبب الرفض أو ملاحظات إضافية...">{{ old('note') }}</textarea>
                </div>

                <div style="display:flex; gap:10px; margin-top:6px;">
                    <a href="{{ route('supervisor.approvals') }}" class="btn btn-outline" style="flex:1; justify-content:center;">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                    <button type="submit" class="btn btn-primary" style="flex:2; justify-content:center;" id="submitBtn" disabled>
                        <i class="fas fa-save"></i> تأكيد القرار
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.querySelectorAll('.approval-option').forEach(function(option) {
        option.addEventListener('click', function() {
            var value = this.dataset.value;
            document.querySelectorAll('.approval-option').forEach(function(o) {
                o.style.borderColor = '#dde4e0';
                o.style.background = '';
                o.style.color = '#6c7a72';
            });
            if (value === 'approved') {
                this.style.borderColor = '#28a745';
                this.style.background = '#d4edda';
                this.style.color = '#155724';
                document.getElementById('radio-approve').checked = true;
            } else {
                this.style.borderColor = '#dc3545';
                this.style.background = '#f8d7da';
                this.style.color = '#721c24';
                document.getElementById('radio-reject').checked = true;
            }
            document.getElementById('submitBtn').disabled = false;
        });
    });
</script>
@endpush

@endsection
