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
    public function getAllSavedRecipes($userId) {

    }

    public function getRecipeByName($recipeName) {

    }

    public function getRecipeByID($recipeId) {

    }

}
?>