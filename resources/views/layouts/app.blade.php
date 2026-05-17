{{-- Author: Emily Cardona Castañeda --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', __('layout.app_title')) — {{ __('layout.footer_brand') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="{{ route('home.index') }}"
           style="font-family:'Cormorant Garamond',serif; font-size:1.6rem; font-style:italic;">

            <img src="{{ asset('images/logo.png') }}"
            alt="Logo"
            style="height:60px; margin-right:15px;">

             {{ __('layout.brand') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">{{ __('layout.nav_home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">{{ __('layout.nav_products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('service.index') }}">{{ __('layout.nav_services') }}</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i> {{ __('layout.nav_cart') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.index') }}">{{ __('layout.nav_my_orders') }}</a>
                    </li>
                    @if(auth()->user()->getRole() === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-semibold" href="{{ route('admin.index') }}">
                                <i class="bi bi-gear-fill"></i> {{ __('layout.nav_admin') }}
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm ms-2">{{ __('layout.nav_logout') }}</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('layout.nav_login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success btn-sm ms-2" href="{{ route('register') }}">{{ __('layout.nav_register') }}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@hasSection('hero')
    @yield('hero')
@else
    @hasSection('subtitle')
    <div style="background:#fff; border-bottom:1px solid #e2ddd4; padding:1.25rem 0;">
        <div class="container">
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:1.75rem; font-weight:600; color:#1a3a2a; margin:0;">
                @yield('subtitle')
            </h1>
        </div>
    </div>
    @endif
@endif

<main class="container py-4 flex-grow-1">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</main>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1" style="font-family:'Cormorant Garamond',serif; font-size:1.2rem; font-style:italic;">{{ __('layout.footer_brand') }}</p>
        <small class="text-secondary">{{ __('layout.footer_tagline') }}</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
