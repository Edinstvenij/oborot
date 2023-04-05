<?php

namespace Tests\Feature;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsePageTest extends TestCase
{
    use RefreshDatabase;

    /** @var bool */
    protected bool $seed = true;

    /**
     * @dataProvider dataProviderForPages
     * @param string $page
     * @param int $code
     * @return void
     */
    public function testStatusPage(string $page, int $code): void
    {
        $this->get($page)->assertStatus($code);
    }

    /**
     * @return array<int, array<string, string|int>>
     */
    public function dataProviderForPages(): array
    {
        return [
            [
                'page' => '/',
                'code' => 302,
            ],
            [
                'page' => '/currency',
                'code' => 200,
            ],
        ];
    }

    /**
     * @return void
     */
    public function testCurrencyHistoryPage(): void
    {
        $date = Carbon::yesterday()->format('Y-m-d');
        $this->get("/currency?date=$date")
            ->assertStatus(200);
    }

    /**
     * @dataProvider dataProviderForCurrencies
     * @param string $page
     * @return void
     */
    public function testCurrenciesPage(string $page): void
    {
        foreach (Currency::all() as $currency) {
            $this->get("/currency/$currency->cipher/$page")
                ->assertStatus(200);
        }
        if ($page != 'edit') {
            $this->get("/currency/all/$page")
                ->assertStatus(200);
        }
    }

    /**
     * @return array<int, array<string, string|int>>
     */
    public function dataProviderForCurrencies(): array
    {
        return [
            [
                'buy',
            ],
            [
                'sale',
            ],
            [
                'parishes',
            ],
            [
                'expenses',
            ],
            [
                'edit',
            ],
        ];
    }
}
