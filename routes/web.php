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
Route::controller(CurrencyController::class)->prefix('currency')
    ->where(['currency' => '^[A-Z]{3}$', 'method' => '^[a-zS]+$'])
    ->group(function () {
        Route::get('/', 'index')->name('currency.index');

        Route::get('/{currency}/{method}', 'startOperations')->name('currency.operations');
        Route::post('/{currency}/{method}', 'startOperationsSave')->name('currency.operations.save');
    });
