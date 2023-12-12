<?php

namespace Blog\Controller\PageView;

use Blog\Controller\Admin\AbstractController;
use Blog\Exceptions\NotFoundPost;
use Blog\Model\PageRepository;

class PageView extends AbstractController
{
    private PageRepository $pageRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PageRepository $pageRepository
    ) {
        parent::__construct($adminLogin);
        $this-> pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $pageData = $this->pageRepository->getCollection()->getItemsData();
        $page = $this-> pageRepository->getById($request->param('id'));

        return $this->render('pageView.html.twig',
            ['page' => $page->getData()]);
    }
}
