
<button id="lang-btn" onclick="langOpen()" type="button"
  class="nav-icon-btn"
  aria-label="تغيير اللغة / Change Language">
  {{-- أيقونة كرة الأرض الافتراضية --}}
  <i id="lang-btn-icon" class="ti ti-language"
     style="font-size:17px;color:#9d4db8;" aria-hidden="true"></i>
  {{-- علم اللغة — يظهر بعد أول اختيار --}}
  <span id="lang-btn-flag"
        style="font-size:15px;line-height:1;display:none;"></span>
  {{-- سهم --}}
  <i class="ti ti-chevron-down chevron" aria-hidden="true"></i>
</button>

<style>
/* ══ Overlay ══ */
#lang-ov{
  display:none;position:fixed;inset:0;z-index:99992;
  background:rgba(10,12,25,0.58);opacity:0;
  transition:opacity 0.22s ease;
}
#lang-ov.ls-show{display:block;}
#lang-ov.ls-vis{opacity:1;}

/* ══ Modal ══ */
#lang-md{
  display:none;position:fixed;top:50%;left:50%;
  transform:translate(-50%,-54%) scale(0.91);
  z-index:99993;width:min(560px,93vw);
  border-radius:24px;overflow:hidden;background:#fff;
  box-shadow:
    0 0 0 1px rgba(15,23,42,0.06),
    0 28px 64px rgba(15,23,42,0.18),
    0 6px 20px rgba(157,77,184,0.14);
  transition:transform 0.26s cubic-bezier(0.34,1.56,0.64,1),
             opacity 0.2s ease;
  opacity:0;
}
#lang-md.ls-show{display:block;}
#lang-md.ls-vis{transform:translate(-50%,-50%) scale(1);opacity:1;}

/* ══ Header ══ */
#lang-header{
  display:flex;align-items:center;justify-content:space-between;
  padding:18px 22px 14px;border-bottom:1px solid #f0e8ff;
  background:linear-gradient(135deg,#fdf4ff 0%,#f0e6ff 100%);
}

/* ══ Grid ══ */
.lang-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:8px;padding:16px 18px 20px;
}

/* ══ Card ══ */
.lang-card{
  display:flex;flex-direction:column;align-items:center;gap:6px;
  padding:12px 4px 10px;border-radius:14px;
  border:2px solid #eef0f4;background:#fafbfc;
  cursor:pointer;position:relative;user-select:none;
  transition:all 0.2s cubic-bezier(0.34,1.56,0.64,1);
}
.lang-card:hover{
  border-color:#9d4db8;background:#fdf4ff;
  transform:translateY(-3px) scale(1.04);
  box-shadow:0 8px 20px rgba(157,77,184,0.18);
}
.lang-card.lang-active{
  border-color:#9d4db8;
  background:linear-gradient(135deg,#fdf4ff,#ede9fe);
  box-shadow:0 6px 18px rgba(157,77,184,0.24);
}

.lang-flag  { font-size:26px;line-height:1; }
.lang-native{ font-size:11px;font-weight:700;color:#374151;text-align:center;line-height:1.3; }
.lang-en    { font-size:9px;font-weight:500;color:#94a3b8;text-align:center; }
.lang-dir-badge{
  font-size:8px;padding:1px 5px;border-radius:6px;
  background:#f1f5f9;color:#64748b;font-weight:600;
}

.lang-check{
  position:absolute;top:5px;right:5px;
  width:16px;height:16px;border-radius:50%;
  background:#9d4db8;
  display:none;align-items:center;justify-content:center;
}
.lang-active .lang-check{display:flex;}

/* ══ Close btn ══ */
#lang-close-btn{
  width:30px;height:30px;border-radius:50%;border:none;
  background:rgba(255,255,255,0.7);cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  transition:all 0.18s;color:#64748b;
  border:1px solid #e9d5ff;
}
#lang-close-btn:hover{background:#fee2e2;color:#ef4444;border-color:#fecaca;}

/* ══ Scrollable body ══ */
#lang-body{max-height:70vh;overflow-y:auto;}
#lang-body::-webkit-scrollbar{width:3px;}
#lang-body::-webkit-scrollbar-thumb{background:#e2e8f0;border-radius:3px;}

@media(max-width:480px){
  .lang-grid{grid-template-columns:repeat(3,1fr);gap:7px;padding:12px 12px 16px;}
  .lang-flag{font-size:22px;}
  .lang-native{font-size:10px;}
}
</style>

<script>
(function(){
  const LANGS = [
    {code:'ar',flag:'🇸🇦',native:'العربية',   english:'Arabic',    dir:'rtl',label:'العربية',  color:'#006c35'},
    {code:'en',flag:'🇬🇧',native:'English',   english:'English',   dir:'ltr',label:'English',   color:'#012169'},
    {code:'am',flag:'🇪🇹',native:'አማርኛ',     english:'Amharic',   dir:'ltr',label:'አማርኛ',     color:'#078930'},
    {code:'tl',flag:'🇵🇭',native:'Filipino',  english:'Filipino',  dir:'ltr',label:'Filipino',  color:'#0038a8'},
    {code:'ne',flag:'🇳🇵',native:'नेपाली',    english:'Nepali',    dir:'ltr',label:'नेपाली',    color:'#003893'},
    {code:'bn',flag:'🇧🇩',native:'বাংলা',    english:'Bengali',   dir:'ltr',label:'বাংলা',    color:'#006a4e'},
    {code:'ur',flag:'🇵🇰',native:'اردو',      english:'Urdu',      dir:'rtl',label:'اردو',      color:'#115740'},
    {code:'id',flag:'🇮🇩',native:'Indonesia', english:'Indonesian',dir:'ltr',label:'Indonesia', color:'#ce1126'},
    {code:'fr',flag:'🇫🇷',native:'Français',  english:'French',    dir:'ltr',label:'Français',  color:'#002395'},
    {code:'sw',flag:'🇰🇪',native:'Kiswahili', english:'Swahili',   dir:'ltr',label:'Kiswahili', color:'#006600'},
    {code:'zh',flag:'🇨🇳',native:'中文',       english:'Chinese',   dir:'ltr',label:'中文',       color:'#de2910'},
  ];

  let domBuilt = false, currentLang = null;

  window.langOpen  = openM;
  window.langClose = closeM;
  window._langPick = pick;

  /* ── تحميل اللغة المحفوظة ── */
  try {
    const sv = localStorage.getItem('wazzifni_lang');
    if (sv) {
      const f = LANGS.find(l => l.code === sv);
      if (f) { currentLang = f; applyLang(f, false); }
    }
  } catch(e){}
  if (!currentLang) { currentLang = LANGS[0]; applyLang(LANGS[0], false); }

  /* ════ OPEN ════ */
  function openM() {
    buildOnce(); renderCards();
    const ov = document.getElementById('lang-ov');
    const md = document.getElementById('lang-md');
    ov.classList.add('ls-show'); md.classList.add('ls-show');
    requestAnimationFrame(() => {
      ov.classList.add('ls-vis'); md.classList.add('ls-vis');
    });
    document.body.style.overflow = 'hidden';
  }

  /* ════ CLOSE ════ */
  function closeM() {
    const ov = document.getElementById('lang-ov');
    const md = document.getElementById('lang-md');
    if (!ov || !md) return;
    ov.classList.remove('ls-vis'); md.classList.remove('ls-vis');
    setTimeout(() => {
      ov.classList.remove('ls-show');
      md.classList.remove('ls-show');
      document.body.style.overflow = '';
    }, 240);
  }

  /* ════ PICK ════ */
  function pick(lang) {
    currentLang = lang;
    localStorage.setItem('wazzifni_lang', lang.code);
    applyLang(lang, true);
    updateBtn(lang);
    renderCards();
    closeM();
  }

  /* ── تحديث زر الـ Navbar ── */
  function updateBtn(lang) {
    const icon = document.getElementById('lang-btn-icon');
    const flag = document.getElementById('lang-btn-flag');
    if (icon && flag) {
      /* بعد الاختيار: أخفِ الأيقونة وأظهر العلم */
      icon.style.display = 'none';
      flag.style.display = 'inline';
      flag.textContent   = lang.flag;
    }
  }

  /* ── تطبيق اللغة على الصفحة ── */
  function applyLang(lang, animate) {
    updateBtn(lang);
    document.documentElement.setAttribute('dir',  lang.dir);
    document.documentElement.setAttribute('lang', lang.code);
    if (window.i18nTranslate) window.i18nTranslate(lang.code);
    document.dispatchEvent(new CustomEvent('langChanged', { detail: lang }));
  }

  /* ── بناء DOM المودال (مرة واحدة) ── */
  function buildOnce() {
    if (domBuilt) return;
    domBuilt = true;

    /* Overlay */
    const ov = document.createElement('div');
    ov.id = 'lang-ov';
    ov.addEventListener('click', closeM);
    document.body.appendChild(ov);

    /* Modal */
    const md = document.createElement('div');
    md.id = 'lang-md';
    md.innerHTML = `
      <div id="lang-header">
        <div style="display:flex;align-items:center;gap:12px;">
          <div style="width:42px;height:42px;border-radius:13px;
                      background:linear-gradient(135deg,#9d4db8,#c084fc);
                      display:flex;align-items:center;justify-content:center;
                      box-shadow:0 5px 14px rgba(157,77,184,0.32);">
            <i class="ti ti-language"
               style="font-size:21px;color:#fff;" aria-hidden="true"></i>
          </div>
          <div>
            <p style="font-size:15px;font-weight:700;color:#1e293b;margin:0;
                      font-family:inherit;">اختر اللغة</p>
            <p style="font-size:11px;color:#94a3b8;margin:2px 0 0;
                      font-family:inherit;">Choose your preferred language</p>
          </div>
        </div>
        <button id="lang-close-btn" onclick="langClose()" type="button"
                aria-label="إغلاق">
          <i class="ti ti-x" style="font-size:14px;" aria-hidden="true"></i>
        </button>
      </div>

      <div id="lang-body">
        <div class="lang-grid" id="lang-grid"></div>
      </div>

      <div style="padding:8px 20px 14px;text-align:center;
                  border-top:1px solid #f1f5f9;background:#fafbfc;">
        <p style="font-size:10px;color:#cbd5e1;margin:0;font-weight:500;
                  font-family:inherit;">
          🌍 Wazzifni · منصة التوظيف متعددة اللغات · 11 لغة
        </p>
      </div>
    `;
    document.body.appendChild(md);
  }

  /* ── رسم البطاقات ── */
  function renderCards() {
    const grid = document.getElementById('lang-grid');
    if (!grid) return;

    grid.innerHTML = LANGS.map(lang => {
      const active   = currentLang?.code === lang.code;
      const safeJson = JSON.stringify(lang).replace(/"/g, '&quot;');
      return `
        <div class="lang-card ${active ? 'lang-active' : ''}"
             onclick="window._langPick(${safeJson})">

          <div class="lang-check">
            <i class="ti ti-check"
               style="font-size:9px;color:#fff;" aria-hidden="true"></i>
          </div>

          <span class="lang-flag">${lang.flag}</span>

          <span class="lang-native"
                style="${active ? 'color:' + lang.color + ';' : ''}">
            ${lang.native}
          </span>

          <span class="lang-en">${lang.english}</span>

          <span class="lang-dir-badge"
                style="${active
                  ? 'background:' + lang.color + '18;color:' + lang.color + ';'
                  : ''}">
            ${lang.dir.toUpperCase()}
          </span>
        </div>`;
    }).join('');
  }

})();
</script>
