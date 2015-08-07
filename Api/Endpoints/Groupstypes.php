<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Groupstypes
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function createGroupType($accessToken = null, $name = null, $description = null, $visible = null, $hasWall = null, $hasFiles = null, $groupRoleUrn = null, $visibleMembers = null, $public = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'description' => $description,
            'visible' => $visible,
            'hasWall' => $hasWall,
            'hasFiles' => $hasFiles,
            'groupRoleUrn' => $groupRoleUrn,
            'visibleMembers' => $visibleMembers,
            'public' => $public
        );

        $this->curl->post($this->oauth['host'] . '/api/groups/types', array_filter($parameters));

        return $this->curl;
    }

    public function getGroupTypes($accessToken = null, $page = null, $size = null, $sortname = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname
        );

        $this->curl->get($this->oauth['host'] . '/api/groups/types', array_filter($parameters));

        return $this->curl;
    }

    public function getGroup($accessToken = null, $groupTypeUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupTypeUrn' => $groupTypeUrn
        );

        $parameters['groupTypeUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/types/' . $groupTypeUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function editGroupType($accessToken = null, $groupTypeUrn = null, $name = null, $description = null, $visible = null, $hasWall = null, $hasFiles = null, $groupRoleUrn = null, $visibleMembers = null, $public = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupTypeUrn' => $groupTypeUrn,
            'name' => $name,
            'description' => $description,
            'visible' => $visible,
            'hasWall' => $hasWall,
            'hasFiles' => $hasFiles,
            'groupRoleUrn' => $groupRoleUrn,
            'visibleMembers' => $visibleMembers,
            'public' => $public
        );

        $parameters['groupTypeUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/types/' . $groupTypeUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteGroupType($accessToken = null, $groupTypeUrn = null, $urnGroupTypeDelegated = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupTypeUrn' => $groupTypeUrn,
            'urnGroupTypeDelegated' => $urnGroupTypeDelegated
        );

        $parameters['groupTypeUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/types/' . $groupTypeUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function getConfigurationPublication($accessToken = null, $groupTypeUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupTypeUrn' => $groupTypeUrn
        );

        $parameters['groupTypeUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/types/' . $groupTypeUrn . '/publications/configuration', array_filter($parameters));

        return $this->curl;
    }
}