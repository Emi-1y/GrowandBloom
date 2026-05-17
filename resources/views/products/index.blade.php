{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')
@section('title', __('product.index_title'))
@section('subtitle', __('product.index_title'))

@section('content')
{{-- FILTERS --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('product.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label text-muted" style="font-size:.72rem; letter-spacing:.08em; text-transform:uppercase; font-weight:600;">
                    {{ __('product.filter_search') }}
                </label>
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="{{ __('product.filter_search_placeholder') }}" value="{{ $viewData['search'] ?? '' }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted" style="font-size:.72rem; letter-spacing:.08em; text-transform:uppercase; font-weight:600;">
                    {{ __('product.filter_category') }}
                </label>
                <select name="category" class="form-select form-select-sm">
                    <option value="">{{ __('product.filter_all_categories') }}</option>
                    @foreach($viewData['categories'] ?? [] as $cat)
                        <option value="{{ $cat->getId() }}"
                            {{ (string)($viewData['selectedCategory'] ?? '') === (string)$cat->getId() ? 'selected' : '' }}>
                            {{ $cat->getName() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted" style="font-size:.72rem; letter-spacing:.08em; text-transform:uppercase; font-weight:600;">
                    {{ __('product.filter_type') }}
                </label>
                <select name="exclusive" class="form-select form-select-sm">
                    <option value="">{{ __('product.filter_all') }}</option>
                    <option value="1" {{ ($viewData['selectedExclusive'] ?? '') === '1' ? 'selected' : '' }}>{{ __('product.filter_exclusive') }}</option>
                    <option value="0" {{ ($viewData['selectedExclusive'] ?? '') === '0' ? 'selected' : '' }}>{{ __('product.filter_standard') }}</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-success btn-sm w-100">
                    <i class="bi bi-search me-1"></i>{{ __('product.filter_search') }}
                </button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary btn-sm w-100" title="Clear">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>

@if($viewData['products']->count() > 0)
    <div class="row g-3">
        @foreach($viewData['products'] as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm" style="border-radius:12px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
                 onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,.12)';"
                 onmouseout="this.style.transform='none';this.style.boxShadow='';">
                <div style="background:linear-gradient(135deg,#e8f5ec,#f0f7f2); height:180px; display:flex; align-items:center; justify-content:center; position:relative;">
                    @if($product->getImage())
                        <img src="{{ asset('images/products/'.$product->getImage()) }}"
                             alt="{{ $product->getName() }}" style="height:100%; width:100%; object-fit:cover;">
                    @else
                        <span style="font-size:3.5rem; opacity:.4;"></span>
                    @endif
                    @if($product->getExclusive())
                        <span class="badge position-absolute top-0 start-0 m-2"
                              style="background:#8b5e3c; font-size:.6rem; letter-spacing:.08em;">{{ __('product.badge_exclusive') }}</span>
                    @endif
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <span class="text-success mb-1"
                          style="font-size:.68rem; font-weight:600; letter-spacing:.1em; text-transform:uppercase;">
                        {{ $product->getCategory()->getName() }}
                    </span>
                    <h6 class="mb-2" style="font-family:'Cormorant Garamond',serif; font-size:1.05rem; font-weight:600; color:#1a3a2a;">
                        {{ $product->getName() }}
                    </h6>
                    @if($product->getDescription())
                        <p class="text-muted mb-2" style="font-size:.8rem; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                            {{ $product->getDescription() }}
                        </p>
                    @endif
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span style="font-size:.95rem; font-weight:700; color:#2d5a3d;">
                                ${{ number_format($product->getPrice(), 0, ',', '.') }}
                                <small class="text-muted fw-normal" style="font-size:.65rem;">{{ __('product.currency') }}</small>
                            </span>
                            @if($product->getStock() > 0)
                                <span class="badge" style="background:rgba(45,90,61,.1); color:#2d5a3d; font-size:.62rem;">
                                    {{ __('product.badge_in_stock') }}
                                </span>
                            @else
                                <span class="badge bg-secondary" style="font-size:.62rem;">{{ __('product.badge_out_of_stock') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('product.show', $product->getId()) }}"
                           class="btn btn-outline-success btn-sm w-100" style="border-radius:8px;">
                            {{ __('product.view_detail') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $viewData['products']->links() }}
    </div>
@else
    <div class="text-center py-5">
        <div style="font-size:4rem; opacity:.3;"></div>
        <h4 class="mt-3 text-muted">{{ __('product.not_found') }}</h4>
        <a href="{{ route('product.index') }}" class="btn btn-outline-success mt-3">{{ __('product.view_all') }}</a>
    </div>
@endif
@endsection
