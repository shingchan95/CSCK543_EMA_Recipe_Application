const dietFilterElement = document.getElementById("diet_filter")
const courseFilterElement = document.getElementById("course_filter")
const authorFilterElement = document.getElementById("author_filter")
const recipeResultsElement = document.getElementById("recipe_results")

function renderRecipeList(filters) {
    let filteredRecipes = recipes;

    // Clear previous recipe cards
    recipeResultsElement.innerHTML = ''

    if (filters) {
        /* For each filter, only add the recipes that match the filterKey
            For example: if recipe['diet'] == 'vegan' and filters['diet'] == 'vegan', the recipe
            is added to the filteredRecipes array.
         */
        Object.keys(filters).forEach(filterKey => {
            if (filters[filterKey] !== "all") {
                filteredRecipes = filteredRecipes.filter(recipe => recipe[filterKey] === filters[filterKey]);
            }
        });
    }

    if (filteredRecipes.length === 0) {
        recipeResultsElement.innerHTML += `
        <br>
        <p><strong>No Recipe Matches the Criteria</strong></p>
        <br>
        `
    }

    filteredRecipes.forEach(recipe => {
        let divElement = document.createElement("div");
        divElement.className = "recipe_card";
        divElement.innerHTML = `
            <h3>${recipe.recipe}</h3>
            <img class="card_image" src="/image/600/${recipe.image_path}" alt="Recipe Image">
            <p><b>Diet: </b>${recipe.diet}</p>
            <p><b>Course: </b>${recipe.course}</p>
            <p><b>Preparation: </b>${recipe.preparation}</p>
            <p><b>Cooking: </b>${recipe.cooking}</p>      
            <p><b>Author: </b>${recipe.author}</p>
            <p><b>Added: </b>${recipe.added}</p>
        `;
        recipeResultsElement.appendChild(divElement);
    });
}

function updateFilters() {
    let currentFilters = {}
    currentFilters["diet"] = dietFilterElement.value
    currentFilters["course"] = courseFilterElement.value
    currentFilters["author"] = authorFilterElement.value

    renderRecipeList(currentFilters)
}


window.onload = function () {
    renderRecipeList()
}
