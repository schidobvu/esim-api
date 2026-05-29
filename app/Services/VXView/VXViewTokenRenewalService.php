<?php


namespace App\Services\VXView;

use App\Models\VXViewFootprint;
use Exception;
use Illuminate\Support\Facades\Http;
use TNM\IntegrationsFootprints\Requests\TransactionRequest;

class VXViewTokenRenewalService implements IVXViewTokenRenewalService
{
    use TransactionLog;

    private VXViewFootprint $log;

    public function query(): VXViewTokenResponse
    {
        $requestUrl = $this->getUrl();

        $this->log = VXViewFootprint::logRequest(new TransactionRequest(
                get_class($this),
                now()->timestamp,
                $requestUrl,
                json_encode([]))
        );
        try {
            $response = Http::timeout(config('app.simswap.timeout'))->post($requestUrl);

            $this->logResponse($response, $response->successful());
            if (!$response->successful()) {
                return new VXViewTokenResponse(false);
            }

            return new VXViewTokenResponse($response->successful(), $response->body());
        } catch (Exception $exception) {
            $this->logResponse($exception, false);

            return new VXViewTokenResponse(false);
        }
    }

    protected function getUrl(): string
    {
        return sprintf(
            'http://%s:%s@%s:%s/AuthenticationServices/V1/Authentication/Authenticate/1',
            config('app.simswap.username'),
            config('app.simswap.password'),
            config('app.simswap.host'),
            config('app.simswap.port')
        );
    }
}
