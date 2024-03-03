<?php

class UserModel {    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function createUser($username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created = date('Y-m-d H:i:s'); 
        $role = 1; // Assigning role as 1 for now
        $sql = "INSERT INTO user (username, email, pword, created, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $email, $hashed_password, $created, $role);
        return $stmt->execute();
    }
    public function loginUser($usernameOrEmail, $password) {
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
    public function getUserByUsername($username) {
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

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc();
    }
    private function updateLastLogin($userId) {
        $lastLogin = date('Y-m-d H:i:s'); 
        $sql = "UPDATE user SET last_login = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $lastLogin, $userId);
        $stmt->execute();
    }

}
?>