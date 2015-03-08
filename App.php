<?php

namespace Zyncro\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing;
use Symfony\Component\Yaml;

class App implements HttpKernelInterface
{
    private $routes;

    public function __construct()
    {
        $this->loadRoutes();
    }

    private function loadRoutes()
    {
        $this->routes = new Routing\RouteCollection();
        $srcPath = __DIR__ . '/../../../../../src';
        $appList = preg_grep('/^([^.])/', scandir($srcPath));

        foreach ($appList as $app) {
            $configPath = $srcPath . '/' . $app . '/Config/routing.yml';

            if (file_exists($configPath)) {
                $this->loadSingleAppRoutes($configPath);
            }
        }
    }

    private function loadSingleAppRoutes($path)
    {
        try {
            $yamlParser = new Yaml\Parser();
            $routes = $yamlParser->parse(file_get_contents($path));

            foreach ($routes as $routeName => $route) {
                $this->routes->add($routeName, new Routing\Route($route['path'], $route['defaults']));
            }
        } catch (Yaml\Exception\ParseException $exception) {
            print_r($exception->getMessage());
            die;
        }
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $context = new Routing\RequestContext();
        $matcher = new Routing\Matcher\UrlMatcher($this->routes, $context);

        $context->fromRequest($request);
        $request->attributes->add($matcher->match($request->getPathInfo()));

        try {
            $resolver = new ControllerResolver();
            $controller = $resolver->getController($request);
            $arguments = $resolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (Routing\Exception\ResourceNotFoundException $e) {
            return new Response('Not Found', 404);
        } catch (\Exception $e) {
            return new Response('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}