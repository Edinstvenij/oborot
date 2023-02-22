<?php

namespace App\Events;

use App\Models\Currency;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * @property array $data
 * @property string $method
 * @property Currency $currency
 */
class CurrencyUpdated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;


    /**
     * Create a new event instance.
     *
     * @param Currency $currency
     * @param string $method
     * @param array $data
     */
    public function __construct(Currency $currency, string $method, array $data)
    {
        $this->currency = $currency;
        $this->method = $method;
        $this->data = $data;
    }
}
