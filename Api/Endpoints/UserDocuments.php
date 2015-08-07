<?php

namespace Zyncro\Framework\Api\Endpoints;

use Zyncro\Framework\Api\Curl;

class UserDocuments
{
    private $curl;
    private $oauth;

    public function __construct($oauth)
    {
        $this->curl = new Curl();
        $this->oauth = $oauth;
    }

    public function getDocuments($accessToken = null, $page = null, $size = null, $sortname = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname
        );

        $this->curl->get($this->oauth['host'] . '/api/user/documents', array_filter($parameters));

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

        $this->curl->get($this->oauth['host'] . '/api/user/documents/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function initiateChunkedFileUpload($accessToken = null, $name = null, $description = null, $uploadKey = null, $md5 = null, $totalSize = null, $totalChunks = null, $chunkSize = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'description' => $description,
            'uploadKey' => $uploadKey,
            'md5' => $md5,
            'totalSize' => $totalSize,
            'totalChunks' => $totalChunks,
            'chunkSize' => $chunkSize
        );

        $this->curl->post($this->oauth['host'] . '/api/user/documents/chunked', array_filter($parameters));

        return $this->curl;
    }

    public function abortChunkedFileUpload($accessToken = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'uploadKey' => $uploadKey
        );

        $parameters['uploadKey'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/user/documents/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function getChunkedFileUploadStatus($accessToken = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'uploadKey' => $uploadKey
        );

        $parameters['uploadKey'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function uploadChunkedFile($accessToken = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'uploadKey' => $uploadKey
        );

        $parameters['uploadKey'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/documents/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function uploadFile($accessToken = null)
    {
        $parameters = array(
            'access_token' => $accessToken
        );

        $this->curl->post($this->oauth['host'] . '/api/user/documents/file', array_filter($parameters));

        return $this->curl;
    }

    public function uploadFileVersion($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/documents/file/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function createFolder($accessToken = null, $name = null, $description = null, $parentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'name' => $name,
            'description' => $description,
            'parentUrn' => $parentUrn
        );

        $this->curl->post($this->oauth['host'] . '/api/user/documents/folder', array_filter($parameters));

        return $this->curl;
    }

    public function updateDocument($accessToken = null, $documentUrn = null, $name = null, $description = null, $parentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'name' => $name,
            'description' => $description,
            'parentUrn' => $parentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->put($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function deleteDocument($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '', array_filter($parameters));

        return $this->curl;
    }

    public function removeBookmarkUserDocument($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function addbookmarkUserDocument($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/bookmarks', array_filter($parameters));

        return $this->curl;
    }

    public function download($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/download', array_filter($parameters));

        return $this->curl;
    }

    public function getDocumentWithLastVersion($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/lastVersion', array_filter($parameters));

        return $this->curl;
    }

    public function getDocumentsFolder($accessToken = null, $documentUrn = null, $page = null, $size = null, $sortname = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'page' => $page,
            'size' => $size,
            'sort[name]' => $sortname
        );

        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/list', array_filter($parameters));

        return $this->curl;
    }

    public function previewFile($accessToken = null, $documentUrn = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn
        );

        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/preview', array_filter($parameters));

        return $this->curl;
    }

    public function getDocumentVersions($accessToken = null, $documentUrn = null, $page = null, $size = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'page' => $page,
            'size' => $size
        );

        $parameters['documentUrn'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/versions', array_filter($parameters));

        return $this->curl;
    }

    public function initiateChunkedFileVersionUpload($accessToken = null, $documentUrn = null, $name = null, $description = null, $uploadKey = null, $md5 = null, $totalSize = null, $totalChunks = null, $chunkSize = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'name' => $name,
            'description' => $description,
            'uploadKey' => $uploadKey,
            'md5' => $md5,
            'totalSize' => $totalSize,
            'totalChunks' => $totalChunks,
            'chunkSize' => $chunkSize
        );

        $parameters['documentUrn'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/versions/chunked', array_filter($parameters));

        return $this->curl;
    }

    public function abortChunkedFileVersionUpload($accessToken = null, $documentUrn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'uploadKey' => $uploadKey
        );

        $parameters['documentUrn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->delete($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/versions/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function uploadChunkedFileVersion($accessToken = null, $documentUrn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'uploadKey' => $uploadKey
        );

        $parameters['documentUrn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->post($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/versions/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }

    public function getChunkedFileVersionUploadStatus($accessToken = null, $documentUrn = null, $uploadKey = null)
    {
        $parameters = array(
            'access_token' => $accessToken,
            'documentUrn' => $documentUrn,
            'uploadKey' => $uploadKey
        );

        $parameters['documentUrn'] = null;
        $parameters['uploadKey'] = null;

        $this->curl->get($this->oauth['host'] . '/api/user/documents/' . $documentUrn . '/versions/chunked/' . $uploadKey . '', array_filter($parameters));

        return $this->curl;
    }
}