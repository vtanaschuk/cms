<?php

namespace Blog\Model;

use Blog\Service\DataObject;

class Page extends DataObject
{
    const TABLE_NAME = 'pages';
    const FIELDS = ['id', 'content', 'title', 'status'];

    public function getId(): int
    {
        return (int) $this->_data['id'];
    }

    public function getTitle(): string
    {
        return $this->_data['title'];
    }

    public function setTitle(string $name): Page
    {
        $this->_data['title'] = $name;
        return $this;
    }
    public function getContent(): string
    {
        return $this->_data['content'];
    }

    public function setContent(string $content): Page
    {
        $this->_data['content'] = $content;
        return $this;
    }

    public function getStatus(): bool
    {
        return $this->_data['status'];
    }

    public function setStatus(bool $content): Page
    {
        $this->_data['status'] = $content;
        return $this;
    }


}
