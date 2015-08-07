<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Version
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getVersion($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/version', array_filter($parameters));

        return $this->curl;
    }
}