<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';
class RecipeController {
    private $recipeModel;

    public function __construct() {
        global $conn;
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

    public function showRecipe($recipeId) {
        $recipeDetails = $this->recipeModel->getRecipeDetailsById($recipeId);
      
        if ($recipeDetails) {
            $steps = $this->recipeModel->getStepsByRecipeId($recipeId);
            $tips = $this->recipeModel->getTipsByRecipeId($recipeId);
            $ingredients = $this->recipeModel->getIngredientsByRecipeId($recipeId);
            $recipeDetails['steps'] = $steps;
            $recipeDetails['tips'] = $tips;
            $recipeDetails['ingredients'] = $ingredients;

            $this->render('recipe', ['recipeDetails' => $recipeDetails]);
        } else {
            echo "Recipe not found";
        }
    }


    public function render($view, $data = []) {
        if (!empty($data)) {
            extract($data);
        } else {
            echo "Recipe not found";
        }
        include __DIR__ . "/../view/$view.php";
    }
}

?>

