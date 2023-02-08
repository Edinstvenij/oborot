<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyOperationsServices
{
    // Покупка
    public function buyAndSale(Currency $currency, string $method)
    {
        if ($method === 'buy') {
            $title = 'Покупка';
            $currencyUah = Currency::where('cipher', 'UAH')->first();
        } else {
            $title = 'Продажа';
            $currencyUah = Currency::where('cipher', 'UAH')->first();
        }
        return view('currency.operation-forms.buy_sale', compact('currency', 'currencyUah', 'title', 'method'));
    }

    // Продажа
    public function sale(Currency $currency)
    {

    }

    public function buyAndSaleSave(Request $request, Currency $currency, string $method)
    {
        $currencyUah = Currency::find('UAH');
        if ($method === 'buy') {
            $result = $currency->remainder + $request->get('result');
            $resultUah = $currencyUah->remainder - $request->get('input');
            $message = "Куплено ";
        } else {
            $result = $currency->remainder - $request->get('result');
            $resultUah = $currencyUah->remainder + $request->get('input');
            $message = "Продано ";
        }

        $currency->update([
            'course' => $request->get('course'),
            'remainder' => $result,
        ]);
        $currencyUah->update([
            'remainder' => $resultUah
        ]);

        return redirect()->back()->with('message', [
            "$message $request->result $currency->name на сумму $request->input $currencyUah->name",
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

    /**
     *  - Расходы (expenses)
     *  + Приходы (parishes)
     * @param Currency $currency
     * @param string $method
     * @return View
     */
    public function expensesAndParishes(Currency $currency, string $method = '-'): View
    {
        $title = $method === '-' ? 'Расходы' : 'Приходы';
        return view('currency.operation-forms.expenses_parishes', compact('currency', 'method', 'title'));
    }

    /**
     *  TODO Добавить историю(Записывать в новую таблицу(БД) комментарий, операцию, число)
     * @param Request $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function expensesAndParishesSave(Request $request, Currency $currency): RedirectResponse
    {
        if ($request->get('method') === '-') {
            $result = $currency->remainder - $request->get('number');
        } else {
            $result = $currency->remainder + $request->get('number');
        }

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
