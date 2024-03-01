/*
The Views are where the frontend guys work. Designing them as the example below and using the script.JS and style.CSS files
to style the pages.

It is important that we specify the information we need from the backend guys. on the render method's parameters.
The backend then needs to make sure the views get the required information.

*/
<?php

class ExampleUserView {

public function render($user) { // Here I'm saying I need to receive a user from the backend, and then I access it's name
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Greeting</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<h1>Hello, <?php echo htmlspecialchars($user['name']); ?>!</h1>
<script src="/public/js/script.js"></script>
</body>
</html>
<?php
}
}
