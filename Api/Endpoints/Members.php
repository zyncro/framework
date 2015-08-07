<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Members
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function createMember($accessToken = null, $urn = null, $username = null, $groupRoleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username,
            'groupRoleUrn' => $groupRoleUrn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/members', array_filter($parameters));

        return $this->curl;
    }

    public function getMembers($accessToken = null, $urn = null, $page = null, $size = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'page' => $page,
            'size' => $size
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/members', array_filter($parameters));

        return $this->curl;
    }

    public function leaveGroup($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/members', array_filter($parameters));

        return $this->curl;
    }

    public function getFeedConfiguration($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/members/feed', array_filter($parameters));

        return $this->curl;
    }

    public function joinGroup($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/members/join', array_filter($parameters));

        return $this->curl;
    }

    public function updateMember($accessToken = null, $urn = null, $username = null, $groupRoleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username,
            'groupRoleUrn' => $groupRoleUrn
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/members/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteMember($accessToken = null, $urn = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/members/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function memberCreatePublicationConfiguration($accessToken = null, $urn = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/members/' . $username . '/publications/configuration', array_filter($parameters));

        return $this->curl;
    }

    public function memberEditPublicationConfiguration($accessToken = null, $urn = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/members/' . $username . '/publications/configuration', array_filter($parameters));

        return $this->curl;
    }
}