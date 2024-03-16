<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>

    <h1>All About Recipes!</h1>

    <div class="container" id="homepage_body">
        <section class="dashed-border" id="intro_container">
            <h2>This is who we are...</h2>
            <p>In every corner of the world, recipes serve as a bridge between generations, a testament to cultural
                heritage, and a medium for creative expression in the culinary arts. A recipe, at its core, is more than
                just a list of ingredients and instructions; it is a story, a legacy, and an invitation to partake in a
                ritual as old as civilization itself. From the simplest of meals to the most intricate of dishes,
                recipes are a celebration of flavor, a dance of textures, and a harmony of aromas, meticulously crafted
                to delight the senses.</p>

            <img src="/image/food-image.webp" id="intro_image">

            <p>
                The history of recipes is as old as humanity's discovery of cooking. The act of recording these culinary
                experiments evolved from oral traditions to beautifully illustrated manuscripts, and now to digital
                formats accessible with a simple click. Each recipe carries with it the nuances of its creator's touch,
                the regional ingredients it celebrates, and the cultural contexts that shaped its creation. It's
                fascinating to observe how recipes adapt over time, with each cook adding their personal twist, thereby
                contributing to the living history of the dish.</p>

        </section>
        <section class="dashed-border">
            <h2>Looking for a specific recipe?</h2>
            <br>
            <p>With over 1000 recipes on our application, we know we got what you are looking for!</p>
            <br>
            <?php include 'component/advanced_search.php'; ?>

        </section>
        <aside class="container dashed-border" id="featured_recipes_container">
            <h2>Featured Recipes</h2>
            <ul id="feature_recipe_list">
                <?php foreach ($featuredRecipes as $recipe): ?>
                    <li><h3><?php echo $recipe['recipe']; ?></h3></li><?php endforeach; ?>
            </ul>


        </aside>
    </div>

</main>

<?php include 'component/footer.php'; ?>

<script src="/js/script.js"></script>
</body>
</html>
