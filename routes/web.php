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

Route::get('/', function () {
    return redirect()->route('currency.index');
});

Route::resource('currency', CurrencyController::class,);
Route::controller(CurrencyController::class)->prefix('currency')->group(function () {
    Route::get('/', 'index')->name('currency.index');

    Route::get('/{currency}/buy', 'buy')->name('currency.buy');
    Route::get('/{currency}/sale', 'sale')->name('currency.sale');
    Route::post('/{currency}/{method}/buyAndSaleSave', 'buyAndSaleSave')->name('currency.buyAndSale.save');


    Route::get('/{currency}/reinforcement', 'reinforcement')->name('currency.reinforcement');
    Route::get('/{currency}/shipment', 'shipment')->name('currency.shipment');

    Route::get('/{currency}/parishes', 'parishes')->name('currency.parishes');
    Route::get('/{currency}/expenses', 'expenses')->name('currency.expenses');
    Route::post('/{currency}/expensesAndParishesSave', 'expensesAndParishesSave')->name('currency.expensesAndParishes.save');

    Route::get('/{currency}/remains', 'remains')->name('currency.remains');
    Route::get('/{currency}/notebook', 'notebook')->name('currency.notebook');
    Route::get('/{currency}/conversion', 'conversion')->name('currency.conversion');
});
