<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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
    public function testStatusPage(string $page, int $code, bool $isAuth): void
    {
        if ($isAuth) {
            $this->get($page)->assertStatus(302);
            $this->actingAs(User::find(1))->get($page)->assertStatus($code);
        } else {
            $this->get($page)->assertStatus($code);
        }
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
                'isAuth' => true,
            ],
            [
                'page' => '/currency',
                'code' => 200,
                'isAuth' => true,
            ],
            [
                'page' => '/login',
                'code' => 200,
                'isAuth' => false,
            ],
            [
                'page' => '/logout',
                'code' => 302,
                'isAuth' => true,
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
            ->assertStatus(302);

        $this->actingAs(User::find(1))->get("/currency?date=$date")
            ->assertStatus(200);
    }

    /**
     * @dataProvider dataProviderForCurrencies
     * @param string $page
     * @return void
     */
    public function testCurrenciesPageAuth(string $page): void
    {
        foreach (Currency::all() as $currency) {
            $this->actingAs(User::find(1))->get("/currency/$currency->cipher/$page")
                ->assertStatus(200);
        }
        if ($page != 'edit') {
            $this->actingAs(User::find(1))->get("/currency/all/$page")
                ->assertStatus(200);
        }
    }

    /**
     * @dataProvider dataProviderForCurrencies
     * @param string $page
     * @return void
     */
    public function testCurrenciesPageNoAuth(string $page): void
    {
        foreach (Currency::all() as $currency) {
            $this->get("/currency/$currency->cipher/$page")
                ->assertStatus(302);
        }
        if ($page != 'edit') {
            $this->get("/currency/all/$page")
                ->assertStatus(302);
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

    public function testLogin()
    {
        $email = 'test@gmail.com';
        $password = 'test123';

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        echo csrf_field();
        $this->post('/login', [
            'email' => $email,
            'password' => $password,
            '_token' => csrf_token()
        ])->assertStatus(
            302
        );
        $this->assertAuthenticated();
    }

    public function testLogout()
    {
        $this->actingAs(User::find(1));
        $this->get('/logout')->assertStatus(302);
        $this->assertGuest();
    }
}
