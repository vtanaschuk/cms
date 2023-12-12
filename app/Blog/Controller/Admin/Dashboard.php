<?php

namespace Blog\Controller\Admin;

use Blog\Model\PostRepository;
use Blog\Model\CategoryRepository;
use Blog\Model\PageRepository;


class Dashboard extends \Blog\Controller\Admin\AbstractController
{
    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;
    private PageRepository $pageRepository;



    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        PageRepository $pageRepository

    ) {
        parent::__construct($adminLogin);
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

//        var_dump($_SESSION['isAdmin']);
//        die();
        parent::execute($request, $response);

        $data = $this->postRepository->getCollection()->getItemsData();
        $categoryData = $this->categoryRepository->getCollection()->getItemsData();
        $pageRepository = $this->pageRepository->getCollection()->getItemsData();

        foreach ($categoryData as $key=>$value) {
            $categoryArr [$value['id']] = $value['name'];
        }

        $i = 0;

        foreach ($data as $item){
            if($data[$i]["category"] == null){
                $data[$i]["category"] = 'категорія не вибрана';
            }else{
                $data[$i]["category"] = $categoryArr[$item["category"]];
            }
            $item["picture"] = addslashes(base64_encode($item["picture"]));
            $data[$i]["picture"]= $item["picture"];

            $i = $i + 1;
        }

        return $this->render('adminhtml/dashboard.html.twig',
            ['post' => $data, 'category' => $categoryData,'page' => $pageRepository, 'message'=>'Hello admin']);
    }
}
