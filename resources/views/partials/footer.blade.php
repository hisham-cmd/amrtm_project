<style>
    /* ==============================
       SHARED FOOTER STYLES
    ============================== */
    .site-footer {
        background: linear-gradient(to top, #071f12 0%, #0d3320 35%, #1a5c38 75%, #1e7a50 100%);
        color: #d1f5e3;
        font-size: 14px;
        direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
    }

    .footer-main {
        padding: 50px 5% 30px;
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr 1fr 1fr;
        gap: 28px;
        max-width: 1300px;
        margin: 0 auto;
    }

    .footer-col-title {
        font-size: 17px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255,255,255,0.18);
    }

    .footer-about-desc {
        font-size: 13px;
        line-height: 1.85;
        color: #b8ead0;
        margin-bottom: 18px;
    }

    .footer-blog-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #a7f3d0;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 18px;
    }

    .footer-blog-link:hover { color: #fff; }

    .footer-socials {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .footer-social-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 15px;
        text-decoration: none;
        transition: background 0.2s;
        border: 1px solid rgba(255,255,255,0.18);
    }

    .footer-social-btn:hover { background: rgba(255,255,255,0.25); color: #a7f3d0; }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li { margin-bottom: 10px; }

    .footer-links a {
        color: #b8ead0;
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: color 0.2s;
    }

    .footer-links a::before {
        content: '\276F';
        font-size: 10px;
        color: #6ee7b7;
        flex-shrink: 0;
    }

    .footer-links a:hover { color: #fff; }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 13px;
        font-size: 13.5px;
        color: #b8ead0;
        line-height: 1.6;
    }

    .footer-contact-item i {
        color: #6ee7b7;
        font-size: 15px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .footer-certs-imgs {
        display: flex;
        gap: 12px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .footer-cert-thumb {
        width: 90px;
        height: 65px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid rgba(255,255,255,0.18);
        cursor: pointer;
        transition: transform 0.2s, border-color 0.2s;
    }

    .footer-cert-thumb:hover {
        transform: scale(1.06);
        border-color: #6ee7b7;
    }

    /* Lightbox */
    .cert-lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.82);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: lbFadeIn 0.2s ease;
    }

    .cert-lightbox.open { display: flex; }

    @keyframes lbFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .cert-lightbox-inner {
        position: relative;
        max-width: 90vw;
        max-height: 88vh;
        animation: lbZoomIn 0.22s ease;
    }

    @keyframes lbZoomIn {
        from { transform: scale(0.82); opacity: 0; }
        to   { transform: scale(1);    opacity: 1; }
    }

    .cert-lightbox-inner img {
        max-width: 90vw;
        max-height: 84vh;
        border-radius: 12px;
        box-shadow: 0 12px 60px rgba(0,0,0,0.7);
        display: block;
    }

    .cert-lightbox-close {
        position: absolute;
        top: -14px;
        left: -14px;
        width: 36px;
        height: 36px;
        background: #fff;
        border: none;
        border-radius: 50%;
        font-size: 18px;
        font-weight: 800;
        color: #0f3d24;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.4);
        line-height: 1;
        transition: background 0.2s;
    }

    .cert-lightbox-close:hover { background: #f0fdf4; }

    .cert-lightbox-caption {
        text-align: center;
        color: #d1fae5;
        font-size: 14px;
        font-weight: 600;
        margin-top: 12px;
    }

    .footer-copy {
        background: rgba(0,0,0,0.30);
        padding: 14px 5%;
        text-align: center;
        font-size: 13px;
        color: #a7f3d0;
        border-top: 1px solid rgba(255,255,255,0.10);
    }

    .whatsapp-float {
        position: fixed;
        bottom: 26px;
        left: 26px;
        width: 52px;
        height: 52px;
        background: #25d366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 26px;
        text-decoration: none;
        box-shadow: 0 4px 18px rgba(37,211,102,0.45);
        z-index: 999;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 24px rgba(37,211,102,0.6);
    }

    @media (max-width: 1100px) {
        .footer-main { grid-template-columns: 1fr 1fr 1fr; gap: 28px; }
    }

    @media (max-width: 700px) {
        .footer-main { grid-template-columns: 1fr 1fr; gap: 22px; }
    }

    @media (max-width: 600px) {
        .footer-main { grid-template-columns: 1fr; gap: 22px; padding: 32px 6% 22px; }
        .footer-certs-imgs { justify-content: flex-start; }
    }
</style>

<!-- ============ FOOTER ============ -->
<footer class="site-footer">

    <div class="footer-main">

        <!-- عن الشركة -->
        <div>
            <div class="footer-col-title">{{ __('footer.about_company') }}</div>
            <p class="footer-about-desc">
                {{ __('footer.company_desc') }}
            </p>
            <a href="#" class="footer-blog-link">
                <i class="fa fa-chevron-left" style="font-size:10px;"></i>
                {{ __('footer.blog') }}
            </a>
            <div class="footer-socials">
                <a href="#" class="footer-social-btn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="footer-social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="footer-social-btn" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="footer-social-btn" title="Twitter / X"><i class="fab fa-x-twitter"></i></a>
            </div>
        </div>

        <!-- روابط سريعة -->
        <div>
            <div class="footer-col-title">{{ __('footer.quick_links') }}</div>
            <ul class="footer-links">
                <li><a href="/">{{ __('footer.home') }}</a></li>
                <li><a href="/halls">{{ __('halls.halls') }}</a></li>
                <li><a href="/privacy">{{ __('footer.privacy_policy') }}</a></li>
                <li><a href="/about">{{ __('footer.about_us') }}</a></li>
                <li><a href="/contact">{{ __('footer.contact_us') }}</a></li>
            </ul>
        </div>

        <!-- خدماتنا -->
        <div>
            <div class="footer-col-title">{{ __('footer.our_services') }}</div>
            <ul class="footer-links">
                <li><a href="#">{{ __('footer.service_wedding') }}</a></li>
                <li><a href="#">{{ __('footer.service_conference') }}</a></li>
                <li><a href="#">{{ __('footer.service_events') }}</a></li>
                <li><a href="#">{{ __('footer.service_consult') }}</a></li>
                <li><a href="#">{{ __('footer.service_bookings') }}</a></li>
            </ul>
        </div>

        <!-- اتصل بنا -->
        <div>
            <div class="footer-col-title">{{ __('footer.contact_us') }}</div>
            <div class="footer-contact-item">
                <i class="fa fa-location-dot"></i>
                <span>{{ __('footer.address_full') }}</span>
            </div>
            <div class="footer-contact-item">
                <i class="fa fa-phone"></i>
                <span>{{ __('footer.phone') }}</span>
            </div>
            <div class="footer-contact-item">
                <i class="fa fa-envelope"></i>
                <span>{{ __('footer.email') }}</span>
            </div>
        </div>

        <!-- الشهادات والرخص -->
        <div>
            <div class="footer-col-title">{{ __('footer.certs_title') }}</div>
            <div class="footer-certs-imgs">
                <img src="{{ asset('images/Commercial_Registry_Certificate.png') }}" alt="شهادة السجل التجاري" class="footer-cert-thumb" onclick="openCertLightbox(this)">
                <img src="{{ asset('images/E-Commerce_Authentication_Certificate.png') }}" alt="شهادة توثيق التجارة الإلكترونية" class="footer-cert-thumb" onclick="openCertLightbox(this)">
                <img src="{{ asset('images/Realestate_General_Authority.png') }}" alt="هيئة العقارات" class="footer-cert-thumb" onclick="openCertLightbox(this)">
            </div>
        </div>

    </div>

    <div class="footer-copy">
        {{ __('footer.copyright_inner') }}
    </div>

</footer>

<!-- Certificate Lightbox -->
<div class="cert-lightbox" id="certLightbox" onclick="closeCertLightbox(event)">
    <div class="cert-lightbox-inner">
        <button class="cert-lightbox-close" onclick="closeCertLightbox()" title="إغلاق">&times;</button>
        <img id="certLightboxImg" src="" alt="">
        <div class="cert-lightbox-caption" id="certLightboxCaption"></div>
    </div>
</div>

<!-- WhatsApp floating button -->
<a href="https://wa.me/966504915222" class="whatsapp-float" target="_blank" rel="noopener" title="{{ __('footer.whatsapp_title') }}">
    <i class="fab fa-whatsapp"></i>
</a>

<script>
    function openCertLightbox(img) {
        document.getElementById('certLightboxImg').src = img.src;
        document.getElementById('certLightboxImg').alt = img.alt;
        document.getElementById('certLightboxCaption').textContent = img.alt;
        document.getElementById('certLightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeCertLightbox(e) {
        if (e && e.target.tagName === 'IMG') return;
        document.getElementById('certLightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeCertLightbox();
    });
</script>
