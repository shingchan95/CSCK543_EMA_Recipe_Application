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
    <section class="container" id="intro_content">
        <div>
            <h1>All About Recipes!</h1>
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
        <img src="/image/food-image.webp" id="intro_image">
    </section>

    <section>
        <h2>Looking for a specific recipe?</h2>
        <p>With over 1000 recipes on our application, we know we got what you are looking for!</p>
        <?php include 'component/advanced_search.php'; ?>
    </section>

    <section>
        <h2>Featured Recipes</h2>
        <div class="recipe_container">
            <?php foreach ($featuredRecipes as $recipe): ?>
                <div class="card"
                     onclick="goTo('/CSCK543_EMA_Recipe_Application/recipe', <?php echo $recipe['id']; ?>)">
                    <h3><?php echo $recipe['recipe']; ?></h3>
                    <img class="card_image" src="/image/600/<?php echo $recipe['image_path']; ?>" alt="Recipe Image">
                    <p><b>Diet: </b><?php echo $recipe['diet']; ?></p>
                    <p><b>Course: </b><?php echo $recipe['course']; ?></p>
                    <p><b>Preparation: </b><?php echo $recipe['preparation']; ?></p>
                    <p><b>Cooking: </b><?php echo $recipe['cooking']; ?></p>
                    <p><b>Author: </b><?php echo $recipe['author']; ?></p>
                    <p><b>Added: </b><?php echo $recipe['added']; ?></p>
                </div>
            <?php endforeach; ?>

        </div>
    </section>

</main>

<?php include 'component/footer.php'; ?>

<script src="/js/script.js"></script>
</body>
</html>
