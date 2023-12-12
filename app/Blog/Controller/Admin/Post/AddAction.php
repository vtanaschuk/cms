<?php

namespace Blog\Controller\Admin\Post;

use Blog\Controller\Admin\AbstractController;
use Blog\Model\AdminLogin;
use Blog\Model\Category;
use Blog\Model\CategoryRepository;

class AddAction extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRep;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        CategoryRepository $categoryRep
    )
    {
        parent::__construct($adminLogin);
        $this->categoryRep = $categoryRep;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

        parent::execute($request, $response);

        $collection = $this->categoryRep->getCollection([]);
        $cats=[];


        foreach ($collection->getItems() as $Category){
            /** @var Category $Category */
            $categoryData = $Category->getData('name');
            $cats[] = $categoryData;
        }

        return $this->render('adminhtml/newPost.html.twig',[
            'categoryData' => $cats
        ]);
    }
}
