<?php

class Router
{
    public function __construct()
    {

    }
    public function handleRoute($url)
    {
        global $routes;
        unset($routes["default_controller"]);
        $url = trim($url, "/"); // xoa ky tu / o dau va cuoi chuoi url
          if (empty($url)) {
            $url = "/";
        }
        $handledUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                // kiểm tra chuỗi có phù hợp với 1 biểu thức chính quy hay không
                // ~ cho phép dùng các ký tự phân cách, .key là chuỗi cần so khớp, i không phân biệt hoa thường, còn s là khớp nếu nội dung có xuống dòng
                if (preg_match("~" .$key . "~is", $url)) {
                    $handledUrl = preg_replace("~" .$key . "~is", $value, $url);
                }
            }
        }
        return $handledUrl;
    }
}
