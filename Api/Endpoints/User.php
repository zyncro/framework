<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class User
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getUser($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/user', array_filter($parameters));

        return $this->curl;
    }

    public function getUserExtended($accessToken = null, $profile = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'profile' => $profile
        );

        $this->curl->get($this->oauth['host'] . '/api/user', array_filter($parameters));

        return $this->curl;
    }

    public function updateUser($accessToken = null, $address = null, $area = null, $avatar = null, $bornDate = null, $city = null, $country = null, $education = null, $experience = null, $formatDate = null, $mobilePhone = null, $other = null, $position = null, $skypeUser = null, $timeZone = null, $website = null, $workPhone = null, $province = null, $workPhoneExtension = null, $mobilePhoneExtension = null, $showSkypeUser = null, $skills = null, $name = null, $lastName = null, $email = null, $organizationRoleUrn = null, $emailVisibilityType = null, $linkedinId = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'address' => $address,
            'area' => $area,
            'avatar' => $avatar,
            'bornDate' => $bornDate,
            'city' => $city,
            'country' => $country,
            'education' => $education,
            'experience' => $experience,
            'formatDate' => $formatDate,
            'mobilePhone' => $mobilePhone,
            'other' => $other,
            'position' => $position,
            'skypeUser' => $skypeUser,
            'timeZone' => $timeZone,
            'website' => $website,
            'workPhone' => $workPhone,
            'province' => $province,
            'workPhoneExtension' => $workPhoneExtension,
            'mobilePhoneExtension' => $mobilePhoneExtension,
            'showSkypeUser' => $showSkypeUser,
            'skills' => $skills,
            'name' => $name,
            'lastName' => $lastName,
            'email' => $email,
            'organizationRoleUrn' => $organizationRoleUrn,
            'emailVisibilityType' => $emailVisibilityType,
            'linkedinId' => $linkedinId
        );

        $this->curl->put($this->oauth['host'] . '/api/user', array_filter($parameters));

        return $this->curl;
    }

    public function uploadUserAvatar($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->post($this->oauth['host'] . '/api/user/avatar', array_filter($parameters));

        return $this->curl;
    }

    public function getFeedConfiguration($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/user/feed', array_filter($parameters));

        return $this->curl;
    }

    public function getFollowers($accessToken = null, $page = null, $size = null, $sortname = null, $sortlastName = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName
        );

        $this->curl->get($this->oauth['host'] . '/api/user/followers', array_filter($parameters));

        return $this->curl;
    }

    public function removeFollower($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/user/followers/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function getFollowings($accessToken = null, $page = null, $size = null, $sortname = null, $sortlastName = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName
        );

        $this->curl->get($this->oauth['host'] . '/api/user/following', array_filter($parameters));

        return $this->curl;
    }

    public function acceptsInvitation($accessToken = null, $groupUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupUrn' => $groupUrn
        );

        $this->curl->put($this->oauth['host'] . '/api/user/invitations', array_filter($parameters));

        return $this->curl;
    }

    public function cancelInvitation($accessToken = null, $groupUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupUrn' => $groupUrn
        );

        $this->curl->delete($this->oauth['host'] . '/api/user/invitations', array_filter($parameters));

        return $this->curl;
    }

    public function getInvitations($accessToken = null, $page = null, $size = null, $sortcreatedDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate
        );

        $this->curl->get($this->oauth['host'] . '/api/user/invitations', array_filter($parameters));

        return $this->curl;
    }

    public function userEditPublicationConfiguration($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->put($this->oauth['host'] . '/api/user/publications/configuration', array_filter($parameters));

        return $this->curl;
    }
}