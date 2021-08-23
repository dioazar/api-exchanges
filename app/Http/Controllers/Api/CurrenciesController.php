<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\CurrenciesResource;
use App\Models\Currency;

class CurrenciesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/currencies/list",
     *     @OA\Response(response="200", description="Display all avaiable currencies."),
     * )
     */
    public function index()
    {
        return new CurrenciesResource(Currency::all());
    }
}
