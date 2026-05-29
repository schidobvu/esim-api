<?php

namespace App\Services\GetQRCode;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FakeGetESimQRCodeService implements IGetESimQRCodeService
{
    public function query(string $iccid): GetESimQRCodeResponse
    {
        return new GetESimQRCodeResponse([], true, ResponseAlias::HTTP_OK);
    }
}
