{{-- Author: Emily Cardona Castañeda  --}}

@extends('layouts.app')
@section('title', 'Registro')

@section('content')
<div class="auth-wrap">
    <div class="auth-card" style="max-width:540px;">
        <div class="auth-logo"> Grow and Bloom</div>
        <div class="auth-subtitle">Crea tu cuenta</div>

        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                <ul style="margin:0; padding-left:1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.store') }}" novalidate>
            @csrf

            <div style="margin-bottom:1rem;">
                <label for="name" class="form-label">Nombre completo</label>
                <input id="name" name="name" type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Ana López" required />
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:1rem;">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" name="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="tu@correo.com" required />
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label for="phone" class="form-label">Teléfono</label>
                    <input id="phone" name="phone" type="tel"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}" placeholder="300 000 0000" required />
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="city" class="form-label">Ciudad</label>
                    <input id="city" name="city" type="text"
                           class="form-control @error('city') is-invalid @enderror"
                           value="{{ old('city') }}" placeholder="Medellín" required />
                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label for="address" class="form-label">Dirección</label>
                <input id="address" name="address" type="text"
                       class="form-control @error('address') is-invalid @enderror"
                       value="{{ old('address') }}" placeholder="Calle 10 #5-20" required />
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:1rem;">
                <label for="postal_code" class="form-label">Código postal</label>
                <input id="postal_code" name="postal_code" type="text"
                       class="form-control @error('postal_code') is-invalid @enderror"
                       value="{{ old('postal_code') }}" placeholder="050001" required />
                @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:1rem;">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" name="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••" required />
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       class="form-control" placeholder="••••••••" required />
            </div>

            <button type="submit" class="btn btn-success w-100" style="border-radius:10px;">
                Crear cuenta
            </button>
        </form>

        <hr class="auth-divider">
        <p class="auth-footer-text">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" style="color:var(--c-accent); font-weight:600;">Inicia sesión</a>
        </p>
    </div>
</div>
@endsection