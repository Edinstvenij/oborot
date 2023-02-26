@component('currency.components.form-operations', compact('currency', 'title'))
    <form action="{{ route('currency.operations.save', [$currency, $method]) }}" method="POST" class="p-3 mt-3 bg-dark">
        @csrf
        <div class="mb-3">
            <label for="number" class="form-label text-white">Введите цифры*</label>
            <input type="number" class="form-control" id="number"
                   name="result"
                   placeholder="@if($method === 'expenses') Сколько потратили? @else Сколько получили?@endif"
                   required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label text-white">Комментарий*</label>
            <input type="text" class="form-control" id="comment" name="comment"
                   placeholder="@if($method === 'expenses') На что потратили? @elseНа что получили?@endif"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endcomponent
@component('currency.components.operations', compact('currency', 'method', 'operations'))
@endcomponent
