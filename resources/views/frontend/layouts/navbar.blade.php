    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="#"> <img src="{{ asset('assets/logo.jpeg') }}" class="logo-img"
                        alt=""> </a>
                <!--<a class="logo" href="{{url('/')}}"><h2>Midnight<span>Lux</span></h2></a>-->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                     <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{url('/')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{route('about')}}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('services') ? 'active' : '' }}" href="{{route('services')}}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('cars') ? 'active' : '' }}" href="{{route('cars')}}">Cars</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="about.html">Blog</a></li> --}}
                    <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{route('contact')}}">Contact</a></li>
                </ul>
                <div class="navbar-right">
                    <div class="wrap">
                        <div class="icon"> <i class="flaticon-phone-call"></i> </div>
                        <div class="text">
                            <p>Need help?</p>
                            <h5><a href="tel:702-336-8078">702-336-8078</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
