// Get references to HTML elements
const dietFilterElement = document.getElementById("diet_filter"); // Diet filter dropdown element
const courseFilterElement = document.getElementById("course_filter"); // Course filter dropdown element
const authorFilterElement = document.getElementById("author_filter"); // Author filter dropdown element
const recipeResultsElement = document.getElementById("recipe_results"); // Recipe results container element
const sortSelectElement = document.getElementById("sort_select"); // Sort select dropdown element

let presentedRecipes; // Variable to store recipes to be presented

// Function to render the recipe list based on applied filters
function renderRecipeList(filters) {
    // Clear previous recipe cards
    recipeResultsElement.innerHTML = '';

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

    // Display message if no recipes match the criteria
    if (presentedRecipes.length === 0) {
        recipeResultsElement.innerHTML += `
            <br>
            <p><strong>No Recipe Matches the Criteria</strong></p>
            <br>
        `;
    }

    // Iterate through presented recipes and create recipe cards
    presentedRecipes.forEach(recipe => {
        let divElement = document.createElement("div"); // Create a div for the recipe card
        divElement.className = "card"; // Add class for styling
        divElement.onclick = function () {
            goTo('/CSCK543_EMA_Recipe_Application/recipe', recipe.id); // Redirect to recipe details page on click
        };

        // Convert added date to a more user-friendly format
        const addedDate = new Date(recipe.added);
        divElement.innerHTML = `
            <h3>${recipe.recipe}</h3>
            <img class="card_image" src="/image/600/${recipe.image_path}" alt="${recipe.recipe}">
            <p><b>Diet: </b>${recipe.diet}</p>
            <p><b>Course: </b>${recipe.course}</p>
            <p><b>Preparation: </b>${recipe.preparation} minutes</p>
            <p><b>Cooking: </b>${recipe.cooking} minutes</p>      
            <p><b>Author: </b>${recipe.author}</p>
            <p><b>Added: </b>${addedDate.toLocaleDateString()}</p>
        `;
        recipeResultsElement.appendChild(divElement); // Append recipe card to results container
    });
}

// Function to update filters and render the recipe list accordingly
function updateFilters() {
    presentedRecipes = recipes; // Reset presented recipes to all recipes
    let currentFilters = {} // Initialize empty object for current filters
    currentFilters["diet"] = dietFilterElement.value; // Get selected diet filter value
    currentFilters["course"] = courseFilterElement.value; // Get selected course filter value
    currentFilters["author"] = authorFilterElement.value; // Get selected author filter value

    renderRecipeList(currentFilters); // Render the recipe list with applied filters
}

// Function to sort the recipes based on selected sort method
function sortRecipes() {
    const sortMethod = sortSelectElement.value; // Get selected sort method from dropdown

    if (sortMethod === "default") {
        return; // Do nothing if the default option is selected
    }

    // Sort the presented recipes based on the selected method
    presentedRecipes.sort((a, b) => {
        if (sortMethod === "preparation" || sortMethod === "cooking") {
            return a[sortMethod] - b[sortMethod]; // Sort by numerical values directly

        } else if (sortMethod === "added") {
            return new Date(a[sortMethod]) - new Date(b[sortMethod]); // Sort by date values

        } else {
            return a[sortMethod].localeCompare(b[sortMethod]); // Sort by string values
        }
    });

    renderRecipeList(); // Render the sorted recipe list
}

// Event listener to initialize presentedRecipes and render the recipe list on window load
window.onload = function () {
    presentedRecipes = recipes; // Set presentedRecipes to all recipes
    renderRecipeList(); // Render the recipe list without filters on window load
}
