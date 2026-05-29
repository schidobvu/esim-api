<?php


namespace App\Services\KYC;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spoofchecker;

class Customer
{
    private array $attributes;
    private bool $success;

    public function __construct(array $attributes, bool $success)
    {
        $this->attributes = $attributes;
        $this->success = $success;
    }

    public function idMatches(string $idNumber): bool
    {
        $spoofChecker = new Spoofchecker();
        return $spoofChecker->areConfusable($this->getIdNumber(), strtoupper($idNumber));
    }

    public function isNotNationalID(): bool
    {
        return $this->attributes['id_type'] != "National ID";
    }

    public function getIdType(): string
    {
        return $this->attributes['id_type'] ?? '';
    }

    public function successful(): bool
    {
        return $this->success;
    }

    public function getId(): ?int
    {
        return $this->attributes['id'] ?? null;
    }

    public function getIdNumber(): string
    {
        return $this->attributes['id_number'] ?? '';
    }

    public function getCustomerType(): int
    {
        return $this->attributes['customer_type'] ?? 1;
    }

    public function getCustomerKey(): string
    {
        return $this->attributes['customer_key'] ?? '';
    }

    public function getName(): string
    {
        return $this->attributes['full_name'] ?? '';
    }

    public function getFirstname(): string
    {
        return $this->attributes['first_name'] ?? '';
    }

    public function getLastname(): string
    {
        return $this->attributes['last_name'] ?? '';
    }

    public function getPhoneNumbers(): Collection
    {
        return collect($this->attributes['phone_numbers']);
    }

    public function isBusiness(): bool
    {
        return $this->getCustomerType() == 2;
    }

    public function notSuccessful(): bool
    {
        return !$this->successful();
    }

    private function stripChars($value, $key = null)
    {
        $except = [
            'date_of_birth',
            'gender',
            'monthly_income',
            'id_number',
            'id_expiry_date'
        ];

        $defaults = [
            'next_of_kin_phone_number' => 0,
            'contact_phone_number' => 0,
            'source_of_income' => 'Other',
            'monthly_income' => 1,
        ];

        if (!is_array($value)) {

            $clean = in_array($key, $except) ? $value : preg_replace('/[^ A-Za-z0-9(N\/A)._\-]/', '', $value);
            if (in_array($key, array_keys($defaults)) && ($clean == '' || !$clean)) return $defaults[$key];

            return (!$clean || $clean == '') ? 'N/A' : $clean;
        }

        $arr = [];
        foreach ($value as $key => $val) $arr[$key] = $this->stripChars($val, $key);

        return $arr;
    }

    public function getKycFormat(string $msisdn): array
    {
        $format = [
            'personal_details' => [
                "first_name" => $this->attributes['first_name'],
                "middle_name" => $this->attributes['other_names'],
                "last_name" => $this->attributes['last_name'],
                "date_of_birth" => str_replace('-', '', $this->attributes['date_of_birth']),
                "gender" => $this->attributes['gender'] == 'M' ? 'male' : 'female',
                "marital_status" => 'N/A',
                "next_of_kin" => $this->attributes['contact_name'],
                "next_of_kin_phone_number" => $this->getContactPhoneNumber(),
                "customer_msisdn" => msisdn($msisdn)->internationalize()
            ],
            'occupation_details' => [
                "source_of_income" => $this->attributes['income_source'],
                "monthly_income" => $this->attributes['income_upper_limit'],
            ],
            'address_details' => [
                "physical_address" => $this->attributes["physical_address"],
                "postal_address" => $this->attributes['postal_address'],
                "district" => $this->attributes['district'],
                "urbanisation" => 'N/A',
                "region" => 'N/A'
            ],
            'id_details' => [
                "id_type" => $this->attributes['id_type'],
                "id_number" => $this->attributes['id_number'],
                "id_expiry_date" => $this->provisionalIdExpiryDate()
            ]
        ];

        return $this->stripChars($format);
    }

    private function getContactPhoneNumber(): ?string
    {
        return $this->attributes['contact_phone'] && is_valid_malawian_number($this->attributes['contact_phone'])
            ? $this->attributes['contact_phone'] : null;
    }

    private function hasExpiredId(): bool
    {
        return Carbon::parse($this->attributes['id_expiry_date'])->isBefore(today());
    }

    private function provisionalIdExpiryDate(): array|string
    {
        return str_replace('-', '', $this->hasExpiredId()
            ? today()->addDay()->toDateString()
            : $this->attributes['id_expiry_date']);
    }

    public function toArray(string $msisdn)
    {
        $format = [
            "first_name" => $this->attributes['first_name'],
            "other_names" => $this->attributes['other_names'],
            "last_name" => $this->attributes['last_name'],
            "date_of_birth" => str_replace('-', '', $this->attributes['date_of_birth']),
            "gender" => $this->attributes['gender'] == 'M' ? 'male' : 'female',
            "marital_status" => 'N/A',
            "contact_name" => $this->attributes['contact_name'],
            "contact_relationship" => $this->attributes['contact_relationship'],
            "contact_phone_number" => $this->getContactPhoneNumber(),
            "msisdn" => msisdn($msisdn)->internationalize(),

            "income_source" => $this->attributes['income_source'],
            "monthly_income" => $this->attributes['income_upper_limit'],

            "physical_address" => $this->attributes["physical_address"],
            "postal_address" => $this->attributes['postal_address'],
            "district" => $this->getDistrictCode($this->attributes['district']),
            "home_district" => $this->attributes['home_district'],
            "urbanisation" => 'N/A',
            "region" => 'N/A',
            "ta" => $this->attributes['district'],

            "id_type" => $this->getIdCode(),
            "id_number" => $this->attributes['id_number'],
            "id_expiry_date" => $this->provisionalIdExpiryDate(),
        ];

        return $this->stripChars($format);
    }

    private function getIdCode(): ?string
    {
        $idTypes = [
            'Chiphaso cha Unzika' => '01',
            'Driver\'s Licence' => '05',
            'Drivers Licence' => '05',
            'Driving Licence' => '05',
            'Driving License' => '05',
            'National ID' => '01',
            'Passport' => '02',
            'Voters ID' => '04',
        ];

        return $this->map($idTypes, $this->attributes['id_type']);
    }

    private function getDistrictCode(?string $district): ?string
    {
        $districts = [
            'dowa' => '01',
            'kasungu' => '02',
            'lilongwe' => '03',
            'mchinji' => '04',
            'nkhotakota' => '05',
            'ntcheu' => '06',
            'ntchisi' => '07',
            'salima' => '08',
            'karonga' => '09',
            'likoma' => '10',
            'mzimba' => '11',
            'nkhatabay' => '12',
            'rumphi' => '13',
            'blantyre' => '14',
            'chikhwawa' => '15',
            'chikwawa' => '15',
            'chiradzulu' => '16',
            'machinga' => '17',
            'mangochi' => '18',
            'mulanje' => '19',
            'mwanza' => '20',
            'nsanje' => '21',
            'thyolo' => '22',
            'phalombe' => '23',
            'zomba' => '24',
            'neno' => '25',
            'dedza' => '26',
            'balaka' => '27',
            'chitipa' => '28',
        ];

        return $this->map($districts, strtolower($district));
    }

    private function map(array $array, string $key): ?string
    {
        if (!array_key_exists($key, $array)) return null;

        return $array[$key];
    }
}
