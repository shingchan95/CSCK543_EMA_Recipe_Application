<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Welcome to the Homepage</h1>
    <form action="" method="GET">
        <label for="dietId">Select Diet:</label>
        <select name="dietId" id="dietId">
            <option value="all">All</option>
            <option value="1">Vegan</option>
            <option value="2">Vegetarian</option>
            <option value="3">Pescetarian</option>
            <option value="4">Omni</option>
        </select>
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter search term">
        <button type="submit">Search</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['dietId']) && $_GET['dietId'] !== 'all') {
            $selectedDietId = $_GET['dietId'];
            $recipes = $this->recipeModel->getRecipeByDietId($selectedDietId);
            foreach ($recipes as $recipe): 
    ?>
            <p><?php echo $recipe['recipe']; ?></p>
    <?php
            endforeach;
        } else {
            $recipes = $data['recipes'] ?? [];
            foreach ($recipes as $recipe): 
    ?>
            <p><?php echo $recipe['recipe']; ?></p>
    <?php
            endforeach;
        }
    ?>
</body>
</html>