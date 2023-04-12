<div class="scroll-table-body">
    <table class="table table-dark text-white text-center">
        @foreach($compressOperations as $compressOperation)
            <tr class="table-active">
                <td>{{ $compressOperation['code'] }}</td>
            </tr>
            @foreach($compressOperation['data'] as $operation)
                <tr>
                    <td>{{  "$operation[sum]  X  $operation[course] =  $operation[total]" }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
