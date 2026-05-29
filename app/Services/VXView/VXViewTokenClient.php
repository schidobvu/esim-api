<?php


namespace App\Services\VXView;


use App\Models\VXViewToken;
use App\Services\BaseScript;
use TNM\VXView\Models\AccessToken;

class VXViewTokenClient
{
    private IVXViewTokenRenewalService $service;

    public function __construct()
    {
        $this->service = app(IVXViewTokenRenewalService::class);
    }

    public function process(): void
    {
        $response = $this->service->query();

        if (!$response->success()) return;

        VXViewToken::refreshToken($response->getToken());
        AccessToken::updateOrCreate([], ['token' => $response->getToken()]);
    }
}
