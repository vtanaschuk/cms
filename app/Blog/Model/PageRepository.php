<?php

namespace Blog\Model;
use Blog\Api\PageRepositoryInterface;
use Blog\Exceptions\NotFoundPost;
use Blog\Service\Collection;
use Blog\Service\DataBase;

class PageRepository implements PageRepositoryInterface
{
    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Page $page): Page
    {
        $savedData = [];
        foreach (Page::FIELDS as $field) {
            $savedData[$field] = $page->getData($field);
        }



        if ( $savedData['id'] == '' ) {
            $this->dataBase->insert(Page::TABLE_NAME, $savedData);

        } else {
            $this->dataBase->update(Page::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }
        return $page;
    }

    /**
     * @throws NotFoundPost
     */
    public function getById(int $id): Page
    {

        $data = $this->dataBase->select(
            Page::TABLE_NAME, Page::FIELDS,
            [
                'id' => $id
            ]


        );

        if (count($data)) {

            $data = array_shift($data);
            $page = new Page();
            $page->setData($data);
            return $page;
        }


        throw new NotFoundPost('Page not found');
    }

    /**
     * @throws NotFoundPost
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Page::TABLE_NAME, [
            'id' => $id
        ]);


        if ($data->rowCount() == 0) {
            throw new NotFoundPost('Page not found');
        }
    }


    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Page::TABLE_NAME, Page::FIELDS, $condition);
        $_items = [];

        foreach ($data as $postData) {
            $post = new Post();
            $post->setData($postData);
            $_items[] = $post;
        }

        return new Collection($_items);
    }
}
