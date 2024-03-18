<!-- Form for advanced search functionality -->
<form method="GET" action="/CSCK543_EMA_Recipe_Application/search">
    <!-- Input field for search query -->
    <input class="form_input" name="search" value="<?php
    // Pre-fill search input with previous search query if available
    if (isset($_SESSION["currentSearch"])) {
        echo htmlspecialchars($_SESSION["currentSearch"]);
    }
    ?>" required>
    <!-- Select dropdown for search type -->
    <select name="searchType" class="form_select" required>
        <!-- Default option -->
        <option value disabled selected>Select Type</option>
        <!-- Search options for different types -->
        <option value="all">All</option>
        <option value="author">Author</option>
        <option value="diet">Diet</option>
        <option value="course">Course</option>
        <option value="ingredient">Recipe Ingredient</option>
    </select>
    <!-- Submit button to trigger search -->
    <input class="form_submit_button" type="submit" value="search">
</form>
