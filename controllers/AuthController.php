<?php
class AuthController {
    private $userModel;

    public function __construct() {
      
        require_once '../models/User.php';
        $this->userModel ;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

        
            if (empty($username) || empty($password)) {
                $error = "Username and password are required.";
                require '../views/auth/login.php';
                return;
            }

            
            $user = $this->userModel->getUsername($username);
            if ($user && password_verify($password, $user['password'])) {
         
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: ../views/student/dashboard.php');
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        }
        require '../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $error = "All fields are required.";
                require '../views/auth/register.php';
                return;
            }

            if ($password !== $confirm_password) {
                $error = "Passwords do not match.";
                require '../views/auth/register.php';
                return;
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

       
            if ($this->userModel->createUser($username, $email, $hashed_password)) {
                header('Location: ../views/auth/login.php');
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
        require '../views/auth/register.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../views/auth/login.php');
        exit();
    }
}
?>