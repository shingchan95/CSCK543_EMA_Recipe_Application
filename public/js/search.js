const dietFilterElement = document.getElementById("diet_filter")
const courseFilterElement = document.getElementById("course_filter")
const authorFilterElement = document.getElementById("author_filter")
const recipeResultsElement = document.getElementById("recipe_results")
const sortSelectElement = document.getElementById("sort_select")
let presentedRecipes;

function renderRecipeList(filters) {
    // Clear previous recipe cards
    recipeResultsElement.innerHTML = ''

    if (filters) {
        /* For each filter, only add the recipes that match the filterKey
            For example: if recipe['diet'] == 'vegan' and filters['diet'] == 'vegan', the recipe
            is added to the presentedRecipes array.
         */
        Object.keys(filters).forEach(filterKey => {
            if (filters[filterKey] !== "all") {
                presentedRecipes = presentedRecipes.filter(recipe => recipe[filterKey] === filters[filterKey]);
            }
        });
    }

    if (presentedRecipes.length === 0) {
        recipeResultsElement.innerHTML += `
        <br>
        <p><strong>No Recipe Matches the Criteria</strong></p>
        <br>
        `
    }

    presentedRecipes.forEach(recipe => {
        let divElement = document.createElement("div");
        divElement.className = "card"
        divElement.onclick = function () {
            goTo('/CSCK543_EMA_Recipe_Application/recipe', recipe.id);
        };
        // Keeping a reference to format the Date in a more convenient way
        const addedDate = new Date(recipe.added)
        divElement.innerHTML = `
            <h3>${recipe.recipe}</h3>
            <img class="card_image" src="/image/600/${recipe.image_path}" alt="Recipe Image">
            <p><b>Diet: </b>${recipe.diet}</p>
            <p><b>Course: </b>${recipe.course}</p>
            <p><b>Preparation: </b>${recipe.preparation} minutes</p>
            <p><b>Cooking: </b>${recipe.cooking} minutes</p>      
            <p><b>Author: </b>${recipe.author}</p>
            <p><b>Added: </b>${addedDate.toLocaleDateString()}</p>
        `;
        recipeResultsElement.appendChild(divElement);
    });
}

function updateFilters() {
    presentedRecipes = recipes;
    let currentFilters = {}
    currentFilters["diet"] = dietFilterElement.value
    currentFilters["course"] = courseFilterElement.value
    currentFilters["author"] = authorFilterElement.value

    renderRecipeList(currentFilters)
}

function sortRecipes() {
    const sortMethod = sortSelectElement.value;
    if (sortMethod === "default") {
        return;
    }

    presentedRecipes.sort((a, b) => {
        if (sortMethod === "preparation" || sortMethod === "cooking") {
            // We can just subtract Numbers directly
            return a[sortMethod] - b[sortMethod];

        } else if (sortMethod === "added") {
            // Convert and compare Date values
            return new Date(a[sortMethod]) - new Date(b[sortMethod]);

        } else {
            // LocaleCompare to compare string values
            return a[sortMethod].localeCompare(b[sortMethod]);
        }
    });

    renderRecipeList();
}

window.onload = function () {
    presentedRecipes = recipes;
    renderRecipeList()
}
