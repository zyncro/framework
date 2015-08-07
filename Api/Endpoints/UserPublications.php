<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class UserPublications
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getMainWallPublications($accessToken = null, $page = null, $size = null, $sortcreatedDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate
        );

        $this->curl->get($this->oauth['host'] . '/api/user/publications', array_filter($parameters));

        return $this->curl;
    }

    public function createMessage($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->post($this->oauth['host'] . '/api/user/publications', array_filter($parameters));

        return $this->curl;
    }

    public function getPublicationByUrn($accessToken = null, $publicationUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn
        );

        $parameters['publicationUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/publications/' . $publicationUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function createComment($accessToken = null, $publicationUrn = null, $text = null, $source = null, $asGroup = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn,
            'text' => $text,
            'source' => $source,
            'asGroup' => $asGroup
        );

        $parameters['publicationUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/publications/' . $publicationUrn . '/comments', array_filter($parameters));

        return $this->curl;
    }

    public function getMessageComments($accessToken = null, $publicationUrn = null, $page = null, $size = null, $sortcreatedDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate
        );

        $parameters['publicationUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/publications/' . $publicationUrn . '/comments', array_filter($parameters));

        return $this->curl;
    }

    public function unlike($accessToken = null, $publicationUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn
        );

        $parameters['publicationUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/user/publications/' . $publicationUrn . '/like', array_filter($parameters));

        return $this->curl;
    }

    public function like($accessToken = null, $publicationUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn
        );

        $parameters['publicationUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/publications/' . $publicationUrn . '/like', array_filter($parameters));

        return $this->curl;
    }
}