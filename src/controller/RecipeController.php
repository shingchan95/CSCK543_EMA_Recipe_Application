<?php

// Include required files
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

    /**
     * Constructor for RecipeController.
     * Initializes recipeModel, favouritesModel and ratingModel instance.
     */
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
    public function index($userId)
    {
        // Handle POST requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                // Check the value of the action parameter
                case 'saveFavorite':
                    // Handlesaving favorite recipes
                    $this->handleSaveFavorite($userId);
                    break;

                case 'giveRating':
                    // Handle giving favorite recipes
                    $this->handleGiveRating($userId);
                    break;
                default:
                    // If the action parameter is invalid, echo error message
                    http_response_code(400);
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
     * @param int $userId The ID of the current user.
     * @throws Exception if recipe details, steps, tips, or ingredients are not found.
     */
    public function showRecipe($recipeId, $userId)
    {
        try {
            // Get recipe details by ID
            $recipeDetails = $this->recipeModel->getRecipeDetailsById($recipeId);
            $isFavourite = $this->favouritesModel->isFavourite($userId, $recipeId);
            if (!$recipeDetails) {
                throw new Exception("Recipe not found");
            }

            // Get steps for the recipe
            $steps = $this->recipeModel->getStepsByRecipeId($recipeId);
            // Get tips for the recipe
            $tips = $this->recipeModel->getTipsByRecipeId($recipeId);
            // Get ingredients for the recipe
            $ingredients = $this->recipeModel->getIngredientsByRecipeId($recipeId);

            // If a user is logged in, get their ratings for the recipe
            if ($userId) {
                // Get category 1 rating
                $ratingC1 = $this->ratingModel->getRating($userId, $recipeId, 1);
                // Get category 2 rating
                $ratingC2 = $this->ratingModel->getRating($userId, $recipeId, 2);
                // Get category 3 rating
                $ratingC3 = $this->ratingModel->getRating($userId, $recipeId, 3);

                // Add all Category 1,2 and 3 do recipe details
                $recipeDetails['ratingC1'] = $ratingC1;
                $recipeDetails['ratingC2'] = $ratingC2;
                $recipeDetails['ratingC3'] = $ratingC3;
            }

            // Add steps, tips, and ingredients to recipe details
            $recipeDetails['isFavourite'] = $isFavourite;
            $recipeDetails['steps'] = $steps;
            $recipeDetails['tips'] = $tips;
            $recipeDetails['ingredients'] = $ingredients;

            // Render the recipe view with recipe details
            $this->render('recipe', ['recipeDetails' => $recipeDetails]);
        } catch (Exception $e) {
            // Print error message to client's console
            echo '<script>console.error(' . json_encode($e->getMessage()) . ')</script>';
            $this->render('recipe', ['recipeDetails' => []]);
        }
    }

    /**
     * Saves the recipe as a favorite for the user.
     * Throws an exception if an error occurs during the operation.
     *
     * @param int $userId The ID of the current user.
     * @throws Exception if an error occurs during favorite saving.
     */
    private function handleSaveFavorite($userId)
    {
        if (isset($_POST['recipeId'])) {
            $recipeId = $_POST['recipeId'];
            try {
                $this->favouritesModel->addToFavorites($userId, $recipeId);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Recipe ID not provided']);
        }
    }

    /**
     * Adds a rating for the recipe given by the user.
     * Throws an exception if an error occurs during the operation.
     *
     * @param int $userId The ID of the current user.
     * @throws Exception if an error occurs during rating addition.
     */
    private function handleGiveRating($userId)
    {
        if (isset($_POST['recipeId'], $_POST['rating'], $_POST['category_id'])) {
            $recipeId = $_POST['recipeId'];
            $rating = $_POST['rating'];
            $categoryId = $_POST['category_id'];
            try {
                // Add the rating for the recipe by the user
                $this->ratingModel->addRating($userId, $recipeId, $rating, $categoryId);
            } catch (Exception $e) {
                http_response_code(500);
                // Echo error message if an exception occurs
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
        }
    }

    /**
     * Delete the favorite recipe for the user.
     * Throws an exception if an error occurs during the operation.
     *
     * @param int $userId The ID of the current user.
     * @param int $recipeId The ID of the recipe to delete.
     * @throws Exception if an error occurs during favorite saving.
     */
    public function handleDeleteFavorite($userId, $recipeId)
    {
        try {
            // Try to delete the recipe as favorite
            $this->favouritesModel->deleteFavorites($recipeId, $userId);
            // Respond with success message
            echo json_encode(['success' => true, 'message' => 'Recipe removed from favorites successfully.']);
        } catch (Exception $e) {
            http_response_code(500);
            // If an exception occurs during favorite deletion, echo error message
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
        }
        include __DIR__ . "/../view/$view.php";
    }

}

?>