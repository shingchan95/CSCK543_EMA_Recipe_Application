<?php
class RatingModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

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

    public function hasRated($userId, $recipeId, $categoryId) {
        $sql = "SELECT 1 FROM rating WHERE user_id = ? AND recipe_id = ? AND category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $recipeId, $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

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

    // Optional, I don't know if we want this or not
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
