<?php 
class Connection {
    private static $instance = null;

    public function __construct() {

    }
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
}