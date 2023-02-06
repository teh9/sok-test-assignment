<?php

namespace application\lib;

class RouteKernel
{
    /**
     * Create associative array with routes data.
     *
     * @param string $path uri path
     * @param string $resource controller + method => SomeController@someMethod
     * @param string|null $middleware middleware name
     *
     * @return array
     */
    public function add (string $path, string $resource, ?string $middleware = null): array
    {
        if ($path !== '/') {
            $path = '/'.$path;
        }

        // Here might be implemented via object for more readable, but array works faster so, I choose in this case performance
        return [
            'path'       => $path,
            'middleware' => $middleware,
            ...$this->splitControllerAndMethod($resource)
        ];
    }

    /**
     * Separating a controller from a method from a string => controller@method - separate by @.
     *
     * @param string $params
     * @return array
     */
    private function splitControllerAndMethod (string $params): array
    {
        [ $controller, $method ] = explode('@', $params);
        return [
            'controller' => $controller,
            'method'     => $method
        ];
    }
}
