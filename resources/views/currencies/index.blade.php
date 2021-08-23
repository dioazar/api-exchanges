@extends('layouts.guest')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>@lang('currencies.historic_currencies')</h1>

<h4>Filters</h4>
<form action="javascript:void(0)" id="filterForm" onsubmit="filter()">
    <div class="row">
        <div class="form-group col-md-5">
            <select class="form-select col-md-6" name="currency_code">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->code }}">{{ $currency->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <input name="date_from" class="form-control" type="date">
        </div>
        <div class="form-group col-md-3">
            <input name="date_to" class="form-control" type="date">
        </div>
        <button class="btn btn-secondary col-md-1">Filter</button>
    </div>
</form>

<br>

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
                <td><a href="{{route('currencies.filters', ['currency_code' => $currencyValue->currency->code])}}">{{ $currencyValue->currency->code }}</a></td>
                <td>{{ $currencyValue->currencyDenom->code }}</td>
                <td>{{ $currencyValue->date }}</td>
                <td>{{ $currencyValue->currency->symbol }} {{ $currencyValue->value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $currencyValues->links() }}

@endsection

@push('scripts')
<script>
    function filter()
    {
        var form = $('#filterForm').serializeArray();
        var url = '{{ route('currencies.filters') }}?';
        $.each(form, function(key,input){
            if(input.value.length != 0) {
                url += input.name + '=' + input.value + '&';
            }
        });

        window.location.href = url;
    }
</script>
@endpush
