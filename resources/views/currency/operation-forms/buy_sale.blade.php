@component('currency.components.form-operations', ['currency' => $currency, 'title' => $title])
    @if($errors->any())
        <div class="alert alert-danger mt-5" role="alert">
            {{ $errors->first()}}
        </div>
    @endif
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <!-- Content -->
                <div class="card p-3">
                    <form id="form" action="{{ route('currency.operations.save', [$currency, $method]) }}"
                          method="POST">
                        @csrf
                        <input type="hidden" name="currency_cipher_donor" value="{{ $currencyUah->cipher }}">
                        @if($method === 'buy')

                            <div class="row mb-1">
                                <div class="col">
                                    <label for="result">Сумма:</label>
                                    <select class="form-control" disabled>
                                        <option value="{{ $currency->cipher }}"
                                                selected>{{$currency->cipher .' — '. $currency->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input id="result" name="result" type="number" class="form-control" min="0"
                                           step="any"
                                           tabindex="0"
                                           autofocus
                                           required/>
                                </div>
                            </div>
                        @else
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="result">Cумма:</label>
                                    <select id="select" class="form-control" disabled>
                                        <option value="{{ $currency->cipher }}"
                                                selected>{{$currency->cipher .' — '. $currency->name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input id="result" name="result" type="number" class="form-control" min="0"
                                           step="any"
                                           tabindex="0"
                                           autofocus
                                           required/>
                                </div>
                            </div>
                        @endif
                        <div class="row mb-1">
                            <div class="col">
                                <label for="course">Курс:</label>
                                <input class="form-control" type="number" name="course" id="course" min="0" step="any"
                                       tabindex="0"
                                       value="{{ $currency->course ?? $currencyUah->course ?? '' }}"
                                       required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary mt-3"
                                tabindex="0"
                                data-bs-toggle="modal"
                                data-bs-whatever="Подтвердите операцию"
                                data-bs-target="#confirmation">
                            Далее
                        </button>
                    </form>
                </div>
                <!-- // Content -->
            </div>
            <!-- // col-6 -->
        </div>
        <!-- // row -->
    </div>



    @section('modal')
        <div class="modal" id="confirmation" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="font-size:3rem;">...</p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit"
                               id="submit"
                               class="btn btn-outline-success"
                               data-bs-dismiss="modal"
                               tabindex="0"
                               autofocus
                               value="Далее">


                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Отмена
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcomponent

@component('currency.components.operations', compact('currency', 'method', 'operations'))
@endcomponent


