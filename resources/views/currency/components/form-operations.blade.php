@extends('layouts.layout')

@section('title', $currency->name)

@section('content')
    <a href="{{ route('currency.index') }}" class="btn btn-secondary mt-3">Назад</a>

    <h1 class="display-1 mt-5">{{ $title }}</h1>

    @component('currency.components.card', compact('currency'))
    @endcomponent
    {{-- $slot === form --}}
    {{ $slot }}

@endsection
