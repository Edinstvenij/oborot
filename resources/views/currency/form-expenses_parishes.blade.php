@extends('layouts.layout')

@section('title', $currency->name)

@section('content')
    <a href="{{ route('currency.index') }}" class="btn btn-secondary mt-3">Назад</a>

    @if($method === '-')
        <h1 class="display-1 mt-5">Расходы</h1>
    @else
        <h1 class="display-1 mt-5">Приходы</h1>
    @endif

    @component('currency.component.card', compact('currency'))
    @endcomponent



    <form action="{{ route('currency.expensesAndParishes.save',$currency) }}" method="POST">
        @csrf
        <input type="hidden" name="method" value="{{ $method }}">
        <div class="mb-3">
            <label for="number" class="form-label">Введите цифры*</label>
            <input type="number" class="form-control" id="number"
                   name="number"
                   placeholder="@if($method === '-') Сколько потратили? @else Сколько получили?@endif"
                   required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий*</label>
            <input type="text" class="form-control" id="comment" name="comment"
                   placeholder="@if($method === '-') На что потратили? @elseНа что получили?@endif"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endsection
