<?php

include_once __DIR__ . '/../model/RecipeModel.php'; // Include the RecipeModel

#[AllowDynamicProperties]
class RecipeController {

    private $conn;
    private $recipeModel;


    public function __construct($conn) {
        $this->conn = $conn;
        $this->recipeModel = new RecipeModel($conn);
    }

    public function index() {
        $recipes = $this->recipeModel->getAllRecipes();
        require_once '../src/view/recipe.php';
    }


    public function showRecipe($recipeId) {
        // Fetch the main recipe details
        $recipeDetails = $this->recipeModel->getRecipeDetailsById($recipeId);
    
        if (!$recipeDetails) {
            // Redirect to a 404 page
            header('Location: /404.php');
            exit;
        }
    
        // Fetch related data
        $ingredients = $this->recipeModel->getIngredientsByRecipeId($recipeId);
        $steps = $this->recipeModel->getStepsByRecipeId($recipeId);
        $comments = $this->recipeModel->getCommentsByRecipeId($recipeId);
    
        // Combine all data into a single array to pass to the view
        $recipeDetails['ingredients'] = $ingredients;
        $recipeDetails['steps'] = $steps;
        $recipeDetails['comments'] = $comments;
    
        extract($recipeDetails);

        // Pass the fetched data to the view
        require_once __DIR__ . '/../view/recipe.php';
    }
}

?>