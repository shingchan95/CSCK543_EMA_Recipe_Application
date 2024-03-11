<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
 
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';
 
class SearchController {
    private $userModel;
    private $recipeModel;

    public function __construct() {
        global $conn;
        $this->userModel = new UserModel($conn);
        $this->recipeModel = new RecipeModel($conn);
    }

    public function index() {
        $recipes = $this->recipeModel->getAllRecipes();
        $this->render('search', ['recipes' => $recipes]);
    }

    public function searchRecipes($searchTerm, $searchType) {
            if ($searchType === 'all') {
                $recipes = $this->recipeModel->searchRecipes($searchTerm);
            } else {
                $recipes = $this->recipeModel->searchRecipesWithType($searchTerm, $searchType);
            }   
            $this->render('search', ['recipes' => $recipes]);
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