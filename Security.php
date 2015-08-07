<?php

namespace Zyncro\Framework;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Security
{
    public static function listener(RequestEvent $requestEvent)
    {
        $request = $requestEvent->getRequest();
        $pathInfo = $request->getPathInfo();
        $session = $requestEvent->getSession();
        $configSecurity = $requestEvent->getSecurityConfig();
        $routes = $requestEvent->getRoutes();

        $context = new RequestContext();
        $matcher = new UrlMatcher($routes, $context);

        $context->fromRequest($request);
        $matching = $matcher->match($pathInfo);
        $matchedRoute = $matching['_route'];

        if (isset($configSecurity['protected'])) {
            $protected = $configSecurity['protected'];
            $protectedRoutes = $protected['routes'];
            $sessionKey = $protected['session'];
            $notLoggedRoute = $protected['not_logged'];
            $loggedRoute = $protected['logged'];
            $redirectRoute = null;

            if ($session->get($sessionKey) && $matchedRoute === $notLoggedRoute) {
                $redirectRoute = $routes->get($loggedRoute);
            }

            if (!$session->get($sessionKey) && in_array($matchedRoute, $protectedRoutes)) {
                $redirectRoute = $routes->get($notLoggedRoute);
            }

            if ($redirectRoute) {
                $redirectResponse = new RedirectResponse($request->getBaseUrl() . $redirectRoute->getPath());

                $redirectResponse->send();
            }
        }
    }
}