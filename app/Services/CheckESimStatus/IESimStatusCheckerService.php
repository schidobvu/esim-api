<?php

namespace App\Services\CheckESimStatus;

interface IESimStatusCheckerService
{
    public function query(string $iccid): ESimStatusCheckerResponse;
}
