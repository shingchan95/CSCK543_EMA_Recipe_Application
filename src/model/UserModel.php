<?php

class UserModel {    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Login Page Functions
    public function createAccount($username, $password, $email) {

    }

    public function getUserDetails($username, $password) {

    }
}
?>