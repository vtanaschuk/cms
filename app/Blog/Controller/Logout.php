<?php

namespace Blog\Controller;

class Logout extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $this->adminLogin->logout();
        $response->redirect('/')->send();
    }
}
