<?php

namespace Blog\Controller\Admin\Post;

use Blog\Controller\Admin\AbstractController;
use Blog\Exceptions\NotFoundPost;
use Blog\Model\PostRepository;
use Blog\Model\AdminLogin;
use Blog\Model\Category;
use Blog\Model\CategoryRepository;

class Edit extends AbstractController
{
    private PostRepository $postRepository;
    private CategoryRepository $categoryRep;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PostRepository $postRepository,
        CategoryRepository $categoryRep
    ) {
        parent::__construct($adminLogin);
        $this->postRepository = $postRepository;
        $this->categoryRep = $categoryRep;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {

        try {
            $category = $this->categoryRep->getCollection()->getItems();

            $cats=[];
            foreach ($category as $Category){
                /** @var Category $Category */
                $key = $Category->getData('id');
                $val = $Category->getData('name');

                $cats[$key] = $val;
            }

            $collection = $this->categoryRep->getCollection()->getItemsData();


            $post = $this->postRepository->getById($request->param('id'));

            $img = $post->getData()['picture'];
            $img= (addslashes(base64_encode($img)));

            $postCat = $post->getData()['category'];
            $count = (count($category));

            if( $img !== ''){

            }
            $copyCat=[];
            for ($i = 0; $i < $count; $i++){
                $item = $collection[$i];
                if($collection[$i]['id'] == $postCat){
                    array_unshift($copyCat, $item);
                }else{
                    $copyCat[] = $item;
                }
            }
            $collection = $copyCat;

        } catch (NotFoundPost $e) {

            return $response->redirect('/admin/dashboard')->send();
        }


        return $this->render('adminhtml/editPost.html.twig',
            [
                'post' => $post->getData(),
                'categoryData' => $cats,
                'img'=> $img
            ]
        );
    }
}


