{{-- Author: Emily Cardona Castañeda --}}
@extends('layouts.app')
@section('title', __('service.index_title'))
@section('subtitle', __('service.index_subtitle'))

@section('content')
<p class="text-muted mb-4" style="max-width:600px; line-height:1.8;">
    {{ __('service.index_description') }}
</p>

@if($viewData['services']->isEmpty())
    <div class="alert alert-info">{{ __('service.empty') }}</div>
@else
    <div class="row g-4">
        @foreach($viewData['services'] as $service)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="border-radius:16px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
                 onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 40px rgba(45,90,61,.15)';"
                 onmouseout="this.style.transform='none';this.style.boxShadow='';">

                <div style="height:200px; background:linear-gradient(135deg,#e8f5ec,#d4eddf); display:flex; align-items:center; justify-content:center; overflow:hidden;">
                    @if($service->getImage())
                        <img src="{{ asset('images/services/' . $service->getImage()) }}"
                             alt="{{ $service->getName() }}"
                             style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="text-align:center; color:#4a7c59; opacity:.4;">
                            <div style="font-size:3rem; margin-bottom:.5rem;"></div>
                            <div style="font-size:.75rem; letter-spacing:.1em; text-transform:uppercase;">{{ __('service.no_image') }}</div>
                        </div>
                    @endif
                </div>

                <div style="height:5px; background:linear-gradient(90deg,#2d5a3d,#4a7c59);"></div>

                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="mb-1" style="font-family:'Cormorant Garamond',serif; font-size:1.35rem; font-weight:600; color:#1a3a2a;">
                        {{ $service->getName() }}
                    </h5>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span style="font-size:1.15rem; font-weight:700; color:#2d5a3d;">
                            ${{ number_format($service->getPrice(), 0, ',', '.') }}
                            <small class="text-muted fw-normal" style="font-size:.65rem;">{{ __('product.currency') }}</small>
                        </span>
                        @if($service->getDuration())
                            <span class="badge"
                                  style="background:rgba(45,90,61,.1); color:#2d5a3d; font-size:.68rem; font-weight:600;">
                                {{ $service->getDuration() }}
                            </span>
                        @endif
                    </div>

                    @if($service->getDescription())
                        <p class="text-muted mb-3" style="font-size:.88rem; line-height:1.7;">
                            {{ $service->getDescription() }}
                        </p>
                    @endif

                    @if(!empty($service->getFeatures()))
                        <ul class="list-unstyled mb-3" style="font-size:.875rem;">
                            @foreach($service->getFeatures() as $feature)
                                <li class="mb-1 d-flex align-items-start gap-2">
                                    <span style="color:#4a7c59; font-weight:700; flex-shrink:0;"></span>
                                    <span class="text-muted">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if($service->getEmployee())
                        <div class="mb-3 py-2 px-3 rounded-2"
                             style="background:#f0f7f2; font-size:.8rem; color:#4a7c59;">
                            {{ __('service.assigned_gardener') }} <strong>{{ $service->getEmployee() }}</strong>
                        </div>
                    @endif

                    <div class="mt-auto">
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->getId() }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="item_type" value="service">
                                <button type="submit" class="btn btn-success w-100" style="border-radius:10px;">
                                    {{ __('service.request_service') }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-success w-100" style="border-radius:10px;">
                                {{ __('service.login_to_request') }}
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
