<?php

namespace App\Http\Controllers;

use App\Services\CurrencyValueService;
use App\Services\SdwService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $start = Carbon::now()->subMonth(3);
        $end = Carbon::now()->subMonth(1);

        $sdw = new CurrencyValueService();
        $sdw->storePeriod($start, $end);
    }
}
