<?php

namespace App\Services;

use App\Models\Currency;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CurrencyOperationsServices
{
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
        $currencyUah = Currency::where('cipher', 'UAH')->first();
        return view('currency.operation-forms.buy_sale', compact('currency', 'currencyUah', 'title', 'method'));
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
        try {
            $currencyUah = Currency::find('UAH');

            $result = $currency->remainder + $request->get('result');
            $resultUah = $currencyUah->remainder - $request->get('input');
            $message = "Куплено ";


            DB::beginTransaction();

            $currency->update([
                'course' => $request->get('course'),
                'remainder' => $result,
            ]);
            $currencyUah->update([
                'remainder' => $resultUah
            ]);

            DB::commit();

            return redirect()->back()->with('message', [
                "$message $request->result $currency->name на сумму $request->input $currencyUah->name",
                'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }
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
        $currencyUah = Currency::where('cipher', 'UAH')->first();
        return view('currency.operation-forms.buy_sale', compact('currency', 'currencyUah', 'title', 'method'));
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
        try {
            $currencyUah = Currency::find('UAH');

            $result = $currency->remainder - $request->get('result');
            $resultUah = $currencyUah->remainder + $request->get('input');
            $message = "Продано ";

            DB::beginTransaction();

            $currency->update([
                'course' => $request->get('course'),
                'remainder' => $result,
            ]);
            $currencyUah->update([
                'remainder' => $resultUah
            ]);

            DB::commit();

            return redirect()->back()->with('message', [
                "$message $request->result $currency->name на сумму $request->input $currencyUah->name",
                'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return throw new Exception('Поймано исключение:' . $e->getMessage() . '\n');
        }
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
        return view('currency.operation-forms.expenses_parishes', compact('currency', 'method', 'title'));
    }

    /**
     * Сохранение затрат
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     */
    public function expensesSave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        $result = $currency->remainder - $request->get('number');
        $currency->update([
            'remainder' => $result
        ]);

        return redirect()
            ->back()
            ->with('message', [
                "$request->number $currency->name на '$request->comment' успешно потрачена",
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
        return view('currency.operation-forms.expenses_parishes', compact('currency', 'method', 'title'));
    }


    /**
     * Сохранение приходов
     *
     *  TODO Добавить историю(Записывать в новую таблицу(БД) комментарий, операцию, число)
     *
     * @param Request $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function parishesSave(Request $request, Currency $currency): RedirectResponse
    {
        $result = $currency->remainder + $request->get('number');

        $currency->update([
            'remainder' => $result
        ]);

        return redirect()
            ->back()
            ->with('message', [
                "$request->number $currency->name на '$request->comment' успешно добавлены",
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
}
