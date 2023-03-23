@extends('layouts.layout')

@section('title','История операций за день')

@section('content')
    @component('currency.components.choice-date', compact('date'))
    @endcomponent
    @component('currency.components.operations', compact('operations', 'compressOperations'))
    @endcomponent
@endsection
