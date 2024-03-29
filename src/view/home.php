<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Linking external CSS files -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>
    <!-- Introduction section -->
    <section class="container" id="intro_content">
        <div>
            <h1>All About Recipes!</h1>
            <!-- Introduction paragraphs -->
            <p>In every corner of the world, recipes serve as a bridge between generations, a testament to cultural
                heritage, and a medium for creative expression in the culinary arts. A recipe, at its core, is more than
                just a list of ingredients and instructions; it is a story, a legacy, and an invitation to partake in a
                ritual as old as civilization itself. From the simplest of meals to the most intricate of dishes,
                recipes are a celebration of flavor, a dance of textures, and a harmony of aromas, meticulously crafted
                to delight the senses.</p>

            <p>
                The history of recipes is as old as humanity's discovery of cooking. The act of recording these culinary
                experiments evolved from oral traditions to beautifully illustrated manuscripts, and now to digital
                formats accessible with a simple click. Each recipe carries with it the nuances of its creator's touch,
                the regional ingredients it celebrates, and the cultural contexts that shaped its creation. It's
                fascinating to observe how recipes adapt over time, with each cook adding their personal twist, thereby
                contributing to the living history of the dish.</p>
        </div>
        <!-- Introduction image -->
        <img src="/image/food-image.webp" id="intro_image">
    </section>

    <!-- Advanced search section -->
    <section>
        <h2>Looking for a specific recipe?</h2>
        <p>With over 1000 recipes on our application, we know we got what you are looking for!</p>
        <?php include 'component/advanced_search.php'; ?>
    </section>

    <!-- Featured recipes section -->
    <section>
        <h2>Featured Recipes</h2>
        <?php
        include_once 'component/recipes.php';
        displayRecipes($featuredRecipes, false);
        ?>
    </section>

</main>

<?php include 'component/footer.php'; ?>
<!-- Linking external JavaScript file -->
<script src="/js/script.js"></script>
</body>
</html>
