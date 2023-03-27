<?php

namespace Tests\Feature;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponsePageTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_indexPage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_currencyPage(): void
    {
        $response = $this->get('/currency');

        $response->assertStatus(200);
    }

    public function test_currencyHistoryPage(): void
    {
        $date = Carbon::yesterday()->format('Y-m-d');
        $response = $this->get("/currency?date=$date");

        $response->assertStatus(200);
    }

    public function test_currenciesBuyPages(): void
    {
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $response = $this->get("/currency/$currency->cipher/buy");
            $response->assertStatus(200);
        }
        $response = $this->get("/currency/all/buy");
        $response->assertStatus(200);
    }


    public function test_currenciesSalePages(): void
    {
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $response = $this->get("/currency/$currency->cipher/sale");
            $response->assertStatus(200);
        }
        $response = $this->get("/currency/all/sale");
        $response->assertStatus(200);
    }

    public function test_currenciesParishesPages(): void
    {
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $response = $this->get("/currency/$currency->cipher/parishes");
            $response->assertStatus(200);
        }
        $response = $this->get("/currency/all/parishes");
        $response->assertStatus(200);
    }

    public function test_currenciesExpensesPages(): void
    {
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $response = $this->get("/currency/$currency->cipher/expenses");
            $response->assertStatus(200);
        }

        $response = $this->get("/currency/all/expenses");
        $response->assertStatus(200);
    }

    public function test_currenciesShows()
    {
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $response = $this->get("/currency/$currency->cipher");
            $response->assertStatus(200);

            $response = $this->get("/currency/$currency->cipher/edit");
            $response->assertStatus(200);

            $response = $this->delete("/currency/$currency->cipher");
            $response->assertStatus(302);
        }
    }

}
