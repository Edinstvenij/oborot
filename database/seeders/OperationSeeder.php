<?php

namespace Database\Seeders;

use App\Models\Operation;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
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
        
        Operation::factory(6000)->make()->each(function ($item) use ($currencies_ciphers) {
            $item->currency_cipher = fake()->randomElement($currencies_ciphers);
            $item->save();
        });
    }
}
