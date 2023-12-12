<?php

namespace Blog\Controller\Admin\Category;

use Blog\Controller\Admin\AbstractController;
use Blog\Exceptions\NotFoundPost;
use Blog\Model\AdminLogin;
use Blog\Model\Category;
use Blog\Model\CategoryRepository;
use Blog\Model\PostRepository;

class Delete extends AbstractController
{
    private CategoryRepository $categoryRep;
    private  PostRepository $postRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        CategoryRepository $categoryRep,
        PostRepository $postRepository
    ) {
        parent::__construct($adminLogin);
        $this->categoryRep = $categoryRep;
        $this->postRepository = $postRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

        try {
            $category = $this-> categoryRep->getById($request->param('id'))->getData();
            $this->postRepository->deletePostCatId($category['id']);
            $this->categoryRep->deleteById($request->param('id'));

        } catch (NotFoundPost $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}


