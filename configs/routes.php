<?php
    $routes["default_controller"] = "home";
    $routes["san-pham"] = "product";
    // http://php_mvc_frame-main.test/trang-chu -> http://php_mvc_frame-main.test/home
    $routes["trang-chu"] = "home";

    // tin-tuc/: URL phải bắt đầu bằng tin-tuc/
    // .+-: phần trước dấu - có thể là bất kỳ chữ nào (tựa như tên bài viết) → . + - nghĩa là "ít nhất 1 ký tự + dấu -"
    // (\d+): một hoặc nhiều chữ số, nằm sau dấu -, và được lưu lại làm tham số $1
    // .html: kết thúc bằng .html
    // http://php_mvc_frame-main.test/tin-tuc/the-gioi-1.html -> http://php_mvc_frame-main.test/news/category/1
    $routes["tin-tuc/.+-(\d+).html"] = "news/category/$1";