<?php

namespace Tests\Unit;

use App\Jobs\UserCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\Job as JobContract;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class UserCreatedTest extends TestCase
{
    public function test_user_created_job_logs_received_user()
    {
        Log::shouldReceive('info')->once()->with('Received user:', ['firstName' => 'John', 'lastName' => 'Doe', 'email' => 'john@example.com']);

        $job = new UserCreated();
        $this->mockJob($job);

        $job->handle();
    }

    protected function mockJob(UserCreated $job)
    {
        $queueJob = $this->getMockBuilder(JobContract::class)->getMock();
        $job->setJob($queueJob);

        $payload = ['data' => ['firstName' => 'John', 'lastName' => 'Doe', 'email' => 'john@example.com']];
        $queueJob->expects($this->once())->method('payload')->willReturn($payload);

        return $queueJob;
    }
}
