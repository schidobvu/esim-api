<?php

namespace App\Services\CheckESimStatus;

class ESimStatusCheckerResponse
{
    private array $response;
    private bool $success;
    private int $status;

    public function __construct(array $response, bool $success, int $status)
    {
        $this->response = $response;
        $this->success = $success;
        $this->status = $status;
    }

    public function array(): array
    {
        return $this->response;
    }

    public function success(): bool
    {
        return $this->success;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function isOk(): bool
    {
        return ($this->response['statusCode'] ?? 0) === 1;
    }

    public function statusCode(): int
    {
        return $this->response['statusCode'] ?? 0;
    }

    public function remark(): ?string
    {
        return $this->response['remark'] ?? null;
    }

    public function hasErrors(): bool
    {
        return !empty($this->response['errors'] ?? []);
    }

    public function errors(): array
    {
        return $this->response['errors'] ?? [];
    }

    public function data(): array
    {
        return $this->response['data'] ?? [];
    }

    public function globalConfiguration(): ?array
    {
        return $this->data()['globalConfiguration'] ?? null;
    }

    public function terminalConfiguration(): ?array
    {
        return $this->data()['terminalConfiguration'] ?? null;
    }

    public function taxpayerConfiguration(): ?array
    {
        return $this->data()['taxpayerConfiguration'] ?? null;
    }

    public function taxRates(): array
    {
        return $this->globalConfiguration()['taxRates'] ?? [];
    }

    public function activatedTaxRateIds(): array
    {
        return $this->taxpayerConfiguration()['activatedTaxRateIds'] ?? [];
    }

    public function tin(): ?string
    {
        return $this->taxpayerConfiguration()['tin'] ?? null;
    }

    public function isVatRegistered(): bool
    {
        return (bool) ($this->taxpayerConfiguration()['isVATRegistered'] ?? false);
    }

    public function taxOffice(): ?array
    {
        return $this->taxpayerConfiguration()['taxOffice'] ?? null;
    }

    public function offlineLimit(): ?array
    {
        return $this->terminalConfiguration()['offlineLimit'] ?? null;
    }

    public function maxOfflineAmount(): ?int
    {
        return $this->offlineLimit()['maxCummulativeAmount'] ?? null;
    }

    public function maxOfflineAgeHours(): ?int
    {
        return $this->offlineLimit()['maxTransactionAgeInHours'] ?? null;
    }
}
