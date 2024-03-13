<?php
require_once __DIR__ . '/../model/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        global $conn;
        $this->userModel = new UserModel($conn);
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['login_submit'])) {
                $this->handleLogin();
            } elseif (isset($_POST['register_submit'])) {
                $this->handleRegistration();
            }
        }
    }

    private function handleLogin()
    {
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

        $user = $this->userModel->loginUser($username_email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            $_SESSION['login_error'] = "Invalid username or password";
        }
        header("Location: " . $_SESSION['current_page']);
        exit();
    }

    private function handleRegistration()
    {
        $username = $_POST['register_username'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];

        $currentLocation = $_SESSION['current_page'];

        if ($this->userModel->getUserByUsername($username)) {
            $_SESSION['register_error'] = "Username already taken. Choose a different username.";
            header("Location: " . $currentLocation);
            exit();
        }
        if ($this->userModel->getUserByEmail($email)) {
            $_SESSION['register_error'] = "Email already exists. Choose a different email.";
            header("Location: " . $currentLocation);
            exit();
        }

        $success = $this->userModel->createUser($username, $email, $password);

        if ($success) {
            $user = $this->userModel->getUserByUsername($username);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            $_SESSION['register_error'] = "Registration failed";
        }
        header("Location: " . $currentLocation);
        exit();
    }
}
