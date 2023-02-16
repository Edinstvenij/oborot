
<div class="container">
    <div class="card mt-3 mx-auto" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $currency->name }} <br> ({{ $currency->cipher .'-'. $currency->code }})</h5>
            <p class="card-text">Остаток: {{ $currency->remainder }}</p>

            {{ $slot }}

        </div>
    </div>
</div>
