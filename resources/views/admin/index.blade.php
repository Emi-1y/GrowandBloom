{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')

{{-- STATS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden;">
            <div style="height:5px; background:linear-gradient(90deg,#2d5a3d,#4a7c59);"></div>
            <div class="card-body p-4">
                <div style="font-size:2.5rem; font-weight:700; color:#2d5a3d; font-family:'Cormorant Garamond',serif; line-height:1;">
                    {{ $viewData['plantsCount'] }}
                </div>
                <div style="font-size:.72rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-top:.4rem;">
                    {{ __('admin.stat_total_plants') }}
                </div>
                <div style="font-size:.8rem; color:#4a7c59; margin-top:.25rem;">
                    {{ $viewData['activePlantsCount'] }} {{ __('admin.stat_active') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden;">
            <div style="height:5px; background:linear-gradient(90deg,#8b5e3c,#c4922a);"></div>
            <div class="card-body p-4">
                <div style="font-size:2.5rem; font-weight:700; color:#8b5e3c; font-family:'Cormorant Garamond',serif; line-height:1;">
                    {{ $viewData['servicesCount'] }}
                </div>
                <div style="font-size:.72rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-top:.4rem;">
                    {{ __('admin.stat_active_services') }}
                </div>
                <div style="font-size:.8rem; color:#8b5e3c; margin-top:.25rem;">
                    {{ __('admin.stat_professional_gardening') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden;">
            <div style="height:5px; background:linear-gradient(90deg,#1a3a2a,#2d5a3d);"></div>
            <div class="card-body p-4">
                <div style="font-size:2.5rem; font-weight:700; color:#1a3a2a; font-family:'Cormorant Garamond',serif; line-height:1;">
                    {{ $viewData['ordersCount'] }}
                </div>
                <div style="font-size:.72rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-top:.4rem;">
                    {{ __('admin.stat_total_orders') }}
                </div>
                <div style="font-size:.8rem; color:#2d5a3d; margin-top:.25rem;">
                    {{ $viewData['pendingOrdersCount'] }} {{ __('admin.stat_pending') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden;">
            <div style="height:5px; background:linear-gradient(90deg,#4a7c59,#7aab8a);"></div>
            <div class="card-body p-4">
                <div style="font-size:2.5rem; font-weight:700; color:#4a7c59; font-family:'Cormorant Garamond',serif; line-height:1;">
                    {{ $viewData['usersCount'] }}
                </div>
                <div style="font-size:.72rem; letter-spacing:.12em; text-transform:uppercase; color:#7a7165; font-weight:600; margin-top:.4rem;">
                    {{ __('admin.stat_registered_users') }}
                </div>
                <div style="font-size:.8rem; color:#4a7c59; margin-top:.25rem;">
                    {{ __('admin.stat_active_clients') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODULES --}}
<div class="row g-3 mb-5">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(45,90,61,.15)';"
             onmouseout="this.style.transform='none';this.style.boxShadow='';">
            <div class="card-body p-4">
                <div style="width:42px; height:42px; background:#e8f5ec; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                    <svg width="20" height="20" fill="none" stroke="#2d5a3d" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/>
                    </svg>
                </div>
                <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:600; color:#1a3a2a; margin-bottom:.4rem;">
                    {{ __('admin.module_plants') }}
                </h5>
                <p style="font-size:.85rem; color:#7a7165; line-height:1.6; margin-bottom:1.25rem;">
                    {{ __('admin.module_plants_desc') }}
                </p>
                <a href="{{ route('admin.plant.index') }}" class="btn btn-success btn-sm px-4" style="border-radius:8px;">
                    {{ __('admin.module_plants_link') }}
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(45,90,61,.15)';"
             onmouseout="this.style.transform='none';this.style.boxShadow='';">
            <div class="card-body p-4">
                <div style="width:42px; height:42px; background:#e8f5ec; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                    <svg width="20" height="20" fill="none" stroke="#2d5a3d" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 10h16M4 14h10M4 18h6"/>
                    </svg>
                </div>
                <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:600; color:#1a3a2a; margin-bottom:.4rem;">
                    {{ __('admin.module_categories') }}
                </h5>
                <p style="font-size:.85rem; color:#7a7165; line-height:1.6; margin-bottom:1.25rem;">
                    {{ __('admin.module_categories_desc') }}
                </p>
                <a href="{{ route('admin.category.index') }}" class="btn btn-success btn-sm px-4" style="border-radius:8px;">
                    {{ __('admin.module_categories_link') }}
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(45,90,61,.15)';"
             onmouseout="this.style.transform='none';this.style.boxShadow='';">
            <div class="card-body p-4">
                <div style="width:42px; height:42px; background:#f5ece4; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                    <svg width="20" height="20" fill="none" stroke="#8b5e3c" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:600; color:#1a3a2a; margin-bottom:.4rem;">
                    {{ __('admin.module_services') }}
                </h5>
                <p style="font-size:.85rem; color:#7a7165; line-height:1.6; margin-bottom:1.25rem;">
                    {{ __('admin.module_services_desc') }}
                </p>
                <a href="{{ route('admin.service.index') }}" class="btn btn-success btn-sm px-4" style="border-radius:8px;">
                    {{ __('admin.module_services_link') }}
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(45,90,61,.15)';"
             onmouseout="this.style.transform='none';this.style.boxShadow='';">
            <div class="card-body p-4">
                <div style="width:42px; height:42px; background:#e8f5ec; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                    <svg width="20" height="20" fill="none" stroke="#2d5a3d" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 12V22H4V12"/><path d="M22 7H2v5h20V7z"/><path d="M12 22V7"/><path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/>
                    </svg>
                </div>
                <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:600; color:#1a3a2a; margin-bottom:.4rem;">
                    {{ __('admin.module_orders') }}
                </h5>
                <p style="font-size:.85rem; color:#7a7165; line-height:1.6; margin-bottom:1.25rem;">
                    {{ __('admin.module_orders_desc') }}
                </p>
                <a href="{{ route('admin.order.index') }}" class="btn btn-success btn-sm px-4" style="border-radius:8px;">
                    {{ __('admin.module_orders_link') }}
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden; transition:transform .2s, box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 32px rgba(45,90,61,.15)';"
             onmouseout="this.style.transform='none';this.style.boxShadow='';">
            <div class="card-body p-4">
                <div style="width:42px; height:42px; background:#e8f5ec; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                    <svg width="20" height="20" fill="none" stroke="#2d5a3d" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:600; color:#1a3a2a; margin-bottom:.4rem;">
                    {{ __('admin.module_users') }}
                </h5>
                <p style="font-size:.85rem; color:#7a7165; line-height:1.6; margin-bottom:1.25rem;">
                    {{ __('admin.module_users_desc') }}
                </p>
                <a href="{{ route('admin.user.index') }}" class="btn btn-success btn-sm px-4" style="border-radius:8px;">
                    {{ __('admin.module_users_link') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- RECENT ORDERS --}}
@if($viewData['recentOrders']->isNotEmpty())
<div class="d-flex justify-content-between align-items-center mb-3 pb-2" style="border-bottom:1px solid #e2ddd4;">
    <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.4rem; font-weight:600; color:#1a3a2a; margin:0;">
        {{ __('admin.recent_orders') }}
    </h5>
    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-success btn-sm" style="border-radius:8px;">
        {{ __('admin.view_all') }}
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="background:#f2efe8;">
                    <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">
                        {{ __('admin.col_order') }}
                    </th>
                    <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">
                        {{ __('admin.col_client') }}
                    </th>
                    <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">
                        {{ __('admin.col_total') }}
                    </th>
                    <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">
                        {{ __('admin.col_status') }}
                    </th>
                    <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">
                        {{ __('admin.col_date') }}
                    </th>
                    <th style="border:none;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['recentOrders'] as $order)
                <tr>
                    <td style="padding:1rem 1.25rem; font-family:'Courier New',monospace; font-size:.85rem; color:#2d5a3d; font-weight:600; border-color:#f2efe8;">
                        #{{ $order->getId() }}
                    </td>
                    <td style="padding:1rem 1.25rem; font-size:.88rem; border-color:#f2efe8;">
                        {{ $order->getUser()?->getName() ?? '—' }}
                    </td>
                    <td style="padding:1rem 1.25rem; font-size:.88rem; font-weight:600; color:#2d5a3d; border-color:#f2efe8;">
                        {{ $order->getFormattedTotal() }}
                    </td>
                    <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                        @if($order->getStatus() === 'pending')
                            <span style="background:#fff3cd; color:#856404; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:4px 10px; border-radius:20px; border:1px solid rgba(133,100,4,.2);">
                                {{ __('order.status_pending') }}
                            </span>
                        @elseif($order->getStatus() === 'completed')
                            <span style="background:#d4edda; color:#155724; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:4px 10px; border-radius:20px; border:1px solid rgba(21,87,36,.2);">
                                {{ __('order.status_completed') }}
                            </span>
                        @elseif($order->getStatus() === 'cancelled')
                            <span style="background:#f8d7da; color:#721c24; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:4px 10px; border-radius:20px; border:1px solid rgba(114,28,36,.2);">
                                {{ __('order.status_cancelled') }}
                            </span>
                        @else
                            <span style="background:#e2ddd4; color:#7a7165; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:4px 10px; border-radius:20px;">
                                {{ $order->getStatus() }}
                            </span>
                        @endif
                    </td>
                    <td style="padding:1rem 1.25rem; font-size:.82rem; color:#7a7165; border-color:#f2efe8;">
                        {{ $order->getFormattedDate() }}
                    </td>
                    <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                        <a href="{{ route('admin.order.edit', $order->getId()) }}"
                           class="btn btn-outline-success btn-sm" style="border-radius:8px; font-size:.75rem;">
                            {{ __('admin.action_edit') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
