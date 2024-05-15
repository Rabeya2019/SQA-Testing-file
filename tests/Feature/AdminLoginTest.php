<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase; // Use RefreshDatabase trait to reset the database after each test

    public function testAdminLoginWithValidCredentials()
    {
        $response = $this->post('/user/login', [
            'email' => 'admin@mail.com',
            'password' => 'codeastro.com',
        ]);
        $response->assertStatus(302);
    }
}
