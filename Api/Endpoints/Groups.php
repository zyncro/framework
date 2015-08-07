<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Groups
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getGroups($accessToken = null, $page = null, $size = null, $filter = null, $sortname = null, $sorttotalMembers = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'filter' => $filter,
            'sort[name]' => $sortname,
            'sort[totalMembers]' => $sorttotalMembers
        );

        $this->curl->get($this->oauth['host'] . '/api/groups', array_filter($parameters));

        return $this->curl;
    }

    public function createGroup($accessToken = null, $name = null, $description = null, $visible = null, $groupTypeUrn = null, $visibleMembers = null, $public = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'description' => $description,
            'visible' => $visible,
            'groupTypeUrn' => $groupTypeUrn,
            'visibleMembers' => $visibleMembers,
            'public' => $public
        );

        $this->curl->post($this->oauth['host'] . '/api/groups', array_filter($parameters));

        return $this->curl;
    }

    public function getBookmarkGroups($accessToken = null, $page = null, $size = null, $sortname = null, $sorttotalMembers = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[totalMembers]' => $sorttotalMembers
        );

        $this->curl->get($this->oauth['host'] . '/api/groups/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function moveGroupRoot($accessToken = null, $groupUrnToMove = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupUrnToMove' => $groupUrnToMove
        );

        $parameters['groupUrnToMove'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $groupUrnToMove . '/move', array_filter($parameters));

        return $this->curl;
    }

    public function moveGroup($accessToken = null, $groupUrnToMove = null, $parentGroupUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupUrnToMove' => $groupUrnToMove,
            'parentGroupUrn' => $parentGroupUrn
        );

        $parameters['groupUrnToMove'] = null;
        $parameters['parentGroupUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $groupUrnToMove . '/move/' . $parentGroupUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteGroup($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '', array_filter($parameters));

        return $this->curl;
    }

    public function getGroup($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '', array_filter($parameters));

        return $this->curl;
    }

    public function editGroup($accessToken = null, $urn = null, $name = null, $description = null, $visible = null, $visibleMembers = null, $groupTypeUrn = null, $groupRoleUrn = null, $hasWall = null, $hasFiles = null, $public = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'name' => $name,
            'description' => $description,
            'visible' => $visible,
            'visibleMembers' => $visibleMembers,
            'groupTypeUrn' => $groupTypeUrn,
            'groupRoleUrn' => $groupRoleUrn,
            'hasWall' => $hasWall,
            'hasFiles' => $hasFiles,
            'public' => $public
        );

        $parameters['urn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '', array_filter($parameters));

        return $this->curl;
    }

    public function uploadGroupAvatar($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/avatar', array_filter($parameters));

        return $this->curl;
    }

    public function deleteBookmarkGroup($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function editBookmarkGroup($accessToken = null, $urn = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'bookmark' => $bookmark
        );

        $parameters['urn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function addBookmarkGroup($accessToken = null, $urn = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'bookmark' => $bookmark
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function editFeedConfiguration($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/publications/configuration', array_filter($parameters));

        return $this->curl;
    }

    public function getConfigurationPublication($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/publications/configuration', array_filter($parameters));

        return $this->curl;
    }

    public function getSubgroups($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/subgroups', array_filter($parameters));

        return $this->curl;
    }

    public function createSubgroup($accessToken = null, $urn = null, $name = null, $description = null, $visible = null, $groupTypeUrn = null, $visibleMembers = null, $public = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'name' => $name,
            'description' => $description,
            'visible' => $visible,
            'groupTypeUrn' => $groupTypeUrn,
            'visibleMembers' => $visibleMembers,
            'public' => $public
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/subgroups', array_filter($parameters));

        return $this->curl;
    }
}