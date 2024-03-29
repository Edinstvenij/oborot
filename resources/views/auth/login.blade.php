@extends('layouts.layout')

@section('title','Авторизация')

@section('content')

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="{{ route('authenticate') }}" method="POST">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img width="40" height="32" role="img" aria-label="Bootstrap" src="/img/logo.png"
                                         alt="">
                                    <h2 class="fw-bold mb-2 text-uppercase">Авторизация</h2>
                                    <p class="text-white-50 mb-5">Введите ваш логин и пароль</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                               name="email"/>
                                        <label class="form-label" for="typeEmailX">Логин</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                               name="password"/>
                                        <label class="form-label" for="typePasswordX">Пароль</label>
                                    </div>

                                    @if($errors->any())
                                        <div>
                                            @foreach($errors->all() as $error)
                                                <p class="text-danger mb-5">{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Войти</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection