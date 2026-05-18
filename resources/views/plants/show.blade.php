{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['plant']->getName())

@section('content')
<div class="row g-5 align-items-start" style="margin-top:1rem;">

    {{-- IMAGE --}}
    <div class="col-md-6">
        <div style="border-radius:16px; overflow:hidden; background:#f2efe8; aspect-ratio:4/3; display:flex; align-items:center; justify-content:center; border:1px solid #e2ddd4;">
            @if($viewData['plant']->getImage())
                <img src="{{ asset('images/plants/' . $viewData['plant']->getImage()) }}"
                     alt="{{ $viewData['plant']->getName() }}"
                     style="width:100%; height:100%; object-fit:cover;">
            @else
                <div style="text-align:center; color:#7a7165; opacity:.4;">
                    <div style="font-size:4rem; margin-bottom:.5rem;"></div>
                    <div style="font-size:.75rem; letter-spacing:.1em; text-transform:uppercase;">{{ __('plant.no_image') }}</div>
                </div>
            @endif
        </div>
    </div>

    {{-- INFO --}}
    <div class="col-md-6">

        <div style="font-size:.72rem; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:#4a7c59; margin-bottom:.5rem;">
            {{ $viewData['plant']->getCategory()->getName() }}
        </div>

        <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2rem,5vw,3rem); font-weight:600; color:#1a3a2a; line-height:1.05; margin-bottom:1rem;">
            {{ $viewData['plant']->getName() }}
        </h1>

        <div style="font-size:1.6rem; font-weight:700; color:#2d5a3d; margin-bottom:1.5rem;">
            ${{ number_format($viewData['plant']->getPrice(), 0, ',', '.') }}
            <small style="font-size:.75rem; color:#7a7165; font-weight:400;">{{ __('plant.currency') }}</small>
            @if($viewData['plant']->getDiscount() > 0)
                <span style="font-size:.85rem; background:#f5ece4; color:#8b5e3c; padding:3px 10px; border-radius:20px; margin-left:.5rem; font-weight:600;">
                    -{{ $viewData['plant']->getDiscount() }}%
                </span>
            @endif
        </div>

        @if($viewData['plant']->getDescription())
            <p style="font-size:.95rem; color:#7a7165; line-height:1.8; margin-bottom:1.5rem;">
                {{ $viewData['plant']->getDescription() }}
            </p>
        @endif

        <div style="border:1px solid #e2ddd4; border-radius:12px; overflow:hidden; margin-bottom:1.5rem;">
            <div style="display:grid; grid-template-columns:1fr 1fr;">
                <div style="padding:.875rem 1.25rem; border-right:1px solid #e2ddd4; border-bottom:1px solid #e2ddd4;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">{{ __('plant.label_variety') }}</div>
                    <div style="font-size:.9rem; color:#1a3a2a;">{{ $viewData['plant']->getColor() ?: '—' }}</div>
                </div>
                <div style="padding:.875rem 1.25rem; border-bottom:1px solid #e2ddd4;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">{{ __('plant.label_size') }}</div>
                    <div style="font-size:.9rem; color:#1a3a2a;">{{ $viewData['plant']->getSize() ?: '—' }}</div>
                </div>
                <div style="padding:.875rem 1.25rem; border-right:1px solid #e2ddd4;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">{{ __('plant.label_availability') }}</div>
                    <div style="font-size:.9rem;">
                        @if($viewData['plant']->getStock() > 0)
                            <span style="color:#2d5a3d; font-weight:600;">{{ $viewData['plant']->getStock() }} {{ __('plant.label_available') }}</span>
                        @else
                            <span style="color:#7a7165;">{{ __('plant.label_out_of_stock') }}</span>
                        @endif
                    </div>
                </div>
                <div style="padding:.875rem 1.25rem;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">{{ __('plant.label_category') }}</div>
                    <div style="font-size:.9rem; color:#1a3a2a;">{{ $viewData['plant']->getCategory()->getName() }}</div>
                </div>
            </div>
        </div>

        @if($viewData['plant']->getStock() > 0)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="plant_id" value="{{ $viewData['plant']->getId() }}">
                <input type="hidden" name="item_type" value="plant">
                <div style="display:flex; gap:.75rem; align-items:center; margin-bottom:1rem;">
                    <div>
                        <label for="quantity" style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600; display:block; margin-bottom:.4rem;">
                            {{ __('plant.label_quantity') }}
                        </label>
                        <input id="quantity" type="number" name="quantity" value="1"
                               min="1" max="{{ $viewData['plant']->getStock() }}"
                               class="form-control" style="width:90px; border-radius:8px;">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100" style="border-radius:10px; font-size:.95rem;">
                    {{ __('plant.add_to_cart') }}
                </button>
            </form>
        @else
            <button class="btn btn-lg w-100" disabled
                    style="border-radius:10px; background:#f2efe8; color:#7a7165; border:1px solid #e2ddd4; cursor:not-allowed;">
                {{ __('plant.out_of_stock_btn') }}
            </button>
        @endif

    </div>
</div>

@endsection
