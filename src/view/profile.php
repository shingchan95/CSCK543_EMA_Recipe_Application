<?php

$favoriteRecipes = [
    ["recipe" => "d1221d", "image_path" => "easy_lamb_biryani.jpg", "diet" => "Omni",
        "course" => "Main", "preparation" => "", "cooking" => "32",
        "author" => "Mike", "added" => "Today"],
    ["recipe" => "213123", "image_path" => "mango_pie.jpg", "diet" => "Omni",
        "course" => "Main", "preparation" => "", "cooking" => "32",
        "author" => "Mike", "added" => "Today"]
]


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>
    <h1>Profile Details</h1>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <strong>
            User is not logged in.
        </strong>
    <?php else: ?>
    <section id="user_details">
        <div>
            <p><b>Username: </b> <?php echo htmlspecialchars($profileDetails['username']); ?></p>
        </div>
        <div>
            <p><b>Email: </b> <?php echo htmlspecialchars($profileDetails['email']); ?></p>
        </div>
        <div>
            <p><b>Account Created: </b> <?php echo htmlspecialchars($profileDetails['created']); ?></p>
        </div>
        <div>
            <p><b>Last Login: </b> <?php echo htmlspecialchars($profileDetails['last_login']); ?></p>
        </div>
        <?php endif; ?>
    </section>
    <section>
        <h2>
            Favorite Recipes
        </h2>
        <?php if (empty($favoriteRecipes)): ?>
            <strong>
                No saved favorites.
            </strong>
        <?php else: ?>
            <div class="recipe_container">
                <?php foreach ($favoriteRecipes as $recipe): ?>
                    <div class="card"
                         onclick="goTo('/CSCK543_EMA_Recipe_Application/recipe', <?php echo $recipe['id']; ?>)">
                        <h3><?php echo $recipe['recipe']; ?></h3>
                        <img class="card_image" src="/image/600/<?php echo $recipe['image_path']; ?>"
                             alt="Recipe Image">
                        <p><b>Diet: </b><?php echo $recipe['diet']; ?></p>
                        <p><b>Course: </b><?php echo $recipe['course']; ?></p>
                        <p><b>Preparation: </b><?php echo $recipe['preparation']; ?> minutes</p>
                        <p><b>Cooking: </b><?php echo $recipe['cooking']; ?> minutes</p>
                        <p><b>Author: </b><?php echo $recipe['author']; ?></p>
                        <p><b>Added: </b><?php echo $recipe['added']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php include 'component/footer.php'; ?>
<script src="/js/script.js"></script>
</body>
</html>
