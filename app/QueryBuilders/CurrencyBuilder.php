<?php

namespace App\QueryBuilders;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;

class CurrencyBuilder extends Builder
{

    /**
     * @param string $date
     * @return Builder
     */
    public function withRemainderDay(string $date): Builder
    {
        return Currency::query()->orderBy('created_at')->with([
            'remainderDay' => function ($builder) use ($date) {
                $builder->where('date', $date);
            }
        ]);
    }
}
