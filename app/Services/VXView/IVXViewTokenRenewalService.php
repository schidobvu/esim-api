<?php


namespace App\Services\VXView;


interface IVXViewTokenRenewalService
{
    public function query(): VXViewTokenResponse;
}
