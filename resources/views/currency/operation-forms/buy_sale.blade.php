@component('currency.component.form-operations', ['currency' => $currency, 'title' => $title])
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <!-- Content -->
                <div class="card p-3">
                    <form action="{{ route('currency.operations.save', [$currency, $method.'Save']) }}" method="POST">
                        @csrf
                        <h1 class="h2 mb-4">Конвертер валют</h1>

                        {{--                        <div class="courses">--}}
                        {{--                            <div class="course-item card card-body">--}}
                        {{--                                <div class="course-item-title">Курс USD</div>--}}
                        {{--                                <div class="course-item-value" data-value="USD">--.--</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="course-item card card-body">--}}
                        {{--                                <div class="course-item-title">Курс EUR</div>--}}
                        {{--                                <div class="course-item-value" data-value="EUR">--.--</div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="course-item card card-body">--}}
                        {{--                                <div class="course-item-title">Курс GPB</div>--}}
                        {{--                                <div class="course-item-value" data-value="GBP">--.--</div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="row mb-1">
                            <div class="col">
                                <label for="course">Курс:</label>
                                <input class="form-control" type="number" name="course" id="course" min="0" step="any"
                                       value="{{ $currency->course ?? $currencyUah->course ?? '' }}" required>
                            </div>
                        </div>


                        @if($method === 'buy')
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="name">Отдаю:</label>
                                    <select disabled class="form-control" id="exampleFormControlSelect1">
                                        <option value="{{ $currencyUah->cipher }}"
                                                selected>{{ $currencyUah->cipher .' — '. $currencyUah->name }}</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="name">Получаю:</label>
                                    <select id="select" class="form-control" id="exampleFormControlSelect1" disabled>
                                        <option value="{{ $currency->cipher }}"
                                                selected>{{$currency->cipher .' — '. $currency->name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <input id="input" name="input" type="number" class="form-control" min="0" step="any"
                                           required/>
                                </div>
                                <div class="col">
                                    <input id="result" name="result" type="number" class="form-control" min="0"
                                           step="any"
                                           autofocus
                                           required/>
                                </div>
                            </div>
                        @else
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="name">Отдаю:</label>
                                    <select id="select" class="form-control" id="exampleFormControlSelect1" disabled>
                                        <option value="{{ $currency->cipher }}"
                                                selected>{{$currency->cipher .' — '. $currency->name}}</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="name">Получаю:</label>
                                    <select disabled class="form-control" id="exampleFormControlSelect1">
                                        <option value="{{ $currencyUah->cipher }}"
                                                selected>{{ $currencyUah->cipher .' — '. $currencyUah->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <input id="result" name="result" type="number" class="form-control" min="0"
                                           step="any"
                                           autofocus
                                           required/>
                                </div>
                                <div class="col">
                                    <input id="input" name="input" type="number" class="form-control" min="0" step="any"
                                           required/>
                                </div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
                <!-- // Content -->
            </div>
            <!-- // col-6 -->
        </div>
        <!-- // row -->
    </div>

@endcomponent
