<!-- Lets Talk -->
<section class="lets-talk bg-img bg-fixed section-padding" data-overlay-dark="{{ $overlay ?? 5 }}" data-background="{{ setting_image('shared.letstalk.background') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h6>{{ setting('shared.letstalk.subtitle') }}</h6>
                <h5>{{ setting('shared.letstalk.title') }}</h5>
                <p>{{ setting('shared.letstalk.text') }}</p>
                <a href="tel:{{ setting('shared.letstalk.phone') }}" class="button-1 mt-15 mb-15 mr-10"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" @isset($rentCarId) data-car-id="{{ $rentCarId }}" @endisset href="#0" class="button-2 mt-15 mb-15">Rent Now <span class="ti-arrow-top-right"></span></a>
            </div>
        </div>
    </div>
</section>
