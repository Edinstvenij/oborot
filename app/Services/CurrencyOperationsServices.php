<?php

namespace App\Services;

use App\Events\CurrencyUpdated;
use App\Models\Currency;
use App\Models\Operation;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyOperationsServices
{
    /**
     * Все валюты
     *
     * @param string|null $date
     * @return Collection
     */
    public function index(string $date = null): Collection
    {
        if ($date) {
            return Currency::withRemainderDay($date)->get();
        }
        return Currency::query()->orderBy('created_at')->get();
    }


    /**
     * Покупка
     *
     * @param Currency $currency
     * @param string $method
     * @param string|null $date
     * @return array
     */
    public function buy(Currency $currency, string $method, string $date = null): array
    {
        $data = [];
        $data['currency'] = $currency;
        $data['method'] = $method;
        $data['date'] = $date;

        $data['view'] = 'buy_sale';
        $data['title'] = 'Покупка';
        $data['currencyUah'] = Currency::query()->where('cipher', 'UAH')->first();
        $data['operations'] = Operation::filerDate($method, $currency, $date)->get();
        return $data;
    }


    /**
     * Сохранение покупки
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     * @throws Exception
     */
    public function buySave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        $request->validate([
            'course' => ['required'],
            'result' => ['required'],
        ]);

        $course = $request->get('course');
        $amountCurrency = $request->get('result');
        $amountCurrencyUah = $amountCurrency * $course;

        $data = [];
        $data['course'] = $course;
        $data['amountCurrency'] = $amountCurrency;
        $data['amountCurrencyUah'] = $amountCurrencyUah;

        $data['currencyUah'] = Currency::query()->find('UAH');
        $data['result'] = $currency->remainder + $amountCurrency;
        $data['resultUah'] = $data['currencyUah']->remainder - $amountCurrencyUah;
        $data['message'] = "Куплено ";

        if ($data['resultUah'] < 0) {
            return redirect()
                ->back()
                ->with('message', [
                    "Операция не возможна. Недостаточно гривны!  Остаток гривны {$data['currencyUah']->remainder}",
                    'danger'
                ]);
        }
        return $this->saveBuyAndSale($currency, $method, $data);
    }


    /**
     * Продажа
     *
     * @param Currency $currency
     * @param string $method
     * @param string|null $date
     * @return array
     */
    public function sale(Currency $currency, string $method, string $date = null): array
    {
        $data = [];
        $data['currency'] = $currency;
        $data['method'] = $method;
        $data['date'] = $date;

        $data['view'] = 'buy_sale';
        $data['title'] = 'Продажа';
        $data['currencyUah'] = Currency::query()->where('cipher', 'UAH')->first();
        $data['operations'] = Operation::filerDate($method, $currency, $date)->get();

        return $data;
    }

    /**
     * Сохранение продажи
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     * @throws Exception
     */
    public function saleSave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        $request->validate([
            'course' => ['required'],
            'result' => ['required'],
        ]);

        $course = $request->get('course');
        $amountCurrency = $request->get('result');
        $amountCurrencyUah = $amountCurrency * $course;

        $data = [];
        $data['course'] = $course;
        $data['amountCurrency'] = $amountCurrency;
        $data['amountCurrencyUah'] = $amountCurrencyUah;
        $data['currencyUah'] = Currency::query()->find('UAH');

        $data['result'] = $currency->remainder - $request->get('result');
        $data['resultUah'] = $data['currencyUah']->remainder + $amountCurrencyUah;
        $data['message'] = "Продано ";

        if ($data['result'] < 0) {
            return redirect()
                ->back()
                ->with('message', [
                    "Операция не возможна. Недостаточно {$currency->name}!",
                    'danger'
                ]);
        }
        return $this->saveBuyAndSale($currency, $method, $data);
    }


    /**
     * Расходы
     *
     * @param Currency $currency
     * @param string $method
     * @param string|null $date
     * @return array
     */
    public function expenses(Currency $currency, string $method, string $date = null): array
    {
        $data = [];
        $data['currency'] = $currency;
        $data['method'] = $method;
        $data['date'] = $date;

        $data['view'] = 'expenses_parishes';
        $data['title'] = 'Расходы';
        $data['operations'] = Operation::filerDate($method, $currency, $date)->get();

        return $data;
    }

    /**
     * Сохранение Расходы
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     * @throws Exception
     */
    public function expensesSave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        $data = [];
        $data['amountCurrency'] = $request->get('result');
        $data['comment'] = $request->get('comment');

        DB::beginTransaction();
        try {
            $result = $currency->remainder - $request->get('result');
            $currency->update([
                'remainder' => $result
            ]);

            event(new CurrencyUpdated($currency, $method, $data));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }


        return redirect()
            ->route('currency.index')
            ->with('message', [
                "$request->result $currency->name на '$request->comment' успешно потрачена",
                'success'
            ]);
    }


    /**
     * Приходы
     *
     * @param Currency $currency
     * @param string $method
     * @param string|null $date
     * @return array
     */
    public function parishes(Currency $currency, string $method, string $date = null): array
    {
        $data = [];
        $data['currency'] = $currency;
        $data['method'] = $method;
        $data['date'] = $date;

        $data['view'] = 'expenses_parishes';
        $data['title'] = 'Приходы';
        $data['operations'] = Operation::filerDate($method, $currency, $date ?? null)->get();

        return $data;
    }


    /**
     * Сохранение приходов
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     * @throws Exception
     */
    public function parishesSave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        $data = [];
        $data['amountCurrency'] = $request->get('result');
        $data['comment'] = $request->get('comment');

        DB::beginTransaction();
        try {
            $result = $currency->remainder + $request->get('result');
            $currency->update([
                'remainder' => $result
            ]);

            event(new CurrencyUpdated($currency, $method, $data));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }

        return redirect()
            ->route('currency.index')
            ->with('message', [
                "$request->result $currency->name на '$request->comment' успешно добавлены",
                'success'
            ]);
    }


    // Подкрепление
    public function reinforcement(Currency $currency)
    {
    }

    // Инкассация
    public function shipment(Currency $currency)
    {
    }

    // Остатки
    public function remains(Currency $currency)
    {
    }

    // Блокнот
    public function notebook(Currency $currency)
    {
    }

    // Конверсия
    public function conversion(Currency $currency)
    {
    }

    /**
     * Сохранение данных  Buy и Sale методов
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @param array $data
     * @return RedirectResponse
     * @throws Exception
     */
    private function saveBuyAndSale(Currency $currency, string $method, array $data): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $currency->update([
                'course' => $data['course'],
                'remainder' => $data['result'],
            ]);

            $data['currencyUah']->update([
                'remainder' => $data['resultUah']
            ]);

            event(new CurrencyUpdated($currency, $method, $data));

            DB::commit();
            return redirect()->route('currency.index')->with('message', [
                "{$data['message']} {$data['amountCurrency']} $currency->name на сумму {$data['amountCurrencyUah']} {$data['currencyUah']->name}",
                'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }
    }

}
