<?php

namespace Blog\Service;

class App
{
    private array $routes;

    public function __construct() {
        require_once 'app/config/routes.php';

        $this->routes = $routes;
    }

    public function run(): void
    {
        $router = new Router($this->routes);
        $router->dispatch();
    }
}
