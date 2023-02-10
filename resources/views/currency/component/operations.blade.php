@if($currency->operations()->where('name', $method)->first())
    <div class="container">
        <h2 class="h2">История транзакций</h2>
        <table id="currencies" class="table table-dark table-hover ">
            <thead>
            <tr>
                @php($operation = $currency->operations()->where('name', $method)->first())
                @if($operation->name)
                    <th scope="col">Название</th>
                @endif
                @if($operation->currency_cipher)
                    <th scope="col">Шифр</th>
                @endif
                @if($operation->currency_cipher_donor)
                    <th scope="col">Шифр второй валюты</th>
                @endif
                @if($operation->course)
                    <th scope="col">Курс операции</th>
                @endif
                @if($operation->sum)
                    <th scope="col">Сумма</th>
                @endif
                @if($operation->sum_donor)
                    <th scope="col">Сумма второй валюты</th>
                @endif
                @if($operation->comment)
                    <th scope="col">Комментарий</th>
                @endif
                @if($operation->date)
                    <th scope="col">Дата</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($currency->operations()->where('name', $method)->get() as $operation)
                <tr class="row-link">
                    @if($operation->name)
                        <td>{{ $operation->name}}</td>
                    @endif
                    @if($operation->currency_cipher)
                        <td>{{ $operation->currency_cipher}}</td>
                    @endif
                    @if($operation->currency_cipher_donor)
                        <td>{{ $operation->currency_cipher_donor}}</td>
                    @endif
                    @if($operation->course)
                        <td>{{ $operation->course}}</td>
                    @endif
                    @if($operation->sum)
                        <td>{{ $operation->sum}}</td>
                    @endif
                    @if($operation->sum_donor)
                        <td>{{ $operation->sum_donor}}</td>
                    @endif
                    @if($operation->comment)
                        <td>{{ $operation->comment}}</td>
                    @endif
                    @if($operation->date)
                        <td>{{ $operation->date}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
