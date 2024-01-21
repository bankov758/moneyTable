<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{
    private static DB $db;

    public function __construct(protected Router $router, protected array $request, protected Config $config)
    {
        /*
         * Late static binding - resolves which child is calling the variable
        *  The static:: syntax is used to reference the static property within the class.
        *  This ensures that all instances of the class share the same database connection.
        */
        static::$db = new DB($config->db ?? []);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    /**
     * The run method is responsible for
     * handling the application's execution. It attempts to resolve a route using the Router class
     * and catches a RouteNotFoundException if the route is not found. In case of a 404 error,
     * it sets the HTTP response code and displays a custom error page using the View class.
     */
    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method'] ?? ""));
        } catch (RouteNotFoundException) {
            http_response_code(404);
            echo View::make('error/404');
        }
    }
}