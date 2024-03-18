<?php
class RecipeModel {
    /**
     * Constructor for RecipeModel.
     * Initializes the database connection.
     *
     * @param $conn Database connection object
     */
    private $conn;
 
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
     /**
     * Get all recipes from the database.
     *
     * @return array Array of recipes
     */
    public function getAllRecipes() {
        $sql = "SELECT * FROM recipe_view";
        $result = $this->conn->query($sql);
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Get recipes by diet ID from the database.
     *
     * @param int $dietId Diet ID
     * @return array Array of recipes matching the diet ID
     */

    public function getRecipeByDietId($dietId) {
        $sql = "SELECT * FROM recipe_view WHERE diet_id <= ?";
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
 
    /**
     * Searches recipes in the database by various criteria.
     *
     * @param string $searchTerm Search term
     * @return array Array of recipes matching the search criteria
     */
    public function searchRecipes($searchTerm) {
        $sql = "SELECT DISTINCT r.*
                FROM recipe_view AS r
                INNER JOIN recipe_ingredient AS ri ON r.id = ri.recipe_id
                INNER JOIN ingredient AS i ON ri.ingredient_id = i.id
                WHERE author LIKE CONCAT('%', ?, '%')
                OR diet LIKE CONCAT('%', ?, '%')
                OR course LIKE CONCAT('%', ?, '%')
                OR ingredient LIKE CONCAT('%', ?, '%')";
 
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $searchTerm,$searchTerm,$searchTerm,$searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Searches recipes in the database by a specific type.
     *
     * @param string $searchTerm Search term
     * @param string $searchType Type of search (course, author, diet, ingredient)
     * @return array Array of recipes matching the search criteria
     */
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
 
    /**
     * Get all saved recipes for a user from the database.
     *
     * @param int $userId User ID
     * @return array Array of saved recipes for the user
     */
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
 
    /**
     * Get a recipe by its ID from the database.
     *
     * @param int $recipeId Recipe ID
     * @return array|null Recipe details or null if not found
     */
    public function getRecipeByID($recipeId) {
        $sql = "SELECT * FROM recipe_view WHERE id = ?";
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
    
 

    /**
     * Get recipe details by its ID from the database.
     *
     * @param int $recipeId Recipe ID
     * @return array Recipe details
     */
    public function getRecipeDetailsById($recipeId) {
        $sql = "SELECT * FROM recipe_view
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        return $result->fetch_assoc();
    }
    
  
      /**
     * Get recipe steps by its ID from the database.
     *
     * @param int $recipeId Recipe ID
     * @return array Recipe steps
     */
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
    
  
    /**
     * Get recipe tips by its ID from the database.
     *
     * @param int $recipeId Recipe ID
     * @return array Recipe tips
     */
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
 
    
    /**
     * Get recipe ingredients by its ID from the database.
     *
     * @param int $recipeId Recipe ID
     * @return array Recipe ingredients
     */
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
    
    /**
     * Get featured recipes from the database.
     *
     * @return array Array of featured recipes
     */
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