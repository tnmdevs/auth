<?php

namespace TNM\Auth\Services\Authentication;

use LdapRecord\Auth\PasswordRequiredException;
use LdapRecord\Auth\UsernameRequiredException;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User;

class LDAPAuthenticationService implements IAuthenticationService
{
    /**
     * @throws UsernameRequiredException
     * @throws PasswordRequiredException
     */
    public function authenticate(string $username, string $password): ?AuthenticationResponse
    {
        $connection = Container::getDefaultConnection();

        $authenticated = $connection->auth()->attempt($username, $password);

        if (!$authenticated) {
            return null;
        }

        $result = (new User)->whereEquals('samaccountname', $username)->first();

        if (!$result) {
            return null;
        }

        $phone = $result->getFirstAttribute('telephonenumber');

        $msisdn = $phone
            ? msisdn($phone)->humanize()
            : null;

        return new AuthenticationResponse(
            $result->getFirstAttribute('samaccountname'),
            $result->getFirstAttribute('cn'),
            $result->getFirstAttribute('mail'),
            $msisdn,
            $result->getFirstAttribute('title')
        );
    }
}