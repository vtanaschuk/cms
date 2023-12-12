<?php

namespace Blog\Controller\Admin\Page;

use Blog\Controller\Admin\AbstractController;
use Blog\Model\AdminLogin;
use Blog\Model\Page;
use Blog\Model\PageRepository;

class AddAction extends AbstractController
{

    private PageRepository $pageRep;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PageRepository $pageRep
    )
    {
        parent::__construct($adminLogin);
        $this->pageRep = $pageRep;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

        parent::execute($request, $response);

        $collection = $this->pageRep->getCollection([]);
        $pages=[];


        foreach ($collection->getItems() as $Page){

            $pageData = $Page->getData('name');
            $pages[] = $pageData;
        }

        return $this->render('adminhtml/newPost.html.twig',[
            'pageData' => $pages
        ]);
    }
}
