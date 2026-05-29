<?php

namespace App\Services\CheckESimStatus;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ESimStatusCheckerService implements IESimStatusCheckerService
{
    public function query(string $iccid): ESimStatusCheckerResponse
    {
        try {
            $response = Http::withHeaders(['x-api-key' => config('app.mesh.api_key')])
                ->timeout(config('app.mesh.timeout'))
                ->get(sprintf("%s/profiles/%s", config('app.mesh.url'), $iccid));
            return new ESimStatusCheckerResponse($response->json(), $response->successful(), $response->status());
        } catch (Exception $exception) {
            Log::error(sprintf('Failed to get eSIM QR Code %s', $exception->getMessage()));
            return new ESimStatusCheckerResponse([], false, ResponseAlias::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
