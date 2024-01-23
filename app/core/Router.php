<?php

declare(strict_types=1);

namespace app\core;

use app\exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function delete(string $route, callable|array $action): self
    {
        return $this->register('delete', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestUri, string $requestMethod)
    {
        $route = explode('?', $requestUri)[0];          //separate the address from the parameters
        $action = $this->routes[$requestMethod][$route] ?? null; //get the registered action
        if (!$action) {
            throw new RouteNotFoundException();
        }
        if (is_callable($action)) {             //if only a method name is registered directly call it
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action;        //if we have a given class and method name

            if (class_exists($class)) {
                $class = new $class();
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);     //if the class and its method exist do callback
                }
            }
        }
        throw new RouteNotFoundException();
    }
}