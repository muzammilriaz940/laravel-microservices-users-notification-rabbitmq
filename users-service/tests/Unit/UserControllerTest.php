<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_user_creation_success()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson('/api/users', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'User created successfully']);
    }

    public function test_user_creation_validation_error()
    {
        $response = $this->postJson('/api/users', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['firstName', 'lastName', 'email']);
    }
}
