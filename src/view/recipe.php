<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dynamically set the title based on recipe details -->
    <title><?php echo htmlspecialchars($recipeDetails['recipe'] ?? 'Recipe Title'); ?></title>
    <!-- Linking external CSS files -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/recipe.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>
    <!-- Display recipe details if available -->
    <?php if (!empty($recipeDetails)): ?>
        <section class="top-container">
            <!-- Left box containing recipe photo -->
            <div class="left-box">
                <!-- Verify if image is available -->
                <?php if (!empty($recipeDetails["image_path"])): ?>
                    <img src="/image/600/<?php echo htmlspecialchars($recipeDetails["image_path"]); ?>"
                        alt="<?php echo $recipeDetails['recipe']; ?>"
                        class="recipe-photo">
                <?php else: ?>
                    <!-- If no image available, display default photo -->
                    <img src="default-recipe-photo.jpg" alt="No Photo Available" class="recipe-photo">
                <?php endif; ?>
            </div>
            <!-- Middle box containing recipe intro -->
            <div class="middle-box">
                <div class="recipe-intro">
                    <h1><?php echo htmlspecialchars($recipeDetails['recipe']); ?></h1>
                    <p>
                        <b>Author: </b>
                        <span class="author"><?php echo htmlspecialchars($recipeDetails['author']); ?></span>
                    </p>
                    <p>
                        <b>Description: </b>
                        <span class="description"><?php echo htmlspecialchars($recipeDetails['tagline']); ?></span>
                    </p>
                </div>
            </div>
            <!-- Right box containing interactive features -->
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']): ?>
                <div class="right-box">
                    <section class="interactive-features">
                        <!-- Button to save or delete recipe to/from favorites -->
                        <?php if ($recipeDetails["isFavourite"] == 0): ?>
                            <button class="save-recipe"
                                    onclick="saveBtn('<?php echo htmlspecialchars($recipeDetails['id']); ?>')">Save Recipe
                                to Favourites
                            </button>
                        <?php else: ?>
                            <button class="save-recipe"
                                    onclick="deleteBtn('<?php echo htmlspecialchars($recipeDetails['id']); ?>')">Delete
                                Recipe to Favourites
                            </button>
                        <?php endif; ?>
                        <!-- Star rating feature -->
                        <div class="star-container">
                            <span onclick="saveRating(1)" class="star">★</span>
                            <span onclick="saveRating(2)" class="star">★</span>
                            <span onclick="saveRating(3)" class="star">★</span>
                            <span onclick="saveRating(4)" class="star">★</span>
                            <span onclick="saveRating(5)" class="star">★</span>
                        </div>
                        <!-- Output rating display -->
                        <div id="output_rating"></div>
                    </section>
                </div>
            <?php endif; ?>
        </section>
        <!-- Middle container containing ingredients and cooking method -->
        <div class="middle-container">
            <section class="ingredients-time">
                <!-- Ingredients section -->
                <h2>Ingredients</h2>
                <!-- Slider for servings and dynamic display of ingredients -->
                <div class="slideContainer">
                    <input type="range" min="1" max="20" value="<?php echo $recipeDetails['servings']; ?>" id="myRange"
                           class="slider">
                    <p><b>Servings:&nbsp;</b><span id="Value"><?php echo $recipeDetails['servings']; ?></span></p>
                </div>
                <!-- Dynamically display ingredients list -->
                <?php if (isset($recipeDetails['ingredients']) && is_array($recipeDetails['ingredients'])): ?>
                    <ul class="ingredients">
                        <?php foreach ($recipeDetails['ingredients'] as $ingredient): ?>
                            <li>
                                <?php echo $ingredient['ingredient'] . ": " .
                                    $ingredient['amount'] . " " .
                                    $ingredient['unit']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <!-- Display cooking time -->
                <p>Time to Cook: <span
                            class="time-to-cook"><?php echo htmlspecialchars($recipeDetails['cooking']); ?></span>
                    minutes</p>
            </section>
            <!-- Cooking method section -->
            <section class="cooking-method">
                <h2>Preparation Steps</h2>
                <!-- Dynamically display cooking steps -->
                <?php if (isset($recipeDetails['steps']) && is_array($recipeDetails['steps'])): ?>
                    <ol class="steps">
                        <?php foreach ($recipeDetails['steps'] as $step): ?>
                            <li><b><?php echo htmlspecialchars($step['minutes']); ?> Minutes - </b>
                                <?php echo htmlspecialchars($step['step']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
            </section>
        </div>
    <?php else: ?>
        <!-- Display message if recipe not found -->
        <p>Recipe not found.</p>
    <?php endif; ?>
</main>
<!-- Including footer -->
<?php include 'component/footer.php'; ?>
<!-- Assigning PHP variables to JavaScript -->
<script>
    const originalServings = <?php echo json_encode($recipeDetails['servings']); ?>;
    const ingredients = <?php echo json_encode($recipeDetails['ingredients']); ?>;
    const recipeId = <?php echo json_encode($recipeDetails['id']); ?>;
    const rating = "<?php echo isset($recipeDetails['ratingC1']) ? htmlspecialchars($recipeDetails['ratingC1']) : ''; ?>";
</script>
<!-- Including external JavaScript files -->
<script src="/js/recipe.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
