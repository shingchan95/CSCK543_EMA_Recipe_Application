<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';

class HomeController
{
    private $userModel;
    private $recipeModel;


    public function __construct()
    {
        global $conn;
        $this->userModel = new UserModel($conn);
        $this->recipeModel = new RecipeModel($conn);
    }

    public function index($currentPage, $loggedUser)
    {
        $recipes = $this->recipeModel->getAllRecipes();
        $featuredRecipes = $this->recipeModel->getFeaturedRecipes();
        $this->render('home', ['recipes' => $recipes, 'featuredRecipes' => $featuredRecipes]);
    }

    // public function getRecipeByDietId($dietId) {
    //     $recipes = $this->recipeModel->getRecipeByDietId($dietId);
    //     $this->render('home', ['recipes' => $recipes]);
    // }
 
    // public function searchRecipes($searchTerm) {
    //     $recipes = $this->recipeModel->searchRecipes($searchTerm);
    //     // $recipes = $this->recipeModel->getRecipeByDietId($searchTerm);
    //     $this->render('home', ['recipes' => $recipes]);
    // }
   
    public function render($view, $data = []) {
        include __DIR__ . "/../view/$view.php";
    }
}
?>