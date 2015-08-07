<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class AdminUsers
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getUsers($accessToken = null, $page = null, $size = null, $sortname = null, $sortlastName = null, $sortcreatedDate = null, $filter = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[lastName]' => $sortlastName,
            'sort[createdDate]' => $sortcreatedDate,
            'filter' => $filter
        );

        $this->curl->get($this->oauth['host'] . '/api/admin/users', array_filter($parameters));

        return $this->curl;
    }

    public function createUser($accessToken = null, $name = null, $lastName = null, $email = null, $organizationRoleUrn = null, $emailVisibilityType = null, $password = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'lastName' => $lastName,
            'email' => $email,
            'organizationRoleUrn' => $organizationRoleUrn,
            'emailVisibilityType' => $emailVisibilityType,
            'password' => $password
        );

        $this->curl->post($this->oauth['host'] . '/api/admin/users', array_filter($parameters));

        return $this->curl;
    }

    public function getGroupPermissions($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/admin/users/permissions', array_filter($parameters));

        return $this->curl;
    }

    public function getUserExtended($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->get($this->oauth['host'] . '/api/admin/users/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function updateUser($accessToken = null, $username = null, $address = null, $area = null, $avatar = null, $bornDate = null, $city = null, $country = null, $education = null, $experience = null, $formatDate = null, $mobilePhone = null, $other = null, $position = null, $skypeUser = null, $timeZone = null, $website = null, $workPhone = null, $province = null, $workPhoneExtension = null, $mobilePhoneExtension = null, $showSkypeUser = null, $skills = null, $name = null, $lastName = null, $email = null, $organizationRoleUrn = null, $emailVisibilityType = null, $linkedinId = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
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

        $parameters['username'] = null;

        $this->curl->put($this->oauth['host'] . '/api/admin/users/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteUser($accessToken = null, $username = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username
        );

        $parameters['username'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/admin/users/' . $username . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteUserWithDelegate($accessToken = null, $username = null, $delegateUsername = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'username' => $username,
            'delegateUsername' => $delegateUsername
        );

        $parameters['username'] = null;
        $parameters['delegateUsername'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/admin/users/' . $username . '/delegate/' . $delegateUsername . '', array_filter($parameters));

        return $this->curl;
    }
}