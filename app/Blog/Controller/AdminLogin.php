<?php

namespace Blog\Controller;

class AdminLogin extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        if ($this->adminLogin->validateAdmin()) {

            return $response->redirect('/admin/dashboard')->send();
        }
        return $this->render('adminhtml/login.html.twig');
    }
}
