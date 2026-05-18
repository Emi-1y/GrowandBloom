{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')
@section('title', 'Grow and Bloom')

@section('hero')
<div style="background: linear-gradient(135deg, #1a3a2a 0%, #2d5a3d 60%, #4a7c59 100%); min-height: 75vh; display:flex; align-items:center; position:relative; overflow:hidden;">
    {{-- Decorative circles --}}
    <div style="position:absolute; top:-80px; right:-80px; width:400px; height:400px; background:rgba(255,255,255,0.04); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-60px; left:-60px; width:300px; height:300px; background:rgba(255,255,255,0.03); border-radius:50%;"></div>

    <div class="container py-5 position:relative">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-success bg-opacity-50 text-white mb-3 px-3 py-2"
                      style="font-size:.75rem; letter-spacing:.15em; text-transform:uppercase;">
                    {{ __('home.hero_badge') }}
                </span>
                <h1 class="display-3 fw-light text-white mb-3"
                    style="font-family:'Cormorant Garamond',serif; line-height:1.05;">
                    Grow<br>
                    <em style="font-weight:600; color:#a8d5b5;">{{ __('home.hero_emphasis') }}</em>
                </h1>
                <p class="text-white mb-5" style="opacity:.8; font-size:1.05rem; max-width:480px; line-height:1.8;">
                    {{ __('home.hero_description') }}
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    @auth
                        <a href="{{ route('plant.index') }}" class="btn btn-light btn-lg px-4" style="border-radius:8px; font-weight:600;">
                            <i class="bi bi-grid me-2"></i>{{ __('home.hero_browse_products') }}
                        </a>
                        <a href="{{ route('service.index') }}" class="btn btn-outline-light btn-lg px-4" style="border-radius:8px;">
                            {{ __('home.hero_browse_services') }}
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4" style="border-radius:8px; font-weight:600; color:#2d5a3d;">
                            <i class="bi bi-person-plus me-2"></i>{{ __('home.hero_get_started') }}
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4" style="border-radius:8px;">
                            {{ __('home.hero_login') }}
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                <div style="font-size: 14rem; opacity:.15; line-height:1; user-select:none;"></div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('content')

{{-- FEATURED PRODUCTS --}}
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-end border-bottom pb-3 mb-4">
        <div>
            <h2 style="font-family:'Cormorant Garamond',serif; font-size:2rem; font-weight:600; color:#2d5a3d;">
                {{ __('home.featured_title') }}
            </h2>
            <p class="text-muted mb-0" style="font-size:.85rem; letter-spacing:.08em; text-transform:uppercase;">
                {{ __('home.featured_subtitle') }}
            </p>
        </div>
        <a href="{{ route('plant.index') }}"
           class="btn btn-outline-success btn-sm">{{ __('home.featured_view_all') }}</a>
    </div>

    @if($viewData['featuredPlants']->isEmpty())
        <div class="alert alert-info">{{ __('home.featured_empty') }}</div>
    @else
        <div class="row g-3">
            @foreach($viewData['featuredPlants'] as $plant)
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm" style="border-radius:12px; overflow:hidden; transition: transform .2s, box-shadow .2s;"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,.12)';"
                     onmouseout="this.style.transform='none';this.style.boxShadow='';">

                    <div style="background:linear-gradient(135deg,#e8f5ec,#f0f7f2); height:180px; display:flex; align-items:center; justify-content:center; position:relative;">
                        @if($plant->getImage())
                            <img src="{{ asset('images/plants/'.$plant->getImage()) }}"
                                 alt="{{ $plant->getName() }}" style="height:100%; width:100%; object-fit:cover;">
                        @else
                            <span style="font-size:3.5rem; opacity:.4;"></span>
                        @endif
                        @if($plant->getStock() === 0)
                            <span class="badge bg-secondary position-absolute top-0 end-0 m-2"
                                  style="font-size:.62rem;">{{ __('home.badge_out_of_stock') }}</span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column p-3">
                        <span class="text-success mb-1"
                              style="font-size:.68rem; font-weight:600; letter-spacing:.1em; text-transform:uppercase;">
                            {{ $plant->getCategory()->getName() }}
                        </span>
                        <h6 class="card-title mb-2" style="font-family:'Cormorant Garamond',serif; font-size:1.05rem; font-weight:600; color:#1a3a2a; line-height:1.25;">
                            {{ $plant->getName() }}
                        </h6>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span style="font-size:.95rem; font-weight:700; color:#2d5a3d;">
                                    ${{ number_format($plant->getPrice(), 0, ',', '.') }}
                                    <small class="text-muted fw-normal" style="font-size:.65rem;">{{ __('plant.currency') }}</small>
                                </span>
                                @if($plant->getStock() > 0)
                                    <span class="badge text-success"
                                          style="background:rgba(45,90,61,.1); font-size:.62rem;">{{ __('home.badge_in_stock') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('plant.show', $plant->getId()) }}"
                               class="btn btn-outline-success btn-sm w-100" style="border-radius:8px; font-size:.8rem;">
                                {{ __('home.card_view_detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

{{-- SERVICES BANNER --}}
<div class="rounded-4 p-5 mb-5 d-flex justify-content-between align-items-center flex-wrap gap-4"
     style="background:linear-gradient(135deg,#e8f5ec,#d4eddf); border:1px solid #b8dfc6;">
    <div>
        <span style="font-size:.7rem; letter-spacing:.18em; text-transform:uppercase; color:#4a7c59; font-weight:600;">
            {{ __('home.services_badge') }}
        </span>
        <h2 class="mt-1 mb-2" style="font-family:'Cormorant Garamond',serif; font-size:2rem; color:#1a3a2a; font-weight:600;">
            {{ __('home.services_title') }}
        </h2>
        <p class="text-muted mb-0" style="max-width:460px; line-height:1.75;">
            {{ __('home.services_description') }}
        </p>
    </div>
    <a href="{{ route('service.index') }}" class="btn btn-success btn-lg px-4" style="border-radius:10px; white-space:nowrap;">
        {{ __('home.services_explore') }} <i class="bi bi-arrow-right ms-2"></i>
    </a>
</div>

{{-- CATEGORIES --}}
@if(!$viewData['categories']->isEmpty())
<div>
    <div class="d-flex justify-content-between align-items-end border-bottom pb-3 mb-4">
        <div>
            <h2 style="font-family:'Cormorant Garamond',serif; font-size:2rem; font-weight:600; color:#2d5a3d;">
                {{ __('home.categories_title') }}
            </h2>
            <p class="text-muted mb-0" style="font-size:.82rem;">{{ __('home.categories_subtitle') }}</p>
        </div>
    </div>
    <div class="row g-3">
        @foreach($viewData['categories'] as $category)
        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('plant.index') }}"
               class="text-decoration-none d-block text-center p-4 rounded-3 border h-100"
               style="background:#fff; border-color:#d4eddf !important; transition:all .2s;"
               onmouseover="this.style.borderColor='#4a7c59';this.style.background='#e8f5ec';this.style.transform='translateY(-2px)';"
               onmouseout="this.style.borderColor='#d4eddf';this.style.background='#fff';this.style.transform='none';">
                <div style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-weight:600; color:#1a3a2a; margin-bottom:.25rem;">
                    {{ $category->getName() }}
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection
