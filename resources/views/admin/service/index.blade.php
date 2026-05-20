{{-- Author:Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.service.create') }}" class="btn btn-success" style="border-radius:8px;">
        {{ __('service.create_btn') }}
    </a>
</div>

@if($viewData['services']->isEmpty())
    <div class="alert alert-info">{{ __('service.empty_admin') }}</div>
@else
    <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background:#f2efe8;">
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('service.col_id') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('service.col_name') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('service.col_employee') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('service.col_price') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('service.col_duration') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('service.col_active') }}</th>
                        <th style="border:none;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['services'] as $service)
                        <tr>
                            <td style="padding:1rem 1.25rem; font-family:'Courier New',monospace; font-size:.8rem; color:#7a7165; border-color:#f2efe8;">
                                {{ $service->getId() }}
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="font-weight:600; font-size:.9rem; color:#1a3a2a;">
                                    {{ $service->getName() }}
                                </div>
                                @if($service->getDescription())
                                    <div style="font-size:.78rem; color:#7a7165; margin-top:2px;">
                                        {{ Str::limit($service->getDescription(), 50) }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.85rem; color:#7a7165; border-color:#f2efe8;">
                                {{ $service->getEmployee() ?? '—' }}
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.88rem; font-weight:600; color:#2d5a3d; border-color:#f2efe8;">
                                {{ $service->getFormattedPrice() }}
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.85rem; color:#7a7165; border-color:#f2efe8;">
                                {{ $service->getDuration() ?? '—' }}
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                @if($service->getActive())
                                    <span style="background:#d4edda; color:#155724; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(21,87,36,.2);">
                                        {{ __('service.status_active') }}
                                    </span>
                                @else
                                    <span style="background:#f8d7da; color:#721c24; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(114,28,36,.2);">
                                        {{ __('service.status_inactive') }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="display:flex; gap:.5rem;">
                                    <a href="{{ route('admin.service.edit', $service->getId()) }}"
                                       class="btn btn-outline-success btn-sm" style="border-radius:8px; font-size:.75rem;">
                                        {{ __('service.action_edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.service.destroy', $service->getId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm"
                                                style="border-radius:8px; font-size:.75rem; background:transparent; border:1px solid rgba(155,44,44,.3); color:#9b2c2c;"
                                                onclick="return confirm('{{ __('service.confirm_delete') }}')">
                                            {{ __('service.action_delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
