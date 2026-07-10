<!-- Testimonials -->
<section class="testimonials section-padding mt-15">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-30">
                <div class="section-subtitle">{{ setting('shared.testimonials.subtitle') }}</div>
                <div class="section-title">{{ setting('shared.testimonials.title') }}</div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="item">
                            <div class="stars"> <span class="rate">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <div class="shap-left-top">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                                <div class="shap-right-bottom">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                            </div> <i class="fa-solid fa-quote-left"></i>
                            <div class="text">
                                <p>{{ setting("shared.testimonials.item{$i}_text") }}</p>
                            </div>
                            <div class="info mt-30">
                                <div class="img-curv">
                                    <div class="img"> <img src="{{ setting_image("shared.testimonials.item{$i}_image") }}" alt=""> </div>
                                    <div class="shap-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-30">
                                    <h6>{{ setting("shared.testimonials.item{$i}_name") }}</h6>
                                    <p>{{ setting("shared.testimonials.item{$i}_role") }}</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
