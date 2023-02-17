<?php

namespace Database\Seeders;

use App\Models\RemainderDay;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RemainderDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies_ciphers = [
            'USD',
            'EUR',
            'GBP',
            'AUD',
            'PLN',
            'CZK',
            'HUF',
            'CAD',
            'DKK',
            'TRY',
            'CHF',
            'SEK',
            'ILS',
            'RON',
            'MDL',
            'NOK',
            'CNY',
            'AED',
            'JPY',
            'GEL',
            'AZN',
            'KZT',
            'UAH'
        ];

        $date = Carbon::yesterday();

        for ($index = 1, $currency_i = 0; $index <= 230; $index++, $currency_i++) {
            if ($currency_i === 23) {
                $date = $date->subDay();
                $currency_i = 0;
            }


            RemainderDay::factory(1)->make()->each(function ($item) use ($currencies_ciphers, $currency_i, $date) {
                $item->cipher = $currencies_ciphers[$currency_i];
                $item->date = $date;
                $item->save();
            });
        }
    }
}
