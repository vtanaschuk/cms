<?php

$routes = [
    [
        'method' => "GET",
        'path' => "/",
        'className' => \Blog\Controller\Home::class
    ],
    [
        'method' => "GET",
        'path' => "/pagecontroller",
        'className' => \Blog\Controller\PageController::class
    ],
    [
        'method' => "GET",
        'path' => "/admin",
        'className' => \Blog\Controller\AdminLogin::class
    ],
    [
        'method' => "POST",
        'path' => "/admin-login",
        'className' => \Blog\Controller\AdminLoginPost::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/dashboard",
        'className' => \Blog\Controller\Admin\Dashboard::class
    ],
    [
        'method' => "GET",
        'path' => "/logout",
        'className' => \Blog\Controller\Logout::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/add",
        'className' => \Blog\Controller\Admin\Post\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/post/save",
        'className' => \Blog\Controller\Admin\Post\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/edit/id/[i:id]",
        'className' => \Blog\Controller\Admin\Post\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/post/delete/id/[i:id]",
        'className' => \Blog\Controller\Admin\Post\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category/add",
        'className' => \Blog\Controller\Admin\Category\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/category/save",
        'className' => \Blog\Controller\Admin\Category\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category/edit/id/[i:id]",
        'className' => \Blog\Controller\Admin\Category\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/category/delete/id/[i:id]",
        'className' => \Blog\Controller\Admin\Category\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/add",
        'className' => \Blog\Controller\Admin\Category\AddAction::class
    ],
    [
        'method' => "POST",
        'path' => "/admin/page/save",
        'className' => \Blog\Controller\Admin\Page\Save::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/edit/id/[i:id]",
        'className' => \Blog\Controller\Admin\Page\Edit::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/delete/id/[i:id]",
        'className' => \Blog\Controller\Admin\Page\Delete::class
    ],
    [
        'method' => "GET",
        'path' => "/admin/page/view/id/[i:id]",
        'className' => \Blog\Controller\Admin\Page\View::class
    ],
    [
        'method' => "GET",
        'path' => "/page/id/[i:id]",
        'className' => \Blog\Controller\PageView\PageView::class
    ],


];
