@extends('frontend.layouts.app')

@section('title','HOME')

@section('content')
    <!-- Slider -->
    <header class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
            @for ($i = 1; $i <= 3; $i++)
                <div class="item bg-img" data-overlay-dark="5" data-background="{{ setting_image("home.slider.slide{$i}_image") }}">
                    <div class="v-middle caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-30">
                                    <div class="v-middle">
                                        <h6>{{ setting("home.slider.slide{$i}_subtitle") }}</h6>
                                        <h1>{{ setting("home.slider.slide{$i}_title") }}</h1>
                                        <h5>{{ setting("home.slider.slide{$i}_car") }} <span>{{ setting("home.slider.slide{$i}_price") }} <i>/ day</i></span></h5> <a href="{{ route('car') }}" class="button-1 mt-15 mb-15">View Details <span class="ti-arrow-top-right"></span></a> <a href="#" data-scroll-nav="1" class="button-2 mt-15 mb-15">Rent Now <span class="ti-arrow-top-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </header>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-30">
                    <div class="content">
                        <div class="section-subtitle">{{ setting('home.about.subtitle') }}</div>
                        <div class="section-title">{{ setting('home.about.title') }} <span>{{ setting('home.about.title_colored') }}</span></div>
                        <p class="mb-30">{{ setting('home.about.text') }}</p>
                        <ul class="list-unstyled list mb-30">
                            <li>
                                <div class="list-icon"> <span class="ti-check"></span> </div>
                                <div class="list-text">
                                    <p>{{ setting('home.about.feature1') }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-icon"> <span class="ti-check"></span> </div>
                                <div class="list-text">
                                    <p>{{ setting('home.about.feature2') }}</p>
                                </div>
                            </li>
                        </ul> <a href="{{ route('about') }}" class="button-4">{{ setting('home.about.button_text') }} <span class="ti-arrow-top-right"></span></a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-12">
                    <div class="item"> <img src="{{ setting_image('home.about.image') }}" class="img-fluid" alt="">
                        <div class="curv-butn icon-bg">
                            <a href="{{ setting('home.about.video_url') }}" class="vid">
                                <div class="icon"> <i class="ti-control-play"></i> </div>
                            </a>
                            <div class="br-left-top">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                    <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                            <div class="br-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                    <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Services 2 -->
    <section class="services2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('home.services.subtitle') }}</div>
                    <div class="section-title">{{ setting('home.services.title') }} <span>{{ setting('home.services.title_colored') }}</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="item"> <img src="{{ setting_image("shared.services.item{$i}_image") }}" class="img-fluid" alt="">
                            <div class="bottom-fade"></div>
                            <div class="title">
                                <h4><a href="{{ route('service_details') }}">{{ setting("shared.services.item{$i}_title") }}</a></h4>
                            </div>
                            <div class="curv-butn icon-bg">
                                <a href="{{ route('service_details') }}" class="vid">
                                    <div class="icon">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</div>
                                </a>
                                <div class="br-left-top">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                                <div class="br-right-bottom">
                                    <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                        <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Booking Search -->
    <section id="booking" data-scroll-index="1" class="background bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="{{ setting_image('home.booking.background') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-15">
                    <div class="section-subtitle">{{ setting('home.booking.subtitle') }}</div>
                    <div class="section-title white">{{ setting('home.booking.title') }}</div>
                </div>
            </div>
            <div class="booking-inner clearfix">
                @include('common.alert')

                @auth
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('myRequests.store') }}" method="POST" class="form1 brdr clearfix booking-form">
                    @csrf
                    <input type="hidden" name="booking_source" value="home">
                    <div class="col2 c3">
                        <div class="select1_wrapper">
                            <label>Choose Car</label>
                            <div class="select1_inner">
                                <select class="select2 select" name="car_id" style="width: 100%" required>
                                    <option value="">Choose Car</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                            {{ $car->make }} {{ $car->model }} ({{ $car->registration_number }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col2 c4">
                        <div class="select1_wrapper">
                            <label>Delivery Type</label>
                            <div class="select1_inner">
                                <select class="select2 select delivery-type-select" name="delivery_type" style="width: 100%" required>
                                    <option value="">Choose Delivery Type</option>
                                    <option value="pickup" {{ old('delivery_type') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                                    <option value="delivery" {{ old('delivery_type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col2 c5 delivery-location-wrapper" data-static-toggle>
                        <div class="input1_wrapper">
                            <label>Delivery Location (for Delivery only)</label>
                            <div class="input1_inner">
                                <input type="text" name="delivery_location" class="form-control input delivery-location-input"
                                    placeholder="Delivery Location" value="{{ old('delivery_location') }}"
                                    {{ old('delivery_type') === 'delivery' ? 'required' : 'disabled' }}>
                            </div>
                        </div>
                    </div>
                    <div class="col1 c1">
                        <div class="input1_wrapper">
                            <label>Pick Up Date</label>
                            <div class="input1_inner">
                                <input type="text" name="pickup_date" class="form-control input datepicker"
                                    placeholder="Pick Up Date" value="{{ old('pickup_date') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col1 c2">
                        <div class="input1_wrapper">
                            <label>Drop Date</label>
                            <div class="input1_inner">
                                <input type="text" name="drop_date" class="form-control input datepicker"
                                    placeholder="Drop Date" value="{{ old('drop_date') }}" required>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both; width: 100%; padding: 15px 15px 0; border-top: 1px solid #f2f2f2;">
                        <small class="d-block" style="color: #888; font-size: 12px; margin-bottom: 8px;">Have a
                            discount coupon or veteran ID? Enter one below (only one can be used per booking).</small>
                        <div class="d-flex align-items-start flex-wrap" style="gap: 15px;">
                            <div class="input1_wrapper" style="max-width: 220px; margin-bottom: 0; flex: 0 1 220px;">
                                <div class="input1_inner">
                                    <input type="text" name="coupon_code"
                                        class="form-control input discount-input @error('coupon_code') is-invalid @enderror"
                                        placeholder="Coupon Code" style="text-transform: uppercase;"
                                        value="{{ old('coupon_code') }}">
                                </div>
                            </div>
                            <div class="input1_wrapper" style="max-width: 220px; margin-bottom: 0; flex: 0 1 220px;">
                                <div class="input1_inner">
                                    <input type="text" name="veteran_id"
                                        class="form-control input discount-input @error('veteran_id') is-invalid @enderror"
                                        placeholder="Veteran ID" value="{{ old('veteran_id') }}">
                                </div>
                            </div>
                            <button type="submit" class="booking-button"
                                style="display: inline-block; width: auto; min-width: 180px; padding: 0 40px; flex: 0 0 auto;">Rent
                                Now</button>
                        </div>
                    </div>
                </form>
                @endauth

                @guest
                <div class="col-md-12 text-center">
                    <div class="alert alert-warning d-inline-block">
                        Please <a href="{{ route('login') }}" class="alert-link">login</a> to book a car.
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </section>
    <!-- Cars 1 -->
    <section class="cars1 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('home.fleet.subtitle') }}</div>
                    <div class="section-title">{{ setting('home.fleet.title') }} <span>{{ setting('home.fleet.title_colored') }}</span></div>
                </div>
            </div>
            @if ($cars->count())
                <div class="cars1-carousel owl-theme owl-carousel">
                    @foreach ($cars as $car)
                        <div class="item">
                            <div class="img">
                                <img src="{{ $car->image ? asset($car->image) : asset('assets/img/slider/11.jpg') }}"
                                    alt="{{ $car->make }} {{ $car->model }}">
                            </div>
                            <div class="con opacity-1">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="title">
                                            <a href="{{ route('car_details', $car->id) }}">{{ $car->make }} {{ $car->model }}</a>
                                        </div>
                                        <div class="details">
                                            <span><i class="omfi-door"></i> {{ $car->passengers ?? '-' }} Seats</span>
                                            <span><i class="omfi-transmission"></i> {{ $car->transmission ?? '-' }}</span>
                                            <span><i class="omfi-luggage"></i> {{ $car->luggage ?? '-' }}</span>
                                            <span><i class="omfi-age"></i> Age 25</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="book">
                                            <div>
                                                <a href="{{ route('car_details', $car->id) }}" class="btn"><span>Details</span></a>
                                            </div>
                                            <div>
                                                <span class="price">${{ rtrim(rtrim(number_format($car->rental_price_per_day, 2), '0'), '.') }}</span><span>/day</span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <a href="#0" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-car-id="{{ $car->id }}" class="btn"><span>Rent Now</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted">No cars available right now.</div>
            @endif
        </div>
    </section>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Car Category -->
    <section class="car-types1 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('home.categories.subtitle') }}</div>
                    <div class="section-title">{{ setting('home.categories.title') }} <span>{{ setting('home.categories.title_colored') }}</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="item"> <img src="{{ setting_image("home.categories.item{$i}_image") }}" class="img-fluid" alt="">
                                <div class="title">
                                    <h4>{{ setting("home.categories.item{$i}_title") }}</h4>
                                </div>
                                <div class="curv-butn icon-bg">
                                    <a href="{{ route('car') }}" class="vid">
                                        <div class="icon"> <i class="ti-arrow-top-right"></i> </div>
                                    </a>
                                    <div class="br-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="br-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Process -->
    <section class="process section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('home.process.subtitle') }}</div>
                    <div class="section-title">{{ setting('home.process.title') }} <span>{{ setting('home.process.title_colored') }}</span></div>
                </div>
            </div>
            <div class="row">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="col-md-4 mb-30">
                        <div class="item">
                            <div class="text">
                                <h5>{{ setting("home.process.step{$i}_title") }}</h5>
                                <p>{{ setting("home.process.step{$i}_text") }}</p>
                            </div>
                            <div class="numb">
                                <div class="numb-curv">
                                    <div class="number">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}.</div>
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
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mt-15">
                    <p><span class="ti-info"></span> {{ setting('home.process.note') }}</p>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.video_promo')
    @include('frontend.partials.testimonials')
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Blog 2 -->
    <section class="blog2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('home.blog.subtitle') }}</div>
                    <div class="section-title">{{ setting('home.blog.title') }} <span>{{ setting('home.blog.title_colored') }}</span></div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="item"> <img src="{{ setting_image("home.blog.post{$i}_image") }}" class="img-fluid" alt="">
                                <div class="bottom-fade"></div>
                                <div class="title">
                                    <h6>{{ setting("home.blog.post{$i}_tag") }}</h6>
                                    <h4>{{ setting("home.blog.post{$i}_title") }}</h4>
                                </div>
                                <div class="curv-butn icon-bg">
                                    <a href="#0" class="vid">
                                        <div class="icon"> <i class="icon-show"><span>{{ setting("home.blog.post{$i}_day") }}<br><i>{{ setting("home.blog.post{$i}_month") }}</i></span>
                                            </i><i class="ti-arrow-top-right icon-hidden"></i> </div>
                                    </a>
                                    <div class="br-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="br-right-bottom">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                            <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#ffffff"></path>
                                        </svg>
                                    </div>
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
