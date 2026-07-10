<!-- Clients -->
<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="owl-carousel owl-theme">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="clients-logo">
                            <a href="#0"><img src="{{ setting_image("shared.clients.logo{$i}") }}" alt=""></a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
