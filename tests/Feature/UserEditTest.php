<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use Illuminate\Support\Arr;

class UserEditTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testEditUser()
    {$userId = 1;
        // Assuming $userId is the ID of an existing user
        $response = $this->put('/admin/users/' . $userId, [
            // Provide valid user data to update here
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            // Ensure the user data is updated in the database
        ]);
    }


}
