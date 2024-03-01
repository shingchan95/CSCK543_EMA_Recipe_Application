<?php

require 'controller/ExampleUserController.php';

// Here we instantiate all the classes that will be required by our app, in this example the only existing controller.
$userController = new ExampleUserController();

// Get the current path from the URL and prepare it for parsing
$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
$segments = explode('/', $path);

// Basic routing
if (!empty($segments[0])) {
    switch ($segments[0]) {
        case 'hello':
            // This is an example for the path /hello/{name}, as "/hello/miguel
            $name = $segments[1];
            $userController->sayHello($name);
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
}
