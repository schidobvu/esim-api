<?php

namespace App\Services\CheckESimStatus;

class ESimStatusCheckerClient
{
    private IESimStatusCheckerService $service;

    public function __construct()
    {
        $this->service = resolve(IESimStatusCheckerService::class);
    }

    public function query(string $iccid): ESimStatusCheckerResponse
    {
        return $this->service->query($iccid);
    }
}
