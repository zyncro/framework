<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Invitations
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
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

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/invitations', array_filter($parameters));

        return $this->curl;
    }

    public function cancelGroupInvitationFromInviterUser($accessToken = null, $urn = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/invitations/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function inviteUser($accessToken = null, $urn = null, $username = null, $groupRoleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'username' => $username,
            'groupRoleUrn' => $groupRoleUrn
        );

        $parameters['urn'] = null;
        $parameters['username'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/invitations/' . $username . '', array_filter($parameters));

        return $this->curl;
    }
}