<?php

namespace App\Services;

use App\Http\Resources\CurrencyValuesResource;
use App\Models\Currency;
use App\Models\CurrencyValue;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CurrencyValueService
{
    public function storePeriod(Carbon $start, Carbon $end)
    {
        try {
            $sdw = new SdwService();
            $data = $sdw->getPeriod($start, $end);

            foreach ($this->format($data) as $series) {
                $currency = Currency::firstOrCreate(['code' => $series['attributes']['CURRENCY']]);
                $curreny_denom = Currency::firstOrCreate(['code' => $series['attributes']['CURRENCY_DENOM']]);

                foreach ($series['values'] as $info) {
                    $cv = CurrencyValue::firstOrNew([
                        'currency_id' => $currency->id,
                        'currency_denom_id' => $curreny_denom->id,
                        'date' => $info['date']
                    ]);

                    if(!$cv->value) {
                        $cv->value = $info['value'];
                        $cv->save();
                    }
                }
            }
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function getWithFilters(array $filters)
    {
        $currency = Currency::getByCode($filters['currency_code']);
        $currencyValues = CurrencyValue::query()->where('currency_id', $currency->id);

        if(isset($filters['date_from'])) {
            $from = Carbon::createFromFormat('Y-m-d', $filters['date_from'])->startOfDay();
            $to = Carbon::createFromFormat('Y-m-d', $filters['date_to'])->endOfDay();
            $currencyValues->whereBetween('date', [$from, $to]);
        }

        return $currencyValues->orderBy('id', 'DESC')->paginate(50)->appends(request()->input());
    }

    public function getLast(string $currency_code)
    {
        $currency = Currency::getByCode($currency_code);
        return CurrencyValue::where('currency_id', $currency->id)->orderBy('id', 'DESC')->first();
    }

    private function format(Collection $data): Collection
    {
        $coll = new Collection();

        $data->map(function ($item) use ($coll) {
            $attributes = [];
            $values = [];

            foreach ($item['SeriesKey']['Value'] as $attr) {
                $attributes[$attr['@attributes']['id']] = $attr['@attributes']['value'];
            }

            if (isset($item['Obs']['ObsDimension'])) {
                $values[] = [
                    'date' => $item['Obs']['ObsDimension']['@attributes']['value'],
                    'value' => $item['Obs']['ObsValue']['@attributes']['value']
                ];
            } else {
                foreach ($item['Obs'] as $value) {
                    $values[] = [
                        'date' => $value['ObsDimension']['@attributes']['value'],
                        'value' => $value['ObsValue']['@attributes']['value']
                    ];
                }
            }

            $coll->add([
                'attributes' => $attributes,
                'values' => $values
            ]);
        });

        return $coll;
    }
}
