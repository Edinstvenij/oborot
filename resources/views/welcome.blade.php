@extends('layouts.layout')

@section('title','Оборот')

@section('content')
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">Шифр</th>
            <th scope="col">Код</th>
            <th scope="col">Название</th>
            <th scope="col">Остаток</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>980</td>
            <td>UAH</td>
            <td>Украинская гривна</td>
            <td>1900</td>
        </tr>
        </tbody>
    </table>
@endsection
