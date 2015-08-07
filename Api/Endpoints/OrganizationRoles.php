<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class OrganizationRoles
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getOrganizationRolesPaginatedList($accessToken = null, $page = null, $size = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size
        );

        $this->curl->get($this->oauth['host'] . '/api/organizations/roles', array_filter($parameters));

        return $this->curl;
    }

    public function createOrganizationRole($accessToken = null, $name = null, $authorities = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'authorities' => $authorities
        );

        $this->curl->post($this->oauth['host'] . '/api/organizations/roles', array_filter($parameters));

        return $this->curl;
    }

    public function getOrganizationRole($accessToken = null, $roleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'roleUrn' => $roleUrn
        );

        $parameters['roleUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/organizations/roles/' . $roleUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function updateOrganizationRole($accessToken = null, $roleUrn = null, $name = null, $authorities = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'roleUrn' => $roleUrn,
            'name' => $name,
            'authorities' => $authorities
        );

        $parameters['roleUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/organizations/roles/' . $roleUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteOrganizationRole($accessToken = null, $roleUrn = null, $newRoleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'roleUrn' => $roleUrn,
            'newRoleUrn' => $newRoleUrn
        );

        $parameters['roleUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/organizations/roles/' . $roleUrn . '', array_filter($parameters));

        return $this->curl;
    }
}