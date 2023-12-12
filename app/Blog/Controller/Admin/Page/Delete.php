<?php

namespace Blog\Controller\Admin\Page;

use Blog\Controller\Admin\AbstractController;
use Blog\Exceptions\NotFoundPage;
use Blog\Model\PageRepository;
use Blog\Model\AdminLogin;

class Delete extends AbstractController
{
    private PageRepository $pageRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PageRepository $pageRepository
    ) {
        parent::__construct($adminLogin);
        $this->pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

        try {
            $this->pageRepository->deleteById($request->param('id'));



        } catch (NotFoundPost $e) {

            return $response->redirect('/admin/dashboard')->send();
        }


        return $response->redirect('/admin/dashboard')->send();
    }
}


