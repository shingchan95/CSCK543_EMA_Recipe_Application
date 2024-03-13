<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipeDetails['recipe']); ?></title>
    <link rel="stylesheet" href="../public/css/recipestyle.css"> 
</head>
<body>
   
    <main>
        <section class="top-container">
            <img src="<?php echo htmlspecialchars($recipeDetails['photo_url']); ?>" alt="Recipe Photo" class="recipe-photo">
       
       
            <!--
            <div class="recipe-intro">
                <h1><?php echo htmlspecialchars($recipeDetails['recipe']); ?></h1>
                <p>Author: <span class="author"><?php echo htmlspecialchars($recipeDetails['author']); ?></span></p>
                <p>Rating: <span class="rating"><?php echo htmlspecialchars($recipeDetails['average_rating']); ?> Stars</span></p>
                <p>Description: <span class="description"><?php echo htmlspecialchars($recipeDetails['description']); ?></span></p>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
            <section class="interactive-features">
                <button class="save-recipe" onclick="saveToFavourites(<?php echo $recipeDetails['id']; ?>)">Save Recipe to Favourites</button>
                <label>Rate the Recipe:
                    <select class="rate-recipe" onchange="rateRecipe(<?php echo $recipeDetails['id']; ?>, this.value)">
                        <option value="">Choose a rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </label>
            </section>
            <?php endif; ?>
        </section>

        <div class="middle-container">
            <section class="ingredients-time">
                <h2>Ingredients</h2>
                <ul class="ingredients">
                    <?php foreach ($recipeDetails['ingredients'] as $ingredient) {
                        echo "<li>" . htmlspecialchars($ingredient) . "</li>";
                    } ?>
                </ul>
                <p>Time to Cook: <span class="time-to-cook"><?php echo htmlspecialchars($recipeDetails['time_to_cook']); ?> minutes</span></p>
            </section>

            <section class="cooking-method">
                <h2>Method</h2>
                <ol class="method">
                    <?php foreach ($recipeDetails['method'] as $method) {
                        echo "<li>" . htmlspecialchars($method) . "</li>";
                    } ?>
                </ol>
            </section>
        </div>

        <section class="bottom-container">
            <h2>User Comments</h2>
            <?php foreach ($recipeDetails['comments'] as $comment) {
                echo "<div class=\"comment\"><p class=\"user\">" . htmlspecialchars($comment['user_name']) . "</p><p>" . htmlspecialchars($comment['comment']) . "</p><p>Rating: <span class=\"user-rating\">" . htmlspecialchars($comment['rating']) . " Stars</span></p></div>";
            } ?>
        </section>
    </main>
    <script>

        // JavaScript for interactive features - NEED BACKEND FEATURES?
    function saveToFavourites(recipeId) {
    fetch('/api/saveToFavourites.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // 'X-CSRF-TOKEN': 'your_csrf_token_here', // How to do this?
        },
        body: JSON.stringify({
            recipeId: recipeId
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Handle response data
        alert('Recipe saved to favourites!');
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('An error occurred while saving to favourites.');
    });
}

function rateRecipe(recipeId, rating) {
    fetch('/api/rateRecipe.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // 'X-CSRF-TOKEN': 'your_csrf_token_here', // How to do this?
        },
        body: JSON.stringify({
            recipeId: recipeId,
            rating: rating
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Handle response data
        alert('Rating submitted successfully!');
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('An error occurred while submitting your rating.');
    });
}
    </script>
    <?php include 'footer.php'; // TBD Miguel ?>
</body>
</html>
