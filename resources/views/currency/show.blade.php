@extends('layouts.layout')

@section('title', $currency->name)

@section('content')
    <a href="{{ route('currency.index') }}" class="btn btn-secondary mt-3">Назад</a>
    <div class="container">
        <div class="card mt-3 mx-auto" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $currency->name }} <br> ({{ $currency->cipher .'-'. $currency->code }})</h5>
                <p class="card-text">Остаток: {{ $currency->remainder }}</p>
                <a href="{{ route('currency.edit', $currency->id) }}" class="btn btn-warning mb-2">Редактировать</a>
                <form action="{{ route('currency.destroy',$currency->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Удалить валюту</button>
                </form>
            </div>
        </div>
    </div>
@endsection
