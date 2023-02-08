<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyOperationsServices
{
    // Покупка
    public function buy(Currency $currency, string $method)
    {
        return view('currency.form-expenses_parishes', compact('currency', 'method'));
    }

    // Продажа
    public function sale(Currency $currency)
    {

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
        return view('currency.form-expenses_parishes', compact('currency', 'method'));
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
