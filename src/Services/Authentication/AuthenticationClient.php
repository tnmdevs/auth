<?php

namespace TNM\Auth\Services\Authentication;

class AuthenticationClient
{
    private string $username;
    private string $password;
    private IAuthenticationService $service;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->service = app(IAuthenticationService::class);
    }

    public function authenticate(): ?AuthenticationResponse
    {
        return $this->service->authenticate($this->username, $this->password);
    }
}