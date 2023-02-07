<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyOperationsServices
{
    // Покупка
    public function buy()
    {

    }

    // Продажа
    public function sale()
    {

    }

    // Подкрепление
    public function reinforcement()
    {

    }

    // Инкассация
    public function shipment()
    {

    }

    // -Расходы (expenses) и +Приходы (parishes)
    public function expensesAndParishes(Currency $currency, string $method = '-'): View
    {
        return view('currency.form-expenses_parishes', compact('currency', 'method'));
    }

    public function expensesAndParishesSave(Request $request, Currency $currency)
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
    public function remains()
    {

    }

    // Блокнот
    public function notebook()
    {

    }

    // Конверсия
    public function conversion()
    {

    }
}
