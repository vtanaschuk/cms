<?php

namespace Blog\Model;

use Blog\Service\DataObject;

class Post extends DataObject
{
    const TABLE_NAME = 'post';
    const FIELDS = ['entity_id', 'title', 'description', 'category', 'picture'];

    public function getId(): int
    {
        return (int) $this->_data['entity_id'];
    }

    public function getName(): string
    {
        return $this->_data['title'];
    }

    public function setName(string $name): Post
    {
        $this->_data['title'] = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->_data['text'];
    }

    public function setDescription($description): Post
    {
        $this->_data['text'] = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return (float) $this->_data['category'];
    }

    public function setPrice($price): Post
    {
        $this->_data['category'] = $price;
        return $this;
    }

    public function getPicture()
    {
        return $this->_data['picture'];
    }

    public function setPicture($picture): Post
    {

        $this->_data['picture'] = $picture;
        return $this;
    }

}
