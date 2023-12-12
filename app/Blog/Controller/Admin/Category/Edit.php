<?php

namespace Blog\Controller\Admin\Category;

use Blog\Controller\Admin\AbstractController;
use Blog\Exceptions\NotFoundPost;
use Blog\Model\CategoryRepository;

class Edit extends AbstractController
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        CategoryRepository $categoryRepository
    ) {
        parent::__construct($adminLogin);
        $this-> categoryRepository = $categoryRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $categoryData = $this->categoryRepository->getCollection()->getItemsData();

        try {
            $category = $this-> categoryRepository->getById($request->param('id'));

        } catch (NotFoundPost $e) {
            return $response->redirect('/admin/dashboard')->send();
        }

        return $this->render('adminhtml/editCategory.html.twig',
            ['category' => $category->getData()]);
    }
}
