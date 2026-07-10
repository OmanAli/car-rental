@extends('frontend.layouts.app')

@section('title', 'SERVICES')

@section('content')
    <!-- Header Banner -->
    <section class="banner-header section-padding bg-img" data-overlay-dark="5" data-background="{{ setting_image('services.banner.image') }}">
        <div class="v-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6>{{ setting('services.banner.subtitle') }}</h6>
                        <h1>{{ setting('services.banner.title') }} <span>{{ setting('services.banner.title_colored') }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Services 1 -->
    <section class="services1 section-padding">
        <div class="container">
            <div class="row">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="col-lg-4 col-md-6 mb-45">
                        <div class="item">
                            <div class="text">
                                <h5>{{ setting("shared.services.item{$i}_title") }}</h5>
                                <p>{{ setting("shared.services.item{$i}_text") }}</p>
                            </div>
                            <div class="numb">
                                <div class="numb-curv">
                                    <a href="{{ route('service_details') }}">
                                        <div class="number"><i class="ti-arrow-top-right"></i></div>
                                    </a>
                                    <div class="shap-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-11 h-11">
                                            <path
                                                d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                                fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-right-bottom">
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
                @endfor
            </div>
        </div>
    </section>
    <!-- Booking Search -->
    <section id="booking" class="background bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="{{ setting_image('services.booking.background') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-15">
                    <div class="section-subtitle">{{ setting('services.booking.subtitle') }}</div>
                    <div class="section-title white">{{ setting('services.booking.title') }}</div>
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
                    <div class="col2 c5 delivery-location-wrapper" style="display: none;">
                        <div class="input1_wrapper">
                            <label>Delivery Location (for Delivery only)</label>
                            <div class="input1_inner">
                                <input type="text" name="delivery_location" class="form-control input delivery-location-input"
                                    placeholder="Delivery Location" value="{{ old('delivery_location') }}">
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
                    <div class="col3 c6">
                        <button type="submit" class="booking-button">Rent Now</button>
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
    <!-- Other Services -->
    <section class="process section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-30">
                    <div class="section-subtitle">{{ setting('services.other.subtitle') }}</div>
                    <div class="section-title">{{ setting('services.other.title') }}</div>
                </div>
            </div>
            <div class="row">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="col-lg-4 col-md-6 mb-30">
                        <div class="item">
                            <div class="text">
                                <h5>{{ setting("services.other.item{$i}_title") }}</h5>
                                <p>{{ setting("services.other.item{$i}_text") }}</p>
                            </div>
                            <div class="numb">
                                <div class="numb-curv">
                                    <div class="number">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}.</div>
                                    <div class="shap-left-top">
                                        <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            class="w-11 h-11">
                                            <path
                                                d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z"
                                                fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="shap-right-bottom">
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
                @endfor
            </div>
        </div>
    </section>
    @include('frontend.partials.video_promo')
    @include('frontend.partials.clients')

@endsection
