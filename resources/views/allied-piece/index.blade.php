{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')
@section('title', __('allied.title'))

@section('content')

{{-- Section header --}}
<div style="text-align: center; margin-bottom: 2.5rem;">
    <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2.2rem; font-weight: 400; color: #1a1a2e; font-style: italic; margin-bottom: 0.5rem;">
        {{ __('allied.section_title') }}
    </h2>
    <p style="font-size: 0.88rem; color: var(--c-muted);">
        {{ __('allied.section_subtitle') }}
    </p>
</div>

@if(!empty($viewData['error']))
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ $viewData['error'] }}
    </div>
@elseif(empty($viewData['pieces']))
    <div style="text-align: center; padding: 4rem 2rem; color: var(--c-muted);">
        {{ __('allied.empty') }}
    </div>
@else
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
        @foreach($viewData['pieces'] as $piece)
        @php
            $inStock = ($piece['stock'] ?? 0) > 0;
            $price = '$' . number_format($piece['price'] ?? 0, 2, '.', ',') . ' COP';
        @endphp
        <div class="col">
            <div style="
                background: #fff;
                border: 1px solid #e8e2d9;
                border-radius: 12px;
                overflow: hidden;
                height: 100%;
                display: flex;
                flex-direction: column;
            ">
                {{-- Image area --}}
                <div style="background: #f5f0e8; aspect-ratio: 1 / 1; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img
                        src="{{ $piece['image_url'] ?? '' }}"
                        alt="{{ $piece['name'] ?? '' }}"
                        style="width: 100%; height: 100%; object-fit: cover;"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div style="display: none; width: 100%; height: 100%; align-items: center; justify-content: center;">
                        <i class="bi bi-box" style="font-size: 3rem; color: #c9a96e; opacity: 0.6;"></i>
                    </div>
                </div>

                {{-- Card body --}}
                <div style="padding: 1rem 1.1rem 1.2rem; display: flex; flex-direction: column; gap: 0.25rem; flex: 1;">
                    <div style="font-size: 0.95rem; font-weight: 600; color: #1a1a2e; line-height: 1.3;">
                        {{ $piece['name'] ?? '' }}
                    </div>
                    <div style="font-size: 0.9rem; color: #1a1a2e; margin-top: 0.1rem;">
                        {{ $price }}
                    </div>
                    <div style="font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em; color: #c9a96e; margin-top: 0.1rem;">
                        {{ $piece['stock'] ?? 0 }} {{ __('allied.stock_label') }}
                    </div>

                    <div style="margin-top: auto; padding-top: 0.85rem;">
                        <a href="{{ $piece['view_url'] ?? '#' }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           style="
                               display: block;
                               text-align: center;
                               border: 1px solid #c9a96e;
                               color: #1a1a2e;
                               font-size: 0.8rem;
                               padding: 8px 0;
                               border-radius: 6px;
                               text-decoration: none;
                               transition: background .15s, color .15s;
                           "
                           onmouseover="this.style.background='#c9a96e'; this.style.color='#fff'"
                           onmouseout="this.style.background='transparent'; this.style.color='#1a1a2e'">
                            {{ __('allied.view_product') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection
