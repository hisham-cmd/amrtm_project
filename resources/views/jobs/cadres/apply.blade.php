@extends('jobs.layouts.app')
@section('title', 'نموذج بيانات المتقدم للعمل')

@section('extra-styles')
<style>
/* ══ Progress ══ */
.cw-step-item { display:flex;flex-direction:column;align-items:center;gap:6px;flex:1;position:relative; }
.cw-step-item:not(:last-child)::after {
  content:'';position:absolute;top:20px;left:-50%;
  width:100%;height:2px;background:#e2e8f0;z-index:0;transition:background 0.4s;
}
.cw-step-item.done:not(:last-child)::after { background:#9d4db8; }
.cw-step-circle {
  width:40px;height:40px;border-radius:50%;border:2px solid #e2e8f0;
  background:#fff;display:flex;align-items:center;justify-content:center;
  font-size:13px;font-weight:700;color:#94a3b8;z-index:1;position:relative;
  transition:all 0.35s cubic-bezier(0.34,1.56,0.64,1);
}
.cw-step-item.active .cw-step-circle {
  border-color:#9d4db8;background:#9d4db8;color:#fff;
  box-shadow:0 0 0 6px rgba(157,77,184,0.15);
}
.cw-step-item.done .cw-step-circle { border-color:#9d4db8;background:#9d4db8;color:#fff; }
.cw-step-label { font-size:11px;font-weight:600;color:#94a3b8;text-align:center; }
.cw-step-item.active .cw-step-label,
.cw-step-item.done  .cw-step-label { color:#9d4db8; }

/* ══ Panels ══ */
.cw-panel { display:none; }
.cw-panel.active { display:block;animation:cwUp 0.35s cubic-bezier(0.22,1,0.36,1); }
@keyframes cwUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }

/* ══ Fields ══ */
.cw-label { display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:6px; }
.cw-req   { color:#ef4444;margin-right:2px; }
.cw-inp, .cw-sel, .cw-textarea {
  width:100%;padding:12px 16px;border-radius:14px;border:1.5px solid #e2e8f0;
  font-size:13px;color:#1e293b;background:#f8fafc;font-family:inherit;
  outline:none;transition:all 0.18s;box-sizing:border-box;
}
.cw-inp:focus,.cw-sel:focus,.cw-textarea:focus {
  border-color:#9d4db8;background:#fff;box-shadow:0 0 0 4px rgba(157,77,184,0.1);
}
.cw-inp.is-invalid,.cw-sel.is-invalid { border-color:#ef4444 !important; }
.cw-err { font-size:11px;color:#ef4444;margin-top:4px; }

/* ══ Upload ══ */
.cw-drop {
  border:2px dashed #d1d5db;border-radius:16px;padding:24px 16px;
  text-align:center;cursor:pointer;transition:all 0.2s;
  background:#f9fafb;position:relative;
}
.cw-drop:hover,.cw-drop.drag { border-color:#9d4db8;background:#faf5ff; }
.cw-drop.done { border-color:#10b981;background:#f0fdf4; }
.cw-drop input[type=file] {
  position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;
}
#photo-preview {
  width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #9d4db8;
  display:none;margin:0 auto 10px;box-shadow:0 4px 14px rgba(157,77,184,0.3);
}

/* ══ Gender ══ */
.gopt { display:none; }
.glbl {
  display:flex;align-items:center;gap:10px;padding:11px 16px;
  border:2px solid #e2e8f0;border-radius:14px;cursor:pointer;
  transition:all 0.18s;background:#f9fafb;font-size:13px;font-weight:600;
}
.gopt:checked + .glbl { border-color:#9d4db8;background:rgba(157,77,184,0.08);color:#7c3aed; }

/* ══ Buttons ══ */
.btn-next {
  display:inline-flex;align-items:center;gap:8px;padding:13px 26px;
  border-radius:50px;font-size:14px;font-weight:700;font-family:inherit;
  background:linear-gradient(135deg,#9d4db8,#7c3aed);color:#fff;border:none;
  cursor:pointer;transition:all 0.22s;box-shadow:0 6px 18px rgba(157,77,184,0.3);
}
.btn-next:hover { transform:translateY(-2px);box-shadow:0 10px 26px rgba(157,77,184,0.4); }
.btn-prev {
  display:inline-flex;align-items:center;gap:8px;padding:13px 26px;
  border-radius:50px;font-size:14px;font-weight:700;font-family:inherit;
  background:#f1f5f9;color:#64748b;border:none;cursor:pointer;transition:all 0.2s;
}
.btn-prev:hover { background:#e2e8f0; }
.btn-sub {
  display:inline-flex;align-items:center;gap:8px;padding:13px 30px;
  border-radius:50px;font-size:14px;font-weight:700;font-family:inherit;
  background:linear-gradient(135deg,#10b981,#059669);color:#fff;border:none;
  cursor:pointer;transition:all 0.22s;box-shadow:0 6px 18px rgba(16,185,129,0.3);
}
.btn-sub:hover { transform:translateY(-2px); }

/* ══ Server errors banner ══ */
.err-banner {
  background:#fef2f2;border:1.5px solid #fecaca;border-radius:16px;
  padding:14px 18px;margin-bottom:20px;
}
</style>
@endsection

@section('content')
<div class="min-h-screen py-10" style="background:linear-gradient(135deg,#f8fafc,#f3e8ff20,#f8fafc);">
<div class="max-w-3xl mx-auto px-4">

  {{-- Header --}}
  <div class="text-center mb-10">
    <h1 class="text-2xl md:text-3xl font-bold text-surface-900 mb-2">نموذج بيانات المتقدم للعمل</h1>
    <p class="text-sm text-surface-500">أكمل الخطوتين وسنتواصل معك قريباً</p>
  </div>

  {{-- ── Progress (خطوتان) ── --}}
  <div class="flex items-start justify-between px-2 mb-10" id="cw-prog" style="max-width:360px;margin-inline:auto;">
    @foreach([['1','البيانات الشخصية'],['2','الوثائق والتفضيلات']] as [$n,$lbl])
    <div class="cw-step-item {{ $n == '1' ? 'active' : '' }}" data-step="{{ $n }}">
      <div class="cw-step-circle">{{ $n }}</div>
      <span class="cw-step-label">{{ $lbl }}</span>
    </div>
    @endforeach
  </div>

  {{-- ── أخطاء السيرفر ── --}}
  @if($errors->any())
  <div class="err-banner mb-6">
    <p class="font-bold text-red-700 text-sm mb-2">يرجى تصحيح الأخطاء التالية:</p>
    <ul class="space-y-1">
      @foreach($errors->all() as $error)
      <li class="text-xs text-red-600 flex items-center gap-2"><span>•</span> {{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  {{-- ══ FORM ══ --}}
  <form action="{{ route('jobs.cadres.store') }}" method="POST" enctype="multipart/form-data" id="cw-form">
    @csrf

    {{-- ━━━━ STEP 1 — البيانات الشخصية ━━━━ --}}
    <div class="cw-panel active bg-white rounded-3xl shadow-sm border border-surface-100 p-7" id="p1">
      <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center">
          <i data-lucide="user" class="w-4 h-4 text-brand-600"></i>
        </div>
        <div><p class="font-bold text-surface-900">البيانات الشخصية</p><p class="text-xs text-surface-400">الخطوة 1 من 2</p></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
          <label class="cw-label">الدولة <span class="cw-req">*</span></label>
          <input type="text" name="country" value="{{ old('country') }}"
            class="cw-inp {{ $errors->has('country') ? 'is-invalid' : '' }}" placeholder="مثال: مصر">
          @error('country')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">المحافظة / المدينة <span class="cw-req">*</span></label>
          <input type="text" name="city" value="{{ old('city') }}"
            class="cw-inp {{ $errors->has('city') ? 'is-invalid' : '' }}" placeholder="مثال: القاهرة">
          @error('city')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="cw-label">الاسم الأول <span class="cw-req">*</span></label>
          <input type="text" name="first_name" value="{{ old('first_name') }}"
            class="cw-inp {{ $errors->has('first_name') ? 'is-invalid' : '' }}" placeholder="محمد">
          @error('first_name')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">اسم الأب <span class="cw-req">*</span></label>
          <input type="text" name="father_name" value="{{ old('father_name') }}"
            class="cw-inp {{ $errors->has('father_name') ? 'is-invalid' : '' }}" placeholder="أحمد">
          @error('father_name')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">اسم العائلة <span class="cw-req">*</span></label>
          <input type="text" name="last_name" value="{{ old('last_name') }}"
            class="cw-inp {{ $errors->has('last_name') ? 'is-invalid' : '' }}" placeholder="العمري">
          @error('last_name')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">الجنسية <span class="cw-req">*</span></label>
          <input type="text" name="nationality" value="{{ old('nationality') }}"
            class="cw-inp {{ $errors->has('nationality') ? 'is-invalid' : '' }}" placeholder="سعودي / مصري / هندي ...">
          @error('nationality')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="cw-label">تاريخ الميلاد <span class="cw-req">*</span></label>
          <input type="date" name="birth_date" value="{{ old('birth_date') }}"
            class="cw-inp {{ $errors->has('birth_date') ? 'is-invalid' : '' }}"
            max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}">
          @error('birth_date')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">الجنس <span class="cw-req">*</span></label>
          <div class="grid grid-cols-2 gap-2">
            <div>
              <input type="radio" name="gender" value="male" id="gm" class="gopt" {{ old('gender') == 'male' ? 'checked' : '' }}>
              <label for="gm" class="glbl">👨 ذكر</label>
            </div>
            <div>
              <input type="radio" name="gender" value="female" id="gf" class="gopt" {{ old('gender') == 'female' ? 'checked' : '' }}>
              <label for="gf" class="glbl">👩 أنثى</label>
            </div>
          </div>
          @error('gender')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

        <div>
          <label class="cw-label">رقم جواز السفر <span class="cw-req">*</span></label>
          <input type="text" name="passport_number" value="{{ old('passport_number') }}"
            class="cw-inp {{ $errors->has('passport_number') ? 'is-invalid' : '' }}" placeholder="A12345678">
          @error('passport_number')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">البريد الإلكتروني <span class="cw-req">*</span></label>
          <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}"
            class="cw-inp {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="example@mail.com">
          @error('email')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="cw-label">رقم الجوال <span class="cw-req">*</span></label>
          <div style="display:grid;grid-template-columns:130px 1fr;gap:8px;">
            <select name="country_code" class="cw-sel {{ $errors->has('country_code') ? 'is-invalid' : '' }}">
              <option value="">المفتاح</option>
              @foreach([
                '+966'=>'🇸🇦 +966','+971'=>'🇦🇪 +971','+965'=>'🇰🇼 +965','+974'=>'🇶🇦 +974',
                '+973'=>'🇧🇭 +973','+968'=>'🇴🇲 +968','+20'=>'🇪🇬 +20','+962'=>'🇯🇴 +962',
                '+961'=>'🇱🇧 +961','+963'=>'🇸🇾 +963','+964'=>'🇮🇶 +964','+967'=>'🇾🇪 +967',
                '+970'=>'🇵🇸 +970','+212'=>'🇲🇦 +212','+213'=>'🇩🇿 +213','+216'=>'🇹🇳 +216',
                '+218'=>'🇱🇾 +218','+249'=>'🇸🇩 +249','+90'=>'🇹🇷 +90','+1'=>'🇺🇸 +1',
                '+44'=>'🇬🇧 +44','+49'=>'🇩🇪 +49','+33'=>'🇫🇷 +33','+91'=>'🇮🇳 +91',
                '+92'=>'🇵🇰 +92','+63'=>'🇵🇭 +63','+60'=>'🇲🇾 +60','+62'=>'🇮🇩 +62',
              ] as $code=>$lbl)
              <option value="{{ $code }}" {{ old('country_code') == $code ? 'selected' : '' }}>{{ $lbl }}</option>
              @endforeach
            </select>
            <input type="tel" name="phone" value="{{ old('phone') }}"
              class="cw-inp {{ $errors->has('phone') ? 'is-invalid' : '' }}" placeholder="5X XXX XXXX">
          </div>
          @error('country_code')<p class="cw-err">{{ $message }}</p>@enderror
          @error('phone')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

      </div>
    </div>

    {{-- ━━━━ STEP 2 — الوثائق والتفضيلات ━━━━ --}}
    <div class="cw-panel bg-white rounded-3xl shadow-sm border border-surface-100 p-7" id="p2">
      <div class="flex items-center gap-3 mb-6">
        <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
          <i data-lucide="file-text" class="w-4 h-4 text-emerald-600"></i>
        </div>
        <div><p class="font-bold text-surface-900">الوثائق والتفضيلات</p><p class="text-xs text-surface-400">الخطوة 2 من 2</p></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
          <label class="cw-label">البلد المراد العمل به <span class="cw-req">*</span></label>
          <input type="text" name="work_country" value="{{ old('work_country') }}"
            class="cw-inp {{ $errors->has('work_country') ? 'is-invalid' : '' }}" placeholder="مثال: الإمارات">
          @error('work_country')<p class="cw-err">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="cw-label">المؤهلات الدراسية <span class="cw-req">*</span></label>
          <select name="education_level" class="cw-sel {{ $errors->has('education_level') ? 'is-invalid' : '' }}">
            <option value="">-- اختر --</option>
            @foreach([
              'below_secondary'=>'أقل من الثانوي','high_school'=>'ثانوية عامة','diploma'=>'دبلوم',
              'bachelor'=>'بكالوريوس','master'=>'ماجستير','phd'=>'دكتوراه','other'=>'أخرى',
            ] as $val=>$lbl)
            <option value="{{ $val }}" {{ old('education_level') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
            @endforeach
          </select>
          @error('education_level')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

        {{-- الصورة الشخصية --}}
        <div class="md:col-span-2">
          <label class="cw-label">الصورة الشخصية <span class="cw-req">*</span></label>
          <img id="photo-preview" src="" alt="">
          <div class="cw-drop {{ $errors->has('photo') ? 'border-red-400' : '' }}" id="photo-zone">
            <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png" id="photo-input">
            <i data-lucide="camera" class="w-8 h-8 text-brand-400 mx-auto mb-2"></i>
            <p style="font-size:13px;font-weight:600;color:#4b5563;">اضغط لرفع صورتك الشخصية</p>
            <p style="font-size:11px;color:#9ca3af;margin-top:3px;">JPG أو PNG — حد أقصى 3 ميجا</p>
            <p id="photo-nm" class="text-xs font-semibold text-emerald-600 mt-2"></p>
          </div>
          @error('photo')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

        {{-- السيرة الذاتية --}}
        <div class="md:col-span-2">
          <label class="cw-label">رفع السيرة الذاتية <span class="cw-req">*</span></label>
          <div class="cw-drop {{ $errors->has('cv') ? 'border-red-400' : '' }}" id="cv-zone">
            <input type="file" name="cv" accept=".pdf,.doc,.docx" id="cv-input">
            <i data-lucide="file-text" class="w-7 h-7 text-brand-400 mx-auto mb-2"></i>
            <p style="font-size:13px;font-weight:600;color:#4b5563;">ارفع السيرة الذاتية</p>
            <p style="font-size:11px;color:#9ca3af;margin-top:3px;">PDF أو Word — حد أقصى 5 ميجا</p>
            <p id="cv-nm" class="text-xs font-semibold text-emerald-600 mt-2"></p>
          </div>
          @error('cv')<p class="cw-err">{{ $message }}</p>@enderror
        </div>

      </div>

      <label class="flex items-start gap-3 mt-6 cursor-pointer">
        <input type="checkbox" id="agree" class="mt-1" required>
        <span style="font-size:12px;color:#64748b;line-height:1.6;">
          أقر بأن جميع المعلومات صحيحة وأوافق على
          <a href="#" class="text-brand-600 font-bold">سياسة الخصوصية</a> و
          <a href="#" class="text-brand-600 font-bold">شروط الاستخدام</a>.
        </span>
      </label>
    </div>

    {{-- ── أزرار التنقل ── --}}
    <div class="flex items-center justify-between mt-5">
      <button type="button" class="btn-prev" id="btn-prev" style="display:none;" onclick="cwPrev()">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        السابق
      </button>
      <div></div>
      <button type="button" class="btn-next" id="btn-next" onclick="cwNext()">
        التالي
        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      </button>
      <button type="submit" class="btn-sub" id="btn-sub" style="display:none;">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:17px;height:17px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        إرسال الطلب
      </button>
    </div>
  </form>
</div>
</div>
@endsection

@section('extra-scripts')
<script>
/* ══ Wizard State (خطوتان) ══ */
let step = 1;
const TOTAL = 2;

const STEP_FIELDS = {
  1: ['country','city','first_name','father_name','last_name','nationality','birth_date','gender','passport_number','country_code','phone','email'],
  2: ['work_country','education_level','photo','cv'],
};
const serverErrors = @json($errors->keys());
if (serverErrors.length > 0) {
  for (let s = 1; s <= TOTAL; s++) {
    if (STEP_FIELDS[s].some(f => serverErrors.includes(f))) { step = s; break; }
  }
}

/* ══ File uploads ══ */
function setupDrop(inpId, nmId, zoneId, isPhoto) {
  const inp  = document.getElementById(inpId);
  const nm   = document.getElementById(nmId);
  const zone = document.getElementById(zoneId);
  if (!inp) return;
  inp.addEventListener('change', function () {
    if (!this.files[0]) return;
    nm.textContent = '✅ ' + this.files[0].name;
    zone.classList.add('done');
    if (isPhoto) {
      const r = new FileReader();
      r.onload = e => {
        const p = document.getElementById('photo-preview');
        p.src = e.target.result; p.style.display = 'block';
      };
      r.readAsDataURL(this.files[0]);
    }
  });
  ['dragover','dragenter'].forEach(e => zone.addEventListener(e, ev => { ev.preventDefault(); zone.classList.add('drag'); }));
  ['dragleave','drop'].forEach(e => zone.addEventListener(e, () => zone.classList.remove('drag')));
}
setupDrop('photo-input','photo-nm','photo-zone', true);
setupDrop('cv-input',   'cv-nm',   'cv-zone',    false);

/* ══ Validation ══ */
const V = {
  1() {
    let ok = true;
    ['country','city','first_name','father_name','last_name','nationality','birth_date','passport_number','country_code','phone'].forEach(n => {
      const el = document.querySelector(`[name="${n}"]`);
      if (el && !el.value.trim()) { el.classList.add('is-invalid'); ok = false; }
      else el?.classList.remove('is-invalid');
    });
    const em = document.querySelector('[name="email"]');
    if (em && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em.value)) { em.classList.add('is-invalid'); ok = false; }
    else em?.classList.remove('is-invalid');
    if (!document.querySelector('[name="gender"]:checked')) ok = false;
    return ok;
  },
  2() {
    let ok = true;
    const wc = document.querySelector('[name="work_country"]');
    if (wc && !wc.value.trim()) { wc.classList.add('is-invalid'); ok = false; }
    else wc?.classList.remove('is-invalid');
    const edu = document.querySelector('[name="education_level"]');
    if (!edu?.value) { edu?.classList.add('is-invalid'); ok = false; }
    else edu?.classList.remove('is-invalid');
    if (!document.getElementById('photo-input')?.files[0]) ok = false;
    if (!document.getElementById('cv-input')?.files[0]) ok = false;
    return ok;
  },
};

/* ══ UI ══ */
function updateUI() {
  document.querySelectorAll('.cw-panel').forEach((p, i) => p.classList.toggle('active', i + 1 === step));
  document.querySelectorAll('.cw-step-item').forEach(item => {
    const s = +item.dataset.step;
    item.classList.toggle('active', s === step);
    item.classList.toggle('done',   s < step);
  });
  document.getElementById('btn-prev').style.display = step > 1     ? 'inline-flex' : 'none';
  document.getElementById('btn-next').style.display = step < TOTAL ? 'inline-flex' : 'none';
  document.getElementById('btn-sub').style.display  = step === TOTAL ? 'inline-flex' : 'none';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
function cwNext() {
  if (V[step] && !V[step]()) return;
  if (step < TOTAL) { step++; updateUI(); }
}
function cwPrev() {
  if (step > 1) { step--; updateUI(); }
}

/* ══ Init ══ */
updateUI();
</script>
@endsection
