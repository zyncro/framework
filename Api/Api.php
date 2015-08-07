<?php

namespace Zyncro\Framework\Api;

class Api
{
    private $endpoints = array();
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->loadEndpoints();
    }

    private function loadEndpoints()
    {
        $endpoints = preg_grep('/^([^.])/', scandir(__DIR__ . '/Endpoints'));

        foreach ($endpoints as $endpoint) {
            $baseEndpointName= basename($endpoint, '.php');
            $endpointName = 'Zyncro\\Framework\\Api\\Endpoints\\' . $baseEndpointName;

            $this->endpoints[$baseEndpointName] = new $endpointName($this->config['oauth']);
        }
    }

    public function getEndpoint($name)
    {
        if (!isset($this->endpoints[$name])) {
            return null;
        }

        return $this->endpoints[$name];
    }
}