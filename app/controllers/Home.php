<?php
    require_once _DIR_ROOT . "/app/models/HomeModel.php";
    class Home extends Controller {
        private $model;
        public function __construct() {
            $this->model = $this->model("HomeModel");
        }
        public function index() {
            $data = $this->model->getList();
            echo"<pre>";
            print_r($data);
            echo"</pre>";
        }
        public function detail() {}
        
    }