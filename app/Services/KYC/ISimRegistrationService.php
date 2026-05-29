<?php


namespace App\Services\KYC;


interface ISimRegistrationService
{
    public function query(string $msisdn): Customer;
}
