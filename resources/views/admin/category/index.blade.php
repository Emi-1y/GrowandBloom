{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.category.create') }}" class="btn btn-success" style="border-radius:8px;">
        + {{ __('category.create_button') }}
    </a>
</div>

@if($viewData['categories']->isEmpty())
    <div class="alert alert-info">{{ __('category.empty') }}</div>
@else
    <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background:#f2efe8;">
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('category.id') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('category.name') }}</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">{{ __('category.description') }}</th>
                        <th style="border:none;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['categories'] as $category)
                        <tr>
                            <td style="padding:1rem 1.25rem; font-family:'Courier New',monospace; font-size:.8rem; color:#7a7165; border-color:#f2efe8;">
                                {{ $category->getId() }}
                            </td>
                            <td style="padding:1rem 1.25rem; font-weight:600; font-size:.9rem; color:#1a3a2a; border-color:#f2efe8;">
                                {{ $category->getName() }}
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.85rem; color:#7a7165; border-color:#f2efe8;">
                                {{ Str::limit($category->getDescription(), 60) }}
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="display:flex; gap:.5rem;">
                                    <a href="{{ route('admin.category.edit', $category->getId()) }}"
                                       class="btn btn-outline-success btn-sm" style="border-radius:8px; font-size:.75rem;">
                                        {{ __('category.edit_button') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.category.destroy', $category->getId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm"
                                                style="border-radius:8px; font-size:.75rem; background:transparent; border:1px solid rgba(155,44,44,.3); color:#9b2c2c;"
                                                onclick="return confirm('{{ __('category.confirm_delete') }}')">
                                            {{ __('category.delete_button') }}
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
