<?php

namespace App\Services\GetQRCode;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GetESimQRCodeService implements IGetESimQRCodeService
{
    public function query(string $iccid): GetESimQRCodeResponse
    {
        try {
            $response = Http::withHeaders(['x-api-key' => config('app.mesh.api_key')])
                ->timeout(config('app.mesh.timeout'))
                ->get(sprintf("%s/profile_activation_data/%s", config('app.mesh.url'), $iccid));
            return new GetESimQRCodeResponse($response->json(), $response->successful(), $response->status());
        } catch (Exception $exception) {
            Log::error(sprintf('Failed to get latest config %s', $exception->getMessage()));
            return new GetESimQRCodeResponse([], false, ResponseAlias::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
