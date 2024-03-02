<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../model/UserModel.php';
require __DIR__ . '/../model/RecipeModel.php';

class HomeController {
    private $userModel;
    private $recipeModel;

    
    public function __construct() {
        global $conn; 
        $this->userModel = new UserModel($conn); 
        $this->recipeModel = new RecipeModel($conn); 
    }
    public function index() {
        $recipes = $this->recipeModel->getAllRecipes();
        $this->render('home', ['recipes' => $recipes]);
    }
    public function getRecipeByDietId($dietId) {
        $recipes = $this->recipeModel->getRecipeByDietId($dietId);
        $this->render('home', ['recipes' => $recipes]);
    }
    
    public function render($view, $data = []) {
        include __DIR__ . "/../view/$view.php";
    }
}
?>