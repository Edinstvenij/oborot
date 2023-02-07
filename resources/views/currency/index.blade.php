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
                        <a href="#"
                           class="list-group-item list-group-item-action list-group-item-dark ">Покупка</a>
                        <a href="#"
                           class="list-group-item list-group-item-action list-group-item-dark ">Продажа</a>
                        <a href="#"
                           class="list-group-item list-group-item-action list-group-item-dark ">Подкрепление</a>
                        <a href="#" class="list-group-item list-group-item-action list-group-item-dark ">Инкассация</a>
                        <a href="#"
                           class="list-group-item list-group-item-action list-group-item-dark ">Приходы</a>
                        <a href="#"
                           class="list-group-item list-group-item-action list-group-item-dark ">Расходы</a>
                        <a href="#" class="list-group-item list-group-item-action list-group-item-dark ">Конверсия</a>
                        <a href="#"
                           class="list-group-item list-group-item-action list-group-item-dark ">Блокнот</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
