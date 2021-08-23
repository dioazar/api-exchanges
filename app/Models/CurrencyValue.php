<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyValue extends Model
{
    protected $table = 'currency_values';

    protected $fillable = [
        'currency_id',
        'currency_denom_id',
        'date',
        'value'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function currencyDenom()
    {
        return $this->belongsTo(Currency::class, 'currency_denom_id', 'id');
    }
}
