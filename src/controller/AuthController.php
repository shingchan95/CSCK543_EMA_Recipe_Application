<?php
require_once __DIR__ . '/../model/UserModel.php';
class AuthController {
    private $userModel;

    public function __construct() {
        global $conn;
        $this->userModel = new UserModel($conn);
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['login_submit'])) {
                $this->handleLogin();
            } elseif (isset($_POST['register_submit'])) {
                $this->handleRegistration();
            }
        } else {
            $this->render('login', ['login_error' => '']);
        }
    }

    private function handleLogin() {
        session_start();
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

        $user = $this->userModel->loginUser($username_email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: home");
            exit();
        } else {
            $login_error = "Invalid username or password";
            $this->render('login', ['login_error' => $login_error]);
        }
    }

    private function handleRegistration() {
        $username = $_POST['register_username'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];
    
        if ($this->userModel->getUserByUsername($username)) {
            $register_error = "Username already taken. Choose a different username.";
            $this->render('login', ['register_error' => $register_error]);
            return; 
        }
        if ($this->userModel->getUserByEmail($email)) {
            $register_error = "Email already exists. Choose a different email.";
            $this->render('login', ['register_error' => $register_error]);
            return;
        }
    
        $success = $this->userModel->createUser($username, $email, $password);
    
        if ($success) {
            session_start();
            $user = $this->userModel->getUserByUsername($username); // Assuming you have a method to get a user by username
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: home");
            exit();
        } else {
            $register_error = "Registration failed";
            $this->render('login', ['register_error' => $register_error]);
        }
    }

    private function render($view, $data = []) {
        include __DIR__ . "/../view/$view.php";
    }
}
?>