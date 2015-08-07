<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Membership
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function membershipRequest($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/membership', array_filter($parameters));

        return $this->curl;
    }

    public function getInvitations($accessToken = null, $urn = null, $page = null, $size = null, $sortcreatedDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/membership', array_filter($parameters));

        return $this->curl;
    }

    public function denyGroupJoinRequest($accessToken = null, $urn = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/membership/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function approveGroupJoinRequest($accessToken = null, $urn = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/membership/' . $username . '', array_filter($parameters));

        return $this->curl;
    }
}