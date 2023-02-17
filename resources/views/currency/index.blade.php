@extends('layouts.layout')

@section('title','Оборот')

@section('content')
    @if(!empty($date))
        <form action="{{ route('currency.index') }}" method="GET" class="mb-2">
            <label class="h2 me-2" for="date">История за:</label>
            <input class="input" type="date" name="date" id="date" value="{{$date}}"
                   min="2023-02-06"
                   max="{{ \Carbon\Carbon::yesterday()->format('Y-m-d') }}">
            <button class="btn btn-light ms-2" type="submit">Выбрать</button>
        </form>
    @endif
    <table id="currencies" class="table table-dark table-hover ">
        <thead>
        <tr>
            <th scope="col">Код</th>
            <th scope="col">Шифр</th>
            <th scope="col">Название</th>
            <th scope="col">Остаток</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currencies as $currency)
            <tr class="row-link"
                data-bs-toggle="modal"
                data-bs-target="#operationsModal"
                data-bs-whatever="{{ $currency->name }}"
                data-id="{{ $currency->cipher }}">
                <td>{{ $currency->code }}</td>
                <td>{{ $currency->cipher }}</td>
                <td>{{ $currency->name }}</td>
                @if(!empty($date))
                    <td>{{ $currency->remainderDay->first()->remainder ?? 0 }}</td>
                @else
                    <td>{{ $currency->remainder }}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(!empty($date))
        <a href="{{ route('currency.index') }}"
           class="position-fixed bottom-0 start-0  translate-middle btn btn-sm btn-primary rounded-pill"
           style="margin-left: 50px">Назад</a>
    @else
        <a href="{{ route('currency.index') }}?date={{ date("Y-m-d", time()-(60*60*24)) }}"
           class="position-fixed bottom-0 start-0  translate-middle btn btn-sm btn-primary rounded-pill"
           style="margin-left: 50px">История</a>
    @endif

    <a href="{{ route('currency.create') }}"
       class="position-fixed bottom-0 end-0  translate-middle btn btn-sm btn-primary rounded-pill"
       style="width: 2rem; height:2rem;">+</a>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="operationsModal" tabindex="-1" aria-labelledby="operationsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="operationsModalLabel">Операции с </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        <a href="{{ route('currency.operations', ['replacement', 'buy']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark">Покупка</a>
                        <a href="{{ route('currency.operations', ['replacement', 'sale']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark">Продажа</a>
                        <a href="{{ route('currency.operations', ['replacement', 'reinforcement']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark disabled">Подкрепление</a>
                        <a href="{{ route('currency.operations', ['replacement', 'shipment']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark disabled">Инкассация</a>
                        <a href="{{ route('currency.operations', ['replacement', 'parishes']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark">Приходы</a>
                        <a href="{{ route('currency.operations', ['replacement', 'expenses']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark">Расходы</a>
                        <a href="{{ route('currency.operations', ['replacement', 'remains']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark disabled">Конверсия</a>
                        <a href="{{ route('currency.operations', ['replacement', 'notebook']) }}@if(!empty($date))?date={{ $date }} @endif"
                           class="list-group-item list-group-item-action list-group-item-dark disabled">Блокнот</a>
                    </div>
                    <hr>
                    <a href="{{ route('currency.show','replacement') }}" class="btn btn-info">Редактировать</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endsection
