<?php
// Include required files
require_once __DIR__ . '/../model/UserModel.php';


/**
 * AuthController class handles authentication-related operations.
 */
class AuthController
{
    private $userModel;
    /**
     * Constructor for AuthController.
     * Initializes UserModel instance.
     */
    public function __construct()
    {
        global $conn;
        $this->userModel = new UserModel($conn);
    }

     /**
     * Index method handles login, registration, and account deletion based on POST requests.
     * Sets error messages in session if an exception occurs during login, registration, or account deletion.
     */
    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if login form is submitted
            if (isset($_POST['login_submit'])) {
                try {
                    $this->handleLogin(); // Call handleLogin method
                } catch (Exception $e) { 
                    $_SESSION['login_error'] = $e->getMessage(); // Set login error message in session
                    header("Location: " . $_SESSION['current_page']); // Redirect to current page
                }
            } // Check if registration form is submitted
            elseif (isset($_POST['register_submit'])) {
                try {
                    $this->handleRegistration(); // Call handleRegistration method
                } catch (Exception $e) {
                    $_SESSION['register_error'] = $e->getMessage(); // Set registration error message in session
                    header("Location: " . $_SESSION['current_page']); // Redirect to current page
                }
            } // Check if delete account form is submitted
            elseif (isset($_POST['delete_submit'])) {
                try {
                    $this->handleAccountDeletion(); // Call handleAccountDeletion method
                } catch (Exception $e) {
                    $_SESSION['register_error'] = $e->getMessage(); // Set registration error message in session
                    header("Location: " . $_SESSION['current_page']);  // Redirect to current page
                }
            }
        }
    }

    /**
     * Handles user logout.
     * Destroys session and redirects to home page.
     */
    public function handleLogout()
    {
        // Destroy session
        session_destroy();
        // Redirect to home page
        header("Location: home");
        exit();
    }

    /**
     * Handles user login.
     * Sets user session if login is successful, otherwise sets login error message.
     */
    private function handleLogin()
    {
        // Retrieve login credentials
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

        // Attempt to login user
        $user = $this->userModel->loginUser($username_email, $password);

        // If login successful, set user session
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            // If login fails, set login error message
            throw new Exception("Invalid username or password");
        }
        // Redirect to current page
        header("Location: " . $_SESSION['current_page']);
        exit();
    }

    /**
     * Handles user registration.
     * Sets user session if registration is successful, otherwise sets registration error message.
     */
    private function handleRegistration()
    {
        // Retrieve registration data
        $username = $_POST['register_username'];
        $email = $_POST['register_email'];
        $password = $_POST['register_password'];

        // Get current page location
        $currentLocation = $_SESSION['current_page'];

        // Check if username is already taken
        if ($this->userModel->getUserByUsername($username)) {
            throw new Exception("Username already taken. Choose a different username.");
        }
        // Check if email is already registered
        if ($this->userModel->getUserByEmail($email)) {
            throw new Exception("Email already exists. Choose a different email.");
        }

        // Create user
        $success = $this->userModel->createUser($username, $email, $password);

        // If user creation successful, set user session
        if ($success) {
            $user = $this->userModel->getUserByUsername($username);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
        } else {
            throw new Exception("Registration failed");
        }
        // Redirect to previous page
        header("Location: " . $currentLocation);
        exit();
    }

    /**
     * Handles user account deletion.
     * Redirects to the current page after deletion.
     */
    private function handleAccountDeletion()
    {
        // Get user ID
        $userId = $_SESSION['user_id'];
        // Attempt to delete user account
        $success = $this->userModel->deleteUser($userId);
        // If deletion successful, unset session and destroy session
        if ($success) {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            session_destroy();
        } else {
            throw new Exception("Failed to delete user account");
        }
        // Redirect to home page
        header("Location: home");
        exit();
    }
}
