<?php
class AuthController {
    use Controller;
    public function __construct() {

    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $arr = json_decode($json, true); 
    
            if (!$arr) {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "message" => "Invalid JSON"]);
                exit;
            }
    
            $user = new UserModel();
            $user->login($arr);
    
            header('Content-Type: application/json');
            echo json_encode($user->message);
            exit;
        }
        $this->view('auth/login');
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $arr = json_decode($json, true); 
    
            if (!$arr) {
                echo json_encode(["success" => false, "message" => "Invalid JSON"]);
                exit;
            }
    
            $user = new UserModel();
            $user->register($arr);
    
            header('Content-Type: application/json');
            echo json_encode($user->message);
            exit;
        }
        
        $this->view('auth/register');
    }
    public function forgot() {
    }
    public function logout() {
        session_unset();
        session_destroy(); 
        $this->redirect('main/home');

    }
    


}
