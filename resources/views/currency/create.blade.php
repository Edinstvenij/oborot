@extends('layouts.layout')

@section('title','Создание валюты ')

@section('content')
    <a href="{{ route('currency.index') }}" class="btn btn-secondary mt-3">Назад</a>

    <form class="mt-5" action="{{ route('currency.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Название валюты</label>
            <input type="text" class="form-control" id="name" name="name" maxlength="255"
                   value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif

        </div>
        <div class="mb-3">
            <label for="cipher" class="form-label">Шифр валюты</label>
            <input type="text" class="form-control" id="cipher" name="cipher" maxlength="3"
                   value="{{ old('cipher') }}">
            @if ($errors->has('cipher'))
                <span class="text-danger">{{ $errors->first('cipher') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Код валюты</label>
            <input type="number" class="form-control" id="code" name="code" max="999"
                   value="{{ old('code') }}">
            @if ($errors->has('code'))
                <span class="text-danger">{{ $errors->first('code') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection
