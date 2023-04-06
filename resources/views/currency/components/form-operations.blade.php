@extends('layouts.layoutCurrency')

@section('title', $currency->name)

@section('content')
    <a href="{{ back()->getTargetUrl() === request()->fullUrl() ? route('currency.index') : back()->getTargetUrl()}}"
       class="btn btn-secondary mt-3">Назад</a>

    <h1 class="display-1 mt-5 text-white">{{ $title }}</h1>
    @if(!request()->query->has('date'))
        @component('currency.components.card', compact('currency'))
        @endcomponent
        {{-- $slot === form --}}
        {{ $slot }}

    @endif
@endsection
