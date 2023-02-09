<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Services\CurrencyOperationsServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyController extends Controller
{

    protected CurrencyOperationsServices $operations;

    public function __construct(CurrencyOperationsServices $services)
    {
        $this->operations = $services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $currencies = Currency::query()->orderBy('created_at')->get();
        return view('currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CurrencyRequest $request
     * @return RedirectResponse
     */
    public function store(CurrencyRequest $request): RedirectResponse
    {
        Currency::create($request->validated());
        return redirect()->route('currency.index')->with('message',
            ['Создана новая валюта: ' . $request->name, 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Currency $currency
     * @return View
     */
    public function show(Currency $currency): View
    {
        return view('currency.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Currency $currency
     * @return View
     */
    public function edit(Currency $currency): View
    {
        return view('currency.edit', compact('currency'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param CurrencyRequest $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function update(CurrencyRequest $request, Currency $currency): RedirectResponse
    {
        $currency->update($request->validated());
        return redirect()->back()->with('message', ['Изменение внесены успешно', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Currency $currency
     * @return RedirectResponse
     */
    public function destroy(Currency $currency): RedirectResponse
    {
        if ($currency->cipher === 'UAH') {
            return redirect()->back()->with('message', ['Гривну нельзя удалить', 'danger']);
        }
        $nameDeleted = $currency->name;
        $currency->delete();
        return redirect()->route('currency.index')->with('message', ['Удалена валюта: ' . $nameDeleted, 'danger']);
    }


    public function startOperations(Currency $currency, string $method)
    {
        return $this->operations->$method($currency, $method);
    }

    public function startOperationsSave(Request $request, Currency $currency, string $method)
    {
        return $this->operations->$method($request, $currency, $method);
    }


    /**
     *  Приходы
     * @param Currency $currency
     * @return View
     */
    public function parishes(Currency $currency): View
    {
        return $this->operations->expensesAndParishes($currency, '+');

    }


    /**
     *  Расходы
     * @param Currency $currency
     * @return View
     */
    public function expenses(Currency $currency): View
    {
        return $this->operations->expensesAndParishes($currency, '-');
    }

    /**
     *  Сохранение результатов приходов и расходов
     * @param Request $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function expensesAndParishesSave(Request $request, Currency $currency): RedirectResponse
    {
        return $this->operations->expensesAndParishesSave($request, $currency);
    }

}
