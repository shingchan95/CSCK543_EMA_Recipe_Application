<?php
class FavouritesModel {
    private $conn;
    /**
     * Constructor for FavouritesModel.
     * Initializes the database connection.
     *
     * @param $conn Database connection object
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Adds a recipe to the user's favorites.
     *
     * @param int $userId User ID
     * @param int $recipeId Recipe ID
     * @return array Array indicating success or failure of the operation
     * @throws Exception If the operation fails
     */
    public function addToFavorites($userId, $recipeId) {
        // Check if the recipe is already in the user's favorites
        $sql = "SELECT 1 FROM favourite WHERE user_id = ? AND recipe_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result->num_rows > 0) {
            // Recipe is already in favorites
            return ['success' => false, 'message' => 'Recipe is already in favorites.'];
        } else {
            // Add recipe to favorites
            $sqlInsert = "INSERT INTO favourite (user_id, recipe_id) VALUES (?, ?)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->bind_param("ii", $userId, $recipeId);
            if ($stmtInsert->execute()) {
                // Insert successful
                return ['success' => true, 'message' => 'Recipe added to favorites successfully.'];
            } else {
                // Insert failed
                throw new Exception("Failed to save favorite."); 
            }

        }
    }

     /**
     * Deletes a recipe from the user's favorites.
     *
     * @param int $recipeId Recipe ID
     * @param int $userId User ID
     * @return array Array indicating success or failure of the operation
     * @throws Exception If the operation fails
     */
    public function deleteFavorites($recipeId, $userId) {
        // Check if the recipe exists in the user's favorites
        if ($this -> isFavourite($userId, $recipeId)) {
            // Recipe found in favorites, delete it
            $sqlDelete = "DELETE FROM favourite WHERE user_id = ? AND recipe_id = ?";
            $stmtDelete = $this->conn->prepare($sqlDelete);
            $stmtDelete->bind_param("ii", $userId, $recipeId);
            if ($stmtDelete->execute()) {
                // Deletion successful
                return ['success' => true, 'message' => 'Recipe removed from favorites successfully.'];
            } else {
                // Deletion failed
                throw new Exception("Failed to remove favorite.");
            }
        } else {
            // Recipe not found in favorites
            return ['success' => false, 'message' => 'Recipe not found in favorites.'];
        }
    }


     /**
     * Checks if a recipe is in the user's favorites.
     *
     * @param int $userId User ID
     * @param int $recipeId Recipe ID
     * @return bool True if the recipe is in favorites, false otherwise
     */
    public function isFavourite($userId, $recipeId) {
        $sql = "SELECT 1 FROM favourite WHERE user_id = ? AND recipe_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    /**
     * Retrieves the user's favorite recipes.
     *
     * @param int $userId User ID
     * @return array Array of favorite recipes
     */
    public function getFavouriteRecipes($userId){

        $sql = "SELECT *
        from recipe_view
        LEFT join favourite
        on recipe_view.id = favourite.recipe_id
        where favourite.user_id = ?";

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

}
?>
