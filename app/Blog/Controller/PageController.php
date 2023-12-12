<?php
namespace Blog\Controller;

class PageController extends AbstractController
{

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $result = $this->render('page.html.twig', [
            'show' => 'first controller'
        ]);

        return $result;

    }

}
