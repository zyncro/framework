<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class AdminOrganizations
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function updateOrganization($accessToken = null, $urn = null, $canCreateZlinks = null, $name = null, $allowsZlink = null, $owner = null, $type = null, $totalUsers = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'canCreateZlinks' => $canCreateZlinks,
            'name' => $name,
            'allowsZlink' => $allowsZlink,
            'owner' => $owner,
            'type' => $type,
            'totalUsers' => $totalUsers
        );

        $this->curl->put($this->oauth['host'] . '/api/admin/organizations', array_filter($parameters));

        return $this->curl;
    }
}