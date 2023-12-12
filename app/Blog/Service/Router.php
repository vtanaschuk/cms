<?php

namespace Blog\Service;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch()
    {
        $klein = new \Klein\Klein();

        foreach ($this->routes as $route) {
            $klein->respond(
                $route['method'],
                $route['path'],
                function ($request, $response) use ($route) {
                    $container = \DI\ContainerSingleton::getInstance();
                    $controller = $container->get($route['className']);
                    return $controller->execute($request, $response);
                });
        }

        $klein->dispatch();
    }
}
