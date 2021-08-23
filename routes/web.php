<?php

use App\Http\Controllers\CurrencyValuesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('test', [TestController::class, 'index'])->name('test');
Route::get('currencies', [CurrencyValuesController::class, 'index'])->name('currencies.index');
Route::get('currencies/filters', [CurrencyValuesController::class, 'withFilters'])->name('currencies.filters');
Route::get('currencies/{currency_code}/last', [CurrencyValuesController::class, 'last'])->name('currencies.last');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
