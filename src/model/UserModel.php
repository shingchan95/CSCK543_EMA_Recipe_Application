<?php

/* UserModel class represents a model for user-related database operations. */

class UserModel
{

    // mysqli Database connection object
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Create a new user in the database.
     *
     * @param string $username Username of the user
     * @param string $email Email of the user
     * @param string $password Password of the user
     * @return bool True if user creation is successful, false otherwise
     */
    public function createUser($username, $email, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created = date('Y-m-d H:i:s');
        $role = 1; // Assigning role as 1 for now
        $sql = "INSERT INTO user (username, email, pword, created, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $email, $hashed_password, $created, $role);
        return $stmt->execute();
    }

    /**
     * Log in a user with the provided username or email and password.
     *
     * @param string $usernameOrEmail Username or email of the user
     * @param string $password Password of the user
     * @return array|null User data if login is successful, null otherwise
     */
    public function loginUser($usernameOrEmail, $password)
    {
        $sql = "SELECT * FROM user WHERE username = ? OR email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['pword'])) {
                $this->updateLastLogin($user['id']);
                return $user;
            }
        }

        return null;
    }

    /**
     * Get a user by their username.
     *
     * @param string $username Username of the user
     * @return array|null User data if found, null otherwise
     */
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    /**
     * Get a user by their email.
     *
     * @param string $email Email of the user
     * @return array|null User data if found, null otherwise
     */
    public
    function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    /**
     * Update the last login time for a user.
     *
     * @param int $userId ID of the user
     * @return void
     */
    private
    function updateLastLogin($userId)
    {
        $lastLogin = date('Y-m-d H:i:s');
        $sql = "UPDATE user SET last_login = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $lastLogin, $userId);
        $stmt->execute();
    }

}

?>