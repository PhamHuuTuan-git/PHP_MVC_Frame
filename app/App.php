<?php

class App
{
    private $__controller;
    private $__action;
    private $__params;
    private $__router;
    public function __construct()
    {
        // khai báo dùng biến toàn cục là $routes, nó nằm ở ngoài hàm này, vì mặc định trong php,
        // các biến ngoài hàm không thể truy cập bên trong hàm
        global $routes;
        $this->__router = new Router();
        if (!empty($routes["default_controller"])) {
            $this->__controller = $routes["default_controller"];
        }
        $this->__action = "index";
        $this->__params = [];
        try {
            $this->handleUrl();
        } catch (Exception $e) {
            $this->loadError();
        }
    }

    private function getUrl(): string
    {
        $url = "/";
        if (!empty($_SERVER["PATH_INFO"])) { // không dùng isset, vì empty check luôn có phải là "" hay không, còn isset chỉ check tồn tại và khác null
            $url = $_SERVER["PATH_INFO"];
        }
        return $url;
    }

    public function handleUrl(): void
    {
        $url = $this->getUrl();
        $url = $this->__router->handleRoute($url);
  
        // array_filter để lọc đi các phần tử là "", do quá trình tách chuỗi theo /
        // array_values: đánh lại index cho nó, vì khi dùng array_filter bỏ đi nó sẽ bị không theo quy tắc index, cho nên cần sắp xếp lại
        $urlArray = array_values(array_filter(explode("/", $url)));
        // Xử lý nếu có controller nằm lồng cấp, ví dụ có folder admin/Dashboard.php, thì cần phải biết và có được Dashboard
        $urlCheck = "";
        if(!empty($urlArray)) {
            foreach($urlArray as $key=>$item) {
                $urlCheck .= $item."/";
                $fileCheck = rtrim($urlCheck , '/'); // loại bỏ dấu / ở cuỗi  chuỗi nếu có.
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) -1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode("/", $fileArr);
                if (!empty($urlArray[$key-1])) {
                    unset($urlArray[$key-1]);
                }
                if (file_exists('app/controllers/'.$fileCheck . '.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArray = array_values($urlArray);
        }
        
        // Xử lý các controller
        if (!empty($urlArray[0])) {
            $this->__controller = ucfirst($urlArray[0]); // ucfirst để viết hoa chữ cái đầu lên
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        // Trường hợp trang chủ, không có /trang-chu
        if(empty($urlCheck)) {
            $urlCheck = $this->__controller;
        }

        if (file_exists('app/controllers/'.$urlCheck . '.php')) {
            require_once 'controllers/'.$urlCheck . '.php';
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller(); // PHP cho phép khỏi tạo đối tượng với tên class có dạng chuỗi
                unset($urlArray[0]); // Xóa biến, và nếu dùng như này thì là xóa phần tử trong mảng, nhưng nó không định lại index.
            } else {
                $this->loadError();
            }
        } else {
            // echo"$this->__controller";
            throw new Exception('Error to open controller ' . ($this->__controller));
        }

        // Xử lý các action
        if (!empty($urlArray[1])) {
            $this->__action = $urlArray[1];
            unset($urlArray[1]);
        }

        // Xử lý params
        $this->__params = array_values($urlArray);

        // Hàm call_user_func_array() trong PHP được sử dụng để gọi một hàm hoặc phương thức với một danh sách đối số được
        // truyền dưới dạng mảng. Đây là hàm rất hữu ích khi bạn không biết trước số lượng tham số cần truyền vào hàm hoặc
        // bạn cần gọi hàm/method một cách động.

        // Có thể truyền vào 1 callback và mảng các tham số muốn truyền, còn nếu dùng cho class và đối tượng thì truyền 1 array
        // chứa đối tượng và phương thức muốn thực hiện, array thứ 2 là chứa các tham số muốn truyền

        // Cần kiểm tra xem action muốn gọi có tồn tại bên trong controller hay không, thông qua hàm method_exists,
        // nếu tồn tại thì thực thi hàm đó bằng call_user_func_array
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }
    }

    public function loadError($name = "404")
    {
        require_once "errors/" .$name . ".php";
    }
}
