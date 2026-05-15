{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['product']->getName())

@section('content')
<div class="row g-5 align-items-start" style="margin-top:1rem;">

    {{-- IMAGEN --}}
    <div class="col-md-6">
        <div style="border-radius:16px; overflow:hidden; background:#f2efe8; aspect-ratio:4/3; display:flex; align-items:center; justify-content:center; border:1px solid #e2ddd4;">
            @if($viewData['product']->getImage())
                <img src="{{ asset('images/products/' . $viewData['product']->getImage()) }}"
                     alt="{{ $viewData['product']->getName() }}"
                     style="width:100%; height:100%; object-fit:cover;">
            @else
                <div style="text-align:center; color:#7a7165; opacity:.4;">
                    <div style="font-size:4rem; margin-bottom:.5rem;"></div>
                    <div style="font-size:.75rem; letter-spacing:.1em; text-transform:uppercase;">Sin imagen</div>
                </div>
            @endif
        </div>
    </div>

    {{-- INFO --}}
    <div class="col-md-6">

        {{-- Categoría --}}
        <div style="font-size:.72rem; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:#4a7c59; margin-bottom:.5rem;">
            {{ $viewData['product']->getCategory()->getName() }}
        </div>

        {{-- Nombre --}}
        <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2rem,5vw,3rem); font-weight:600; color:#1a3a2a; line-height:1.05; margin-bottom:1rem;">
            {{ $viewData['product']->getName() }}
        </h1>

        {{-- Precio --}}
        <div style="font-size:1.6rem; font-weight:700; color:#2d5a3d; margin-bottom:1.5rem;">
            ${{ number_format($viewData['product']->getPrice(), 0, ',', '.') }}
            <small style="font-size:.75rem; color:#7a7165; font-weight:400;">COP</small>
            @if($viewData['product']->getDiscount() > 0)
                <span style="font-size:.85rem; background:#f5ece4; color:#8b5e3c; padding:3px 10px; border-radius:20px; margin-left:.5rem; font-weight:600;">
                    -{{ $viewData['product']->getDiscount() }}%
                </span>
            @endif
        </div>

        {{-- Descripción --}}
        @if($viewData['product']->getDescription())
            <p style="font-size:.95rem; color:#7a7165; line-height:1.8; margin-bottom:1.5rem;">
                {{ $viewData['product']->getDescription() }}
            </p>
        @endif

        {{-- Detalles --}}
        <div style="border:1px solid #e2ddd4; border-radius:12px; overflow:hidden; margin-bottom:1.5rem;">
            <div style="display:grid; grid-template-columns:1fr 1fr;">
                <div style="padding:.875rem 1.25rem; border-right:1px solid #e2ddd4; border-bottom:1px solid #e2ddd4;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">Variedad</div>
                    <div style="font-size:.9rem; color:#1a3a2a;">{{ $viewData['product']->getColor() ?: '—' }}</div>
                </div>
                <div style="padding:.875rem 1.25rem; border-bottom:1px solid #e2ddd4;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">Presentación</div>
                    <div style="font-size:.9rem; color:#1a3a2a;">{{ $viewData['product']->getSize() ?: '—' }}</div>
                </div>
                <div style="padding:.875rem 1.25rem; border-right:1px solid #e2ddd4;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">Disponibilidad</div>
                    <div style="font-size:.9rem;">
                        @if($viewData['product']->getStock() > 0)
                            <span style="color:#2d5a3d; font-weight:600;">{{ $viewData['product']->getStock() }} disponibles</span>
                        @else
                            <span style="color:#7a7165;">Sin stock</span>
                        @endif
                    </div>
                </div>
                <div style="padding:.875rem 1.25rem;">
                    <div style="font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-bottom:3px;">Categoría</div>
                    <div style="font-size:.9rem; color:#1a3a2a;">{{ $viewData['product']->getCategory()->getName() }}</div>
                </div>
            </div>
        </div>

        {{-- Agregar al carrito --}}
        @if($viewData['product']->getStock() > 0)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
                <input type="hidden" name="item_type" value="product">
                <div style="display:flex; gap:.75rem; align-items:center; margin-bottom:1rem;">
                    <div>
                        <label for="quantity" style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600; display:block; margin-bottom:.4rem;">
                            Cantidad
                        </label>
                        <input id="quantity" type="number" name="quantity" value="1"
                               min="1" max="{{ $viewData['product']->getStock() }}"
                               class="form-control" style="width:90px; border-radius:8px;">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100" style="border-radius:10px; font-size:.95rem;">
                    Agregar al carrito
                </button>
            </form>
        @else
            <button class="btn btn-lg w-100" disabled
                    style="border-radius:10px; background:#f2efe8; color:#7a7165; border:1px solid #e2ddd4; cursor:not-allowed;">
                Sin stock disponible
            </button>
        @endif

        <hr style="border-color:#e2ddd4; margin:1.5rem 0;">

        {{-- Reseña --}}
        @auth
            <a href="{{ route('review.create', $viewData['product']->getId()) }}"
               class="btn btn-outline-success w-100" style="border-radius:10px;">
                Escribir una reseña
            </a>
        @else
            <a href="{{ route('login') }}"
               class="btn btn-outline-secondary w-100" style="border-radius:10px;">
                Inicia sesión para escribir una reseña
            </a>
        @endauth
    </div>
</div>

{{-- RESEÑAS --}}
@if($viewData['product']->getReviews()->count() > 0)
    <div style="margin-top:4rem;">
        <div style="border-bottom:1px solid #e2ddd4; padding-bottom:1rem; margin-bottom:1.5rem;">
            <h2 style="font-family:'Cormorant Garamond',serif; font-size:1.75rem; font-weight:600; color:#1a3a2a; margin:0;">
                Reseñas
                <span style="font-size:1rem; color:#7a7165; font-weight:400; font-family:'DM Sans',sans-serif;">
                    ({{ $viewData['product']->getReviews()->count() }})
                </span>
            </h2>
        </div>
        <div style="display:grid; gap:1rem;">
            @foreach($viewData['product']->getReviews() as $review)
                <div style="background:#fff; border:1px solid #e2ddd4; border-radius:12px; padding:1.25rem 1.5rem;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:.5rem;">
                        <div>
                            <div style="font-weight:600; font-size:.9rem; color:#1a3a2a;">
                                {{ $review->getUser()->getName() }}
                            </div>
                            <div style="font-size:.75rem; color:#7a7165;">{{ $review->getCreatedAt() }}</div>
                        </div>
                        <div style="color:#b8832a; font-size:.95rem; letter-spacing:.1em;">
                            @for($i = 0; $i < $review->getRating(); $i++)  @endfor
                            @for($i = $review->getRating(); $i < 5; $i++)
                                <span style="opacity:.2;"></span>
                            @endfor
                        </div>
                    </div>
                    @if($review->getComment())
                        <p style="font-size:.875rem; color:#7a7165; line-height:1.75; margin:0;">
                            {{ $review->getComment() }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif

@endsection