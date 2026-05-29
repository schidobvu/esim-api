<?php

namespace App\Services\VXView;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Response;
use TNM\IntegrationsFootprints\Responses\TransactionResponse;

trait TransactionLog
{
    protected function logResponse(PromiseInterface|Exception|\Illuminate\Http\Client\Response $response, bool $success): void
    {
        if ($response instanceof Exception) {
            $this->log->logResponse(
                new TransactionResponse($response->getMessage()),
                Response::HTTP_SERVICE_UNAVAILABLE,
                $success
            );
            return;
        }

        $this->log->logResponse(new TransactionResponse($response->body()), $response->status(), $success);
    }
}
