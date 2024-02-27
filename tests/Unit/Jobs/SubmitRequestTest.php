<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs;

use App\Events\SubmissionSaved;
use App\Jobs\SubmitRequest;
use Illuminate\Support\Facades\Event;
use Mockery;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

final class SubmitRequestTest extends TestCase
{
    private LoggerInterface|MockInterface $logger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->logger = Mockery::mock(LoggerInterface::class);
    }

    public function testSubmissionCreated(): void
    {
        Event::fake();
        $submitRequest = new SubmitRequest('name', 'email', 'message');
        $this->logger
            ->shouldNotReceive('info');

        $submitRequest->handle($this->logger);

        Event::except(SubmissionSaved::class);
    }
}
