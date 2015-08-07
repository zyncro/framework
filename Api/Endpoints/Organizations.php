<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class Organizations
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getCurrentUserOrganization($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/organizations', array_filter($parameters));

        return $this->curl;
    }

    public function getConfigurationPublication($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->get($this->oauth['host'] . '/api/organizations/publications/configuration', array_filter($parameters));

        return $this->curl;
    }

    public function editOrganizationFeedConfig($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->put($this->oauth['host'] . '/api/organizations/publications/configuration', array_filter($parameters));

        return $this->curl;
    }

    public function editGroupTypeFeedConfig($accessToken = null, $groupTypeUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'groupTypeUrn' => $groupTypeUrn
        );

        $parameters['groupTypeUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/organizations/publications/configuration/' . $groupTypeUrn . '/types', array_filter($parameters));

        return $this->curl;
    }
}