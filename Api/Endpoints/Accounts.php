<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Accounts
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function createAccount($accessToken = null, $organizationName = null, $email = null, $password = null, $name = null, $lastName = null, $type = null, $expirationDays = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'organizationName' => $organizationName,
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'lastName' => $lastName,
            'type' => $type,
            'expirationDays' => $expirationDays
        );

        $this->curl->post($this->oauth['host'] . '/api/accounts', array_filter($parameters));

        return $this->curl;
    }

    public function createPasswordRecovery($accessToken = null, $email = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'email' => $email
        );

        $this->curl->post($this->oauth['host'] . '/api/accounts/password/recovery', array_filter($parameters));

        return $this->curl;
    }

    public function updatePassword($accessToken = null, $email = null, $token = null, $password = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'email' => $email,
            'token' => $token,
            'password' => $password
        );

        $this->curl->put($this->oauth['host'] . '/api/accounts/password/recovery', array_filter($parameters));

        return $this->curl;
    }
}