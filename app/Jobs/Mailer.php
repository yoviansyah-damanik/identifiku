<?php

namespace App\Jobs;

use App\Mail\ForgotPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Mailer implements ShouldQueue
{
    use Queueable;

    public $backoff = [3, 5, 10];
    public $tries = 3;
    public $timeout = 0;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $type,
        public string|array $email,
        public array $payload
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->type) {
            case 'forgot_password':
                $view = new ForgotPasswordMail($this->payload);
                break;
            case 'student_registration':
                break;
            case 'school_registration':
                break;
            case 'school_registration_approved':
                break;
            case 'school_registration_rejected':
                break;
            case 'student_registration_approved':
                break;
            case 'student_registration_rejected':
                break;
        }

        if (is_array($this->email)) {
            foreach ($this->email as $email)
                Mail::to($email)
                    ->send($view);
        } else {
            Mail::to($this->email)
                ->send($view);
        }
    }

    public function failed(?\Throwable $exception): void {}
}
