<?php

namespace Blog\Service;

class Collection extends DataObject
{
    private array $_items = [];

    public function __construct($_items = [], $data = [])
    {
        $this->setItems($_items);
        parent::__construct($data);
    }

    public function getItems(): array
    {
        return $this->_items;
    }

    public function getSize(): int
    {
        return count($this->_items);
    }

    public function setItems($items): Collection
    {
        $this->_items = $items;
        return $this;
    }

    public function getItemsData(): array
    {
        $data = [];
        foreach ($this->_items as $item) {
            $data[] = $item->getData();
        }

        return $data;
    }
    public function getPhoto() {
        $data = $_FILES['photo']['tmp_name'];

        if ($data) {
            $image = addslashes(file_get_contents($data));
        } else {
            $image = null;
        }

        return $image;
    }
}
