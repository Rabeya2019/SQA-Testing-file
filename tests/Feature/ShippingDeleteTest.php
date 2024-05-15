<?php

namespace Tests\Feature;


use App\Models\Shipping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use Illuminate\Support\Arr;

class ShippingDeleteTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    public function testDeleteShipping()
    {
        $shippingId = 1;
        // Assuming $shippingId is the ID of an existing shipping
        $response = $this->delete('/admin/shipping/' . $shippingId);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('shippings', [
            'id' => $shippingId
        ]);
    }
}
