<?php

namespace Blog\Controller\Admin\Category;

use Blog\Model\CategoryRepository as CategoryRepositoryInterface;
use Blog\Controller\Admin\AbstractController;
use Blog\Model\Category;

class Save extends AbstractController
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        CategoryRepositoryInterface $categoryRepository
    ) {
        parent::__construct($adminLogin);
        $this-> categoryRepository = $categoryRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();

        if (strlen($data['name'])<= 5 ){
            $response->redirect('/admin/category/add')->send();
        }

        $category = new Category();
        $category->setData($data);
        $this-> categoryRepository->save($category);

        $response->redirect('/admin/dashboard')->send();





    }
}
