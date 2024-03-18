<?php
// Function to display recipes
function displayRecipes($recipes, $addRemoveButton)
{
    // Open container for recipe display
    echo '<div class="recipe_container">';
    // Loop through each recipe
    foreach ($recipes as $recipe) {
        // Determine the ID based on the current page
        $customId = $_SESSION["current_page"] == "profile" ? "recipe_id" : "id";
        // Start card element with onclick event to navigate to recipe page
        echo '<div class="card" onclick="goTo(\'/CSCK543_EMA_Recipe_Application/recipe\', ' . htmlspecialchars($recipe[$customId]) . ')">';
        // Add remove button if specified
        if ($addRemoveButton) {
            echo '<button class="remove_favorite_btn" data-recipe-id="' . htmlspecialchars($recipe['recipe_id']) . '">X</button>';
        }
        // Display recipe name and image
        echo '<h3>' . htmlspecialchars($recipe['recipe']) . '</h3>';
        echo '<img class="card_image" src="/image/600/' . htmlspecialchars($recipe['image_path']) . '" alt="' . htmlspecialchars($recipe['recipe']) . '">';
        // Display diet, course, preparation time, cooking time, author, and added date
        echo '<p><b>Diet: </b>' . htmlspecialchars($recipe['diet']) . '</p>';
        echo '<p><b>Course: </b>' . htmlspecialchars($recipe['course']) . '</p>';
        echo '<p><b>Preparation: </b>' . htmlspecialchars($recipe['preparation']) . ' minutes</p>';
        echo '<p><b>Cooking: </b>' . htmlspecialchars($recipe['cooking']) . ' minutes</p>';
        echo '<p><b>Author: </b>' . htmlspecialchars($recipe['author']) . '</p>';
        $date = date_create($recipe['added']);
        // Format and display added date as dd/mm/yyyy
        echo '<p><b>Added: </b>' . htmlspecialchars(date_format($date, "d/m/Y")) . '</p>';
        // Close card element
        echo '</div>';
    }
    // Close container for recipe display
    echo '</div>';
}
?>
