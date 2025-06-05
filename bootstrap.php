<?php

// _DIR_ nó trỏ từ root, ví dụ trong code này: C:\laragon\www\MVCHome
define('_DIR_ROOT', __DIR__);

// Xử lý lấy HTTP root: ví dụ: http://localhost/
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = "https://" . $_SERVER["HTTP_HOST"];
} else {
    $web_root = "http://" . $_SERVER["HTTP_HOST"];
}
define("_WEB_ROOT", $web_root);
// Xử lý Router
require_once("configs/routes.php");
require_once("core/Router.php");
// Điều hướng tới các controller
require_once("app/App.php");

// Khai báo Controller base, cái này khai báo sau App.php vẫn được,
// Sẽ có thắc mắc bên trong App.php sẽ có sử dụng class Home trước Controller, mà Home lại extends Controller, điều này hoàn toàn không lỗi,
// khi nào mà new Home() trước khai báo class Controller thì mới lỗi.

// Nhưng bên trong App.php rõ ràng có gọi new Home() trước, tại sao vẫn không lỗi.
// Tại vì bên trong class App mới chỉ là khai báo class App, chưa hề có khởi tạo new App(), cho nên thực tế require_once("app/App.php") chưa hề
// gọi new Home().

// Quay qua trang index.php thì sẽ thấy rằng, new App() được gọi sau require_once("bootstrap.php"), lúc mà new App() thì lúc này
// mới có được new Home(), mà trước đó đã nạp bootstrap.php cho nên => đã nạp Controller trước rồi, do đó new Home() sẽ không bị lỗi.
require_once("core/Controller.php");
