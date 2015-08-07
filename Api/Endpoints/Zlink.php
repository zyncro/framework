<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Zlink
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getZlinks($accessToken = null, $page = null, $size = null, $sorttoken = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[token]' => $sorttoken
        );

        $this->curl->get($this->oauth['host'] . '/api/zlink/list', array_filter($parameters));

        return $this->curl;
    }

    public function createZlink($accessToken = null, $documentUrn = null, $password = null, $description = null, $instructions = null, $expirationDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'password' => $password,
            'description' => $description,
            'instructions' => $instructions,
            'expirationDate' => $expirationDate
        );

        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/zlink/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function getZlinksByDocument($accessToken = null, $documentUrn = null, $page = null, $size = null, $sorttoken = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'page' => $page,
            'size' => $size,
            'sort[token]' => $sorttoken
        );

        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/zlink/' . $documentUrn . '/list', array_filter($parameters));

        return $this->curl;
    }

    public function editZlink($accessToken = null, $token = null, $password = null, $description = null, $instructions = null, $expirationDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'token' => $token,
            'password' => $password,
            'description' => $description,
            'instructions' => $instructions,
            'expirationDate' => $expirationDate
        );

        $parameters['token'] = null;

        $this->curl->put($this->oauth['host'] . '/api/zlink/' . $token . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteZlink($accessToken = null, $token = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'token' => $token
        );

        $parameters['token'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/zlink/' . $token . '', array_filter($parameters));

        return $this->curl;
    }

    public function getZlink($accessToken = null, $token = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'token' => $token
        );

        $parameters['token'] = null;

        $this->curl->get($this->oauth['host'] . '/api/zlink/' . $token . '', array_filter($parameters));

        return $this->curl;
    }

    public function downloadZlink($accessToken = null, $token = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'token' => $token
        );

        $parameters['token'] = null;

        $this->curl->get($this->oauth['host'] . '/api/zlink/' . $token . '/download', array_filter($parameters));

        return $this->curl;
    }
}