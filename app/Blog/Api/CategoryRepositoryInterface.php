<?php

namespace Blog\Api;

use Blog\Model\Category;
use Blog\Service\Collection;

interface CategoryRepositoryInterface
{
    public function getById(int $id): Category;
    public function deleteById(int $id): void;
    public function save(Category $category): Category;

    public function getCollection(?array $condition = null): Collection;
}
