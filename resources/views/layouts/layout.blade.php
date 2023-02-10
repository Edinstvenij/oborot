<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if (Session::has('message'))
    @if(count(Session::get('message')) > 1)
        <div class="alert alert-{{ Session::get('message')[1] }}">{{ Session::get('message')[0] }}</div>
    @else
        <div class="alert alert-info">{{ Session::get('message')[0] }}</div>
    @endif
@endif

@yield('modal')
<div class="container">
    @yield('content')
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
