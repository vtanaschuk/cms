<?php

namespace Blog\Api;

use Blog\Model\Page;
use Blog\Service\Collection;

interface PageRepositoryInterface
{
    public function getById(int $id): Page;
    public function deleteById(int $id): void;
    public function save(Page $post): Page;

    public function getCollection(?array $condition = null): Collection;
}
