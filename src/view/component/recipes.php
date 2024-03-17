<?php

function displayRecipes($recipes, $addRemoveButton)
{
    echo '<div class="recipe_container">';
    foreach ($recipes as $recipe) {
        echo '<div class="card" onclick="goTo(\'/CSCK543_EMA_Recipe_Application/recipe\', ' . htmlspecialchars($recipe['id']) . ')">';
        if ($addRemoveButton) {
            echo '<button class="remove_favorite_btn" data-recipe-id="' . htmlspecialchars($recipe['recipe_id']) . '">X</button>';
        }
        echo '<h3>' . htmlspecialchars($recipe['recipe']) . '</h3>';
        echo '<img class="card_image" src="/image/600/' . htmlspecialchars($recipe['image_path']) . '" alt="Recipe Image">';
        echo '<p><b>Diet: </b>' . htmlspecialchars($recipe['diet']) . '</p>';
        echo '<p><b>Course: </b>' . htmlspecialchars($recipe['course']) . '</p>';
        echo '<p><b>Preparation: </b>' . htmlspecialchars($recipe['preparation']) . ' minutes</p>';
        echo '<p><b>Cooking: </b>' . htmlspecialchars($recipe['cooking']) . ' minutes</p>';
        echo '<p><b>Author: </b>' . htmlspecialchars($recipe['author']) . '</p>';
        $date = date_create($recipe['added']);
        echo '<p><b>Added: </b>' . htmlspecialchars(date_format($date, "d/m/Y")) . '</p>';
        echo '</div>';
    }
    echo '</div>';
}

