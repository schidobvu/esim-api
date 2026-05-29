<?php


namespace App\Services\KYC;


class FakeSimRegistrationService implements ISimRegistrationService
{

    public function query(string $msisdn): Customer
    {
        return new Customer([
            'id_type' => 'National ID',
            'full_name' => 'Chimwemwe Kampingo',
            'id' => 1,
            'customer_key' => 'C00000000000000001',
            'phone_numbers' => ['0889399974', '0889399970', '088999971', '0889399997', '0889398882', '0889399973']
        ], true);
    }
}
