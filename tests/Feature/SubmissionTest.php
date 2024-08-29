<?php

namespace Tests\Feature;

use App\Jobs\ProcessSubmissionJob;
use Tests\TestCase;
use Illuminate\Support\Facades\Bus;

class SubmissionTest extends TestCase
{
    /**
     * Test that the ProcessSubmission job is dispatched.
     */
    public function test_process_submission_job_is_dispatched()
    {
        Bus::fake();

        $response = $this->postJson('/api/v1/submit', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);

        $response->assertStatus(202);

        Bus::assertDispatched(ProcessSubmissionJob::class, function ($job) {
            $data = $job->getData();
            return $data['name'] === 'John Doe' &&
                $data['email'] === 'john.doe@example.com' &&
                $data['message'] === 'This is a test message.';
        });
    }
}
