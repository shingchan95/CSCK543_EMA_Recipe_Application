<form method="GET" action="/CSCK543_EMA_Recipe_Application/search">
    <input class="form_input" name="search" placeholder="Search recipes" required>

    <select name="searchType" class="form_select" required>
        <option value disabled selected>Select Type</option>
        <option value="all">All</option>
        <option value="author">Author</option>
        <option value="diet">Diet</option>
        <option value="course">Course</option>
        <option value="recipe_ingredient">Recipe Ingredient</option>
    </select>

    <input class="form_submit_button" type="submit" value="search">
</form>