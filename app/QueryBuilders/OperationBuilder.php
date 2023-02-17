<?php

namespace App\QueryBuilders;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OperationBuilder extends Builder
{

    /**
     * @param Currency $currency
     * @param string $method
     * @param string|null $date
     * @return HasMany
     */
    public function filerDate(Currency $currency, string $method, string $date = null): HasMany
    {
        if ($date === null) {
            $date = Carbon::today();
        }
        return $currency->operations()->where('name', $method)->where('date', '>', Carbon::parse($date));
    }
}
