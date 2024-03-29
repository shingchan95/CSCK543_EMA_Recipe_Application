<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <!-- Linking external CSS files -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>
    <!-- Heading for profile details -->
    <h1>Profile Details</h1>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- Display message if user is not logged in -->
        <strong>
            User is not logged in.
        </strong>
    <?php else: ?>
    <section id="user_details">
        <!-- Display user details if logged in -->
        <div>
            <p><b>Username: </b> <?php echo htmlspecialchars($profileDetails['username']); ?></p>
        </div>
        <div>
            <p><b>Email: </b> <?php echo htmlspecialchars($profileDetails['email']); ?></p>
        </div>
        <div>
            <p><b>Account Created: </b> <?php
                $date = date_create($profileDetails['created']);
                echo htmlspecialchars(date_format($date, "d/m/Y")); ?></p>
        </div>
        <div>
            <p><b>Last Login: </b> <?php
                $date = date_create($profileDetails['last_login']);
                echo htmlspecialchars(date_format($date, "d/m/Y")); ?></p>
        </div>
        <?php endif; ?>
    </section>
    <!-- Section for favorite recipes -->
    <section>
        <h2>
            Favorite Recipes
        </h2>
        <?php if (empty($favoriteRecipes)): ?>
            <!-- Display message if no favorite recipes saved -->
            <strong>
                No saved favorites.
            </strong>
        <?php else: ?>
            <?php
            include_once 'component/recipes.php';
            // Display favorite recipes
            displayRecipes($favoriteRecipes, true);
            ?>
        <?php endif; ?>
    </section>
</main>
<?php include 'component/footer.php'; ?>
<!-- Linking external JavaScript files -->
<script src="/js/profile.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
