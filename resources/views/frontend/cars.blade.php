@extends('frontend.layouts.app')

@section('title', 'CARS')

@section('content')
    <!-- Header Banner -->
    <section class="banner-header section-padding bg-img" data-overlay-dark="5" data-background="{{ setting_image('cars.banner.image') }}">
        <div class="v-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6>{{ setting('cars.banner.subtitle') }}</h6>
                        <h1>{{ setting('cars.banner.title') }} <span>{{ setting('cars.banner.title_colored') }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Cars 2 -->
    <section class="cars2 section-padding">
        <div class="container">
            <div class="row">
                @forelse ($cars as $car)
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="item">
                            <img src="{{ $car->image ? asset($car->image) : asset('assets/img/blog/8.jpg') }}"
                                class="img-fluid" alt="{{ $car->make }} {{ $car->model }}">
                            <div class="bottom-fade"></div>
                            <div class="title">
                                <h4>{{ $car->make }} {{ $car->model }}</h4>
                                <div class="details">
                                    <span><i class="omfi-door"></i> {{ $car->passengers ?? '-' }} Seats</span>
                                    <span><i class="omfi-transmission"></i> {{ $car->transmission ?? '-' }}</span>
                                    <span><i class="omfi-luggage"></i> {{ $car->luggage ?? '-' }}</span>
                                </div>
                                <div class="mt-2">
                                    <a href="#0" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        data-car-id="{{ $car->id }}"
                                        class="button-3 d-inline-block">
                                        Rent Now <span class="ti-arrow-top-right"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="curv-butn icon-bg">
                                <a href="{{ route('car_details', $car->id) }}" class="vid">
                                    <div class="icon">
                                        <i class="icon-show">
                                            <span>${{ rtrim(rtrim(number_format($car->rental_price_per_day, 2), '0'), '.') }}<br><i>day</i></span>
                                        </i>
                                        <i class="ti-arrow-top-right icon-hidden"></i>
                                    </div>
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
                @empty
                    <div class="col-md-12 text-center">
                        <p class="text-muted">No cars available right now. Please check back soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @include('frontend.partials.lets_talk')
@endsection
