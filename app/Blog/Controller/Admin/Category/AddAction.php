<?php

namespace Blog\Controller\Admin\Category;

use Blog\Controller\Admin\AbstractController;

class AddAction extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        parent::execute($request, $response);
        return $this->render('adminhtml/newCategory.html.twig');
    }
}
