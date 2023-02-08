<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = [
            [
                'code' => '840',
                'cipher' => 'USD',
                'name' => 'Доллар США',
                'remainder' => 0
            ],
            [
                'code' => '978',
                'cipher' => 'EUR',
                'name' => 'Евро',
                'remainder' => 0
            ],
            [
                'code' => '826',
                'cipher' => 'GBP',
                'name' => 'Английский фунт',
                'remainder' => 0
            ],
            [
                'code' => '036',
                'cipher' => 'AUD',
                'name' => 'Австралийский доллар',
                'remainder' => 0
            ],
            [
                'code' => '985',
                'cipher' => 'PLN',
                'name' => 'Польский злотый',
                'remainder' => 0
            ],
            [
                'code' => '203',
                'cipher' => 'CZK',
                'name' => 'Чешская крона',
                'remainder' => 0
            ],
            [
                'code' => '348',
                'cipher' => 'HUF',
                'name' => 'Венгерский форинт',
                'remainder' => 0
            ],
            [
                'code' => '124',
                'cipher' => 'CAD',
                'name' => 'Канадский доллар',
                'remainder' => 0
            ],
            [
                'code' => '208',
                'cipher' => 'DKK',
                'name' => 'Датская крона',
                'remainder' => 0
            ],
            [
                'code' => '949',
                'cipher' => 'TRY',
                'name' => 'Турецкая лира',
                'remainder' => 0
            ],
            [
                'code' => '756',
                'cipher' => 'CHF',
                'name' => 'Швейцарский франк',
                'remainder' => 0
            ],
            [
                'code' => '752',
                'cipher' => 'SEK',
                'name' => 'Шведская крона',
                'remainder' => 0
            ],
            [
                'code' => '376',
                'cipher' => 'ILS',
                'name' => 'Израильский шекель',
                'remainder' => 0
            ],
            [
                'code' => '946',
                'cipher' => 'RON',
                'name' => 'Румынский лей',
                'remainder' => 0
            ],
            [
                'code' => '498',
                'cipher' => 'MDL',
                'name' => 'Молдовский лей',
                'remainder' => 0
            ],
            [
                'code' => '578',
                'cipher' => 'NOK',
                'name' => 'Норвежская крона',
                'remainder' => 0
            ],
            [
                'code' => '156',
                'cipher' => 'CNY',
                'name' => 'Китайский юань',
                'remainder' => 0
            ],
            [
                'code' => '784',
                'cipher' => 'AED',
                'name' => 'Дирхам ОАЭ',
                'remainder' => 0
            ],
            [
                'code' => '392',
                'cipher' => 'JPY',
                'name' => 'Японская йена',
                'remainder' => 0
            ],
            [
                'code' => '981',
                'cipher' => 'GEL',
                'name' => 'Грузинский лари',
                'remainder' => 0
            ],
            [
                'code' => '944',
                'cipher' => 'AZN',
                'name' => 'Азербайджанский манат',
                'remainder' => 0
            ],
            [
                'code' => '398',
                'cipher' => 'KZT',
                'name' => 'Казахстанский тенге',
                'remainder' => 0
            ],
            [
                'code' => '980',
                'cipher' => 'UAH',
                'name' => 'Украинская гривна',
                'remainder' => 0
            ],
        ];

        foreach ($currency as $value) {
            Currency::factory()->make([
                'code' => $value['code'],
                'cipher' => $value['cipher'],
                'name' => $value['name'],
                'remainder' => $value['remainder'],
            ])->save();
            sleep(1);
        }
    }
}
