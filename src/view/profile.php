<?php

// $favoriteRecipes = [
//     ["id" => "31",
//         "recipe" => "d1221d", "image_path" => "easy_lamb_biryani.jpg", "diet" => "Omni",
//         "course" => "Main", "preparation" => "", "cooking" => "32",
//         "author" => "Mike", "added" => "Today"],
//     ["id" => "22",
//         "recipe" => "213123", "image_path" => "mango_pie.jpg", "diet" => "Omni",
//         "course" => "Main", "preparation" => "", "cooking" => "32",
//         "author" => "Mike", "added" => "Today"]
// ]


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
            <?php
            include_once 'component/recipes.php';
            // displayRecipes($favoriteRecipes, true);
            displayRecipes($favoriteRecipes, true);
            ?>
        <?php endif; ?>
    </section>
</main>
<?php include 'component/footer.php'; ?>
<script src="/js/profile.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
