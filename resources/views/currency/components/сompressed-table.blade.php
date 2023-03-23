<div class="scroll-table-body">
    <table class="table table-dark text-white text-center">
        @foreach($compressOperations as $compressOperation)

            <tr>
                <td>{{ $compressOperation['code'] }}</td>
            </tr>
            @foreach($compressOperation['data'] as $operation)
                <tr>
                    <td>{{  "$operation[sum]  X  $operation[curses] =  $operation[total]" }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
