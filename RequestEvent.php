<?php

namespace Zyncro\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Session;

class RequestEvent extends Event
{
    private $request;
    private $session;
    private $securityConfig;
    private $routes;

    public function __construct(Request $request, Session $session, $securityConfig, $routes)
    {
        $this->request = $request;
        $this->session = $session;
        $this->securityConfig = $securityConfig;
        $this->routes = $routes;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getSecurityConfig()
    {
        return $this->securityConfig;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}