<?php

namespace Tests\Unit;

use Tests\TestCase;

class ShippingTest extends TestCase
{
    public function test_fast_shipping_route_200()
    {
        $response = $this->postJson('/api/shipping', [
            'type' => 'fast',
            'sourceKladr' => 'Istanbul',
            'targetKladr' => 'Antalya',
            'weight' => 5.87
        ]);
        $response->assertStatus(200);
    }

    public function test_slow_shipping_route_200()
    {
        $response = $this->postJson('/api/shipping', [
            'type' => 'slow',
            'sourceKladr' => 'Istanbul',
            'targetKladr' => 'LA',
            'weight' => 87.5
        ]);
        $response->assertStatus(200);
    }

    public function test_shipping_route_422()
    {
        $response = $this->postJson('/api/shipping', [
            'type' => 'slow',
            'sourceKladr' => 'Istanbul',
            'targetKladr' => 'LA',
        ]);
        $response->assertStatus(422);
    }
}
