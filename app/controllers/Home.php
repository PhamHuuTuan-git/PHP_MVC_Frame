<?php

require_once _DIR_ROOT . "/app/models/HomeModel.php";
class Home extends Controller
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("HomeModel");
    }
    public function index()
    {
        $data = $this->model->getList();
        $this->data["sub_content"]["home_list"] = $data;
        $this->data["content"] = "home/index";
        // render ra view
        $this->render("layouts/client_layout", $this->data);

    }
    public function detail()
    {
    }

}
