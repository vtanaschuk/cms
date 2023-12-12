<?php

namespace Blog\Controller\Admin;

use Blog\Model\AdminLogin;

abstract class AbstractController extends \Blog\Controller\AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
   {
       if (!$this->adminLogin->validateAdmin()) {
           $response->redirect('/admin')->send();
       }
   }
}
