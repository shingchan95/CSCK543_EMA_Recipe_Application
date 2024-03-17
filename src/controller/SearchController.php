<?php
// Include required files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';
 
class SearchController {

    /**
     * @var UserModel $userModel The UserModel instance.
     * @var RecipeModel $recipeModel The RecipeModel instance.
     */
    private $userModel;
    private $recipeModel;

    public function __construct() {
        global $conn;
        $this->userModel = new UserModel($conn);
        $this->recipeModel = new RecipeModel($conn);
    }


    /**
     * Index method handles rendering the search page and processing search requests.
     */
    public function index() {
      // Check if the request method is GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Get search type and term from GET parameters
            $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : 'all';
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            // Call searchRecipes method to search for recipes
            if(empty($searchTerm)) {
                $this->render('search', ['recipes' => []]);
            }else{
                $this->searchRecipes($searchTerm, $searchType);
            }
        } 
    }


    /**
     * Searches for recipes based on search term and type.
     *
     * @param string $searchTerm The search term.
     * @param string $searchType The search type.
     * @throws Exception if no recipes are found matching the search criteria.
     */
    private function searchRecipes($searchTerm, $searchType) {
        try {
            // Check if the search type is 'all', otherwise search with specific type
            if ($searchType === 'all') {
                $recipes = $this->recipeModel->searchRecipes($searchTerm);
            } else {
                $recipes = $this->recipeModel->searchRecipesWithType($searchTerm, $searchType);
            }
            // Render the search page with the search results
            $this->render('search', ['recipes' => $recipes]);
        } catch (Exception $e) {
            // If an exception occurs, display the error message
            echo $e->getMessage();
            throw $e;
        }
    }


    /**
     * Renders a view with data.
     *
     * @param string $view The view file name.
     * @param array $data The data to be passed to the view.
     */
    private function render($view, $data = []) {
        // Extract data if not empty, otherwise display a message
        if (!empty($data)) {
            extract($data);
        } else {
            echo "Recipe not found";
        }
        include __DIR__ . "/../view/$view.php";
    }
}