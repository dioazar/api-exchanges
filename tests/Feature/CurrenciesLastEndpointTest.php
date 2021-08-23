<?php

namespace Tests\Feature;

use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrenciesLastEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_making_an_api_request()
    {
        $currency = Currency::first();
        $response = $this->getJson('/api/v1/currencies/'.$currency->code.'/last');
        $response->assertStatus(200);
    }
}
