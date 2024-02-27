<?php

declare(strict_types=1);

namespace Tests\Unit\Listeners;

use App\Events\SubmissionSaved;
use App\Listeners\LogSubmission;
use App\Models\Submission;
use Mockery;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

final class LogSubmissionTest extends TestCase
{
    private LoggerInterface|MockInterface $logger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->logger = Mockery::mock(LoggerInterface::class);
    }

    public function testSubmissionSaveLogged(): void
    {
        $this->logger
            ->expects('info')
            ->once()
            ->with('Submission saved. Name - name, email mail@mail.com, message - message.');
        $submission = new Submission();
        $submission->name = 'name';
        $submission->email = 'mail@mail.com';
        $submission->message = 'message';
        $event = new SubmissionSaved($submission);
        $logSubmission = new LogSubmission($this->logger);

        $logSubmission->handle($event);
    }
}
