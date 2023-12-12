<?php

namespace Blog\Controller\Admin\Page;

use Blog\Model\PageRepository as PageRepositoryInterface;
use Blog\Controller\Admin\AbstractController;
use Blog\Model\Page;

class Save extends AbstractController
{
    private PageRepositoryInterface $pageRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PageRepositoryInterface $pageRepository
    ) {
        parent::__construct($adminLogin);
        $this-> pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();


        $page = new Page();
        $page->setData($data);
        $this-> pageRepository->save($page);

        $response->redirect('/admin/dashboard')->send();





    }
}
