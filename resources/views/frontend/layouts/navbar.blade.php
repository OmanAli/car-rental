    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="{{ url('/') }}"> <img src="{{ setting_image('global.navbar.logo') }}" class="logo-img"
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
                    <li class="nav-item"><a class="nav-link {{ request()->is('car') ? 'active' : '' }}" href="{{route('car')}}">Cars</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="about.html">Blog</a></li> --}}
                    <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{route('contact')}}">Contact</a></li>
                </ul>
                <div class="navbar-right">
                    <div class="wrap">
                        <div class="icon"> <i class="flaticon-phone-call"></i> </div>
                        <div class="text">
                            <p>{{ setting('global.navbar.help_text') }}</p>
                            <h5><a href="tel:{{ setting('global.navbar.phone') }}">{{ setting('global.navbar.phone') }}</a></h5>
                        </div>
                    </div>
                    @auth
                        <div class="dropdown ms-3">
                            <a class="btn btn-dark dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.detail') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-dark ms-3 me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-light border">Register</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
