<?php

namespace App\Jobs;

use App\Models\Assessment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class AssessmentResultJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Assessment $assessment,
        public Collection $result
    ) {
        //
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return array<int, int>
     */
    public function backoff(): array
    {
        return [1, 3, 5, 10];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
