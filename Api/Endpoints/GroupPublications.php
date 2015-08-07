<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class GroupPublications
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getGroupPublications($accessToken = null, $urn = null, $page = null, $size = null, $sortcreatedDate = null, $expand = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate,
            'expand' => $expand
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/publications', array_filter($parameters));

        return $this->curl;
    }

    public function createMessage($accessToken = null, $urn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/publications', array_filter($parameters));

        return $this->curl;
    }

    public function getBookmarkPublications($accessToken = null, $urn = null, $page = null, $size = null, $sortcreatedDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/publications/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function removeBookmarkPublication($accessToken = null, $publicationUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn
        );

        $parameters['publicationUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/:urn/publications/' . $publicationUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function editBookmarkPublication($accessToken = null, $publicationUrn = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'publicationUrn' => $publicationUrn,
            'bookmark' => $bookmark
        );

        $parameters['publicationUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/:urn/publications/' . $publicationUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function addBookmarkPublication($accessToken = null, $urn = null, $publicationUrn = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'publicationUrn' => $publicationUrn,
            'bookmark' => $bookmark
        );

        $parameters['urn'] = null;
        $parameters['publicationUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/publications/' . $publicationUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function getMessageComments($accessToken = null, $urn = null, $publicationUrn = null, $page = null, $size = null, $sortcreatedDate = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'publicationUrn' => $publicationUrn,
            'page' => $page,
            'size' => $size,
            'sort[createdDate]' => $sortcreatedDate
        );

        $parameters['urn'] = null;
        $parameters['publicationUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/publications/' . $publicationUrn . '/comments', array_filter($parameters));

        return $this->curl;
    }

    public function createComment($accessToken = null, $urn = null, $publicationUrn = null, $text = null, $source = null, $asGroup = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'publicationUrn' => $publicationUrn,
            'text' => $text,
            'source' => $source,
            'asGroup' => $asGroup
        );

        $parameters['urn'] = null;
        $parameters['publicationUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/publications/' . $publicationUrn . '/comments', array_filter($parameters));

        return $this->curl;
    }

    public function unlike($accessToken = null, $urn = null, $publicationUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'publicationUrn' => $publicationUrn
        );

        $parameters['urn'] = null;
        $parameters['publicationUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/publications/' . $publicationUrn . '/like', array_filter($parameters));

        return $this->curl;
    }

    public function like($accessToken = null, $urn = null, $publicationUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'publicationUrn' => $publicationUrn
        );

        $parameters['urn'] = null;
        $parameters['publicationUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/publications/' . $publicationUrn . '/like', array_filter($parameters));

        return $this->curl;
    }
}