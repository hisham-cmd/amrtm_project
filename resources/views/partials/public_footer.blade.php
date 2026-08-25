<footer class="public-footer">
    <div class="footer-inner container">
        <div class="footer-cols">
            <div class="footer-col">
                <img src="/images/new-logo1.png" alt="أمر تم" style="height:48px;margin-bottom:14px;">
                <p>{{ __('footer.tagline') }}</p>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>{{ __('footer.quick_links') }}</h4>
                <ul>
                    <li><a href="/">{{ __('footer.home') }}</a></li>
                    <li><a href="/about">{{ __('footer.about') }}</a></li>
                    <li><a href="/services">{{ __('footer.services') }}</a></li>
                    <li><a href="/projects">{{ __('footer.projects') }}</a></li>
                    <li><a href="/agencies">{{ __('footer.agencies') }}</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>{{ __('footer.our_services') }}</h4>
                <ul>
                    <li><a href="/halls_list">{{ __('footer.hall_booking') }}</a></li>
                    <li><a href="/consultants">{{ __('footer.consultations') }}</a></li>
                    <li><a href="/business-services">{{ __('footer.biz_services') }}</a></li>
                    <li><a href="/agencies">{{ __('footer.franchise') }}</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>{{ __('footer.contact_us') }}</h4>
                <ul class="footer-contact">
                    <li><i class="fa fa-envelope"></i> {{ __('footer.email') }}</li>
                    <li><i class="fa fa-phone"></i> {{ __('footer.phone') }}</li>
                    <li><i class="fa fa-map-marker-alt"></i> {{ __('footer.address') }}</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom-bar">
            <p>{{ __('footer.copyright', ['year' => date('Y')]) }} &nbsp;|&nbsp; <a href="/privacy">{{ __('footer.privacy') }}</a></p>
        </div>
    </div>
</footer>
