<?php


namespace App\Services\VXView;


class VXViewTokenResponse
{
    private bool $success;
    private $body;

    public function __construct(bool $success, $body = null)
    {
        $this->success = $success;
        $this->body = $body;
    }

    public function success(): bool
    {
        return $this->success;
    }

    public function getToken(): ?string
    {
        if (!$this->success) return null;
        return $this->body;
    }
}
