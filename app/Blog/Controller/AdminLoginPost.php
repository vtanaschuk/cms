<?php

namespace Blog\Controller;

class AdminLoginPost extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        if ($this->adminLogin->login($request->paramsPost()->get('login'), $request->paramsPost()->get('password'))) {
            // login success
            $response->redirect('admin/dashboard')->send();
        } else {
            // login fail
            $response->redirect('admin')->send();
        }
    }
}
