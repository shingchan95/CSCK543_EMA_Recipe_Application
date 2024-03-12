<?php
class RecipeModel {
    private $conn;
 
    public function __construct($conn) {
        $this->conn = $conn;
    }
 
    public function getAllRecipes() {
        $sql = "SELECT r.*, a.author, d.diet, c.course FROM recipe AS r
                LEFT JOIN diet AS d ON r.diet_id = d.id
                LEFT JOIN author AS a ON r.author_id = a.id
                LEFT JOIN course AS c ON r.course_id = c.id";
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
        $sql = "SELECT r.* , a.author, d.diet, c.course FROM recipe AS r
                LEFT JOIN diet AS d ON r.diet_id = d.id
                LEFT JOIN author AS a ON r.author_id = a.id
                LEFT JOIN course AS c ON r.course_id = c.id
                WHERE r.recipe LIKE CONCAT('%', ?, '%')";
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
        $sql = "SELECT DISTINCT r.* , a.author, d.diet, c.course FROM recipe AS r
                LEFT JOIN diet AS d ON r.diet_id = d.id
                LEFT JOIN author AS a ON r.author_id = a.id
                LEFT JOIN course AS c ON r.course_id = c.id
                LEFT JOIN recipe_ingredient AS ri ON r.id = ri.recipe_id
                LEFT JOIN ingredient AS i ON ri.ingredient_id = i.id
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
        $sql = "
            SELECT
                r.id,
                r.recipe,
                r.servings,
                r.tagline,
                r.preparation,
                r.cooking,
                r.image_path,
                r.added,
                d.diet,
                c.course,
                a.author
            FROM
                recipe r
            LEFT JOIN diet d ON r.diet_id = d.id
            LEFT JOIN course c ON r.course_id = c.id
            LEFT JOIN author a ON r.author_id = a.id
            WHERE
                r.id = ?
        ";

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
            LEFT JOIN
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
        $sql = "SELECT r.*, a.author, d.diet, c.course FROM recipe AS r
        LEFT JOIN diet AS d ON r.diet_id = d.id
        LEFT JOIN author AS a ON r.author_id = a.id
        LEFT JOIN course AS c ON r.course_id = c.id
        WHERE r.featured = '1'";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }                               
    }

}
?>


