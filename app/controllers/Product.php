<?php

// Đây là class controller, nó sẽ chứa các phương thức (action)
class Product extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("ProductModel");
    }
    public function index()
    {
        // echo "Danh sach san pham";
        $this->list_product();
    }
    public function list_product()
    {
        $dataProducts = $this->model->getProductList();
        $this->data["sub_content"]["product_list"] = $dataProducts;
        $this->data["content"] = "products/list";
        // render ra view
        $this->render("layouts/client_layout", $this->data);

    }
    public function detail($id = 0)
    {
        $this->data["sub_content"]["information"] = $this->model->getProductById($id);
        $this->data["content"] = "products/detail";
        $this->render("layouts/client_layout", $this->data);
    }
}
