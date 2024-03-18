<?php
/**
 * RatingModel class handles operations related to recipe ratings.
 */
class RatingModel {
    
    /**
     * Constructor for RatingModel.
     * Initializes the database connection.
     *
     * @param $conn Database connection object
     */

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

     /**
     * Adds or updates a rating for a recipe by a user.
     *
     * @param int $userId User ID
     * @param int $recipeId Recipe ID
     * @param int $rating Rating value
     * @param int $categoryId Category ID
     * @return array Array indicating success or failure of the operation
     */
    public function addRating($userId, $recipeId, $rating, $categoryId) {
        // Check if the user has already rated this recipe
        if ($this->hasRated($userId, $recipeId, $categoryId)) {
            // Update the existing rating
            return $this->updateRating($userId, $recipeId, $rating, $categoryId);
        } else {
            // Insert new rating
            $sql = "INSERT INTO rating (user_id, recipe_id, rating, category_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iiii", $userId, $recipeId, $rating, $categoryId);
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Rating added successfully.'];
            } else {
                return ['success' => false, 'message' => 'Failed to add rating.'];
            }
        }
    }


    /**
     * Updates an existing rating for a recipe by a user.
     *
     * @param int $userId User ID
     * @param int $recipeId Recipe ID
     * @param int $rating Rating value
     * @param int $categoryId Category ID
     * @return array Array indicating success or failure of the operation
     */
    private function updateRating($userId, $recipeId, $rating, $categoryId) {
        $sql = "UPDATE rating SET rating = ? WHERE user_id = ? AND recipe_id = ? AND category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $rating, $userId, $recipeId, $categoryId);
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Rating updated successfully.'];
        } else {
            return ['success' => false, 'message' => 'Failed to update rating.'];
        }
    }


    /**
     * Checks if a user has already rated a recipe in a specific category.
     *
     * @param int $userId User ID
     * @param int $recipeId Recipe ID
     * @param int $categoryId Category ID
     * @return bool True if the user has rated the recipe, false otherwise
     */
    public function hasRated($userId, $recipeId, $categoryId) {
        $sql = "SELECT 1 FROM rating WHERE user_id = ? AND recipe_id = ? AND category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $recipeId, $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    /**
     * Retrieves the rating given by a user for a recipe in a specific category.
     *
     * @param int $userId User ID
     * @param int $recipeId Recipe ID
     * @param int $categoryId Category ID
     * @return int Rating value
     */
    public function getRating($userId, $recipeId, $categoryId) {
        $sql = "SELECT rating FROM rating WHERE user_id = ? AND recipe_id = ? AND category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $recipeId, $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['rating'];
        } else {
            return 0;
        }
    }

    /**
     * Retrieves the average rating for a recipe.
     *
     * @param int $recipeId Recipe ID
     * @return float|null Average rating value or null if no ratings exist
     */
    public function getAverageRating($recipeId) {
        $sql = "SELECT AVG(rating) as average_rating FROM rating WHERE recipe_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? $row['average_rating'] : null;
    }
    
}
?>
