<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->resource) {
            return [
                'id' => $this->id,
                'currency' => [
                    'code' => $this->currency->code,
                    'name' => $this->currency->name,
                    'symbol' => $this->currency->symbol,
                ],
                'currency_denom' => [
                    'code' => $this->currencydenom->code,
                    'name' => $this->currencydenom->name,
                    'symbol' => $this->currencydenom->symbol,
                ],
                'date' => $this->date,
                'value' => $this->value,
            ];
        }

        return [];
    }
}
