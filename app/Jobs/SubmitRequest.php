<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\Log\LoggerInterface;
use Throwable;

final class SubmitRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $name;
    private string $email;
    private string $message;

    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function handle(LoggerInterface $logger): void
    {
        try {
            Submission::create(['name' => $this->name, 'email' => $this->email, 'message' => $this->message]);
        } catch (Throwable $e) {
            $logger->error('Failed to save submission.');

            throw $e;
        }
    }
}
