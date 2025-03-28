<?php


/**
 * User Class
 */
class UserModel
{

    use Model;
    public function __construct() {
        $this->allowedColumns = [
            'email',
            'password',
            'username',
        ];
        $this->table = 'users';
        $this->message = [];
    }
    public function register($data) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        
        if (empty($username)) {
            $this->message['message'] = 'Username is required';
            return false;
        }
        
        if (empty($email)) {
            $this->message['message'] = 'Email is required';
            return false;
        }
        
        if (empty($password)) {
            $this->message['message'] = 'Password is required';
            return false;
        }
        
        $user = $this->where(['username' => $username]);
        if ($user) {
            $this->message['message'] = 'Username is already taken';
            return false;
        }
        
        $user = $this->where(['email' => $email]);
        if ($user) {
            $this->message['message'] = 'Email is already taken';
            return false;
        }

        $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        $result = $this->insert($data);
        if ($result) {
            $this->message['success'] = true;
            return true;
        }

        $this->message['message'] = 'Register failed';
        return false;
    }
    public function login($data) {
        $username = $data['username'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
    
        if (empty($password)) {
            $this->message = ["success" => false, "message" => "Password is required"];
            return false;
        }
    
        $user = !empty($username) ? $this->where(['username' => $username]) : $this->where(['email' => $email]);
    
        if (empty($user)) {
            $this->message = ["success" => false, "message" => "User not found"];
            return false;
        }
    
        $user = $user[0];
    
        if (!password_verify($password, $user->password)) {
            $this->message["success"] = false;
            $this->message["message"] = "Incorrect password";
            return false;
        }
    
        $_SESSION['user'] = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
        ];
    
        $this->message = ["success" => true];
        return true;
    }
    
    
    

    


}
