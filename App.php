<?php

namespace Zyncro\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing;
use Symfony\Component\Yaml;
use Symfony\Component\DependencyInjection;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class App implements HttpKernelInterface
{
    public $container;
    private $request;
    private $dispatcher;
    private $routes;
    private $databaseConfig;
    private $zyncroAppConfig;
    private $securityConfig;
    private $generalConfig;
    private $session;
    private $method;

    public function __construct(EventDispatcher $dispatcher, Session $session)
    {
        $this->container = new DependencyInjection\ContainerBuilder();
        $this->dispatcher = $dispatcher;
        $this->session = $session;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        try {
            $this->request = $request;

            $pathInfo = $request->getPathInfo();

            $this->loadRoutes($pathInfo);
            $this->loadGeneralConfig();
            $this->loadZyncroAppConfig($pathInfo);
            $this->loadDatabaseConfig($pathInfo);
            $this->loadSecurityConfig($pathInfo);
            $this->loadTwig($pathInfo);
            $this->loadUtils();

            $this->method = $request->getMethod();

            $this->dispatcher->dispatch('request', new RequestEvent($request, $this->session, $this->securityConfig, $this->routes));

            $this->loadApi();

            $context = new Routing\RequestContext();
            $matcher = new Routing\Matcher\UrlMatcher($this->routes, $context);

            $context->fromRequest($request);
            $request->attributes->add($matcher->match($request->getPathInfo()));

            $resolver = new ControllerResolver();
            $controller = $resolver->getController($request);
            $arguments = $resolver->getArguments($request, $controller);

            $arguments[0] = $this;

            $response = call_user_func_array($controller, $arguments);
        } catch (Routing\Exception\ResourceNotFoundException $e) {
            $response = new Response('Not Found', 404);
        } catch (\Exception $e) {
            $response = new Response('An error occurred: ' . $e->getMessage(), 500);
        }

        return $response;
    }

    private function loadRoutes($path)
    {
        $this->routes = new Routing\RouteCollection();

        $appName = $this->getAppNameFromPath($path);
        $srcPath = __DIR__ . '/../../../../../src';
        $configPath = $srcPath . '/' . $appName . '/Config/routing.yml';

        if (file_exists($configPath)) {
            $this->loadSingleAppRoutes($configPath);
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

    private function loadGeneralConfig()
    {
        $configPath = __DIR__ . '/../../../../../config/config.yml';
        $yamlParser = new Yaml\Parser();
        $generalConfig = $yamlParser->parse(file_get_contents($configPath));

        if (is_array($generalConfig)) {
            $this->generalConfig = $generalConfig;
        }
    }

    public function getConfig()
    {
        return $this->generalConfig;
    }

    public function getSecurityConfig()
    {
        return $this->securityConfig;
    }

    public function getZyncroAppConfig()
    {
        return $this->zyncroAppConfig;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getParametersWithValidation($parameters, $clearEmptyValues = false)
    {
        $response = array();

        foreach ($parameters as $parameter) {
            $required = isset($parameter['required']) ? $parameter['required'] : false;
            $name = $parameter['name'];
            $value = $this->request->request->get($name);

            if ($required && !$value) {
                return false;
            }

            $response[$name] = $value;
        }

        if ($clearEmptyValues) {
            $response = array_filter($response);
        }

        return $response;
    }

    public function redirect($routeName)
    {
        $redirectRoute = $this->routes->get($routeName);
        $redirectResponse = new RedirectResponse($this->request->getBaseUrl() . $redirectRoute->getPath());

        $redirectResponse->send();
    }

    private function loadZyncroAppConfig($path)
    {
        $appName = $this->getAppNameFromPath($path);
        $srcPath = __DIR__ . '/../../../../../src';
        $zyncroAppPath = $srcPath . '/' . $appName . '/Config/config.yml';

        if (file_exists($zyncroAppPath)) {
            try {
                $yamlParser = new Yaml\Parser();
                $zyncroAppConfig = $yamlParser->parse(file_get_contents($zyncroAppPath));

                if (is_array($zyncroAppConfig)) {
                    $this->zyncroAppConfig = $zyncroAppConfig;
                }
            } catch (Yaml\Exception\ParseException $exception) {
                print_r($exception->getMessage());
                die;
            }
        }
    }

    private function loadDatabaseConfig($path)
    {
        $appName = $this->getAppNameFromPath($path);
        $srcPath = __DIR__ . '/../../../../../src';
        $dbPath = $srcPath . '/' . $appName . '/Config/config.yml';

        if (file_exists($dbPath)) {
            try {
                $yamlParser = new Yaml\Parser();
                $databaseConfig = $yamlParser->parse(file_get_contents($dbPath));

                if (is_array($databaseConfig) && isset($databaseConfig['database'])) {
                    $this->databaseConfig = $databaseConfig['database'];

                    $this
                        ->container
                        ->register('doctrine', 'Doctrine\DBAL\DriverManager')
                        ->setFactory(array('Doctrine\DBAL\DriverManager', 'getConnection'))
                        ->addArgument($this->databaseConfig);
                } else {
                    $this->databaseConfig = null;
                }
            } catch (Yaml\Exception\ParseException $exception) {
                print_r($exception->getMessage());
                die;
            }
        }
    }

    private function loadSecurityConfig($path)
    {
        $appName = $this->getAppNameFromPath($path);
        $srcPath = __DIR__ . '/../../../../../src';
        $securityPath = $srcPath . '/' . $appName . '/Config/security.yml';

        if (file_exists($securityPath)) {
            try {
                $yamlParser = new Yaml\Parser();
                $securityConfig = $yamlParser->parse(file_get_contents($securityPath));

                if (is_array($securityConfig)) {
                    $this->securityConfig = $securityConfig;
                }
            } catch (Yaml\Exception\ParseException $exception) {
                print_r($exception->getMessage());
                die;
            }
        }
    }

    private function loadTwig($path)
    {
        require_once __DIR__ . '/../../../../twig/twig/lib/Twig/Autoloader.php';

        \Twig_Autoloader::register();

        $appName = $this->getAppNameFromPath($path);
        $srcPath = __DIR__ . '/../../../../../src';
        $viewsPath = $srcPath . '/' . $appName . '/Views';

        if (is_dir($viewsPath)) {
            $loader = new \Twig_Loader_Filesystem($viewsPath);

            $this
                ->container
                ->register('twig', 'Twig_Environment')
                ->addArgument($loader)
                ->addArgument(array(
                    'cache' => __DIR__ . '/../../../../../cache/twig',
                ))
                ->addMethodCall('addGlobal', ['route', new TwigPath($this->routes, $this->request->getBaseUrl())]);
        }
    }

    private function loadUtils()
    {
        $this
            ->container
            ->register('utils', 'Zyncro\Framework\Utils\Utils');
    }

    private function loadApi()
    {
        $this
            ->container
            ->register('api', 'Zyncro\Framework\Api\Api')
            ->addArgument($this->generalConfig);
    }

    private function getAppNameFromPath($path)
    {
        $explodedPath = explode('/', $path);

        if (isset($explodedPath[1])) {
            return ucfirst($explodedPath[1]);
        }

        return null;
    }
}