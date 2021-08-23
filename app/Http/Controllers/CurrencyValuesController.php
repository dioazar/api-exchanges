<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyFilterRequest;
use App\Models\Currency;
use App\Models\CurrencyValue;
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
        $request->validate([
            'currency_code' => 'required|string|min:2',
            'date_from' => 'required_if:date_to,*|date_format:Y-m-d',
            'date_to' => 'required_if:date_from,*|date_format:Y-m-d'
        ]);

        $currency = Currency::getByCode($request->get('currency_code'));
        $currencyValues = CurrencyValue::query()->where('currency_id', $currency->id);

        if($request->get('date_from')) {
            $from = Carbon::createFromFormat('Y-m-d', $request->get('date_from'));
            $to = Carbon::createFromFormat('Y-m-d', $request->get('date_to'));
            $currencyValues->whereBetween('date', [$from, $to]);
        }

        $currencyValues = $currencyValues->orderBy('id', 'DESC')->paginate(50);

        return view('currencies.show', compact('currencyValues'));
    }

    public function last(string $currency_code)
    {
        $currency = Currency::getByCode($currency_code);
        $currencyValues = CurrencyValue::where('currency_id', $currency->id)->orderBy('id', 'DESC')->first();

        return view('currencies.last', compact('currencyValues'));
    }
}
