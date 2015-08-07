<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class GroupRoles
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function createGroupRole($accessToken = null, $name = null, $authorities = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'authorities' => $authorities
        );

        $this->curl->post($this->oauth['host'] . '/api/groups/roles', array_filter($parameters));

        return $this->curl;
    }

    public function getGroupRolesPaginatedList($accessToken = null, $page = null, $size = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size
        );

        $this->curl->get($this->oauth['host'] . '/api/groups/roles', array_filter($parameters));

        return $this->curl;
    }

    public function getGroupPermissions($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/groups/roles/permissions', array_filter($parameters));

        return $this->curl;
    }

    public function deleteGroupRole($accessToken = null, $roleUrn = null, $newRoleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'roleUrn' => $roleUrn,
            'newRoleUrn' => $newRoleUrn
        );

        $parameters['roleUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/roles/' . $roleUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function getGroupRole($accessToken = null, $roleUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'roleUrn' => $roleUrn
        );

        $parameters['roleUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/roles/' . $roleUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function updateGroupRole($accessToken = null, $roleUrn = null, $name = null, $authorities = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'roleUrn' => $roleUrn,
            'name' => $name,
            'authorities' => $authorities
        );

        $parameters['roleUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/roles/' . $roleUrn . '', array_filter($parameters));

        return $this->curl;
    }
}