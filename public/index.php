<?php

require '../src/controller/HomeController.php';
require '../src/controller/ProfileController.php';
require '../src/controller/RecipeController.php';
require '../src/controller/AuthController.php';
require '../src/controller/SearchController.php';

$homeController = new HomeController();
$profileController = new ProfileController();
$recipeController = new RecipeController($conn); // Passing the database connection here
$authController = new AuthController();
$searchController = new SearchController();

$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$segments = explode('/', $path);

if (!empty($segments[1])) {
    session_start();
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    switch ($segments[1]) {
        case 'home':
            $_SESSION['current_page'] = $segments[1];
            $homeController->index();
            break;

        case 'profile':
            $_SESSION['current_page'] = $segments[1];
            $profileController->index($user_id);
            break;

        case 'recipe':
            $_SESSION['current_page'] = $segments[1];
            if (!empty($segments[2]) && is_numeric($segments[2])) {
                $recipeId = intval($segments[2]);
                $recipeController->showRecipe($recipeId, $user_id);
            } 
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
                $action = $_POST['action']; 
                switch ($action) { 
                    case 'saveFavorite': 
                        $recipeId = $_POST['recipeId'];
                        $recipeController->saveFavorite($recipeId, $user_id); 
                        break; 
                    case 'giveRating':
                        $recipeId = $_POST['recipeId'];
                        $user_Id = $_POST['user_Id'];
                        $rating = $_POST['rating'];
                        $category_id = $_POST['category_id'];
                        $recipeController->addRating($recipeId, $user_id, $rating, $category_id); 
                        break; 
                    default: 
                          echo "Invalid action"; 
                          break; 
                }
            }
            else {
                $recipeController->index();
            }
            break;


        case 'login':
            $authController->index();
            break;

        case 'search':
            $_SESSION['current_page'] = $segments[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : 'all';
                $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                $searchController->searchRecipes($searchTerm, $searchType);
            } else {
                $searchController->index();
            }
            break;

        case 'logout':
            $_SESSION = array();
            session_destroy();
            header("Location: home");
            exit();

        default:
            echo "404 Not Found";
            break;
    }
} else {
    $homeController->index();
}

?>
