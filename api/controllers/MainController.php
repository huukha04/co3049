<?php

class MainController {
    use Controller;
    public function __construct() {
    }
    public function home() {
        $this->view('main/home');
    }

    
    public function get_session_user() {
        header('Content-Type: application/json');
        echo json_encode($_SESSION['user'] ?? []);
        exit;
    }
    
    
    
    
    


}
