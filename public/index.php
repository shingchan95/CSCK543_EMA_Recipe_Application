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

$currentPage = "";
$loggedUser = "";

// Get the current path from the URL and prepare it for parsing
// Basic routing
if (!empty($segments[1])) {
    $currentPage = $segments[1];
    switch ($segments[1]) {
        case 'home':
            $homeController->index($currentPage, $loggedUser);
            break;
        case 'profile':
            $profileController->index($currentPage, $loggedUser);
            break;
        case 'recipe':
            if (!empty($segments[2]) && is_numeric($segments[2])) {
                $recipeId = intval($segments[2]);
                $recipeController->showRecipe($recipeId);
            } else {
                $recipeController->index($currentPage, $loggedUser);
            }
            break;
        case 'login':
            $authController->index();
            $currentPage = $segments[1];
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
            session_start();
            $_SESSION = array();
            session_destroy();
            header("Location: home");
            exit();
        default:
            echo "404 Not Found";
            break;
    }
} else {
    $currentPage = 'home';
    $homeController->index($currentPage, $loggedUser);
}
