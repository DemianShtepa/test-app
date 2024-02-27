<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\SubmitRequest;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

final class SubmissionsControllerTest extends TestCase
{
    public function testSubmission(): void
    {
        Bus::fake();

        $response = $this->postJson('api/submit', ['name' => 'test', 'email' => 'mail@mail.com', 'message' => 'message']);

        $response->assertCreated();

        Bus::assertDispatched(SubmitRequest::class);
    }
}
