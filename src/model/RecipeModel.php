<?php
class RecipeModel {
    private $conn;
 
    public function __construct($conn) {
        $this->conn = $conn;
    }
 
    public function getAllRecipes() {
        $sql = "SELECT * FROM recipe";
        $result = $this->conn->query($sql);
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
 
    public function getRecipeByDietId($dietId) {
        $sql = "SELECT * FROM recipe WHERE diet_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $dietId);
        $stmt->execute();
 
        $result = $stmt->get_result();
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
 
    public function searchRecipes($searchTerm) {
        $sql = "SELECT r.* FROM recipe AS r
                LEFT JOIN diet AS d ON r.diet_id = d.id
                WHERE r.recipe LIKE CONCAT('%', ?, '%')
                OR d.diet LIKE CONCAT('%', ?, '%')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
 
    public function getAllSavedRecipes($userId) {
        $sql = "SELECT r.* FROM recipe AS r JOIN saved_recipes AS sr ON r.id = sr.recipe_id WHERE sr.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
 
    public function getRecipeByID($recipeId) {
        $sql = "SELECT * FROM recipe WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>