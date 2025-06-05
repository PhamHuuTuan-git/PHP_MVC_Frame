<?php
    class Controller {
        protected $data =[];
        public function __construct() {
            $this->data["controller"] = $this;
        }
        protected function model($model) {
            if(file_exists(_DIR_ROOT . "/app/models/" .$model . ".php")) {
                require_once _DIR_ROOT . "/app/models/" .$model . ".php";
                if(class_exists($model)) {
                    $model = new $model();
                    return $model;
                }   
            }
            return false;
        }
        public function render($view, $data=[]) {
            extract($data); // Chuyển các key của array thành 1 biến, và chugns ta có thể sử dụng các biến đó để lấy dữ liệu cụ thể trong view.
            if(file_exists(_DIR_ROOT . "/app/views/" .$view . ".php")) {
                    require_once _DIR_ROOT . "/app/views/" .$view . '.php';
            }
        }
    }