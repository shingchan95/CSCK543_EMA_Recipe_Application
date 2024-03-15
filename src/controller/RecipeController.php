<?php

// Include required files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';
require_once __DIR__ . '/../model/FavouritesModel.php';
require_once __DIR__ . '/../model/RatingModel.php';
class RecipeController {
    /**
     * @var RecipeModel $recipeModel The RecipeModel instance.
     */
    private $recipeModel;
    private $favouritesModel;
    private $ratingModel;

    public function __construct() {
        global $conn;
        $this->recipeModel = new RecipeModel($conn);
        $this->favouritesModel = new FavouritesModel($conn);
        $this->ratingModel = new RatingModel($conn);

    }

    /**
     * Renders the recipe page.
     */
    public function index() {
        include __DIR__. '/../view/recipe.php';
    }

    /**
     * Shows the details of a recipe.
     *
     * @param int $recipeId The ID of the recipe to show.
     * @throws Exception if recipe details, steps, tips, or ingredients are not found.
     */
    public function showRecipe($recipeId) {
        try {
            $recipeDetails = $this->recipeModel->getRecipeDetailsById($recipeId);
    
            if (!$recipeDetails) {
                throw new Exception("Recipe not found");
            }

            $steps = $this->recipeModel->getStepsByRecipeId($recipeId);
            if (!$steps) {
                throw new Exception("Error retrieving steps for the recipe");
            }
    
            $tips = $this->recipeModel->getTipsByRecipeId($recipeId);
            if (!$tips) {
                throw new Exception("Error retrieving tips for the recipe");
            }
    
            $ingredients = $this->recipeModel->getIngredientsByRecipeId($recipeId);
            if (!$ingredients) {
                throw new Exception("Error retrieving ingredients for the recipe");
            }
    
            $recipeDetails['steps'] = $steps;
            $recipeDetails['tips'] = $tips;
            $recipeDetails['ingredients'] = $ingredients;
    
            $this->render('recipe', ['recipeDetails' => $recipeDetails]);
        } catch (Exception $e) {
            echo $e->getMessage();
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

    /**
     * Renders a view with data.
     *
     * @param string $view The view file name.
     * @param array $data The data to be passed to the view.
     */

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


