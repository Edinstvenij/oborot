@extends('layouts.layout')

@section('title','Редактирование '. $currency->cipher)

@section('content')
    <a href="{{ route('currency.index') }}" class="btn btn-secondary mt-3">Назад</a>

    <div class="container">
        <div class="card mt-3 mx-auto" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Название: {{ $currency->name }}</h5>
                <h5>Шифр: {{ $currency->cipher }}</h5>
                <h5>Код: {{ $currency->code }}</h5>
            </div>
        </div>

        <form class="mt-5" action="{{ route('currency.update', $currency->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="mb-3">
                <label for="name" class="form-label">Название валюты</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="255" required
                       value="{{ old('name')??$currency->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif

            </div>
            <div class="mb-3">
                <label for="cipher" class="form-label">Шифр валюты</label>
                <input type="text" class="form-control" id="cipher" name="cipher" maxlength="3" required
                       value="{{ old('cipher')??$currency->cipher }}">
                @if ($errors->has('cipher'))
                    <span class="text-danger">{{ $errors->first('cipher') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Код валюты</label>
                <input type="number" class="form-control" id="code" name="code" max="999" required
                       value="{{ old('code')??$currency->code }}">
                @if ($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>
@endsection
