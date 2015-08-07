<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class OAuth2
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function login($username, $password)
    {
        $parameters = array(
            'grant_type' => $this->oauth['grant_type_login'],
            'client_id' => $this->oauth['client_id'],
            'client_secret' => $this->oauth['client_secret'],
            'scope' => $this->oauth['scope'],
            'username' => $username,
            'password' => $password
        );

        $this->curl->post($this->oauth['host'] . '/oauth/token', $parameters);

        return $this->curl;
    }

    public function refreshToken($refreshToken)
    {
        $parameters = array(
            'grant_type' => $this->oauth['grant_type_refresh'],
            'client_id' => $this->oauth['client_id'],
            'client_secret' => $this->oauth['client_secret'],
            'scope' => $this->oauth['scope'],
            'refresh_token' => $refreshToken
        );

        $this->curl->post($this->oauth['host'] . '/oauth/token', $parameters);

        return $this->curl;
    }
}