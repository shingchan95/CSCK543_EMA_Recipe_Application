<?php

function filterRepeated($array, $keyword): array
{
    $uniqueValues = [];
    foreach ($array as $element) {
        // Use array keys to simulate Set behaviour
        $uniqueValues[$element[$keyword]] = $element[$keyword];
    }
    return $uniqueValues;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/search.css">
</head>
<body>
<?php include 'component/header.php'; ?>
<main>
    <section>
        <?php include 'component/advanced_search.php'; ?>
    </section>

    <section>
        <div class="container" id="search_filter_container">
            <div id="search_filters" class="centered_container">
                <h3>Filter by: </h3>
                <div id ="filter-options">
                    <div>
                        <p>Diet</p>
                        <select id="diet_filter" onchange="updateFilters()">
                            <option value="all">All Diets</option>
                            <?php
                            $uniqueDiets = filterRepeated($recipes, "diet");
                            foreach ($uniqueDiets as $diet) {
                                echo "<option value='" . htmlspecialchars($diet) . "'>" .
                                    htmlspecialchars($diet) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <p>Course</p>
                        <select id="course_filter" onchange="updateFilters()">
                            <option value="all">All Courses</option>
                            <?php
                            $uniqueCourses = filterRepeated($recipes, "course");
                            foreach ($uniqueCourses as $course) {
                                echo "<option value='" . htmlspecialchars($course) . "'>" .
                                    htmlspecialchars($course) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <p>Author</p>
                        <select id="author_filter" onchange="updateFilters()">
                            <option value="all">All Authors</option>
                            <?php
                            $uniqueAuthors = filterRepeated($recipes, "author");
                            foreach ($uniqueAuthors as $author) {
                                echo "<option value='" . htmlspecialchars($author) . "'>" .
                                    htmlspecialchars($author) . "</option>";
                            }
                            ?>
                        </select>
                    </div>               
                </div>
            </div>
            <div id="sort_features" class="centered_container">
                <h3>Sort by:</h3>
                <select id="sort_select" onchange="sortRecipes()">
                    <option value="default">Default</option>
                    <option value="author">Author</option>
                    <option value="preparation">Preparation Time</option>
                    <option value="cooking">Cooking Time</option>
                    <option value="added">Added Date</option>
                </select>

            </div>
        </div>
    </section>
    <section class="container recipe_container" id="recipe_results">

    </section>


</main>

<?php include 'component/footer.php'; ?>
<script>const recipes = <?php echo json_encode($recipes); ?>;</script>
<script src="/js/search.js"></script>
<script src="/js/script.js"></script>

</body>


