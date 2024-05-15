<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Mockery;

class AdminNotificationGenerateOrderPdfTest extends TestCase
{
    public function test_admin_can_generate_order_pdf()
    {
        $admin = Admin::factory()->create([ 'is_admin' => true ]);

        $this->actingAs($admin);


        $mockPdfGenerator = Mockery::mock('App\Services\PdfGenerator');
        $mockPdfGenerator->shouldReceive('generateOrderPdf')
                         ->once()
                         ->andReturn('/* Mock PDF content */'); // Mock PDF content


        $mockSession = Mockery::mock('Illuminate\Session\Store'); // Replace with actual session class
        $mockSession->shouldReceive('get')->with('last_active_at')->andReturn(now()); // Simulate active session
        $this->app->instance('session', $mockSession);


        $orderId = 1;
        $order = Order::find($orderId); //order retrieval


        $response = $this->get('/admin/notifications/' . $orderId . '/generate-pdf');//pdf request

        $response->assertStatus(200);
        $this->assertTrue($mockSession->get('last_active_at')->isFresh()); // Simulate session check
    }

    protected function tearDown(): void
    {
        Mockery::close(); // Close mockery
        parent::tearDown();

//FAIL

    }
}
