{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')
@section('title', __('order.checkout_title'))
@section('subtitle', __('order.checkout_title'))

@section('content')
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
            <div style="height:5px; background:linear-gradient(90deg,#2d5a3d,#4a7c59);"></div>
            <div class="card-body p-4">

                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul style="margin:0; padding-left:1rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h6 style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-weight:600; color:#1a3a2a; margin-bottom:1rem;">
                    {{ __('order.delivery_data') }}
                </h6>
                <div style="background:#f2efe8; border-radius:10px; padding:1rem 1.25rem; margin-bottom:1.5rem; font-size:.9rem;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:.5rem;">
                        <div>
                            <span style="font-size:.65rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600;">{{ __('order.label_name') }}</span>
                            <div style="color:#1a3a2a; font-weight:500;">{{ $viewData['user']->getName() }}</div>
                        </div>
                        <div>
                            <span style="font-size:.65rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600;">{{ __('order.label_phone') }}</span>
                            <div style="color:#1a3a2a;">{{ $viewData['user']->getPhone() ?? '—' }}</div>
                        </div>
                        <div>
                            <span style="font-size:.65rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600;">{{ __('order.label_address') }}</span>
                            <div style="color:#1a3a2a;">{{ $viewData['user']->getAddress() ?? '—' }}</div>
                        </div>
                        <div>
                            <span style="font-size:.65rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600;">{{ __('order.label_city') }}</span>
                            <div style="color:#1a3a2a;">{{ $viewData['user']->getCity() ?? '—' }}</div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('order.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom:1.5rem;">
                        <label for="payment_method" class="form-label">{{ __('order.payment_method') }}</label>
                        <select name="payment_method" id="payment_method"
                                class="form-select @error('payment_method') is-invalid @enderror" required>
                            <option value="">{{ __('order.payment_select') }}</option>
                            <option value="cash"     {{ old('payment_method') === 'cash'     ? 'selected' : '' }}>{{ __('order.payment_cash') }}</option>
                            <option value="card"     {{ old('payment_method') === 'card'     ? 'selected' : '' }}>{{ __('order.payment_card') }}</option>
                            <option value="transfer" {{ old('payment_method') === 'transfer' ? 'selected' : '' }}>{{ __('order.payment_transfer') }}</option>
                            <option value="nequi"    {{ old('payment_method') === 'nequi'    ? 'selected' : '' }}>{{ __('order.payment_nequi') }}</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display:flex; gap:.75rem;">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;">
                            {{ __('order.back_to_cart') }}
                        </a>
                        <button type="submit" class="btn btn-success btn-lg" style="border-radius:10px;">
                            {{ __('order.confirm_order') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden; position:sticky; top:84px;">
            <div style="height:5px; background:linear-gradient(90deg,#2d5a3d,#4a7c59);"></div>
            <div class="card-body p-4">
                <h6 style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-weight:600; color:#1a3a2a; margin-bottom:1rem;">
                    {{ __('order.order_summary_label') }}
                </h6>
                @foreach($viewData['cartItems'] as $cartItem)
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; padding:.75rem 0; border-bottom:1px solid #e2ddd4; font-size:.88rem;">
                        <div>
                            <div style="font-weight:600; color:#1a3a2a;">{{ $cartItem->getDisplayName() }}</div>
                            <div style="font-size:.75rem; color:#7a7165;">× {{ $cartItem->getQuantity() }}</div>
                        </div>
                        <div style="font-weight:600; color:#2d5a3d; white-space:nowrap; margin-left:1rem;">
                            {{ $cartItem->getFormattedSubtotal() }}
                        </div>
                    </div>
                @endforeach

                <div style="display:flex; justify-content:space-between; align-items:center; padding:1rem 0 0; border-top:1.5px solid #e2ddd4; margin-top:.5rem;">
                    <span style="font-size:.75rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; font-weight:600;">{{ __('order.label_total') }}</span>
                    <span style="font-size:1.2rem; font-weight:700; color:#2d5a3d;">
                        ${{ number_format($viewData['totalAmount'], 0, ',', '.') }} {{ __('plant.currency') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
