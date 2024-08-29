<?php

namespace App\Jobs;

use App\Events\SubmissionCreated;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessSubmissionJob implements ShouldQueue
{
    use Queueable;

    protected array $data;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $submission = Submission::create($this->data);
            event(new SubmissionCreated($submission));
        } catch (\Exception $e) {
            Log::error('The error appeared in the process of saving the submission: ' . $e->getMessage());
        }
    }

    public function getData(): array
    {
        return $this->data;
    }
}
