<?php

namespace TNM\Auth\Services\Authentication;

interface IAuthenticationService
{
    public function authenticate(string $username, string $password): ?AuthenticationResponse;
}