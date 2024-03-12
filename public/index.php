<?php

require '../src/controller/HomeController.php';
require '../src/controller/ProfileController.php';
require '../src/controller/RecipeController.php';
require '../src/controller/AuthController.php';
require '../src/controller/SearchController.php';

$homeController = new HomeController();
$profileController = new ProfileController();
$recipeController = new RecipeController();
$authController = new AuthController();
$searchController = new SearchController();

$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$segments = explode('/', $path);

// Get the current path from the URL and prepare it for parsing
// Basic routing
if (!empty($segments[1])) {
    session_start();

    switch ($segments[1]) {
        case 'home':
            $_SESSION['current_page'] = $segments[1];
            $homeController->index();
            break;

        case 'profile':
            $_SESSION['current_page'] = $segments[1];
            $profileController->index();
            break;

        case 'recipe':
            $_SESSION['current_page'] = $segments[1];
            if (!empty($segments[2]) && is_numeric($segments[2])) {
                $recipeId = intval($segments[2]);
                $recipeController->showRecipe($recipeId);
            } else {
                $recipeController->index();
            }
            break;

        case 'login':
            $authController->index();
            break;

        case 'search':
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
