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

    public function getRecipeDetailsById($recipeId) {
        $sql = "SELECT *
                FROM recipe r
                LEFT JOIN r.author_id ON a.author_id = a.id
                LEFT JOIN rating rr ON r.id = rr.recipe_id
                WHERE r.id = ?
                GROUP BY r.id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result ? $result->fetch_assoc() : null;
    }

    public function getRecipeByDietId($dietId) {
        $sql = "SELECT * 
                FROM recipe r
                JOIN diet d
                ON r.recipe.diet_id = d.diet_id
                WHERE d.diet_id = ?";
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
        $sql = "SELECT * 
                FROM recipe AS r
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


    
    public function getIngredientsByRecipeId($recipeId) {
        $sql = "SELECT ri.amount, ri.unit, i.ingredient 
                FROM recipe_ingredient ri
                JOIN ingredient i ON ri.ingredient_id = i.id
                WHERE ri.recipe_id = ?";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getStepsByRecipeId($recipeId) {
        $sql = "SELECT * FROM step WHERE recipe_id = ? ORDER BY step_no ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getCommentsByRecipeId($recipeId) {
        $sql = "SELECT c.*, u.username AS user_name 
                FROM comments c 
                JOIN user u ON c.user_id = u.id 
                WHERE c.recipe_id = ?";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
    
}

?>