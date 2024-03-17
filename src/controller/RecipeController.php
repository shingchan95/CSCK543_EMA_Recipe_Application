<?php

// Include required files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';
require_once __DIR__ . '/../model/FavouritesModel.php';
require_once __DIR__ . '/../model/RatingModel.php';

class RecipeController
{
    private $recipeModel;
    private $favouritesModel;
    private $ratingModel;

    public function __construct()
    {
        global $conn;
        $this->recipeModel = new RecipeModel($conn);
        $this->favouritesModel = new FavouritesModel($conn);
        $this->ratingModel = new RatingModel($conn);

    }

    /**
     * Renders the recipe page.
     * Handles actions like saving favorite and giving ratings based on POST requests.
     * If no action is specified, renders the recipe view.
     */
    public function index($user_id)
    {
        // Check if a POST request with an action parameter is received
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                // Check the value of the action parameter
                case 'saveFavorite':
                    try {
                        // Try to save the recipe as favorite
                        $recipeId = $_POST['recipeId'];
                        $this->saveFavorite($recipeId, $user_id);
                    } catch (Exception $e) {
                        // If an exception occurs during favorite saving, echo error message
                        echo json_encode(['error' => $e->getMessage()]);
                    }
                    break;
                case 'giveRating':
                    try {
                        // Try to add rating to the recipe
                        $recipeId = $_POST['recipeId'];
                        $rating = $_POST['rating'];
                        $category_id = $_POST['category_id'];
                        $this->addRating($recipeId, $user_id, $rating, $category_id);
                    } catch (Exception $e) {
                        // If an exception occurs during rating addition, echo error message
                        echo json_encode(['error' => $e->getMessage()]);
                    }
                    break;
                default:
                    // If the action parameter is invalid, echo error message
                    echo "Invalid action";
                    break;
            }
        } else {
            // If the request method is not POST or action parameter is not set, render the recipe view
            include __DIR__ . '/../view/recipe.php';
        }
    }

    /**
     * Shows the details of a recipe.
     * Fetches recipe details, steps, tips, and ingredients.
     * Handles exceptions if any details are not found.
     *
     * @param int $recipeId The ID of the recipe to show.
     * @throws Exception if recipe details, steps, tips, or ingredients are not found.
     */
    public function showRecipe($recipeId, $userId)
    {
        try {
            // Get recipe details by ID
            $recipeDetails = $this->recipeModel->getRecipeDetailsById($recipeId);

            if (!$recipeDetails) {
                throw new Exception("Recipe not found");
            }

            // Get steps for the recipe
            $steps = $this->recipeModel->getStepsByRecipeId($recipeId);
            if (!$steps) {
                throw new Exception("Error retrieving steps for the recipe");
            }

            // Get tips for the recipe
            $tips = $this->recipeModel->getTipsByRecipeId($recipeId);
            if (!$tips) {
                throw new Exception("Error retrieving tips for the recipe");
            }

            // Get ingredients for the recipe
            $ingredients = $this->recipeModel->getIngredientsByRecipeId($recipeId);
            if (!$ingredients) {
                throw new Exception("Error retrieving ingredients for the recipe");
            }

            // If a user is logged in, get their ratings for the recipe
            if ($userId) {
                $ratingC1 = $this->ratingModel->getRating($userId, $recipeId, 1);
                $ratingC2 = $this->ratingModel->getRating($userId, $recipeId, 2);
                $ratingC3 = $this->ratingModel->getRating($userId, $recipeId, 3);

                $recipeDetails['ratingC1'] = $ratingC1;
                $recipeDetails['ratingC2'] = $ratingC2;
                $recipeDetails['ratingC3'] = $ratingC3;
            }

            // Add steps, tips, and ingredients to recipe details
            $recipeDetails['steps'] = $steps;
            $recipeDetails['tips'] = $tips;
            $recipeDetails['ingredients'] = $ingredients;

            // Render the recipe view with recipe details
            $this->render('recipe', ['recipeDetails' => $recipeDetails]);
        } catch (Exception $e) {
            // Echo error message if an exception occurs
            echo '<script>console.error(' . json_encode($e->getMessage()) . ')</script>';
            $this->render('recipe', ['recipeDetails' => []]);
        }
    }

    /**
     * Saves the recipe as a favorite for the user.
     * Throws an exception if an error occurs during the operation.
     *
     * @param int $recipeId The ID of the recipe to save as favorite.
     * @param int $userId The ID of the current user.
     * @throws Exception if an error occurs during favorite saving.
     */
    private function saveFavorite($recipeId, $userId)
    {
        try {
            // Add the recipe to favorites for the user
            $this->favouritesModel->addToFavorites($userId, $recipeId);
            // Echo success message
            echo json_encode(['isFavorite' => true]);
        } catch (Exception $e) {
            // Echo error message if an exception occurs
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Adds a rating for the recipe given by the user.
     * Throws an exception if an error occurs during the operation.
     *
     * @param int $recipeId The ID of the recipe to rate.
     * @param int $userId The ID of the current user.
     * @param int $rating The rating given by the user.
     * @param int $category_id The category ID for the rating.
     * @throws Exception if an error occurs during rating addition.
     */
    private function addRating($recipeId, $userId, $rating, $category_id)
    {
        try {
            // Add the rating for the recipe by the user
            $this->ratingModel->addRating($recipeId, $userId, $rating, $category_id);
            // Echo success message
            echo 'give rating man';
            echo json_encode(['Rated' => true]);
        } catch (Exception $e) {
            // Echo error message if an exception occurs
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Renders a view with data.
     *
     * @param string $view The view file name.
     * @param array $data The data to be passed to the view.
     */

    public function render($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        } else {
            // If data is empty, echo error message
            echo "Recipe not found";
        }
        include __DIR__ . "/../view/$view.php";
    }

}

?>


