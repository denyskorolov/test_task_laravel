<?php

namespace App\Listeners;

use App\Events\SubmissionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionCreated
{
    /**
     * Handle the event.
     */
    public function handle(SubmissionCreated $event): void
    {
        $submission = $event->getSubmission();
        Log::channel('submission')->info('Submission created', [
            'name' => $submission->name,
            'email' => $submission->email
        ]);
    }
}
