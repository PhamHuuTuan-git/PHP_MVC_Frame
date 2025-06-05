<?php

// Cái này sẽ kế thừa từ class Model
class HomeModel
{
    protected $_table = 'products';
    public function getList()
    {
        $data = ["item 1", "item 2", "item 3"];
        return $data;
    }
}
