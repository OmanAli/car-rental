@extends('frontend.layouts.app')

@section('title', 'ABOUT')

@section('content')
    <!-- Header Banner -->
    <section class="banner-header section-padding bg-img" data-overlay-dark="4"
        data-background="{{ setting_image('about.banner.image') }}">
        <div class="v-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h6>{{ setting('about.banner.subtitle') }}</h6>
                        <h1>{{ setting('about.banner.title') }} <span>{{ setting('about.banner.title_colored') }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content">
                        <div class="section-subtitle">{{ setting('about.about.subtitle') }}</div>
                        <div class="section-title">{{ setting('about.about.title') }} <span>{{ setting('about.about.title_colored') }}</span></div>
                        <p>{{ setting('about.about.text1') }}</p>
                        <p class="mb-30">{{ setting('about.about.text2') }}</p>

                        <ul class="list-unstyled list mb-30">
                            <li>
                                <div class="list-icon"> <span class="ti-check"></span> </div>
                                <div class="list-text">
                                    <p>{{ setting('about.about.feature1') }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-icon"> <span class="ti-check"></span> </div>
                                <div class="list-text">
                                    <p>{{ setting('about.about.feature2') }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="item">
                        <img src="{{ setting_image('about.about.image') }}" class="img-fluid" alt="">
                        <div class="curv-butn icon-bg">
                            <a href="{{ setting('about.about.video_url') }}" class="vid">
                                <div class="icon"> <i class="ti-control-play"></i> </div>
                            </a>
                            <div class="br-left-top">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#ffffff"></path>
                                </svg>
                            </div>
                            <div class="br-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-11 h-11">
                                    <path
                                        d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                        fill="#ffffff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.video_promo')
    @include('frontend.partials.testimonials')
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Team -->
    <section class="team section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('about.team.subtitle') }}</div>
                    <div class="section-title">{{ setting('about.team.title') }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="item"> <img src="{{ setting_image("about.team.member{$i}_image") }}" class="img-fluid"
                                    alt="">
                                <div class="bottom-fade"></div>
                                <div class="butn icon-bg">
                                    <a href="#0" class="vid">
                                        <div class="icon"> <i class="ti-info"></i> </div>
                                    </a>
                                    <div class="br-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-11 h-11">
                                            <path
                                                d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                                fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="br-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-11 h-11">
                                            <path
                                                d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                                fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="title">
                                    <h4>{{ setting("about.team.member{$i}_name") }}</h4>
                                    <h6>{{ setting("about.team.member{$i}_role") }}</h6>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.lets_talk')
    @include('frontend.partials.clients')
@endsection
