<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class GroupDocuments
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getDocuments($accessToken = null, $urn = null, $page = null, $size = null, $sortname = null, $sortcreatedDate = null, $sortsize = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[createdDate]' => $sortcreatedDate,
            'sort[size]' => $sortsize
        );

        $parameters['urn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents', array_filter($parameters));

        return $this->curl;
    }

    public function getBookmarkDocuments($accessToken = null, $page = null, $size = null, $sortname = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname
        );

        $this->curl->get($this->oauth['host'] . '/api/groups/:urn/documents/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function initiateChunkedFileUpload($accessToken = null, $urn = null, $name = null, $description = null, $uploadKey = null, $md5 = null, $totalSize = null, $totalChunks = null, $chunkSize = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'name' => $name,
            'description' => $description,
            'uploadKey' => $uploadKey,
            'md5' => $md5,
            'totalSize' => $totalSize,
            'totalChunks' => $totalChunks,
            'chunkSize' => $chunkSize
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/chunked', array_filter($parameters));

        return $this->curl;
    }

    public function uploadChunkedFile($accessToken = null, $urn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'uploadKey' => $uploadKey
        );

        $parameters['urn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function getChunkedFileUploadStatus($accessToken = null, $urn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'uploadKey' => $uploadKey
        );

        $parameters['urn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function abortChunkedFileUpload($accessToken = null, $urn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'uploadKey' => $uploadKey
        );

        $parameters['urn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/documents/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function uploadFile($accessToken = null, $urn = null, $name = null, $description = null, $parentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'name' => $name,
            'description' => $description,
            'parentUrn' => $parentUrn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/file', array_filter($parameters));

        return $this->curl;
    }

    public function uploadFileVersion($accessToken = null, $urn = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/file/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function createFolder($accessToken = null, $urn = null, $name = null, $description = null, $parentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'name' => $name,
            'description' => $description,
            'parentUrn' => $parentUrn
        );

        $parameters['urn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/folder', array_filter($parameters));

        return $this->curl;
    }

    public function deleteDocument($accessToken = null, $urn = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function updateDocument($accessToken = null, $urn = null, $documentUrn = null, $name = null, $description = null, $parentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'name' => $name,
            'description' => $description,
            'parentUrn' => $parentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function editBookmarkGroupDocument($accessToken = null, $urn = null, $documentUrn = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'bookmark' => $bookmark
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function removeBookmarkGroupDocument($accessToken = null, $urn = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function addBookmarkGroupDocument($accessToken = null, $urn = null, $documentUrn = null, $bookmark = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'bookmark' => $bookmark
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function download($accessToken = null, $urn = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/download', array_filter($parameters));

        return $this->curl;
    }

    public function getDocumentWithLastVersion($accessToken = null, $urn = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/lastVersion', array_filter($parameters));

        return $this->curl;
    }

    public function getDocumentsFolder($accessToken = null, $urn = null, $documentUrn = null, $page = null, $size = null, $sortname = null, $sortcreatedDate = null, $sortsize = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname,
            'sort[createdDate]' => $sortcreatedDate,
            'sort[size]' => $sortsize
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/list', array_filter($parameters));

        return $this->curl;
    }

    public function previewFile($accessToken = null, $urn = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/preview', array_filter($parameters));

        return $this->curl;
    }

    public function getDocumentVersions($accessToken = null, $urn = null, $documentUrn = null, $page = null, $size = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'page' => $page,
            'size' => $size
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/versions', array_filter($parameters));

        return $this->curl;
    }

    public function initiateChunkedFileVersionUpload($accessToken = null, $urn = null, $documentUrn = null, $name = null, $description = null, $uploadKey = null, $md5 = null, $totalSize = null, $totalChunks = null, $chunkSize = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'name' => $name,
            'description' => $description,
            'uploadKey' => $uploadKey,
            'md5' => $md5,
            'totalSize' => $totalSize,
            'totalChunks' => $totalChunks,
            'chunkSize' => $chunkSize
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/versions/chunked', array_filter($parameters));

        return $this->curl;
    }

    public function abortChunkedFileVersionUpload($accessToken = null, $documentUrn = null, $urn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'urn' => $urn,
            'uploadKey' => $uploadKey
        );

        $parameters['documentUrn'] = null;
        $parameters['urn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/versions/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function uploadChunkedFileVersion($accessToken = null, $urn = null, $documentUrn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'urn' => $urn,
            'documentUrn' => $documentUrn,
            'uploadKey' => $uploadKey
        );

        $parameters['urn'] = null;
        $parameters['documentUrn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->post($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/versions/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function getChunkedFileVersionUploadStatus($accessToken = null, $documentUrn = null, $urn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'urn' => $urn,
            'uploadKey' => $uploadKey
        );

        $parameters['documentUrn'] = null;
        $parameters['urn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->get($this->oauth['host'] . '/api/groups/' . $urn . '/documents/' . $documentUrn . '/versions/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }
}