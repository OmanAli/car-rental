    <!-- Footer -->
    <footer class="footer clearfix">
        <div class="container">
            <!-- first footer -->
            <div class="first-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="links dark footer-contact-links">
                            <div class="footer-contact-links-wrapper">
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="flaticon-phone-call"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>{{ setting('global.footer.call_title') }}</h6>
                                        <p>{{ setting('global.footer.phone') }}</p>
                                    </div>
                                </div>
                                <div class="footer-contact-links-divider"></div>
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-envelope"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>{{ setting('global.footer.email_title') }}</h6>
                                        <p>{{ setting('global.footer.email') }}</p>
                                    </div>
                                </div>
                                <div class="footer-contact-links-divider"></div>
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-location"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>{{ setting('global.footer.address_title') }}</h6>
                                        <p>{{ setting('global.footer.address') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- second footer -->
            <div class="second-footer">
                <div class="row">
                    <!-- about & social icons -->
                    <div class="col-md-4 widget-area">
                        <div class="widget clearfix">
                            <div class="footer-logo"><img src="{{ setting_image('global.footer.logo') }}" alt="">
                            </div>
                            <!-- <div class="footer-logo"><h2>CARE<span>X</span></h2></div> -->
                            <div class="widget-text">
                                <p>{{ setting('global.footer.about_text') }}</p>
                                <div class="social-icons">
                                    <ul class="list-inline">
                                        <li><a href="{{ setting('global.footer.whatsapp_url') }}"><i class="fa-brands fa-whatsapp"></i></a></li>
                                        <li><a href="{{ setting('global.footer.facebook_url') }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="{{ setting('global.footer.youtube_url') }}"><i class="fa-brands fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- quick links -->
                    <div class="col-md-3 offset-md-1 widget-area">
                        <div class="widget clearfix usful-links">
                            <h3 class="widget-title">Quick Links</h3>
                            <ul>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li><a href="{{ route('car') }}">Cars</a></li>
                                <li><a href="{{ route('services') }}">Services</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- subscribe -->
                    <div class="col-md-4 widget-area">
                        <div class="widget clearfix">
                            <h3 class="widget-title">{{ setting('global.footer.subscribe_title') }}</h3>
                            <p>{{ setting('global.footer.subscribe_text') }}</p>
                            <div class="widget-newsletter">
                                <form action="#">
                                    <input type="email" placeholder="Email Address" required>
                                    <button type="submit"><i class="ti-arrow-top-right"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bottom footer -->
            <div class="bottom-footer-text">
                <div class="row copyright">
                    <div class="col-md-12">
                        <p class="mb-0">{{ setting('global.footer.copyright') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
