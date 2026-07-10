@extends('frontend.layouts.app')

@section('title', $car->make . ' ' . $car->model)

@section('content')
    <!-- Header Banner -->
    <section class="banner-header section-padding bg-img" data-overlay-dark="5"
        data-background="{{ $car->image ? asset($car->image) : asset('assets/img/slider/11.jpg') }}">
        <div class="v-middle">
            <div class="container">
                <div class="col-md-12">
                    <h6>{{ optional($car->carType)->name ?? 'Luxury Cars' }}</h6>
                    <h1>{{ $car->make }} {{ $car->model }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Details -->
    <section class="car-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row mb-60">
                        <div class="col-md-12">
                            <h3>{{ setting('car_detail.info.heading') }}</h3>
                            <p class="mb-30">
                                Year {{ $car->year }} {{ $car->make }} {{ $car->model }} ({{ $car->registration_number }}).
                                Comfortable, reliable and ready for the road. Book it for as long as you need and we'll
                                take care of the rest.
                            </p>
                            <ul class="list-unstyled list mb-30">
                                @for ($i = 1; $i <= 3; $i++)
                                    <li>
                                        <div class="list-icon"> <span class="ti-check"></span> </div>
                                        <div class="list-text">
                                            <p>{{ setting("car_detail.info.feature{$i}") }}</p>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <!--  Gallery Image -->
                    @if ($car->image)
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Image</h3>
                            </div>
                        </div>
                        <div class="row gallery-items mb-60">
                            <div class="col-md-12 gallery-masonry-wrapper single-item cardio">
                                <a href="{{ asset($car->image) }}" title="" class="gallery-masonry-item-img-link img-zoom">
                                    <div class="gallery-box">
                                        <div class="gallery-img">
                                            <img src="{{ asset($car->image) }}" class="img-fluid mx-auto d-block" alt="">
                                        </div>
                                        <div class="gallery-masonry-item-img"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    <!-- FAQs -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ setting('car_detail.conditions.heading') }}</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <ul class="accordion-box clearfix">
                                @for ($i = 1; $i <= 6; $i++)
                                    <li class="accordion block">
                                        <div class="acc-btn"><span class="count">{{ $i }}.</span> {{ setting("car_detail.conditions.item{$i}_title") }}</div>
                                        <div class="acc-content">
                                            <div class="content">
                                                <div class="text">{{ setting("car_detail.conditions.item{$i}_text") }}</div>
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
                    <div class="sidebar-car">
                        <div class="title">
                            <h4>${{ rtrim(rtrim(number_format($car->rental_price_per_day, 2), '0'), '.') }} <span>/ rent per day</span></h4>
                        </div>
                        <div class="item">
                            <div class="features"><span><i class="omfi-door"></i> Doors</span>
                                <p>{{ $car->doors ?? '-' }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-passengers"></i> Passengers</span>
                                <p>{{ $car->passengers ?? '-' }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-transmission"></i> Transmission</span>
                                <p>{{ $car->transmission ?? '-' }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-luggage"></i> Luggage</span>
                                <p>{{ $car->luggage ?? '-' }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-condition"></i> Air Condition</span>
                                <p>{{ $car->air_condition ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="features"><span><i class="omfi-age"></i> Year</span>
                                <p>{{ $car->year }}</p>
                            </div>
                            <div class="btn-double mt-30" data-grouptype="&amp;">
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-car-id="{{ $car->id }}" href="#0">Rent Now</a>
                                <a href="{{ setting('car_detail.info.whatsapp_url') }}" target="_blank">
                                    <span class="fa-brands fa-whatsapp"></span> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.lets_talk', ['rentCarId' => $car->id])
    @include('frontend.partials.clients')
@endsection
