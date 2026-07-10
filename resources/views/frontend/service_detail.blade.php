@extends('frontend.layouts.app')

@section('title', 'SERVICES')

@section('content')
    <!-- Header Banner -->
    <section class="banner-header section-padding bg-img" data-overlay-dark="5" data-background="{{ setting_image('service_detail.banner.image') }}">
        <div class="v-middle">
            <div class="container">
                <div class="col-md-12">
                    <h6>{{ setting('service_detail.banner.subtitle') }}</h6>
                    <h1>{{ setting('service_detail.banner.title') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Details -->
    <section class="service-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row mb-60">
                        <div class="col-md-12">
                            <p class="mb-30">{{ setting('service_detail.content.intro') }}</p>
                            <h3>{{ setting('service_detail.content.heading1') }}</h3>
                            <p class="mb-30">{{ setting('service_detail.content.text1') }}</p>
                            <h3>{{ setting('service_detail.content.heading2') }}</h3>
                            <p class="mb-30">{{ setting('service_detail.content.text2') }}</p>
                            <h3>{{ setting('service_detail.content.heading3') }}</h3>
                            <p class="mb-30">{{ setting('service_detail.content.text3') }}</p>
                            <ul class="list-unstyled list mb-30">
                                @for ($i = 1; $i <= 3; $i++)
                                    <li>
                                        <div class="list-icon"> <span class="ti-check"></span> </div>
                                        <div class="list-text">
                                            <p>{{ setting("service_detail.content.feature{$i}") }}</p>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <!-- FAQs -->
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <ul class="accordion-box clearfix">
                                @for ($i = 1; $i <= 4; $i++)
                                    <li class="accordion block">
                                        <div class="acc-btn"><span class="count">{{ $i }}.</span> {{ setting("service_detail.faqs.faq{$i}_title") }}</div>
                                        <div class="acc-content">
                                            <div class="content">
                                                <div class="text">{{ setting("service_detail.faqs.faq{$i}_text") }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-page">
                        <div class="title">
                            <h4>{{ setting('service_detail.content.sidebar_title') }}</h4>
                        </div>
                        <div class="item">
                            @for ($i = 1; $i <= 6; $i++)
                                <div class="features"><span><i class="ti-arrow-top-right"></i> {{ setting("shared.services.item{$i}_title") }}</span></div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.lets_talk')
    @include('frontend.partials.clients')
@endsection
