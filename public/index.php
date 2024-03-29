<?php

// Including required controller files
require '../src/controller/HomeController.php';
require '../src/controller/ProfileController.php';
require '../src/controller/RecipeController.php';
require '../src/controller/AuthController.php';
require '../src/controller/SearchController.php';

// Creating instances of controllers
$homeController = new HomeController();
$profileController = new ProfileController();
$recipeController = new RecipeController();
$authController = new AuthController();
$searchController = new SearchController();

// Parsing the URL path
$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$segments = explode('/', $path);

// Handling routing based on URL segments
if (!empty($segments[1])) {
    // Starting session and retrieving user ID from session if available
    session_start();
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    // Switching based on the first segment of the URL path
    switch ($segments[1]) {
        case 'home':
            // Route to home page
            $_SESSION['current_page'] = $segments[1]; // Set current page in session
            $homeController->index(); // Call index method of HomeController
            break;

        case 'profile':
            // Route to profile page, passing user ID for authentication
            $_SESSION['current_page'] = $segments[1]; // Set current page in session
            $profileController->index($user_id); // Call index method of ProfileController with user ID
            break;

        case 'recipe':
            if (!empty($segments[2]) && is_numeric($segments[2])) {
                if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
                    $recipeId = $segments[2]; // Get recipe ID from URL segment
                    $recipeController->handleDeleteFavorite($user_id, $recipeId);// Call handleDeleteFavorite method of RecipeController
                }
                else{
                    // If recipe ID is provided, show recipe details
                    $_SESSION['current_page'] = $segments[1];// Set current page in session
                    $recipeId = intval($segments[2]);// Convert recipe ID to integer
                    $recipeController->showRecipe($recipeId, $user_id);// Call showRecipe method of RecipeController with recipe ID and user ID
                }
            }
             else {
                // Otherwise, show recipe listing
                $recipeController->index($user_id);
            }
            break;

        case 'login':
            // Route to login page
            $authController->index();
            break;

        case 'search':
            // Route to search page
            $_SESSION['current_page'] = $segments[1];
            $searchController->index();
            break;

        case 'logout':
            // Log out user and redirect to home page
            $authController->handleLogout();
            break;

        default:
            // Handle 404 Not Found error
            echo "404 Not Found";
            break;
    }
} else {
    // If no path is specified, route to home page by default
    $homeController->index();
}

?>
