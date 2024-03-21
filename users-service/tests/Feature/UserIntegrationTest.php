<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Jobs\UserCreated;

class UserIntegrationTest extends TestCase
{
    public function test_user_created_job_dispatched()
    {
        Queue::fake();

        $this->postJson('/api/users', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
        ]);

        Queue::assertPushed(UserCreated::class, function ($job) {
            return $job->user == json_encode([
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john@example.com',
            ]);
        });
    }
}
