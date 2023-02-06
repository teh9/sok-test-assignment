<?php

namespace application\core;

use RuntimeException;

class Router
{
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @var string
     */
    private string $controllerClass;

    /**
     * @var string
     */
    private string $methodName;

    /**
     * @var array
     */
    private array $payload = [];

    /**
     * Autoloader for classes and start session.
     *
     * @return void
     */
    public function bootstrap (): void
    {
        spl_autoload_register( static function($class)
        {
            $path = str_replace('\\', '/', $class.'.php');

            if (file_exists($path)) {
                require $path;
            }
        });

        session_start();
    }

    /**
     * Add a route to the router.
     *
     * @param $routeName
     * @param $routeParams
     * @return void
     */
    public function addRoute ($routeName, $routeParams): void
    {
        $routeRegex = '#^'. str_replace(['{route}', '{id}'], ['(?P<route>[\w-]+)', '(?P<id>\d+)'], $routeName) .'$#';

        $this->routes[$routeRegex] = [
            'controller' => $routeParams['controller'],
            'method'     => $routeParams['method'],
            'middleware' => $routeParams['middleware']
        ];
    }

    /**
     * Try to match the requested route.
     *
     * @return bool
     */
    public function matchRoute (): bool
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $routeRegex => $routeParams)
        {
            if (preg_match(trim($routeRegex, '/'), $requestUri, $matches))
            {
                $this->setRequestParams($matches);

                if ($routeParams['middleware']) {
                    $middlewarePath = getMiddleWarePath($routeParams['middleware']);
                    $middleware     = new $middlewarePath();
                    $middleware->handle();
                }

                $this->controllerClass = $routeParams['controller'];
                $this->methodName      = $routeParams['method'];

                return true;
            }
        }

        return false;
    }

    /**
     * Getting routes and handle it.
     *
     * @return void
     */
    public function initializeRoutes (): void
    {
        $routes = require 'application/config/routes.php';

        foreach ($routes as $routeParams)
        {
            $path = $routeParams['path'];

            $this->addRoute($path, $routeParams);
        }
    }

    /**
     * Run the router and execute the requested action.
     *
     * @return void
     * @throws RuntimeException if route is not found or method is not found in the controller.
     */
    public function run (): void
    {
        $this->initializeRoutes();

        if (!$this->matchRoute()) {
            throw new RuntimeException('Route not found');
        }

        $controllerPath = getControllerPath($this->controllerClass);

        isClassExist($controllerPath);
        isMethodExist($controllerPath, $this->methodName);

        $controller = new $controllerPath($this->controllerClass, $this->methodName, $this->payload);

        $controller->{ $this->methodName }();
    }

    /**
     * Saving all params for continues use in controllers.
     *
     * @param array $matches
     * @return void
     */
    private function setRequestParams (array $matches): void
    {
        foreach ($matches as $key => $match) {
            if (is_string($key)) {
                if (is_numeric($match)) {
                    $match = (int) $match;
                }

                $this->payload[$key] = $match;
            }
        }
    }
}
