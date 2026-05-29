<?php

namespace App\Services\GetQRCode;

interface IGetESimQRCodeService
{
    public function query(string $iccid): GetESimQRCodeResponse;
}
