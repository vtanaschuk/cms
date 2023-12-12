<?php

namespace Blog\Model;

use Blog\Api\CategoryRepositoryInterface;
use Blog\Exceptions\NotFoundPost;
use Blog\Service\Collection;
use Blog\Service\DataBase;

class CategoryRepository implements CategoryRepositoryInterface
{
    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Category $category): Category
    {
        $savedData = [];
        foreach (Category::FIELDS as $field) {
            $savedData[$field] = $category->getData($field);
        }



        if ( $savedData['id'] == '' ) {
            $this->dataBase->insert(Category::TABLE_NAME, $savedData);

        } else {
            $this->dataBase->update(Category::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }
        return $category;
    }

    /**
     * @throws NotFoundPost
     */
    public function getById(int $id): Category
    {

        $data = $this->dataBase->select(
            Category::TABLE_NAME, Category::FIELDS,
            [
                'id' => $id
            ]


        );

        if (count($data)) {

            $data = array_shift($data);
            $category = new Category();
            $category->setData($data);
            return $category;
        }


        throw new NotFoundPost('Category not found');
    }

    /**
     * @throws NotFoundPost
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Category::TABLE_NAME, [
            'id' => $id
        ]);


        if ($data->rowCount() == 0) {
            throw new NotFoundPost('Category not found');
        }
    }


    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Category::TABLE_NAME, Category::FIELDS, $condition);
        $_items = [];

        foreach ($data as $postData) {
            $post = new Post();
            $post->setData($postData);
            $_items[] = $post;
        }

        return new Collection($_items);
    }
}
