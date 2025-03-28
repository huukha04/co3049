<?php

class Routes
{
    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'main/home';
        $URL = explode("/", trim($URL, '/'));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        $filename = "../api/controllers/" . ucfirst($URL[0]) . "Controller".".php";
        if (file_exists($filename)) {
            require $filename;
            $controller = ucfirst($URL[0]) . "Controller";
            unset($URL[0]);
        } else {
            $filename = "../api/controllers/ErrorController.php";
            require $filename;
            $controller = "ErrorController";
        }

        $controller = new $controller;

        /** Select Method **/
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $method = $URL[1];
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $method], $URL);
    }

}
