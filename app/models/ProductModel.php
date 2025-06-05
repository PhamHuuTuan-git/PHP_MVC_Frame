<?php

class ProductModel
{
    public function getProductList()
    {
        return [
            "prd1", "prd2"
        ];

    }
    public function getProductById($id)
    {
        $data = [
            "id" => $id,
            "name" => "Sna pham A"
        ];
        return $data;
    }
}
