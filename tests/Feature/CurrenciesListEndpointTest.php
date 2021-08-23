<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrenciesListEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_making_an_api_request()
    {
        $response = $this->getJson('/api/v1/currencies/list');
        $response->assertStatus(200);
    }
}
