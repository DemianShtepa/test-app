<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Psr\Log\LoggerInterface;

class LogSubmission
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(SubmissionSaved $event): void
    {
        $submission = $event->getSubmission();
        $this->logger->info(
            sprintf(
                'Submission saved. Name - %s, email %s, message - %s.',
                $submission->name,
                $submission->email,
                $submission->message,
            )
        );
    }
}
