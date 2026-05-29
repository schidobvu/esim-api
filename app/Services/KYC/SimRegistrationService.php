<?php


namespace App\Services\KYC;


use App\Models\SimregFootprint;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use TNM\IntegrationsFootprints\Requests\TransactionRequest;
use TNM\IntegrationsFootprints\Responses\TransactionResponse;

class SimRegistrationService implements ISimRegistrationService
{
    public function query(string $msisdn): Customer
    {
        $endpoint = sprintf('%s/subscribers/query/phone-numbers/%s', config('app.simreg.host'), $msisdn);
        /** @var SimregFootprint $log */
        $log = SimregFootprint::logRequest(new TransactionRequest(
                get_class($this),
                now()->timestamp,
                $endpoint,
                json_encode(['msisdn' => $msisdn]))
        );

        try {
            $response = Http::withHeaders([
                'Authorization' => sprintf('Bearer %s', config('app.simreg.token'))
            ])
                ->timeout(config('app.simreg.timeout'))
                ->get($endpoint);

            if (!$response->successful()) {
                $log->logResponse(new TransactionResponse(
                    json_encode($response->json()),
                ), $response->status(), false);
                return new Customer([], false);
            }

            $log->logResponse(new TransactionResponse(
                json_encode($response->json()),
            ), $response->status());

            return new Customer($response->json('subscriber'), true);
        } catch (Exception $exception) {
            $log->logResponse(new TransactionResponse(
                $exception->getMessage(),
            ), Response::HTTP_SERVICE_UNAVAILABLE, false);
            return new Customer([], false);
        }
    }
}
