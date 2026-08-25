@extends('jobs.layouts.app')
@section('title', 'تم إرسال طلبك — كوادر')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50/30 to-slate-50
            flex items-center justify-center py-16 px-4">
  <div class="max-w-lg w-full text-center">

    {{-- أيقونة النجاح --}}
    <div class="relative inline-flex mb-8">
      <div style="width:100px;height:100px;border-radius:50%;
                  background:linear-gradient(135deg,#10b981,#059669);
                  display:flex;align-items:center;justify-content:center;
                  box-shadow:0 20px 50px rgba(16,185,129,0.35);
                  animation:successPop 0.6s cubic-bezier(0.34,1.56,0.64,1);">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:48px;height:48px;" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
      {{-- حلقات متموجة --}}
      <div style="position:absolute;inset:-12px;border-radius:50%;
                  border:2px solid rgba(16,185,129,0.3);
                  animation:ripple 1.5s ease-out infinite;"></div>
      <div style="position:absolute;inset:-24px;border-radius:50%;
                  border:2px solid rgba(16,185,129,0.15);
                  animation:ripple 1.5s ease-out 0.4s infinite;"></div>
    </div>

    {{-- شعار كوادر --}}
    <div class="flex items-center justify-center gap-3 mb-5">
      
      <span style="font-size:18px;font-weight:800;color:#1e293b;">كوادر — Cadres</span>
    </div>

    <h1 class="text-3xl font-bold text-surface-900 mb-4" data-i18n="success.title">تم إرسال طلبك بنجاح! 🎉</h1>
    <p class="text-surface-600 mb-8 leading-relaxed">
      شكراً على تقديمك. سيقوم فريق كوادر بمراجعة طلبك والتواصل معك خلال
      <strong class="text-brand-600">3-5 أيام عمل</strong> على بريدك الإلكتروني أو جوالك.
    </p>

    {{-- خطوات ما يحدث بعد ذلك --}}
    <div class="bg-white rounded-2xl border border-surface-100 p-6 text-right mb-8">
      <p class="font-bold text-surface-800 mb-4 text-sm" data-i18n="success.what_next">ماذا يحدث الآن؟</p>
      <div class="space-y-4">
        <div class="flex items-start gap-3">
          <div style="width:28px;height:28px;border-radius:50%;background:#f3e8ff;
                      display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <span style="font-size:12px;font-weight:700;color:#9d4db8;">1</span>
          </div>
          <div>
            <p class="font-semibold text-sm text-surface-800" data-i18n="success.step1_title">مراجعة الطلب</p>
            <p class="text-xs text-surface-500" data-i18n="success.step1_desc">يقوم فريقنا بمراجعة بياناتك ومؤهلاتك</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <div style="width:28px;height:28px;border-radius:50%;background:#f3e8ff;
                      display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <span style="font-size:12px;font-weight:700;color:#9d4db8;">2</span>
          </div>
          <div>
            <p class="font-semibold text-sm text-surface-800" data-i18n="success.step2_title">المطابقة مع الفرص</p>
            <p class="text-xs text-surface-500" data-i18n="success.step2_desc">نبحث عن الوظائف المناسبة لك في دول اختيارك</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <div style="width:28px;height:28px;border-radius:50%;background:#f3e8ff;
                      display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <span style="font-size:12px;font-weight:700;color:#9d4db8;">3</span>
          </div>
          <div>
            <p class="font-semibold text-sm text-surface-800" data-i18n="success.step3_title">التواصل معك</p>
            <p class="text-xs text-surface-500" data-i18n="success.step3_desc">سنتصل بك لتحديد موعد مقابلة مع الشركة المناسبة</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
      <a href="{{ route('welcome') }}"
         class="px-7 py-3 rounded-full font-bold text-sm text-white
                bg-gradient-to-r from-brand-600 to-brand-700 hover:to-brand-800 transition-all
                shadow-lg inline-block">
        العودة للرئيسية
      </a>
      <a href="{{ route('services.professional-jobs') }}"
         class="px-7 py-3 rounded-full font-bold text-sm text-brand-600
                border-2 border-brand-200 hover:border-brand-400 transition-all inline-block">
        استعراض الوظائف
      </a>
    </div>
  </div>
</div>

<style>
@keyframes successPop {
  from { transform:scale(0.5); opacity:0; }
  to   { transform:scale(1);   opacity:1; }
}
@keyframes ripple {
  from { transform:scale(1); opacity:1; }
  to   { transform:scale(1.5); opacity:0; }
}
</style>
@endsection
