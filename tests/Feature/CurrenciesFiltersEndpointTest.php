<?php

namespace Tests\Feature;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrenciesFiltersEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_making_an_api_request()
    {
        $currency = Currency::first();

        $response = $this->getJson('/api/v1/currencies/filters?currency_code='.$currency->code);
        $response->assertStatus(200);
    }
}
