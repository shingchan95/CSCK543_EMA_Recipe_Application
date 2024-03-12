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
        include __DIR__. '/../view/recipe.php';
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


