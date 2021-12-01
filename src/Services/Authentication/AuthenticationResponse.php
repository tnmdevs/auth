<?php

namespace TNM\Auth\Services\Authentication;

class AuthenticationResponse
{
    private string $username;
    private string $name;
    private string $email;
    private string $phoneNumber;
    private ?string $position;

    public function __construct(string $username, string $name, string $email, string $phoneNumber, ?string $position = null)
    {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->position = $position;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'msisdn' => $this->phoneNumber,
            'position' => $this->position
        ];
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }
}