<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_code' => 'required|string|min:2',
            'date_from' => 'required_with:date_to||date_format:Y-m-d',
            'date_to' => 'required_with:date_from|date_format:Y-m-d'
        ];
    }
}
