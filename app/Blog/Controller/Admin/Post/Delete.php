<?php

namespace Blog\Controller\Admin\Post;

use Blog\Controller\Admin\AbstractController;
use Blog\Exceptions\NotFoundPost;
use Blog\Model\PostRepository;
use Blog\Model\AdminLogin;

class Delete extends AbstractController
{
    private PostRepository $postRepository;

    public function __construct(
        \Blog\Model\AdminLogin $adminLogin,
        PostRepository $postRepository
    ) {
        parent::__construct($adminLogin);
        $this->postRepository = $postRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $this->postRepository->deleteById($request->param('id'));
        } catch (NotFoundPost $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}


