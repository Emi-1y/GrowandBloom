{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('cart.subtitle'))

@section('content')
@if($viewData['cartItems']->isNotEmpty())
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="table-responsive" style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden;">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('order.product') }}</th>
                            <th>{{ __('order.price') }}</th>
                            <th style="min-width: 160px;">{{ __('order.quantity') }}</th>
                            <th>{{ __('order.subtotal') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['cartItems'] as $cartItem)
                        <tr>
                            <td>
                                <div style="font-weight: 600; font-size: 0.9rem; color: var(--c-text);">
                                    {{ $cartItem->getDisplayName() }}
                                </div>
                                @if($cartItem->isService())
                                    <span style="font-size: 0.68rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--c-accent); font-weight: 600;">
                                        {{ __('order.service_item') }}
                                    </span>
                                @else
                                    <span style="font-size: 0.68rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--c-muted);">
                                        {{ $cartItem->getPlant()->getCategory()->getName() }}
                                    </span>
                                @endif
                            </td>
                            <td style="font-family: var(--font-mono); font-size: 0.88rem; color: var(--c-accent-dk);">
                                {{ $cartItem->getFormattedUnitPrice() }}
                            </td>
                            <td>
                                @if(! $cartItem->isService())
                                    <form method="POST" action="{{ route('cart.update', $cartItem->getPlantId()) }}" style="display: flex; align-items: center; gap: 0.4rem;">
                                        @csrf
                                        @method('PUT')
                                        <input
                                            type="number"
                                            name="quantity"
                                            class="form-control"
                                            style="max-width: 70px;"
                                            min="1"
                                            max="{{ $cartItem->getPlant()->getStock() }}"
                                            value="{{ $cartItem->getQuantity() }}">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">↺</button>
                                    </form>
                                @else
                                    <span style="font-size: 0.9rem; color: var(--c-muted);">1</span>
                                @endif
                            </td>
                            <td style="font-family: var(--font-mono); font-size: 0.88rem; font-weight: 600; color: var(--c-accent-dk);">
                                {{ $cartItem->getFormattedSubtotal() }}
                            </td>
                            <td>
                                @if(! $cartItem->isService())
                                    <form method="POST" action="{{ route('cart.remove', $cartItem->getPlantId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            {{ __('order.remove') }}
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('cart.remove.service', $cartItem->getServiceId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            {{ __('order.remove') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('plant.index') }}" class="btn btn-outline-secondary">
                    ← {{ __('order.continue_shopping') }}
                </a>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        {{ __('order.clear_cart') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm" style="position: sticky; top: 84px;">
                <div class="card-header">{{ __('order.order_summary') }}</div>
                <div class="card-body">
                    <div class="cart-total-row" style="border-top: none; padding-top: 0;">
                        <span class="cart-total-label">{{ __('order.total_items') }}</span>
                        <span style="font-size: 0.9rem; font-weight: 600;">{{ $viewData['totalQuantity'] }}</span>
                    </div>
                    <div class="cart-total-row">
                        <span class="cart-total-label">{{ __('order.total') }}</span>
                        <span class="cart-total-value">
                            {{ number_format($viewData['totalAmount'], 0, ',', '.') }} {{ __('plant.currency') }}
                        </span>
                    </div>
                    <a href="{{ route('order.checkout') }}" class="btn btn-primary w-100" style="margin-top: 1rem;">
                        {{ __('order.place_order') }} →
                    </a>
                </div>
            </div>
        </div>
    </div>
@else
    <div style="text-align: center; padding: 5rem 2rem;">
        <div style="font-size: 3rem; margin-bottom: 1rem;"></div>
        <h2 style="font-family: var(--font-display); font-size: 1.75rem; margin-bottom: 0.75rem; color: var(--c-text);">
            {{ __('order.cart_empty_title') }}
        </h2>
        <p style="color: var(--c-muted); margin-bottom: 2rem; max-width: 400px; margin-left: auto; margin-right: auto;">
            {{ __('order.cart_empty') }}
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('plant.index') }}" class="btn btn-primary">
                {{ __('order.browse_products') }}
            </a>
            <a href="{{ route('service.index') }}" class="btn btn-outline-secondary">
                {{ __('order.browse_services') }}
            </a>
        </div>
    </div>
@endif
@endsection
