<?php

namespace App\Events;

use App\Models\Currency;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class CurrencyUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Request $request;
    public Currency $currency;
    public string $method;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     */
    public function __construct(Request $request, Currency $currency, string $method)
    {
        $this->request = $request;
        $this->currency = $currency;
        $this->method = $method;
    }
}
