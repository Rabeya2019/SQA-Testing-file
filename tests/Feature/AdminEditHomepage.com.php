<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use App\Models\Admin;
use App\Services\AdminService;
use Mockery;

use Illuminate\Support\Str;

class AdminsettingsUpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    public function test_admin_can_edit_homepage_info()
    {
        $admin =Admin::factory()->create([ 'is_admin' => true ]);
        $this->actingAs($admin);

        $response = $this->get('backend.setting');

        $response->assertStatus(200);

        $updateData = [
            'short_des' => 'Description for SQA testing ',
            'description' => 'Bigger description for SQA testing',
            'address' => 'Dhaka Test Address, Test test ',
            'email' => 'Testing@example.com',
            'phone' => '015412152122'
        ];



        if (isset($updateData['photo'])) {
            Storage::disk('public')->put('/storage/photos/1/blog3.jpg',  file_get_contents('/storage/photos/1/logo.png'));
        }
        if (isset($updateData['logo'])) {
            Storage::disk('public')->put('/storage/photos/1/logo.png',  file_get_contents('/storage/photos/1/Category/mini-banner3.png'));
        }
        $response = $this->put('/admin', $updateData);

        $response->assertStatus(302);
    }


}
