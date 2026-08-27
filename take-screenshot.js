import { chromium } from 'playwright';

const browser = await chromium.launch({ headless: true });
const page = await browser.newPage({ viewport: { width: 1920, height: 1080 } });
await page.goto('http://127.0.0.1:8000/amrtm/proposal/1', { waitUntil: 'networkidle', timeout: 30000 });
await page.waitForTimeout(3000);

const report = await page.evaluate(() => {
    const r = {};
    
    // Check the actual computed font-family on the play icon
    const playEl = document.querySelector('.about-one__video-icon .fa-play');
    if (playEl) {
        const ps = getComputedStyle(playEl);
        r.playTag = playEl.tagName;
        r.playClasses = playEl.className;
        r.playFontFamily = ps.fontFamily;
        r.playFontWeight = ps.fontWeight;
        r.playDisplay = ps.display;
        r.playContent = ps.content;
        r.playColor = ps.color;
        r.playFontSize = ps.fontSize;
        r.playWidth = ps.width;
        r.playHeight = ps.height;
        r.playOverflow = ps.overflow;
        r.playVisibility = ps.visibility;
        r.playPosition = ps.position;
        r.playZIndex = ps.zIndex;
        
        // Check the actual bounding rect
        const rect = playEl.getBoundingClientRect();
        r.playRect = { x: rect.x, y: rect.y, w: rect.width, h: rect.height };
        
        // Check if it has zero dimensions
        r.playHasZeroSize = rect.width === 0 || rect.height === 0;
    }
    
    // Check video-icon parent
    const vIcon = document.querySelector('.about-one__video-icon');
    if (vIcon) {
        const vs = getComputedStyle(vIcon);
        r.vIconPosition = vs.position;
        r.vIconOverflow = vs.overflow;
        r.vIconZIndex = vs.zIndex;
        r.vIconRect = vIcon.getBoundingClientRect();
    }
    
    // Check video-link
    const vLink = document.querySelector('.about-one__video-link');
    if (vLink) {
        const vl = getComputedStyle(vLink);
        r.vLinkPosition = vl.position;
        r.vLinkDisplay = vl.display;
        r.vLinkRect = vLink.getBoundingClientRect();
        r.vLinkOverflow = vl.overflow;
        r.vLinkZIndex = vl.zIndex;
    }
    
    // Check if about-one__img has position:relative
    const img = document.querySelector('.about-one__img');
    if (img) {
        const is = getComputedStyle(img);
        r.imgPosition = is.position;
        r.imgOverflow = is.overflow;
        r.imgDisplay = is.display;
    }
    
    // Check the <img> element
    const imgEl = document.querySelector('.about-one__img img');
    if (imgEl) {
        const ies = getComputedStyle(imgEl);
        r.imgElPosition = ies.position;
        r.imgElZIndex = ies.zIndex;
        r.imgElRect = imgEl.getBoundingClientRect();
    }
    
    return r;
});

console.log('=== PLAY ICON DEEP AUDIT ===');
console.log(JSON.stringify(report, null, 2));

await browser.close();
