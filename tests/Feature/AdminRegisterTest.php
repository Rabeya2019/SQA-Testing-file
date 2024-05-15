<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRegisterTest extends TestCase
{
    use RefreshDatabase; // Use RefreshDatabase trait to reset the database after each test

    public function testAdminRegisterWithValidCredentials()
    {

        $adminData = [
            'name' => 'admin1',
            'email' => 'admin1@mail.com',
            'password' => 'admin1password',
            'password_confirmation' => 'admin1password',
        ];


        $response = $this->post('/user/register', $adminData);


        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'name' => 'admin1',
            'email' => 'admin1@mail.com',

        ]);
    }

}
