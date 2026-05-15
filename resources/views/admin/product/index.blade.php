{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; padding-bottom:1.25rem; border-bottom:1px solid #e2ddd4;">
    <div style="font-family:'Cormorant Garamond',serif; font-size:1.4rem; color:#1a3a2a; font-weight:600;">
        Gestión de productos
    </div>
    <a href="{{ route('admin.product.create') }}" class="btn btn-success" style="border-radius:8px;">
        + Crear producto
    </a>
</div>

@if($viewData['products']->isEmpty())
    <div class="alert alert-info">No hay productos creados aún.</div>
@else
    <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background:#f2efe8;">
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">ID</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">Nombre</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">Categoría</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">Precio</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">Stock</th>
                        <th style="font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:#7a7165; padding:1rem 1.25rem; font-weight:600; border:none;">Activo</th>
                        <th style="border:none;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['products'] as $product)
                        <tr>
                            <td style="padding:1rem 1.25rem; font-family:'Courier New',monospace; font-size:.8rem; color:#7a7165; border-color:#f2efe8;">
                                {{ $product->getId() }}
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="font-weight:600; font-size:.9rem; color:#1a3a2a;">
                                    {{ $product->getName() }}
                                </div>
                                @if($product->getDescription())
                                    <div style="font-size:.78rem; color:#7a7165; margin-top:2px;">
                                        {{ Str::limit($product->getDescription(), 50) }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <span style="background:#e8f5ec; color:#2d5a3d; font-size:.68rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(45,90,61,.2);">
                                    {{ $product->getCategory()->getName() }}
                                </span>
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.88rem; font-weight:600; color:#2d5a3d; border-color:#f2efe8;">
                                {{ $product->getFormattedPrice() }}
                            </td>
                            <td style="padding:1rem 1.25rem; font-size:.88rem; border-color:#f2efe8;">
                                @if($product->getStock() > 0)
                                    <span style="color:#2d5a3d; font-weight:600;">{{ $product->getStock() }}</span>
                                @else
                                    <span style="color:#9b2c2c; font-weight:600;">0</span>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                @if($product->getActive())
                                    <span style="background:#d4edda; color:#155724; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(21,87,36,.2);">
                                        Activo
                                    </span>
                                @else
                                    <span style="background:#f8d7da; color:#721c24; font-size:.65rem; font-weight:600; letter-spacing:.07em; text-transform:uppercase; padding:3px 10px; border-radius:20px; border:1px solid rgba(114,28,36,.2);">
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td style="padding:1rem 1.25rem; border-color:#f2efe8;">
                                <div style="display:flex; gap:.5rem;">
                                    <a href="{{ route('admin.product.edit', $product->getId()) }}"
                                       class="btn btn-outline-success btn-sm" style="border-radius:8px; font-size:.75rem;">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.product.destroy', $product->getId()) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm"
                                                style="border-radius:8px; font-size:.75rem; background:transparent; border:1px solid rgba(155,44,44,.3); color:#9b2c2c;"
                                                onclick="return confirm('¿Eliminar este producto?')">
                                            Eliminar
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