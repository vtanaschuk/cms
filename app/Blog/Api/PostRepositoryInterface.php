<?php

namespace Blog\Api;

use Blog\Model\Post;
use Blog\Model\Category;
use Blog\Service\Collection;

interface PostRepositoryInterface
{
    public function getById(int $id): Post;
    public function deleteById(int $id): void;
    public function save(Post $post): Post;

    public function getCollection(?array $condition = null): Collection;
}
