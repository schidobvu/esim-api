<?php


namespace App\Services\KYC;


class CustomerClient
{
    private string $msisdn;
    private ISimRegistrationService $service;

    public function __construct(string $msisdn)
    {
        $this->msisdn = $msisdn;
        $this->service = app(ISimRegistrationService::class);
    }

    public function query(): Customer
    {
        return $this->service->query($this->msisdn);
    }
}
