<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/img/logo.ico">
    <title>@yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
@yield('modal')
<header>
    <div class="px-3 py-2 bg-dark text-white">
        <div class="container">
            <div id="header-nav"
                 class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/"
                   class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none nav-x">
                    <img width="40" height="32" role="img" aria-label="Bootstrap" src="/img/logo.png" alt="">
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="{{ route('currency.index') }}@if(empty($date))?date={{ date("Y-m-d", time()-(60*60*24)) }}@endif"
                           class="nav-link text-white nav-x">
                            <img class="bi d-block mx-auto mb-1" width="24" height="24" src="/img/header/calendar.svg"
                                 alt="calendar">
                            История
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle nav-x" type="button"
                                    tabindex="0"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false" style="color: #ffffff">
                                <img class="bi d-block mx-auto mb-1" width="24" height="24"
                                     src="/img/header/calculator.svg"
                                     alt="calendar">
                                Операции
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'buy']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item">Покупка</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'sale']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item">Продажа</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'reinforcement']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item disabled">Подкрепление</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'shipment']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item disabled">Инкассация</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'parishes']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item">Приходы</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'expenses']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item">Расходы</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'remains']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item disabled">Конверсия</a>
                                </li>
                                <li>
                                    <a href="{{ route('currency.operations', ['all', 'notebook']) }}@if(!empty($date))?date={{ $date }} @endif"
                                       class="dropdown-item disabled">Блокнот</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="{{ route('currency.create') }}"
                                       class="dropdown-item">Добавить валюту</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
@if (Session::has('message'))
    @if(count(Session::get('message')) > 1)
        <div class="alert mt-2 alert-{{ Session::get('message')[1] }}">{{ Session::get('message')[0] }}</div>
    @else
        <div class="alert mt-2 alert-info">{{ Session::get('message')[0] }}</div>
    @endif
@endif

<div class="container">
    @yield('content')
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
