<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Users
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getUsers($accessToken = null, $page = null, $size = null, $sortname = null, $sortlastName = null, $sortcreatedDate = null, $filter = null, $groupUrn = null, $expand = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName,
            'sort[createdDate]' => $sortcreatedDate,
            'filter' => $filter,
            'groupUrn' => $groupUrn,
            'expand' => $expand
        );

        $this->curl->get($this->oauth['host'] . '/api/users', array_filter($parameters));

        return $this->curl;
    }

    public function getBookmarkUsers($accessToken = null, $page = null, $size = null, $sortname = null, $sortlastName = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName
        );

        $this->curl->get($this->oauth['host'] . '/api/users/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function getUserExtended($accessToken = null, $username = null, $profile = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
            'profile' => $profile
        );

        $parameters['username'] = null;

        $this->curl->get($this->oauth['host'] . '/api/users/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function getUser($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->get($this->oauth['host'] . '/api/users/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function getUserAvatar($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->get($this->oauth['host'] . '/api/users/' . $username . '/avatar', array_filter($parameters));

        return $this->curl;
    }

    public function editBookmarkUser($accessToken = null, $username = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
            'bookmark' => $bookmark
        );

        $parameters['username'] = null;

        $this->curl->put($this->oauth['host'] . '/api/users/' . $username . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function addBookmarkUser($accessToken = null, $username = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
            'bookmark' => $bookmark
        );

        $parameters['username'] = null;

        $this->curl->post($this->oauth['host'] . '/api/users/' . $username . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function deleteBookmarkUser($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/users/' . $username . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function followUser($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->post($this->oauth['host'] . '/api/users/' . $username . '/follow', array_filter($parameters));

        return $this->curl;
    }

    public function unfollowUser($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/users/' . $username . '/follow', array_filter($parameters));

        return $this->curl;
    }

    public function getFollowers($accessToken = null, $username = null, $page = null, $size = null, $sortname = null, $sortlastName = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName
        );

        $parameters['username'] = null;

        $this->curl->get($this->oauth['host'] . '/api/users/' . $username . '/followers', array_filter($parameters));

        return $this->curl;
    }

    public function getFollowings($accessToken = null, $username = null, $page = null, $size = null, $sortname = null, $sortlastName = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName
        );

        $parameters['username'] = null;

        $this->curl->get($this->oauth['host'] . '/api/users/' . $username . '/following', array_filter($parameters));

        return $this->curl;
    }
}