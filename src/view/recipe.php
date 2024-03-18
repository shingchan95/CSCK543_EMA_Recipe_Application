<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipeDetails['recipe'] ?? 'Recipe Title'); ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/recipe.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>
    <?php if (!empty($recipeDetails)): ?>
        <section class="top-container">

            <div class="left-box">
                <!-- Verify image is available -->
                <?php if (!empty($recipeDetails["image_path"])): ?>
                    <img src="/image/600/<?php echo htmlspecialchars($recipeDetails["image_path"]); ?>"
                        alt="<?php echo$recipeDetails['recipe']?>"
                        class="recipe-photo"><?php else: ?>
                    <!-- If no image available -->
                    <img src="default-recipe-photo.jpg" alt="No Photo Available" class="recipe-photo"><?php endif; ?>
            </div>

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

            <div class="right-box">
                <section class="interactive-features">
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
                    <div class="star-container">
                        <span onclick="saveRating(1)" class="star">★</span>
                        <span onclick="saveRating(2)" class="star">★</span>
                        <span onclick="saveRating(3)" class="star">★</span>
                        <span onclick="saveRating(4)" class="star">★</span>
                        <span onclick="saveRating(5)" class="star">★</span>
                    </div>
                    <div id="output_rating"></div>

            </div>
        </section>

        <div class="middle-container">
            <section class="ingredients-time">

                <h2>Ingredients</h2>
                <div class="slideContainer">
                    <input type="range" min="1" max="20" value="<?php echo $recipeDetails['servings']; ?>" id="myRange"
                           class="slider">
                    <p><b>Servings:&nbsp;</b><span id="Value"><?php echo $recipeDetails['servings']; ?></span></p>
                </div>

                <!-- Dynamically display ingredients -->
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
                <p>Time to Cook: <span
                            class="time-to-cook"><?php echo htmlspecialchars($recipeDetails['cooking']); ?></span>
                    minutes</p>
            </section>

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
        <p>Recipe not found.</p>
    <?php endif; ?>
</main>

<?php include 'component/footer.php'; ?>

<script>
    const originalServings = <?php echo json_encode($recipeDetails['servings']); ?>;
    const ingredients = <?php echo json_encode($recipeDetails['ingredients']); ?>;
    const recipeId = <?php echo json_encode($recipeDetails['id']); ?>;
    const rating = "<?php echo isset($recipeDetails['ratingC1']) ? htmlspecialchars($recipeDetails['ratingC1']) : ''; ?>";
</script>
<script src="/js/recipe.js"></script>
<script src="/js/script.js"></script>
</body>
</html>


