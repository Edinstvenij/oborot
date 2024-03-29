<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Models\Operation;
use App\Services\CurrencyOperationsServices;
use Carbon\Carbon;
use Exception;
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request->query->has('date')) {
            $request->validate(['date' => ['required', 'date']]);

            $date = $request->get('date');
            $currencies = $this->operations->index($date);
            return view('currency.index', compact('currencies', 'date'));
        }

        $currencies = $this->operations->index();
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
        return redirect()->route('currency.index')->with(
            'message',
            ['Создана новая валюта: ' . $request->name, 'success']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Currency $currency
     * @return View
     */
    public function show(Currency $currency): View
    {
        return view('currency.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Currency $currency
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
        return redirect()->route('currency.index')->with('message', ['Изменение внесены успешно', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
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


    /**
     * Вызов операций с валютой
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return View
     */
    public function startOperations(Request $request, Currency $currency, string $method): View
    {
        $request->validate(['date' => 'date']);

        $data = $this->operations->$method($currency, $method, $request->get('date'));

        return view('currency.operation-forms.' . $data['view'], $data);
    }

    /**
     * Вызов сохранение операций с валютой
     *
     * @param Request $request
     * @param Currency $currency
     * @param string $method
     * @return RedirectResponse
     * @throws Exception
     */
    public function startOperationsSave(Request $request, Currency $currency, string $method): RedirectResponse
    {
        $method .= 'Save';
        return $this->operations->$method($request, $currency, $method);
    }

    /**
     * @param Request $request
     * @param string $method
     * @return View
     */
    public function startOperationHistory(Request $request, string $method): View
    {
        $request->validate([
            'date' => 'date'
        ]);

        $date = $request->get('date') ?? Carbon::now()->format('Y-m-d');
        $operations = Operation::filerDate($method, null, $date);

        count($operations) === 0
            ? $compressOperations = []
            : $compressOperations = $operations[0]->compressOperations($operations);

        return view('currency.history', compact('operations', 'date', 'compressOperations'));
    }

}
