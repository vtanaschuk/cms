<?php

namespace Blog\Model;

use Blog\Api\PostRepositoryInterface;
use Blog\Exceptions\NotFoundPost;
use Blog\Service\Collection;
use Blog\Service\DataBase;

class PostRepository implements PostRepositoryInterface
{
    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Post $post): Post
    {
        $savedData = [];
        foreach (Post::FIELDS as $field) {
            $savedData[$field] = $post->getData($field);
        }

        if($savedData['picture'] == null){
            unset($savedData['picture']);
        }

        if ( $savedData['entity_id'] == 0 ) {
            $this->dataBase->insert(Post::TABLE_NAME, $savedData);
        } else {
            $this->dataBase->update(Post::TABLE_NAME, $savedData, [
                'entity_id' => $savedData['entity_id']
            ]);
        }
        return $post;
    }


    public function deletePostCatId($id)
    {
        $data = ['category'=> ''];
        $where = ['category' => $id];

        $this->dataBase->update(Post::TABLE_NAME, $data, $where);
    }

    /**
     * @throws NotFoundPost
     */
    public function getById(int $id): Post
    {
        $data = $this->dataBase->select(
            Post::TABLE_NAME, Post::FIELDS,
            [
                'entity_id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $post = new Post();
            $post->setData($data);
            return $post;
        }

        throw new NotFoundPost('Post not found');
    }

    /**
     * @throws NotFoundPost
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Post::TABLE_NAME, [
            'entity_id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundPost('Post not found');
        }
    }



    public function getCollection(?array $where = [], ?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Post::TABLE_NAME, Post::FIELDS, $where, $condition);
        $_items = [];

        foreach ($data as $postData) {
            $post = new Post();
            $post->setData($postData);
            $_items[] = $post;
        }

        return new Collection($_items);
    }

    public function count()
    {
        return $this->dataBase->count(Post::TABLE_NAME);
    }
}
