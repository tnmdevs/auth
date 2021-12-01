<?php

namespace TNM\Auth\Services\Authentication;

use Adldap\AdldapException;
use Adldap\AdldapInterface;
use Adldap\Connections\ProviderInterface;

class LDAPAuthenticationService implements IAuthenticationService
{
    private ProviderInterface $provider;

    /**
     * @throws AdldapException
     */
    public function __construct()
    {
        $ldap = app(AdldapInterface::class);
        $this->provider = $ldap->getDefaultProvider();
    }

    public function authenticate(string $username, string $password): ?AuthenticationResponse
    {
        $authenticated = $this->provider->getGuard()->attempt($username, $password);

        if (!$authenticated) return null;

        $result = $this->provider->search()->where('samaccountname', '=', $username)->first();

        return new AuthenticationResponse(
            $result->getAccountName(),
            $result->getName(),
            $result->getFirstAttribute('mail'),
            msisdn($result->getFirstAttribute('telephonenumber'))->humanize(),
            $result->getFirstAttribute('title')
        );
    }
}