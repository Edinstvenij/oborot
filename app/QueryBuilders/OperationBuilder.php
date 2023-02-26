<?php

namespace App\QueryBuilders;

use App\Models\Currency;
use App\Models\Operation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OperationBuilder extends Builder
{

    /**
     * @param string $method
     * @param Currency|null $currency
     * @param string|null $date
     * @return Collection|HasMany
     */
    public function filerDate(string $method, Currency $currency = null, string $date = null): Collection|HasMany
    {
        if ($date === null) {
            $date = Carbon::today();
        }

        if ($currency === null) {
            return Operation::query()
                ->where('name', $method)
                ->where('date', '>', Carbon::parse($date))
                ->where('date', '<', Carbon::parse($date)->addDay())
                ->orderBy('date')
                ->get();
        }

        return $currency->operations()
            ->where('name', $method)
            ->where('date', '>', Carbon::parse($date))
            ->where('date', '<', Carbon::parse($date)->addDay())
            ->orderBy('date');
    }
}
