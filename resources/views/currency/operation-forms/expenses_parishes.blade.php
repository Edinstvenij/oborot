@component('currency.component.form-operations', compact('currency', 'title'))
    <form action="{{ route('currency.operations.save', [$currency, $method]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="number" class="form-label">Введите цифры*</label>
            <input type="number" class="form-control" id="number"
                   name="number"
                   placeholder="@if($method === 'expenses') Сколько потратили? @else Сколько получили?@endif"
                   required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий*</label>
            <input type="text" class="form-control" id="comment" name="comment"
                   placeholder="@if($method === 'expenses') На что потратили? @elseНа что получили?@endif"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

@endcomponent
