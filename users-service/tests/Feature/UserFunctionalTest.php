<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFunctionalTest extends TestCase
{
    public function test_user_creation_api()
    {
        $response = $this->postJson('/api/users', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'User created successfully']);
    }
}
