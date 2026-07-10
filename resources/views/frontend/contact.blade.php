@extends('frontend.layouts.app')

@section('title', 'CONTACT')

@section('content')
    <!-- Header Banner -->
    <section class="banner-header middle-height section-padding bg-img" data-overlay-dark="6" data-background="{{ setting_image('contact.banner.image') }}">
        <div class="v-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6>{{ setting('contact.banner.subtitle') }}</h6>
                        <h1>{{ setting('contact.banner.title') }} <span>{{ setting('contact.banner.title_colored') }}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Box -->
    <div class="contact-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item"> <span class="icon omfi-envelope"></span>
                        <h5>{{ setting('contact.boxes.email_title') }}</h5>
                        <p>{{ setting('contact.boxes.email') }}</p> <i class="numb omfi-envelope"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item"> <span class="icon omfi-location"></span>
                        <h5>{{ setting('contact.boxes.address_title') }}</h5>
                        <p>{{ setting('contact.boxes.address') }}</p> <i class="numb omfi-location"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item"> <span class="icon ti-time"></span>
                        <h5>{{ setting('contact.boxes.hours_title') }}</h5>
                        <p>{{ setting('contact.boxes.hours') }}</p> <i class="numb ti-time"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 animate-box" data-animate-effect="fadeInUp">
                    <div class="item active"> <span class="icon omfi-phone"></span>
                        <h5>{{ setting('contact.boxes.phone_title') }}</h5>
                        <p>{{ setting('contact.boxes.phone') }}</p> <i class="numb omfi-phone"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact -->
    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <!-- Form -->
                <div class="col-lg-6 col-md-12 mb-30">
                    <div class="form-box">
                        <h5>{{ setting('contact.form.title') }}</h5>
                        <form method="post" class="contact__form" action="#">
                            <!-- form message -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                </div>
                            </div>
                            <!-- form elements -->
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input name="name" type="text" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="email" type="email" placeholder="Your Email *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="phone" type="text" placeholder="Your Number *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="subject" type="text" placeholder="Subject *" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <input name="submit" type="submit" value="Send Message">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Map -->
                <div class="col-lg-5 offset-lg-1 col-md-12">
                    <h5>{{ setting('contact.map.title') }}</h5>
                    <div class="google-map">
                        <iframe src="{{ setting('contact.map.embed_url') }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.lets_talk', ['overlay' => 6])
    @include('frontend.partials.clients')
@endsection
