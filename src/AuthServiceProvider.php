<?php

namespace TNM\Auth;

use Illuminate\Support\ServiceProvider;
use TNM\Auth\Services\Authentication\IAuthenticationService;
use TNM\Auth\Services\Authentication\LDAPAuthenticationService;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(IAuthenticationService::class, LDAPAuthenticationService::class);
    }
}