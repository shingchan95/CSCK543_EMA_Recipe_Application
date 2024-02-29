<?php
include '../controller/Database.php';

/*
 * The Model is where the backend do their magic. This is where we will have methods such as getUsersSortedByAge(),
 * or getRecipesSortedByStars(), etc.
 * Then they invoke the render methods on the views through the controllers (as the example).
 *
 * The Model is responsible for dealing with the database and perform the SQL queries.
 */

class ExampleUserModel
{
    private $db;
    private $table = "users";

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getUserByName($name)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


