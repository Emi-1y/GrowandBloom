{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.plant.create') }}" class="btn btn-success" style="border-radius:8px;">
        {{ __('plant.create_btn') }}
    </a>
</div>

@if($viewData['plants']->isEmpty())
    <div class="alert alert-info">{{ __('plant.empty') }}</div>
@else
    <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background:#f2efe8;">
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('plant.col_id') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('plant.col_name') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('plant.col_category') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('plant.col_price') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('plant.col_stock') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('plant.col_active') }}</th>
                        <th style="border:none;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['plants'] as $plant)
                        <tr>
                            <td style="padding:1rem 1.25rem; font-family:'Courier New',monospace; font-size:.8rem; color:#7a7165; border-color:#f2efe8;">
                                {{ $plant->getId() }}
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="font-weight:600; font-size:.9rem; color:#1a3a2a;">
                                    {{ $plant->getName() }}
                                </div>
                                @if($plant->getDescription())
                                    <div style="font-size:.78rem; color:#7a7165; margin-top:2px;">
                                        {{ Str::limit($plant->getDescription(), 50) }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <span style="background:#e8f5ec; color:#2d5a3d; font-size:.68rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(45,90,61,.2);">
                                    {{ $plant->getCategory()->getName() }}
                                </span>
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.88rem; font-weight:600; color:#2d5a3d; border-color:#f2efe8;">
                                {{ $plant->getFormattedPrice() }}
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.88rem; border-color:#f2efe8;">
                                @if($plant->getStock() > 0)
                                    <span style="color:#2d5a3d; font-weight:600;">{{ $plant->getStock() }}</span>
                                @else
                                    <span style="color:#9b2c2c; font-weight:600;">0</span>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                @if($plant->getActive())
                                    <span style="background:#d4edda; color:#155724; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(21,87,36,.2);">
                                        {{ __('plant.status_active') }}
                                    </span>
                                @else
                                    <span style="background:#f8d7da; color:#721c24; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(114,28,36,.2);">
                                        {{ __('plant.status_inactive') }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="display:flex; gap:.5rem;">
                                    <a href="{{ route('admin.plant.edit', $plant->getId()) }}"
                                       class="btn btn-outline-success btn-sm" style="border-radius:8px; font-size:.75rem;">
                                        {{ __('plant.action_edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.plant.destroy', $plant->getId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm"
                                                style="border-radius:8px; font-size:.75rem; background:transparent; border:1px solid rgba(155,44,44,.3); color:#9b2c2c;"
                                                onclick="return confirm('{{ __('plant.confirm_delete') }}')">
                                            {{ __('plant.action_delete') }}
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
