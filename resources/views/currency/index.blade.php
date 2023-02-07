@extends('layouts.layout')

@section('title','Оборот')

@section('content')
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
                data-id="{{ $currency->id }}">
                <td>{{ $currency->code }}</td>
                <td>{{ $currency->cipher }}</td>
                <td>{{ $currency->name }}</td>
                <td>{{ $currency->remainder }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <a href="{{ route('currency.create') }}" class="position-fixed bottom-0 end-0  translate-middle btn btn-sm btn-primary rounded-pill"
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
                        <a href="{{ route('currency.buy', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Покупка</a>
                        <a href="{{ route('currency.sale', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Продажа</a>
                        <a href="{{ route('currency.reinforcement', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Подкрепление</a>
                        <a href="{{ route('currency.shipment', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Инкассация</a>
                        <a href="{{ route('currency.parishes', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Приходы</a>
                        <a href="{{ route('currency.expenses', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Расходы</a>
                        <a href="{{ route('currency.remains', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Конверсия</a>
                        <a href="{{ route('currency.notebook', 'replacement') }}"
                           class="list-group-item list-group-item-action list-group-item-dark ">Блокнот</a>
                    </div>
                    <hr>
                    <a href="{{ route('currency.show','replacement') }}" class="btn btn-info">Редактировать</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
