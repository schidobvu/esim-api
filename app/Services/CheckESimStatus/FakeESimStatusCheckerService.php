<?php

namespace App\Services\CheckESimStatus;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FakeESimStatusCheckerService implements IESimStatusCheckerService
{
    public function query(string $iccid): ESimStatusCheckerResponse
    {
        return new ESimStatusCheckerResponse([], true, ResponseAlias::HTTP_OK);
    }
}
