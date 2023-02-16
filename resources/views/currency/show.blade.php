@extends('layouts.layout')

@section('title', $currency->name)

@section('content')
    <a href="{{ route('currency.index') }}" class="btn btn-secondary mt-3">Назад</a>

    @component('currency.components.card', compact('currency'))
        <a href="{{ route('currency.edit', $currency) }}" class="btn btn-warning mb-2">Редактировать</a>
        <form action="{{ route('currency.destroy',$currency) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">Удалить валюту</button>
        </form>
    @endcomponent

@endsection
