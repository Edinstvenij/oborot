<?php

namespace App\Services;

use App\Events\CurrencyUpdated;
use App\Models\Currency;
use App\Models\Operation;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CurrencyOperationsServices
{
    /**
     * @return View
     */
    public function index(): View
    {
        if (request()->query->has('date')) {
            $date = request()->query->get('date');
            $currencies = Currency::withRemainderDay($date)->get();
            return view('currency.index', compact('currencies', 'date'));
        }

        $currencies = Currency::query()->orderBy('created_at')->get();
        return view('currency.index', compact('currencies'));
    }


    /**
     * Покупка
     *
     * @param Currency $currency
     * @param string $method
     * @return View
     */
    public function buy(Currency $currency, string $method): View
    {
        $title = 'Покупка';
        $currencyUah = Currency::query()->where('cipher', 'UAH')->first();
        $operations = Operation::filerDate($currency, $method)->get();

        return view(
            'currency.operation-forms.buy_sale',
            compact('currency', 'currencyUah', 'title', 'method', 'operations')
        );
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
        $data = [];

        $data['currencyUah'] = Currency::query()->find('UAH');

        $data['result'] = $currency->remainder + $request->get('result');
        $data['resultUah'] = $data['currencyUah']->remainder - $request->get('input');
        $data['message'] = "Куплено ";

        return $this->saveBuyAndSale($request, $currency, $method, $data);
    }

    /**
     * Продажа
     *
     * @param Currency $currency
     * @param string $method
     * @return View
     */
    public function sale(Currency $currency, string $method): View
    {
        $title = 'Продажа';
        $currencyUah = Currency::query()->where('cipher', 'UAH')->first();
        $operations = Operation::filerDate($currency, $method)->get();

        return view(
            'currency.operation-forms.buy_sale',
            compact('currency', 'currencyUah', 'title', 'method', 'operations')
        );
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
        $data = [];
        $data['currencyUah'] = Currency::query()->find('UAH');

        $data['result'] = $currency->remainder - $request->get('result');
        $data['resultUah'] = $data['currencyUah']->remainder + $request->get('input');
        $data['message'] = "Продано ";

        return $this->saveBuyAndSale($request, $currency, $method, $data);
    }


    /**
     * Затраты
     *
     * @param Currency $currency
     * @param string $method
     * @return View
     */
    public function expenses(Currency $currency, string $method): View
    {
        $title = 'Расходы';
        $operations = Operation::filerDate($currency, $method)->get();

        return view(
            'currency.operation-forms.expenses_parishes',
            compact('currency', 'method', 'title', 'operations')
        );
    }

    /**
     * Сохранение затрат
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     * @throws Exception
     */
    public function expensesSave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $result = $currency->remainder - $request->get('result');
            $currency->update([
                'remainder' => $result
            ]);

            event(new CurrencyUpdated($request, $currency, $method));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }


        return redirect()
            ->back()
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
     * @return View
     */
    public function parishes(Currency $currency, string $method): View
    {
        $title = 'Приходы';
        $operations = Operation::filerDate($currency, $method)->get();

        return view(
            'currency.operation-forms.expenses_parishes',
            compact('currency', 'method', 'title', 'operations')
        );
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
        try {
            DB::beginTransaction();

            $result = $currency->remainder + $request->get('result');
            $currency->update([
                'remainder' => $result
            ]);

            event(new CurrencyUpdated($request, $currency, $method));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }

        return redirect()
            ->back()
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
    private function saveBuyAndSale(Request $request, Currency $currency, string $method, array $data): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $currency->update([
                'course' => $request->get('course'),
                'remainder' => $data['result'],
            ]);

            $data['currencyUah']->update([
                'remainder' => $data['resultUah']
            ]);

            event(new CurrencyUpdated($request, $currency, $method));

            DB::commit();
            return redirect()->back()->with('message', [
                "{$data['message']} $request->result $currency->name на сумму $request->input {$data['currencyUah']->name}",
                'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }
    }

}
