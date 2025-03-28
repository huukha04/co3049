<?php

class AdminController {
    use Controller;
    public function __construct() {
    }
    public function home() {
        $this->view('admin/home');
    }


}
