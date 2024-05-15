<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use App\Models\Admin;
use App\Services\AdminService;
use Mockery;

use Illuminate\Support\Str;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    public function test_admin_can_edit_other_admin_profile()
    {
        $admin1 = Admin::factory()->create([ 'is_admin' => true ]);
        $admin2 = Admin::factory()->create([ 'is_admin' => true ]);
        $this->actingAs($admin1);//here i am logging in as admiin1


        $response = $this->get('//admin/profile' . $admin2->id . '/edit');
        $response->assertStatus(200);


        $updateData = [
            'email' => 'admin2@example.com',// i inserted a new mail here for admin 2
        ];
        $response = $this->put('/admin/users/' . $admin2->id, $updateData);
        $response->assertStatus(302);
        $admin2->refresh();
        $this->assertEquals($updateData['email'], $admin2->email);
    }


}
