{{-- Author: Emily Cardona Castañeda --}}

@extends('layouts.app')
@section('title', __('allied.title'))

@section('content')

@if($viewData['error'])
    <div class="alert alert-warning">{{ $viewData['error'] }}</div>
@else
    <pre style="background:#f8f9fa; border-radius:8px; padding:1.5rem; font-size:.82rem; overflow-x:auto;">{{ json_encode($viewData['pieces'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</pre>
@endif

@endsection
