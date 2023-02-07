<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(CurrencyController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(CurrencyController::class)->group(function () {
    Route::get('buy/{currency}', 'buy')->name('currency.buy');
    Route::get('sale/{currency}', 'sale')->name('currency.sale');
    Route::get('reinforcement/{currency}', 'reinforcement')->name('currency.reinforcement');
    Route::get('shipment/{currency}', 'shipment')->name('currency.shipment');
    Route::get('parishes/{currency}', 'parishes')->name('currency.parishes');
    Route::get('expenses/{currency}', 'expenses')->name('currency.expenses');
    Route::get('remains/{currency}', 'remains')->name('currency.remains');
    Route::get('notebook/{currency}', 'notebook')->name('currency.notebook');
    Route::get('conversion/{currency}', 'conversion')->name('currency.conversion');
});
