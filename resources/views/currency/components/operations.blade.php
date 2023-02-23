@if(count($operations))
    <div class="container">
        <h2 class="h2 text-white">История операций</h2>
        <table id="currencies" class="table table-dark table-hover ">
            <thead>
            <tr>
                @php($operation = $operations->first())
                @if($operation->currency_cipher)
                    <th scope="col">Шифр</th>
                @endif
                @if($operation->sum)
                    <th scope="col">Сумма</th>
                @endif
                @if($operation->course)
                    <th scope="col">Курс операции</th>
                @endif
                @if($operation->sum_donor)
                    <th scope="col">Гривна</th>
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
            @foreach($operations as $operation)
                <tr class="row-link">
                    @if($operation->currency_cipher)
                        <td>{{ $operation->currency_cipher}}</td>
                    @endif
                    @if($operation->sum !== null)
                        <td>{{ $operation->sum}}</td>
                    @endif
                    @if($operation->course !== null)
                        <td>{{ $operation->course}}</td>
                    @endif
                    @if($operation->sum_donor !== null)
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
