<?php

namespace Blog\Controller;

use Blog\Model\Pagination;
use Blog\Model\Post;
use Blog\Model\PostRepository;
use Blog\Model\CategoryRepository;
use Blog\Model\PageRepository;

class Home extends AbstractController
{
    const PER_PAGE = 2;


    private Post $post;
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
        $this->categoryRepository=$categoryRepository;
        $this->pageRepository=$pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

//        $pageRepository = $this->pageRepository->getCollection()->getItemsData();
//        $pageActive =[];
//        foreach ($pageRepository as $page){
//            if ($page["status"] == '1'){
//                $pageActive[]= $page;
//            }
//        }
        $result = $this->render('home.html.twig');

        $pagination = new Pagination($request->param('page'), self::PER_PAGE, $this->postRepository->count());
        $start = $pagination->getStart();

        $where = [];
        $categoryView = (isset($_GET['category']) != NULL ) ? $_GET['category'] : '';
        if($categoryView != 0){
            $where = [
                'category' => $categoryView
            ];
        }
        if (empty($where)){
            $data = $this->postRepository->getCollection(["LIMIT" => [$start,self::PER_PAGE]])->getItemsData();
        }else{
            $data = $this->postRepository->getCollection($where)->getItemsData();
//            $pagination ='';
        }
        var_dump($where);
        var_dump($data);

        $categoryData = $this->categoryRepository->getCollection()->getItemsData();
        foreach ($categoryData as $key=>$value) {
            $categoryArr [$value['id']] = $value['name'];
        }

        $i = 0;
        foreach ($postData as $item){

            if(!isset($categoryArr[$item["category"]])){
                $postData[$i]["category"] = 'категорія не вибрана';
            }else{
                $postData[$i]["category_id"] = $postData[$i]["category"];
                $postData[$i]["category"] = $categoryData[$item["category"]];
            }
//            $item["picture"] = addslashes(base64_encode($item["picture"]));
//            $data[$i]["picture"]= $item["picture"];

            $i = $i + 1;
        }

        $result .= $this->render(
            'postView.html.twig',
            ['postData' => $data, 'category' => $categoryData],
        );

        return $result . $pagination;
    }
}
