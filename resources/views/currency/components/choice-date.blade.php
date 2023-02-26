<form method="GET" class="mb-2">
    <label class="h2 me-2 text-white" for="date">История за:</label>
    <input class="input" type="date" name="date" id="date" value="{{$date}}"
           min="2023-02-06"
           max="{{ \Carbon\Carbon::yesterday()->format('Y-m-d') }}">
    <button class="btn btn-light ms-2" type="submit">Выбрать</button>
</form>