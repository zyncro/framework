<?php

namespace Zyncro\Framework;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;

class TwigPath
{
    private $routes;
    private $basePath;

    public function __construct(RouteCollection $routes, $basePath)
    {
        $this->routes = $routes;
        $this->basePath = $basePath;
    }

    public function path($routeName, $parameters = array())
    {
        /** @var Route $route */
        $route = $this->routes->get($routeName);

        if ($route) {
            $context = new RequestContext();
            $generator = new UrlGenerator($this->routes, $context);

            return $generator->generate($routeName, $parameters);
        }

        return '';
    }
}