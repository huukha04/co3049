<?php

class ErrorController {
    use Controller;
    public function __construct() {
    }
    public function error_404() {
        $this->view('error/error_404');
    }


}
