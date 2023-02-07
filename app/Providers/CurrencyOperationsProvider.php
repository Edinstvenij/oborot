<?php

namespace App\Providers;

use App\Services\CurrencyOperationsServices;
use Illuminate\Support\ServiceProvider;

class CurrencyOperationsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyOperationsServices::class, function () {
            return new CurrencyOperationsServices();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
