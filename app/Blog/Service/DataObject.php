<?php

namespace Blog\Service;

class DataObject
{
    protected array $_data = [];

    public function __construct(
        $data = []
    ) {
        $this->_data = $data;
    }

    public function getData($key = null) {
        if (!is_null($key)) {
            return $this->_data[$key] ?? null;
        }
        return $this->_data;
    }

    public function setData($data): DataObject
    {
        $this->_data = $data;
        return $this;
    }

    public function resetData(): DataObject
    {
        $this->_data = [];
        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (strpos($name, 'get') == 0) {
            $index = substr($name,3);
            $index = strtolower($index);
            if (isset($this->_data[$index])) {
                return $this->_data[$index];
            } else {
                return null;
            }
        }

        if (strpos($name, 'set') == 0) {
            $index = substr($name,3);
            $index = strtolower($index);
            $this->_data[$index] = $arguments[0];
            return $this;
        }
    }
}
