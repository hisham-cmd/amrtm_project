<button id="cs-btn" onclick="csOpen()" type="button"
  style="display:flex;align-items:center;gap:8px;padding:6px 14px 6px 10px;
         border-radius:50px;border:1.5px solid #e2e8f0;background:#fff;
         cursor:pointer;transition:border-color 0.2s,box-shadow 0.2s;
         font-family:inherit;"
  onmouseover="this.style.borderColor='#9d4db8';this.style.boxShadow='0 4px 14px rgba(157,77,184,0.22)';"
  onmouseout="this.style.borderColor='#e2e8f0';this.style.boxShadow='';"
  title="تغيير الدولة">
  <div style="width:26px;height:19px;border-radius:4px;overflow:hidden;flex-shrink:0;
              background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
    <img id="cs-btn-img" src="" alt=""
      style="width:100%;height:100%;object-fit:cover;display:none;">
    <svg id="cs-btn-globe" xmlns="http://www.w3.org/2000/svg"
      style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24"
      stroke="#94a3b8" stroke-width="1.8">
      <circle cx="12" cy="12" r="10"/>
      <path stroke-linecap="round"
        d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
    </svg>
  </div>
  <span id="cs-btn-label" class="hidden md:inline"
    style="font-size:12px;font-weight:600;color:#374151;font-family:inherit;
           max-width:72px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
    الدولة
  </span>
  <svg xmlns="http://www.w3.org/2000/svg"
    style="width:11px;height:11px;flex-shrink:0;color:#9ca3af;"
    fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round"
      stroke-width="2.5" d="M19 9l-7 7-7-7"/>
  </svg>
</button>

<style>

#cs-ov {
  display:none;                     
  position:fixed;inset:0;z-index:99990;
  background:rgba(10,12,25,0.72);
  opacity:0;
  transition:opacity 0.26s ease;
}
#cs-ov.cs-show {
  display:block;
}
#cs-ov.cs-vis {
  opacity:1;
}

#cs-md {
  display:none;                      
  position:fixed;
  top:50%;left:50%;
  transform:translate(-50%,-50%) scale(0.88) translateY(24px);
  z-index:99991;
  width:min(620px,94vw);
  max-height:88vh;
  border-radius:28px;
  overflow:hidden;
  background:#fff;
  box-shadow:
    0 0 0 1px rgba(157,77,184,0.18),
    0 32px 80px rgba(0,0,0,0.28),
    0 60px 120px rgba(157,77,184,0.1);
  flex-direction:column;
  opacity:0;
  transition:
    opacity  0.3s cubic-bezier(0.22,1,0.36,1),
    transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
  /* backdrop-filter على المودال نفسه بدل الـ overlay لتفادي الـ flash */
}
#cs-md.cs-show {
  display:flex;
}
#cs-md.cs-vis {
  opacity:1;
  transform:translate(-50%,-50%) scale(1) translateY(0);
}

/* ── overlay blur بعد الإظهار فقط ── */
#cs-ov.cs-vis {
  backdrop-filter:blur(10px);
  -webkit-backdrop-filter:blur(10px);
}

/* ── Cards ── */
.cs-card {
  display:flex;flex-direction:column;align-items:center;gap:8px;
  padding:14px 6px 12px;border-radius:18px;cursor:pointer;
  border:2px solid #eaecf0;background:#f9fafb;
  transition:all 0.2s cubic-bezier(0.34,1.3,0.64,1);
}
.cs-card:hover {
  transform:translateY(-5px) scale(1.04);
  border-color:#d8b4fe;
  box-shadow:0 10px 26px rgba(157,77,184,0.18);
}
.cs-card.cs-sel { border-width:2.5px; }
.cs-card .cfw {
  width:50px;height:36px;border-radius:8px;overflow:hidden;
  box-shadow:0 3px 10px rgba(0,0,0,0.2);background:#e2e8f0;
}
.cs-card .cfw img { width:100%;height:100%;object-fit:cover;display:block; }
.cs-card .cnm {
  font-size:11px;font-weight:700;color:#374151;
  text-align:center;line-height:1.3;font-family:inherit;
}
.cs-card .cck {
  width:20px;height:20px;border-radius:50%;background:#9d4db8;
  display:flex;align-items:center;justify-content:center;
}

/* ── Rows ── */
.cs-row {
  display:flex;align-items:center;gap:12px;
  padding:11px 14px;border-radius:14px;cursor:pointer;
  border:1.5px solid transparent;transition:all 0.13s;
}
.cs-row:hover { background:#faf5ff; }
.cs-row.cs-sel { background:rgba(157,77,184,0.06); }
.cs-row .rfw {
  width:38px;height:27px;border-radius:6px;overflow:hidden;
  box-shadow:0 2px 8px rgba(0,0,0,0.14);background:#e2e8f0;flex-shrink:0;
}
.cs-row .rfw img { width:100%;height:100%;object-fit:cover;display:block; }
.cs-row .rnm { font-size:13px;font-weight:600;color:#1e293b;flex:1;font-family:inherit; }
.cs-row .rcd { font-size:11px;color:#94a3b8;font-family:inherit; }
.cs-row .rck {
  width:22px;height:22px;border-radius:50%;background:#9d4db8;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}

/* ── Scrollbar ── */
#cs-scroll::-webkit-scrollbar      { width:4px; }
#cs-scroll::-webkit-scrollbar-track{ background:transparent; }
#cs-scroll::-webkit-scrollbar-thumb{ background:#ddd;border-radius:4px; }

@media(max-width:480px){
  .cs-card{padding:10px 4px 8px;}
  .cs-card .cfw{width:40px;height:29px;}
  .cs-card .cnm{font-size:10px;}
}
</style>

<script>
/* ══════════════════════════════════════════════════════════
   Country Selector — يعمل بعد تحميل الصفحة كاملاً
   لا يُنشئ أي عناصر DOM إلا عند الحاجة الفعلية
══════════════════════════════════════════════════════════ */
(function(){
  const C = [
    {c:'sa',code:'SA',n:'المملكة العربية السعودية',s:'السعودية', feat:1,clr:'#006c35'},
    {c:'ae',code:'AE',n:'الإمارات العربية المتحدة',s:'الإمارات', feat:1,clr:'#00732f'},
    {c:'kw',code:'KW',n:'الكويت',                  s:'الكويت',  feat:1,clr:'#007a3d'},
    {c:'qa',code:'QA',n:'قطر',                     s:'قطر',     feat:1,clr:'#8d1b3d'},
    {c:'bh',code:'BH',n:'البحرين',                 s:'البحرين', feat:1,clr:'#ce1126'},
    {c:'om',code:'OM',n:'عُمان',                   s:'عُمان',   feat:1,clr:'#db161b'},
    {c:'eg',code:'EG',n:'مصر',                     s:'مصر',     feat:1,clr:'#ce1126'},
    {c:'jo',code:'JO',n:'الأردن',                  s:'الأردن',  feat:1,clr:'#007a3d'},
    {c:'lb',code:'LB',n:'لبنان',                   s:'لبنان',   feat:1,clr:'#00a651'},
    {c:'iq',code:'IQ',n:'العراق',                  s:'العراق',  feat:1,clr:'#007a3d'},
    {c:'ps',code:'PS',n:'فلسطين',                  s:'فلسطين',  feat:1,clr:'#239e46'},
    {c:'ma',code:'MA',n:'المغرب',                  s:'المغرب',  feat:1,clr:'#c1272d'},
    {c:'dz',code:'DZ',n:'الجزائر',                 s:'الجزائر', feat:1,clr:'#006233'},
    {c:'tn',code:'TN',n:'تونس',                    s:'تونس',    feat:1,clr:'#e70013'},
    {c:'ly',code:'LY',n:'ليبيا',                   s:'ليبيا',   feat:1,clr:'#239e46'},
    {c:'ye',code:'YE',n:'اليمن',                   s:'اليمن',   feat:1,clr:'#ce1126'},
    {c:'sd',code:'SD',n:'السودان',                 s:'السودان', feat:1,clr:'#007229'},
    {c:'sy',code:'SY',n:'سوريا',                   s:'سوريا',   feat:1,clr:'#ce1126'},
    {c:'us',code:'US',n:'الولايات المتحدة',         s:'أمريكا',  clr:'#b22234'},
    {c:'gb',code:'GB',n:'المملكة المتحدة',          s:'بريطانيا',clr:'#012169'},
    {c:'de',code:'DE',n:'ألمانيا',                 s:'ألمانيا', clr:'#dd0000'},
    {c:'fr',code:'FR',n:'فرنسا',                   s:'فرنسا',   clr:'#002395'},
    {c:'tr',code:'TR',n:'تركيا',                   s:'تركيا',   clr:'#e30a17'},
    {c:'pk',code:'PK',n:'باكستان',                 s:'باكستان', clr:'#115740'},
    {c:'in',code:'IN',n:'الهند',                   s:'الهند',   clr:'#ff9933'},
    {c:'ph',code:'PH',n:'الفلبين',                 s:'الفلبين', clr:'#0038a8'},
    {c:'id',code:'ID',n:'إندونيسيا',               s:'إندونيسيا',clr:'#ce1126'},
    {c:'my',code:'MY',n:'ماليزيا',                 s:'ماليزيا', clr:'#cc0001'},
    {c:'sg',code:'SG',n:'سنغافورة',                s:'سنغافورة',clr:'#ef3340'},
    {c:'cn',code:'CN',n:'الصين',                   s:'الصين',   clr:'#de2910'},
    {c:'jp',code:'JP',n:'اليابان',                 s:'اليابان', clr:'#bc002d'},
    {c:'kr',code:'KR',n:'كوريا الجنوبية',           s:'كوريا',   clr:'#003478'},
    {c:'ru',code:'RU',n:'روسيا',                   s:'روسيا',   clr:'#d52b1e'},
    {c:'ca',code:'CA',n:'كندا',                    s:'كندا',    clr:'#ff0000'},
    {c:'au',code:'AU',n:'أستراليا',                s:'أستراليا',clr:'#00008b'},
    {c:'nz',code:'NZ',n:'نيوزيلندا',               s:'نيوزيلندا',clr:'#00247d'},
    {c:'br',code:'BR',n:'البرازيل',                s:'البرازيل',clr:'#009c3b'},
    {c:'mx',code:'MX',n:'المكسيك',                 s:'المكسيك', clr:'#006847'},
    {c:'it',code:'IT',n:'إيطاليا',                 s:'إيطاليا', clr:'#009246'},
    {c:'es',code:'ES',n:'إسبانيا',                 s:'إسبانيا', clr:'#c60b1e'},
    {c:'nl',code:'NL',n:'هولندا',                  s:'هولندا',  clr:'#ae1c28'},
    {c:'se',code:'SE',n:'السويد',                  s:'السويد',  clr:'#006aa7'},
    {c:'ch',code:'CH',n:'سويسرا',                  s:'سويسرا',  clr:'#ff0000'},
    {c:'za',code:'ZA',n:'جنوب أفريقيا',             s:'جنوب أفريقيا',clr:'#007a4d'},
    {c:'ng',code:'NG',n:'نيجيريا',                 s:'نيجيريا', clr:'#008751'},
    {c:'et',code:'ET',n:'إثيوبيا',                 s:'إثيوبيا', clr:'#078930'},
  ];

  const FL  = cc => `https://flagcdn.com/w80/${cc}.png`;
  const BRD = '#9d4db8';

  let sel = null, det = null;
  let domBuilt = false;   /* ← يُبنى المودال مرة واحدة فقط عند أول فتح */

  /* expose */
  window.csOpen  = openM;
  window.csClose = closeM;
  window._csPick = pick;

  /* ══ تحميل الدولة المحفوظة عند بدء الصفحة
     (فقط تحديث الزر — لا overlay لا blur لا DOM)
  ══ */
  try {
    const sv = localStorage.getItem('wazzifni_country');
    if (sv) applyBtn(JSON.parse(sv));
  } catch(e) {}

  /* ══ اكتشاف الـ IP في الخلفية بدون أي تأثير مرئي ══ */
  fetch('{{ route("jobs.geo") }}')
    .then(r => r.json())
    .then(d => {
      const f = C.find(x => x.code === d.country_code);
      if (!f) return;
      det = f;
      if (!localStorage.getItem('wazzifni_country')) {
        applyBtn(f);
        localStorage.setItem('wazzifni_country', JSON.stringify(f));
      }
    })
    .catch(() => {
      if (!localStorage.getItem('wazzifni_country')) {
        const sa = C.find(x => x.code === 'SA');
        if (sa) applyBtn(sa);
      }
    });

  /* ══ تحديث زر الـ Navbar فقط (بدون DOM ثقيل) ══ */
  function applyBtn(country) {
    if (!country) return;
    sel = country;
    const img   = document.getElementById('cs-btn-img');
    const globe = document.getElementById('cs-btn-globe');
    if (img && globe) {
      img.src             = FL(country.c);
      img.style.display   = 'block';
      globe.style.display = 'none';
    }
    const lbl = document.getElementById('cs-btn-label');
    if (lbl) lbl.textContent = country.s || country.n;
  }

  /* ══ بناء DOM المودال — مرة واحدة فقط عند أول فتح ══ */
  function buildOnce() {
    if (domBuilt) return;
    domBuilt = true;

    /* Overlay */
    const ov = document.createElement('div');
    ov.id = 'cs-ov';
    ov.addEventListener('click', closeM);
    document.body.appendChild(ov);

    /* Modal */
    const md = document.createElement('div');
    md.id = 'cs-md';
    md.innerHTML = buildHTML();
    document.body.appendChild(md);

    /* ربط الأحداث */
    md.querySelector('#cs-close-btn').addEventListener('click', closeM);
    md.querySelector('#cs-use-det').addEventListener('click', () => { if (det) pick(det); });
    md.querySelector('#cs-q').addEventListener('input', function () { renderAll(this.value); });

    /* تحديث شريط الاكتشاف إن كان موجوداً */
    if (det) {
      md.querySelector('#cs-det-nm').textContent = det.n;
      md.querySelector('#cs-det-img').src        = FL(det.c);
      md.querySelector('#cs-det').style.display  = 'flex';
    }
  }

  /* ══ open ══ */
  function openM() {
    buildOnce();                     /* ← ينشئ DOM فقط عند الفتح */

    const md = document.getElementById('cs-md');
    const ov = document.getElementById('cs-ov');

    /* إظهار بـ display أولاً */
    md.classList.add('cs-show');
    ov.classList.add('cs-show');

    /* ثم trigger الـ transition في الـ frame التالي */
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        md.classList.add('cs-vis');
        ov.classList.add('cs-vis');
      });
    });

    /* تهيئة المحتوى */
    const q = md.querySelector('#cs-q');
    q.value = '';
    renderAll('');
    setTimeout(() => q.focus(), 340);
    document.body.style.overflow = 'hidden';
  }

  /* ══ close ══ */
  function closeM() {
    const md = document.getElementById('cs-md');
    const ov = document.getElementById('cs-ov');
    if (!md || !ov) return;

    md.classList.remove('cs-vis');
    ov.classList.remove('cs-vis');

    /* إخفاء بـ display بعد انتهاء الـ transition */
    setTimeout(() => {
      md.classList.remove('cs-show');
      ov.classList.remove('cs-show');
    }, 320);

    document.body.style.overflow = '';
  }

  /* ══ pick ══ */
  function pick(country) {
    applyBtn(country);
    localStorage.setItem('wazzifni_country', JSON.stringify(country));
    document.dispatchEvent(new CustomEvent('countryChanged', { detail: country }));

    const btn = document.getElementById('cs-btn');
    btn.style.transform = 'scale(1.1)';
    setTimeout(() => btn.style.transform = '', 250);
    setTimeout(closeM, 80);
  }

  /* ══ render ══ */
  function renderAll(q) {
    const low = q.trim().toLowerCase();
    const fs  = document.getElementById('cs-feat-sec');
    fs.style.display = low ? 'none' : 'block';
    if (!low) renderFeat();
    const list = C.filter(x =>
      !low || x.n.includes(q) || x.s.includes(q) || x.code.toLowerCase().includes(low)
    );
    renderList(list);
  }

  function renderFeat() {
    document.getElementById('cs-feat-grid').innerHTML =
      C.filter(x => x.feat).map(x => {
        const is  = sel?.code === x.code;
        const enc = encodeURIComponent(JSON.stringify(x));
        return `
          <div class="cs-card${is ? ' cs-sel' : ''}"
            onclick="window._csPick(JSON.parse(decodeURIComponent('${enc}')))"
            style="${is ? `border-color:${x.clr};box-shadow:0 8px 24px ${x.clr}28;` : ''}">
            <div class="cfw" style="${is ? `box-shadow:0 4px 16px ${x.clr}45;` : ''}">
              <img src="${FL(x.c)}" alt="${x.s}" loading="lazy">
            </div>
            <span class="cnm" style="${is ? `color:${x.clr};` : ''}">${x.s}</span>
            ${is ? `<div class="cck">
              <svg xmlns="http://www.w3.org/2000/svg" style="width:11px;height:11px;"
                fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg></div>` : ''}
          </div>`;
      }).join('');
  }

  function renderList(list) {
    const wrap  = document.getElementById('cs-list');
    const nores = document.getElementById('cs-nores');
    if (!list.length) { wrap.innerHTML = ''; nores.style.display = 'block'; return; }
    nores.style.display = 'none';
    wrap.innerHTML = list.map(x => {
      const is  = sel?.code === x.code;
      const enc = encodeURIComponent(JSON.stringify(x));
      return `
        <div class="cs-row${is ? ' cs-sel' : ''}"
          onclick="window._csPick(JSON.parse(decodeURIComponent('${enc}')))"
          style="${is ? `border-color:${x.clr}40;` : ''}">
          <div class="rfw" style="${is ? `box-shadow:0 3px 12px ${x.clr}40;` : ''}">
            <img src="${FL(x.c)}" alt="${x.s}" loading="lazy">
          </div>
          <span class="rnm" style="${is ? `color:${x.clr};` : ''}">${x.n}</span>
          <span class="rcd">${x.code}</span>
          ${is
            ? `<div class="rck">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:12px;height:12px;"
                  fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="3.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg></div>`
            : `<svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;flex-shrink:0;"
                fill="none" viewBox="0 0 24 24" stroke="#d1d5db" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
              </svg>`}
        </div>`;
    }).join('');
  }

  /* ══ HTML المودال ══ */
  function buildHTML() {
    return `
      <div style="padding:22px 26px;display:flex;align-items:center;
                  justify-content:space-between;flex-shrink:0;
                  background:${BRD};position:relative;overflow:hidden;">
        <div style="position:absolute;top:-40px;left:-40px;width:160px;height:160px;
                    border-radius:50%;background:rgba(255,255,255,0.07);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-30px;right:20px;width:100px;height:100px;
                    border-radius:50%;background:rgba(255,255,255,0.05);pointer-events:none;"></div>
        <div style="display:flex;align-items:center;gap:14px;position:relative;">
          <div style="width:48px;height:48px;border-radius:16px;
                      background:rgba(255,255,255,0.18);
                      display:flex;align-items:center;justify-content:center;
                      box-shadow:0 4px 16px rgba(0,0,0,0.15);">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:26px;height:26px;"
              fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="1.6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945
                   M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0
                   2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064
                   M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <div>
            <p style="color:#fff;font-size:18px;font-weight:800;margin:0;font-family:inherit;">
              اختر دولتك
            </p>
            <p style="color:rgba(255,255,255,0.82);font-size:12px;margin:3px 0 0;font-family:inherit;">
              تُحدَّث نتائج الوظائف تلقائياً
            </p>
          </div>
        </div>
        <button id="cs-close-btn" type="button"
          style="width:38px;height:38px;border-radius:50%;
                 background:rgba(255,255,255,0.18);
                 border:1.5px solid rgba(255,255,255,0.28);
                 cursor:pointer;color:#fff;font-size:20px;
                 display:flex;align-items:center;justify-content:center;
                 transition:all 0.18s;position:relative;line-height:1;font-family:inherit;"
          onmouseover="this.style.background='rgba(255,255,255,0.3)';this.style.transform='rotate(90deg)';"
          onmouseout="this.style.background='rgba(255,255,255,0.18)';this.style.transform='';">✕</button>
      </div>

      <div id="cs-det"
        style="display:none;align-items:center;gap:10px;padding:11px 26px;
               flex-shrink:0;background:linear-gradient(90deg,#f5f0ff,#fce7f3);
               border-bottom:1px solid #ede9fe;">
        <div style="width:30px;height:22px;border-radius:5px;overflow:hidden;
                    box-shadow:0 2px 6px rgba(0,0,0,0.15);flex-shrink:0;">
          <img id="cs-det-img" src="" alt=""
            style="width:100%;height:100%;object-fit:cover;display:block;">
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;"
          fill="none" viewBox="0 0 24 24" stroke="${BRD}" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <span style="font-size:12px;color:#6b21a8;font-family:inherit;">تم اكتشاف موقعك:</span>
        <span id="cs-det-nm"
          style="font-size:13px;font-weight:700;color:#4c1d95;font-family:inherit;"></span>
        <button id="cs-use-det" type="button"
          style="margin-right:auto;font-size:12px;font-weight:700;color:#fff;
                 background:${BRD};border:none;border-radius:20px;
                 padding:7px 18px;cursor:pointer;font-family:inherit;
                 box-shadow:0 4px 14px rgba(157,77,184,0.35);
                 transition:all 0.18s;"
          onmouseover="this.style.background='#8633a0';this.style.transform='scale(1.04)';"
          onmouseout="this.style.background='${BRD}';this.style.transform='';">
          استخدمها
        </button>
      </div>

      <div style="padding:18px 26px 14px;flex-shrink:0;border-bottom:1px solid #f1f5f9;">
        <div style="position:relative;">
          <svg xmlns="http://www.w3.org/2000/svg"
            style="position:absolute;right:16px;top:50%;transform:translateY(-50%);
                   width:17px;height:17px;pointer-events:none;"
            fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          <input id="cs-q" type="text" placeholder="ابحث عن دولة..."
            style="width:100%;box-sizing:border-box;padding:13px 48px 13px 18px;
                   border-radius:16px;border:1.5px solid #e2e8f0;font-size:13px;
                   direction:rtl;outline:none;background:#f8fafc;color:#1e293b;
                   font-family:inherit;transition:all 0.18s;"
            onfocus="this.style.borderColor='${BRD}';this.style.background='#fff';this.style.boxShadow='0 0 0 4px rgba(157,77,184,0.1)';"
            onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc';this.style.boxShadow='';">
        </div>
      </div>

      <div id="cs-scroll" style="overflow-y:auto;flex:1;padding:20px 26px 28px;">
        <div id="cs-feat-sec">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;"
              fill="#f59e0b" viewBox="0 0 24 24">
              <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            <span style="font-size:12px;font-weight:700;color:${BRD};font-family:inherit;">
              الدول العربية
            </span>
          </div>
          <div id="cs-feat-grid"
            style="display:grid;grid-template-columns:repeat(auto-fill,minmax(84px,1fr));
                   gap:10px;margin-bottom:22px;"></div>
          <div style="border-top:1.5px solid #f1f5f9;margin:4px 0 18px;"></div>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;"
              fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path stroke-linecap="round"
                d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
            </svg>
            <span style="font-size:12px;font-weight:700;color:#64748b;font-family:inherit;">
              جميع الدول
            </span>
          </div>
        </div>
        <div id="cs-list" style="display:flex;flex-direction:column;gap:3px;"></div>
        <div id="cs-nores" style="display:none;text-align:center;padding:50px 0;">
          <div style="font-size:3rem;margin-bottom:12px;">🌍</div>
          <p style="font-size:14px;color:#94a3b8;font-family:inherit;margin:0;">
            لا توجد دولة بهذا الاسم
          </p>
        </div>
      </div>
    `;
  }

  /* Escape */
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeM(); });
})();
</script>
