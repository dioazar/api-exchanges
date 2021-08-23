@extends('layouts.guest')

@section('content')
    <h1>{{ $currencyValues->first() ? $currencyValues->first()->currency->code : '' }}</h1>

    <a class="btn btn-secondary" href="{{ route('currencies.index') }}">
        <i class="bi bi-arrow-left"></i>
    </a>

    <a class="btn btn-secondary" href="{{ route('currencies.last', ['currency_code' => app('request')->input('currency_code')]) }}">
        Last
    </a>

    <table class="table">
        <thead>
        <th>@lang('currencies.currency')</th>
        <th>@lang('currencies.currency_denom')</th>
        <th>@lang('currencies.date')</th>
        <th>@lang('currencies.value')</th>
        </thead>
        <tbody>
            @foreach($currencyValues as $currencyValue)
                <tr>
                    <td>{{ $currencyValue->currency->code }}</td>
                    <td>{{ $currencyValue->currencyDenom->code }}</td>
                    <td>{{ $currencyValue->date }}</td>
                    <td>{{ $currencyValue->currency->symbol }} {{ $currencyValue->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$currencyValues->links()}}
@endsection
