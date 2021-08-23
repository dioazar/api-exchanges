<?php

use App\Http\Controllers\Api\CurrenciesController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CurrencyValuesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1'
], function(Router $router){
    $router->get('currencies', [CurrencyValuesController::class, 'index']);
    $router->get('currencies/filters', [CurrencyValuesController::class, 'filters']);
    $router->get('currencies/{currency_code}/last', [CurrencyValuesController::class, 'last']);
    $router->get('currencies/list', [CurrenciesController::class, 'index']);
});
