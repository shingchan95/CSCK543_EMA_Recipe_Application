<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';
require_once __DIR__ . '/../model/FavouritesModel.php';
require_once __DIR__ . '/../model/RatingModel.php';
class RecipeController {
    private $recipeModel;
    private $favouritesModel;
    private $ratingModel;

    public function __construct() {
        global $conn;
        $this->recipeModel = new RecipeModel($conn);
        $this->favouritesModel = new FavouritesModel($conn);
        $this->ratingModel = new RatingModel($conn);

    }
    public function index() {
        include __DIR__. '/../view/recipe.php';
    }

    public function showRecipe($recipeId, $userId) {
        $recipeDetails = $this->recipeModel->getRecipeDetailsById($recipeId);
      
        if ($recipeDetails) {
            if ($userId){
                $isFavourite = $this->favouritesModel->isFavourite($recipeId, $userId);
                $recipeDetails['isFavourite'] = $isFavourite;

            }
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

    public function saveFavorite($recipeId, $userId){
        
        try { 
            $this->favouritesModel->addToFavorites($userId, $recipeId);         
            echo json_encode(['isFavorite' => true]);
        } 
        catch (Exception $e) {      
            echo json_encode(['error' => $e->getMessage()]);   
        }
    

        }
    public function addRating($recipeId, $userId, $rating, $category_id){
       

        try { 
            
            $this->ratingModel->addRating($recipeId, $userId, $rating, $category_id); 
            echo 'give rating man';        
            echo json_encode(['Rated' => true]);
           
        } 
        catch (Exception $e) {      
            echo json_encode(['error' => $e->getMessage()]);   
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


