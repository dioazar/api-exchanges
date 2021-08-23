@extends('layouts.guest')

@section('content')
    <h1>Last</h1>

    <a class="btn btn-secondary" href="{{ route('currencies.index') }}">
        <i class="bi bi-arrow-left"></i>
    </a>

    <table class="table">
        <thead>
        <th>@lang('currencies.currency')</th>
        <th>@lang('currencies.currency_denom')</th>
        <th>@lang('currencies.date')</th>
        <th>@lang('currencies.value')</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $currencyValues->currency->code }}</td>
                <td>{{ $currencyValues->currencyDenom->code }}</td>
                <td>{{ $currencyValues->date }}</td>
                <td>{{ $currencyValues->currency->symbol }} {{ $currencyValues->value }}</td>
            </tr>
        </tbody>
    </table>
@endsection
