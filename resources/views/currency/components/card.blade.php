<div class="container">
    <div class="card mt-3 mx-auto bg-dark" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title text-white text-center">
                {{ $currency->name }} <br> ({{ $currency->cipher .'-'. $currency->code }})
            </h5>
            <p class="card-text text-white text-center">Остаток: {{ $currency->remainder }}</p>

            {{ $slot }}

        </div>
    </div>
</div>
