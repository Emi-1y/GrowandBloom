{{-- Author: Emily Cardona Castañeda --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin') — Grow and Bloom · Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            @if(Route::has('admin.index'))
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    Grow and Bloom · Admin
                </a>
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="{{ __('layout.toggle_navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    @if(Route::has('admin.index'))
                        <a class="nav-link" href="{{ route('admin.index') }}">{{ __('layout.admin_panel') }}</a>
                    @endif
                    @if(Route::has('admin.plant.index'))
                        <a class="nav-link" href="{{ route('admin.plant.index') }}">{{ __('layout.admin_plants') }}</a>
                    @endif
                    @if(Route::has('admin.category.index'))
                        <a class="nav-link" href="{{ route('admin.category.index') }}">{{ __('layout.admin_categories') }}</a>
                    @endif
                    @if(Route::has('admin.service.index'))
                        <a class="nav-link" href="{{ route('admin.service.index') }}">{{ __('layout.admin_services') }}</a>
                    @endif
                    @if(Route::has('admin.order.index'))
                        <a class="nav-link" href="{{ route('admin.order.index') }}">{{ __('layout.admin_orders') }}</a>
                    @endif
                    @if(Route::has('admin.user.index'))
                        <a class="nav-link" href="{{ route('admin.user.index') }}">{{ __('layout.admin_users') }}</a>
                    @endif
                    @if(Route::has('home.index'))
                        <a class="nav-link" href="{{ route('home.index') }}">{{ __('layout.back_to_store') }}</a>
                    @endif
                    @auth
                        @if(Route::has('logout'))
                            <form method="POST" action="{{ route('logout') }}" class="d-inline ms-lg-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">{{ __('layout.logout') }}</button>
                            </form>
                        @endif
                    @endauth
                    <form method="POST" action="{{ route('locale.switch') }}" class="d-inline ms-lg-2">
                        @csrf
                        <button type="submit" name="locale" value="en"
                            class="btn btn-sm {{ app()->getLocale() === 'en' ? 'btn-success' : 'btn-outline-success' }}">EN</button>
                        <button type="submit" name="locale" value="es"
                            class="btn btn-sm {{ app()->getLocale() === 'es' ? 'btn-success' : 'btn-outline-success' }}">ES</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div style="background:#fff; border-bottom:1px solid #e2ddd4; padding:1.25rem 0;">
    <div class="container">
        <h1 style="font-family:'Cormorant Garamond',serif; font-size:1.75rem; font-weight:600; color:#1a3a2a; margin:0;">
            @yield('subtitle', __('admin.dashboard_subtitle'))
        </h1>
    </div>
</div>

    <main class="container my-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success mb-4" role="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4" role="alert">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container">
            <small>Grow and Bloom · Admin Panel</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
