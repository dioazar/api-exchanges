<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyFilterRequest;
use App\Http\Requests\LastCurrencyRequest;
use App\Models\Currency;
use App\Models\CurrencyValue;
use App\Services\CurrencyValueService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyValuesController extends Controller
{
    public function index()
    {
        $currencyValues = CurrencyValue::orderBy('id', 'DESC')->paginate(50);
        $currencies = Currency::all();

        return view('currencies.index', compact('currencyValues', 'currencies'));
    }

    public function withFilters(CurrencyFilterRequest $request)
    {
        $currencyValues = (new CurrencyValueService())->getWithFilters($request->validated());

        return view('currencies.show', compact('currencyValues'));
    }

    public function last(LastCurrencyRequest $request, string $currency_code)
    {
        $currencyValues = (new CurrencyValueService())->getLast($currency_code);

        return view('currencies.last', compact('currencyValues'));
    }
}
