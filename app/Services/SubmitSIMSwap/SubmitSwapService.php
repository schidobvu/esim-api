<?php

namespace App\Services\SubmitSIMSwap;

use App\Models\Simswap;
use App\Models\VXViewFootprint;
use App\Models\VXViewToken;
use App\Services\VXView\BuildsUrl;
use App\Services\VXView\TransactionLog;
use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use TNM\IntegrationsFootprints\Requests\TransactionRequest;

class SubmitSwapService
{
    use BuildsUrl, TransactionLog;

    private VXViewFootprint $log;
    private Simswap $simswap;

    public function __construct(Simswap $simswap)
    {
        $this->simswap = $simswap;
    }

    public function submit(): void
    {
        $endpoint = $this->getEndpoint();
        $body = $this->getBody();

        $this->log = VXViewFootprint::logRequest(new TransactionRequest(
                get_class($this),
                now()->timestamp,
                $endpoint,
                json_encode([]),
                json_encode($body),
                $this->simswap->{'number_to_replace'}
            )
        );

        try {
            $this->simswap->increment('submission_attempts');

            $response = $this->submitToRemote($endpoint, $body);

            if (!isset($response->json()['ResponseInfo']['Success'])) {
                $this->onFail('Service unavailable', $response);
                return;
            }

            if ($response->json()['ResponseInfo']['Success'] == 'false') {
                $message = str_contains($response->json('ResponseInfo.Message'), 'not valid for SIM Swap')
                    ? 'Invalid simcard number'
                    : $response->json('ResponseInfo.Message');
                $this->onFail($message, $response);
                return;
            }

            $this->onSuccess($response);
        } catch (Exception $exception) {
            $this->onFail('Service unavailable', $exception);
        }
    }

    protected function onSuccess(PromiseInterface|Response $response): void
    {
        $this->logResponse($response, true);

        $this->simswap->update([
            'submitted_to_vx_at' => now(),
            'submission_success' => true,
        ]);

    }

    protected function onFail(string $error, PromiseInterface|Response|Exception $response): void
    {
        $this->logResponse($response, false);

        if ($this->simswap->fresh()->{'submission_attempts'} < config('app.simswap.attempts_limit')) return;

        $this->simswap->update([
            'submitted_to_vx_at' => now(),
            'submission_success' => false,
        ]);
    }

    protected function submitToRemote(string $endpoint, array $body): Response|PromiseInterface
    {
        return Http::timeout(config('app.simswap.timeout'))
            ->withHeaders(['Authorization' => sprintf('Bearer %s', VXViewToken::getToken())])
            ->post(
                $endpoint,
                $body
            );
    }

    protected function getBody(): array
    {
        return [
            "LogID" => trans_id(),
            "newICCID" => $this->simswap->{'request'}->{'sim_number'},
            "oldICCID" => $this->simswap->{'iccid'}
        ];
    }

    protected function getEndpoint(): string
    {
        return sprintf(
            '%s/customerservices-swap-web/V1/Swap/SIM/subUID/%s',
            $this->getBaseUrl(),
            $this->simswap->{'sub_uid'}
        );
    }
}
