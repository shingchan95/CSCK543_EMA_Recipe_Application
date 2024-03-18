<?php

// Include required files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';

/**
 * HomeController class handles home-related operations.
 */
class HomeController
{
    private $userModel;
    private $recipeModel;
    /**
     * Constructor for HomeController.
     * Initializes UserModel and recipeModel instance.
     */

    public function __construct()
    {
        global $conn;
        $this->userModel = new UserModel($conn);
        $this->recipeModel = new RecipeModel($conn);
    }

    /**
     * Renders the home page.
     * Retrieves all recipes and featured recipes from the database.
     * @throws Exception if an error occurs while retrieving recipes.
     */
    public function index()
    {
        try {
            // Retrieve all recipes and featured recipes
            $recipes = $this->recipeModel->getAllRecipes();
            $featuredRecipes = $this->recipeModel->getFeaturedRecipes();
            // Render home view with recipes and featured recipes data
            $this->render('home', ['recipes' => $recipes, 'featuredRecipes' => $featuredRecipes]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

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
        // Extract data for easy access in the view
        extract($data);
        include __DIR__ . "/../view/$view.php";
    }
}
