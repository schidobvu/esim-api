<?php

namespace App\Services\GetQRCode;

class GetESimQRCodeClient
{
    private IGetESimQRCodeService $service;

    public function __construct()
    {
        $this->service = resolve(IGetESimQRCodeService::class);
    }

    public function query(string $iccid): GetESimQRCodeResponse
    {
        return $this->service->query($iccid);
    }
}
