<?php

// require 'controller/ExampleUserController.php';
require '../src/controller/HomeController.php';
require '../src/controller/ProfileController.php';
require '../src/controller/RecipeController.php';
require '../src/controller/AuthController.php';

// Here we instantiate all the classes that will be required by our app, in this example the only existing controller.
// $userController = new ExampleUserController();
$homeController = new HomeController();
$profileController = new ProfileController();
$recipeController = new RecipeController();
$authController = new AuthController();

$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$segments = explode('/', $path);

// Get the current path from the URL and prepare it for parsing
// Basic routing
if (!empty($segments[2])) {
    switch ($segments[2]) {
        // case 'hello':
            // This is an example for the path /hello/{name}, as "/hello/miguel
            // $name = $segments[1];
            // $userController->sayHello($name);
            // break;
        case 'home':
            $homeController->index();
            break;
        case 'profile':
            $profileController->index();
            break;
        case 'recipe':
            $recipeController->index();
            break;
        case 'login':
            $authController->index();
            break;
        default:
            echo "404 Not Found";
            break;
    }
} else {
    /*
    If there is no path,we should have a homepage controller of some sorts that we call here
    to render the homepage.
    So: $homeController->render()
    */
    $homeController->index();
}
