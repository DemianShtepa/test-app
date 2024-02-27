<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SubmitRequest;
use App\Jobs\SubmitRequest as SubmitRequestJob;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

final class SubmissionsController
{
    private ResponseFactory $responseFactory;
    private Dispatcher $dispatcher;

    public function __construct(ResponseFactory $responseFactory, Dispatcher $dispatcher)
    {
        $this->responseFactory = $responseFactory;
        $this->dispatcher = $dispatcher;
    }

    public function submit(SubmitRequest $request): Response
    {
        $this->dispatcher->dispatch(
            new SubmitRequestJob($request->input('name'), $request->input('email'), $request->input('message'))
        );

        return $this->responseFactory->json(status:Response::HTTP_CREATED);
    }
}
