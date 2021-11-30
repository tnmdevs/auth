<?php

namespace TNM\Auth;

use Illuminate\Support\ServiceProvider;
use TNM\Auth\Services\Authentication\IAuthenticationService;
use TNM\Auth\Services\Authentication\LDAPAuthenticationService;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/config/ldap.php' => config_path('ldap.php'),
                __DIR__.'/config/ldap_auth.php' => config_path('ldap_auth.php')
            ], 'config');

        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/ldap.php', 'ldap');
        $this->mergeConfigFrom(__DIR__.'/config/ldap_auth.php', 'ldap_auth');

        $this->app->bind(IAuthenticationService::class, LDAPAuthenticationService::class);
    }
}