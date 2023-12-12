<?php

namespace Blog\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected \Blog\Model\AdminLogin $adminLogin;

    public function __construct(\Blog\Model\AdminLogin $adminLogin)
    {
        $this->adminLogin = $adminLogin;
    }

    abstract public function execute(\Klein\Request $request, \Klein\Response $response);

    protected function render($template, $variables = []) {
        $loader = new FilesystemLoader(__DIR__ . '/../view/templates');
        $twig = new Environment($loader);

        // add info for header
        if (!isset($variables['loginStatus'])) {
            $variables['loginStatus'] = $this->adminLogin->validateAdmin();
            $variables['isAdmin'] = $this->adminLogin->validateIsAdmin();

        }

        return $twig->render($template, $variables);
    }
}
