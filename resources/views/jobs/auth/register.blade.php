@extends('jobs.layouts.app')
@section('title', 'إنشاء حساب - وظّفني')

@section('content')
<div class="min-h-screen from-brand-600 to-brand-800 flex items-center justify-center py-12 px-4">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full">
        <h2 class="text-3xl font-bold text-center text-surface-900 mb-2">إنشاء حساب</h2>
        <p class="text-center text-surface-600 mb-8">اختر نوع الحساب المناسب لك</p>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- ── نوع الحساب ── --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <label class="cursor-pointer">
                    <input type="radio" name="user_type" value="job_seeker" checked class="hidden peer" onchange="updateUserTypeFields()">
                    <div class="p-4 border-2 border-gray-300 rounded-lg peer-checked:border-brand-600 peer-checked:bg-brand-50 transition text-center">
                        <div class="text-2xl mb-2">👤</div>
                        <span class="font-bold text-sm">باحث عن عمل</span>
                    </div>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="user_type" value="company" class="hidden peer" onchange="updateUserTypeFields()">
                    <div class="p-4 border-2 border-gray-300 rounded-lg peer-checked:border-brand-600 peer-checked:bg-brand-50 transition text-center">
                        <div class="text-2xl mb-2">🏢</div>
                        <span class="font-bold text-sm">شركة</span>
                    </div>
                </label>
            </div>

            {{-- ── حقول الباحث ── --}}
            <div id="job-seeker-fields" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الأول</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="الاسم الأول">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الأخير</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="الاسم الأخير">
                    </div>
                </div>
            </div>

            {{-- ── حقول الشركة ── --}}
            <div id="company-fields" style="display:none;">
                <label class="block text-sm font-medium text-gray-700 mb-2">اسم الشركة</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="اسم الشركة">
            </div>

            {{-- ── حقول مشتركة ── --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('name') border-red-500 @enderror"
                       placeholder="اسمك الكامل">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('phone') border-red-500 @enderror">
                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="مدينتك">
            </div>

            {{-- ══════════════════════════════════════
                 نوع الوظيفة + التخصصات الديناميكية
            ══════════════════════════════════════ --}}
            <div id="seeker-type-field" class="space-y-3">

                <label class="block text-sm font-medium text-gray-700">نوع الوظيفة المطلوبة</label>

                <select name="seeker_type" id="seeker-type-select"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        onchange="loadSpecializations(this.value)">
                    <option value="">-- اختر نوع الوظيفة --</option>
                    <option value="administrative" {{ old('seeker_type') == 'administrative' ? 'selected' : '' }}>وظائف إدارية</option>
                    <option value="professional"   {{ old('seeker_type') == 'professional'   ? 'selected' : '' }}>وظائف مهنية</option>
                    <option value="leadership"     {{ old('seeker_type') == 'leadership'     ? 'selected' : '' }}>وظائف قيادية</option>
                </select>

                {{-- ── صندوق التخصصات ── --}}
                <div id="spec-box" style="display:none;"
                     class="border border-gray-200 rounded-2xl p-4 bg-gray-50 space-y-3">

                    {{-- حالة التحميل --}}
                    <div id="spec-loading" class="flex items-center justify-center gap-2 py-4 text-gray-400 text-sm" style="display:none!important;">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                        </svg>
                        جاري تحميل التخصصات...
                    </div>

                    {{-- قائمة التخصصات --}}
                    <div id="spec-list" class="flex flex-wrap gap-2"></div>

                    {{-- الحقل المخفي الذي يُرسل مع الفورم --}}
                    <input type="hidden" name="desired_specialization" id="desired-spec-input"
                           value="{{ old('desired_specialization') }}">

                    @error('desired_specialization')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- ── نوع الشركة ── --}}
            <div id="company-type-field" style="display:none;" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">نوع الشركة</label>
                <select name="company_type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        onchange="updateCompanyTypeFields()">
                    <option value="">-- اختر نوع الشركة --</option>
                    <option value="transfer"   {{ old('company_type') == 'transfer'   ? 'selected' : '' }}>شركة ترغب في التنازل عن عمالة</option>
                    <option value="employment" {{ old('company_type') == 'employment' ? 'selected' : '' }}>شركة توظيف</option>
                    <option value="leasing"    {{ old('company_type') == 'leasing'    ? 'selected' : '' }}>شركة تأجير عمالة</option>
                    <option value="other"      {{ old('company_type') == 'other'      ? 'selected' : '' }}>أخرى</option>
                </select>
            </div>

            {{-- ── أسباب التنازل ── --}}
            <div id="transfer-reasons-field" style="display:none;" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">أسباب التنازل عن العمالة</label>
                <div class="grid grid-cols-2 gap-2">
                    @php
                    $reasons = [
                        'project_end'    => 'انتهاء المشروع',
                        'cost_reduction' => 'تخفيض التكاليف',
                        'restructuring'  => 'إعادة هيكلة',
                        'seasonal'       => 'عمالة موسمية',
                        'overstaffing'   => 'فائض في الكوادر',
                        'other'          => 'أسباب أخرى',
                    ];
                    @endphp
                    @foreach($reasons as $value => $label)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="transfer_reasons[]" value="{{ $value }}" class="hidden peer">
                        <div class="p-3 border-2 border-gray-200 rounded-xl peer-checked:border-brand-600 peer-checked:bg-brand-50 transition text-center text-xs font-semibold text-gray-700 peer-checked:text-brand-700">
                            {{ $label }}
                        </div>
                    </label>
                    @endforeach
                </div>
                <textarea name="transfer_notes" rows="2"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm mt-2"
                          placeholder="تفاصيل إضافية (اختياري)..."></textarea>
            </div>

            {{-- ── كلمة المرور ── --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <button type="submit"
                    class="w-full px-6 py-3 bg-brand-600 text-white font-bold rounded-lg hover:bg-brand-700 transition">
                إنشاء حساب
            </button>

            <p class="text-center text-sm text-gray-600">
                لديك حساب بالفعل؟
                <a href="{{ route('login') }}" class="text-brand-600 font-bold hover:underline">تسجيل الدخول</a>
            </p>
        </form>
    </div>
</div>

<style>
/* ── Pill ── */
.spec-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 999px;
    border: 1.5px solid #e5e7eb;
    background: white;
    font-size: 0.78rem;
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    transition: all 0.18s ease;
    user-select: none;
}
.spec-pill:hover {
    border-color: #7c3aed;
    color: #7c3aed;
    background: #f5f3ff;
}
.spec-pill.selected {
    border-color: #7c3aed;
    background: #7c3aed;
    color: white;
}
.spec-pill svg {
    width: 13px;
    height: 13px;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    flex-shrink: 0;
}

/* ── Animate box appearance ── */
@keyframes specFadeIn {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}
#spec-box { animation: specFadeIn .25s ease both; }

/* ── Stagger pills ── */
.spec-pill { animation: specFadeIn .2s ease both; }
</style>

<script>
/* ════════════════════════════════════════
   تحميل التخصصات من الـ API عند تغيير النوع
════════════════════════════════════════ */
async function loadSpecializations(type) {
    const box    = document.getElementById('spec-box');
    const list   = document.getElementById('spec-list');
    const input  = document.getElementById('desired-spec-input');
    const loader = document.getElementById('spec-loading');

    // إخفاء الصندوق إن لم يكن هناك نوع
    if (!type) {
        box.style.display = 'none';
        list.innerHTML = '';
        input.value = '';
        return;
    }

    // إظهار الصندوق مع حالة التحميل
    list.innerHTML = '';
    input.value = '';
    loader.style.display = 'flex';
    box.style.display = 'block';

    try {
        const res  = await fetch(`/specializations?type=${type}`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        loader.style.display = 'none';
        renderPills(data, list, input);

    } catch (err) {
        loader.style.display = 'none';
        list.innerHTML = '<p class="text-red-500 text-xs">تعذّر تحميل التخصصات، أعد المحاولة.</p>';
    }
}

/* ── رسم الـ Pills ── */
function renderPills(items, list, input) {
    const oldVal = input.value; // قيمة قديمة (بعد validation error)

    items.forEach((item, idx) => {
        const pill = document.createElement('span');
        pill.className   = 'spec-pill';
        pill.style.animationDelay = (idx * 0.04) + 's';
        pill.dataset.id    = item.id;
        pill.dataset.title = item.title;

        // أيقونة SVG بسيطة (lucide-style) إن وجدت
        const icon = getLucideIcon(item.icon);
        pill.innerHTML = (icon ? icon : '') + escHtml(item.title);

        // استعادة الاختيار القديم
        if (oldVal === item.title) {
            pill.classList.add('selected');
            input.value = item.title;
        }

        pill.addEventListener('click', () => {
            list.querySelectorAll('.spec-pill').forEach(p => p.classList.remove('selected'));
            pill.classList.add('selected');
            input.value = item.title;
        });

        list.appendChild(pill);
    });
}

/* ── أيقونات Lucide المُضمَّنة (SVG paths مختصرة) ── */
function getLucideIcon(name) {
    const icons = {
        'crown':         '<svg viewBox="0 0 24 24"><path d="m2 4 3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14"/></svg>',
        'briefcase':     '<svg viewBox="0 0 24 24"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
        'users':         '<svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'trending-up':   '<svg viewBox="0 0 24 24"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>',
        'settings':      '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
        'cpu':           '<svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>',
        'target':        '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
        'award':         '<svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>',
        'star':          '<svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'layers':        '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
        'lightbulb':     '<svg viewBox="0 0 24 24"><line x1="9" y1="18" x2="15" y2="18"/><line x1="10" y1="22" x2="14" y2="22"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>',
        'megaphone':     '<svg viewBox="0 0 24 24"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>',
        'code':          '<svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
        'smartphone':    '<svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
        'shield':        '<svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'bar-chart':     '<svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
        'pen-tool':      '<svg viewBox="0 0 24 24"><path d="m12 19 7-7 3 3-7 7-3-3z"/><path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="m2 2 7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>',
        'layout':        '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>',
        'building':      '<svg viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M16 6h.01M12 6h.01M12 10h.01M8 10h.01M16 10h.01M12 14h.01M8 14h.01M16 14h.01"/></svg>',
        'tool':          '<svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
        'zap':           '<svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
        'file-text':     '<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
        'scale':         '<svg viewBox="0 0 24 24"><line x1="12" y1="3" x2="12" y2="21"/><path d="M3 6l3 4 3-4"/><path d="M15 6l3 4 3-4"/><path d="M6 10H3"/><path d="M21 10h-3"/><path d="M3 18h7"/><path d="M14 18h7"/></svg>',
        'activity':      '<svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
        'heart':         '<svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
        'clipboard':     '<svg viewBox="0 0 24 24"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>',
        'file':          '<svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>',
        'git-merge':     '<svg viewBox="0 0 24 24"><circle cx="18" cy="18" r="3"/><circle cx="6" cy="6" r="3"/><path d="M6 21V9a9 9 0 0 0 9 9"/></svg>',
        'eye':           '<svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>',
        'monitor':       '<svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
        'phone':         '<svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.58 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6.13 6.13l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'user-check':    '<svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>',
        'archive':       '<svg viewBox="0 0 24 24"><polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/></svg>',
        'pie-chart':     '<svg viewBox="0 0 24 24"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>',
        'shopping-cart': '<svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>',
        'globe':         '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
        'network':       '<svg viewBox="0 0 24 24"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M5 16v-3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3"/><path d="M12 12V8"/></svg>',
        'graduation-cap':'<svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
    };
    return icons[name] ?? '';
}

function escHtml(str) {
    return str.replace(/[&<>"']/g, c => ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[c]));
}

/* ── تبديل نوع الحساب ── */
function updateUserTypeFields() {
    const userType = document.querySelector('input[name="user_type"]:checked').value;
    const isSeeker = userType === 'job_seeker';

    document.getElementById('job-seeker-fields').style.display  = isSeeker ? 'block' : 'none';
    document.getElementById('company-fields').style.display      = isSeeker ? 'none'  : 'block';
    document.getElementById('seeker-type-field').style.display   = isSeeker ? 'block' : 'none';
    document.getElementById('company-type-field').style.display  = isSeeker ? 'none'  : 'block';

    if (!isSeeker) {
        document.getElementById('spec-box').style.display = 'none';
        updateCompanyTypeFields();
    } else {
        document.getElementById('transfer-reasons-field').style.display = 'none';
    }
}

function updateCompanyTypeFields() {
    const sel = document.querySelector('select[name="company_type"]');
    document.getElementById('transfer-reasons-field').style.display =
        sel && sel.value === 'transfer' ? 'block' : 'none';
}

/* ── تهيئة أولية ── */
document.addEventListener('DOMContentLoaded', () => {
    updateUserTypeFields();

    const compSel = document.querySelector('select[name="company_type"]');
    if (compSel) compSel.addEventListener('change', updateCompanyTypeFields);

    // استعادة التخصصات بعد validation error
    const oldType = '{{ old("seeker_type") }}';
    if (oldType) loadSpecializations(oldType);
});
</script>
@endsection
