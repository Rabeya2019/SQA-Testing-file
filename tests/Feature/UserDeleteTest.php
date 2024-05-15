<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use Illuminate\Support\Arr;

class UserDeleteTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    public function testDeleteUser()
    {
        $userId = 1;
        // Assuming $userId is the ID of an existing user
        $response = $this->delete('/admin/users/' . $userId);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', [
            'id' => $userId
        ]);
    }
}
