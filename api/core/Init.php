<?php

spl_autoload_register(function ($classname) {
    $paths = ['../api/models/', '../api/middlewares/']; 
    foreach ($paths as $path) {
        $filename = $path . ucfirst($classname) . ".php";
        if (file_exists($filename)) {
            require $filename;
            break;
        }
    }
});



require 'Config.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'Routes.php';

$session_lifetime = 1800;

// Kiểm tra nếu session chứa thông tin user
if (isset($_SESSION["user"])) {
    if (isset($_SESSION["last_activity"])) {
        if (time() - $_SESSION["last_activity"] > $session_lifetime) {
            session_unset(); // Xóa tất cả dữ liệu session
            session_destroy(); // Hủy session
            header("Location: " . ROOT . "page/home"); 
            exit();
        }
    }

    // Cập nhật thời gian hoạt động cuối cùng
    $_SESSION["last_activity"] = time();
}






