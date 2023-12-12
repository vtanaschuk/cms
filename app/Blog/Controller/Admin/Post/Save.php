<?php

namespace Blog\Controller\Admin\Post;

use Blog\Model\PostRepository as PostRepositoryInterface;
use Blog\Controller\Admin\AbstractController;
use Blog\Model\Post;

class Save extends AbstractController
{
    private PostRepositoryInterface $PostRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PostRepositoryInterface $postRepository
    ) {
        parent::__construct($adminLogin);
        $this->postRepository = $postRepository;

    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();
        $img= $_FILES['picture']['tmp_name'];
        if ($img) {
            $image = file_get_contents($img);
            var_dump($image);
            $data['picture'] = $image;

        } else {
            $image = null;
        }

        die();
        $post = new Post();
        $post->setData($data);
        $this->postRepository->save($post);
        $response->redirect('/admin/dashboard')->send();
    }
}
