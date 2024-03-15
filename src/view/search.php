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
        <div class="container">
            <!-- Filters -->

            <?php print_r($recipes); ?>

            <span>Filter by: </span>

        </div>

        <div>
            <!-- Results-->

        </div>


    </section>



</main>

<?php include 'component/footer.php'; ?>

<script src="/js/search.js"></script>

</body>


