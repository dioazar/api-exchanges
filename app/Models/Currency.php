<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'symbol'
    ];

    public static function getByCode(string $code)
    {
        return self::where('code', $code)->first();
    }
}
