<?php
class RecipeModel {
    private $conn;
 
    public function __construct($conn) {
        $this->conn = $conn;
    }
 
    public function getAllRecipes() {
        $sql = "SELECT * FROM recipe_view";
        $result = $this->conn->query($sql);
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
 
    public function getRecipeByDietId($dietId) {
        $sql = "SELECT * FROM recipe_view WHERE diet_id = ?";
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
        $sql = "SELECT * FROM recipe_view
                WHERE recipe LIKE CONCAT('%', ?, '%')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public function searchRecipesWithType($searchTerm, $searchType) {
        //course, author, diet, ingredient
        $sql = "SELECT DISTINCT r.* FROM recipe_view AS r
                INNER JOIN recipe_ingredient AS ri ON r.id = ri.recipe_id
                INNER JOIN ingredient AS i ON ri.ingredient_id = i.id
                WHERE  $searchType LIKE CONCAT('%', ?, '%')";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $searchTerm);
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
 
    public function getRecipeDetailsById($recipeId) {
        $sql = "SELECT * FROM recipe_view
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        return $result->fetch_assoc();
    }
 
    public function getStepsByRecipeId($recipeId) {
        $sql = "
            SELECT
                step_no,
                step,
                minutes
            FROM
                step
            WHERE
                recipe_id = ?
            ORDER BY
                step_no
        ";
 
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        $steps = [];
        while ($row = $result->fetch_assoc()) {
            $steps[] = $row;
        }
 
        return $steps;
    }
 
    public function getTipsByRecipeId($recipeId) {
        $sql = "
            SELECT
                tip_no,
                tip
            FROM
                tip
            WHERE
                recipe_id = ?
            ORDER BY
                tip_no
        ";
 
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        $tips = [];
        while ($row = $result->fetch_assoc()) {
            $tips[] = $row;
        }
 
        return $tips;
    }
 
    public function getIngredientsByRecipeId($recipeId) {
        $sql = "
            SELECT
                amount,
                unit,
                preprep,
                suffix,
                ingredient
            FROM
                recipe_ingredient ri
            INNER JOIN
                ingredient i ON ri.ingredient_id = i.id
            WHERE
                recipe_id = ?
        ";
 
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        $ingredients = [];
        while ($row = $result->fetch_assoc()) {
            $ingredients[] = $row;
        }
 
        return $ingredients;
    }
 
    public function getFeaturedRecipes() {
        $sql = "SELECT * FROM recipe_view
        WHERE featured = '1'";
        $result = $this->conn->query($sql);
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }                               
    }
 
}
?>