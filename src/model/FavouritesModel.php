<?php
class FavouritesModel {
    private $conn;
 
    public function __construct($conn) {
        $this->conn = $conn;
    }
 
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

    public function isFavourite($userId, $recipeId) {
        $sql = "SELECT 1 FROM favourite WHERE user_id = ? AND recipe_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function getFavouriteRecipes($userId){

        $sql = "SELECT *
        from recipe
        LEFT join favourite
        on recipe.id = favourite.recipe_id
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
