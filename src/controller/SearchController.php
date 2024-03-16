<?php
// Include required files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../model/RecipeModel.php';

class SearchController
{

    /**
     * @var UserModel $userModel The UserModel instance.
     * @var RecipeModel $recipeModel The RecipeModel instance.
     */
    private $userModel;
    private $recipeModel;

    public function __construct()
    {
        global $conn;
        $this->userModel = new UserModel($conn);
        $this->recipeModel = new RecipeModel($conn);
    }


    /**
     * Renders the search page.
     */
    public function index()
    {
        $this->render('search', ['recipes' => []]);
    }


    /**
     * Searches for recipes based on search term and type.
     *
     * @param string $searchTerm The search term.
     * @param string $searchType The search type.
     * @throws Exception if no recipes are found matching the search criteria.
     */
    public function searchRecipes($searchTerm, $searchType)
    {
        try {
            if ($searchType === 'all') {
                $recipes = $this->recipeModel->searchRecipes($searchTerm);
            } else {
                $recipes = $this->recipeModel->searchRecipesWithType($searchTerm, $searchType);
            }

            if (!$recipes) {
                throw new Exception("No recipes found matching the search criteria");
            }

            $this->render('search', ['recipes' => $recipes]);
        } catch (Exception $e) {
            echo $e->getMessage();
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
            echo "Recipe not found";
        }
        include __DIR__ . "/../view/$view.php";
    }
}
