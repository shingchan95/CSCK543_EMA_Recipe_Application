// Declare constants for various HTML elements
const slider = document.getElementById("myRange"); // Slider input element
const servingsOutput = document.getElementById("Value"); // Output for servings
const stars = document.getElementsByClassName("star"); // Array-like collection of star elements
const ratingOutput = document.getElementById("output_rating"); // Output for rating

// Display initial servings value
servingsOutput.innerHTML = slider.value;

// Function to scale ingredients based on servings ratio
function scaleIngredients(servingsRatio) {
    // Map over ingredients array and scale each ingredient's amount
    const scaledIngredients = ingredients.map(function (ingredient) {
        // If amount is null or empty, return ingredient as is
        if (ingredient.amount === null || ingredient.amount === "") {
            return { ...ingredient, amount: "" };
        }
        // If amount is numerical, scale it based on servings ratio
        else if (!isNaN(parseFloat(ingredient.amount))) {
            let scaledAmount = ingredient.amount * servingsRatio;
            scaledAmount = Math.round(scaledAmount * 100) / 100; // Round to two decimal places
            return { ...ingredient, amount: scaledAmount };
        }
        // If amount is non-numerical, return ingredient as is
        return ingredient;
    });
    // Update the ingredients list with scaled ingredients
    updateIngredientsList(scaledIngredients);
}

// Function to update ingredients list in HTML
function updateIngredientsList(scaledIngredients) {
    // Update the HTML content of the ingredients list
    document.querySelector('.ingredients').innerHTML = scaledIngredients.map(function (ingredient) {
        // Determine how to display each ingredient based on its properties
        let displayAmount;
        if (ingredient.amount === "" || ingredient.unit === "") {
            displayAmount = ""; // Display nothing if amount or unit is empty
        }
        else if (!isNaN(parseFloat(ingredient.amount))) {
            displayAmount = ingredient.amount; // Display amount if numerical
            if (ingredient.unit != null) {
                displayAmount += ' ' + ingredient.unit; // Include unit if available
            }
        }
        else {
            displayAmount = ingredient.amount; // Display non-numerical value as text
        }
        // Return HTML list item for each ingredient
        return '<li>' + ingredient.ingredient + (displayAmount ? ': ' + displayAmount : '') + '</li>';
    }).join(''); // Convert array of HTML strings to a single string
}

// Event listener for slider input change
slider.oninput = function () {
    servingsOutput.innerHTML = this.value; // Update servings display
    const servingsRatio = this.value / originalServings; // Calculate servings ratio
    scaleIngredients(servingsRatio); // Scale ingredients based on the ratio
}

// Function to handle saving a rating
function saveRating(n) {
    renderRating(n); // Render the rating visually
    sendRatingToServer(n); // Send the rating to the server
}

// Function to render the rating visually
function renderRating(rating) {
    remove(); // Remove any existing star styling
    let cls = ""; // CSS class for star styling
    // Apply different CSS classes based on rating
    if (rating == 1) cls = "one";
    else if (rating == 2) cls = "two";
    else if (rating == 3) cls = "three";
    else if (rating == 4) cls = "four";
    else if (rating == 5) cls = "five";
    // Apply CSS classes to stars based on rating
    for (let i = 0; i < rating; i++) {
        stars[i].className = "star " + cls;
    }
    ratingOutput.innerText = "Rating is: " + rating + "/5"; // Update rating output
}

// Function to send rating to the server
function sendRatingToServer(rating) {
    // Send a POST request to the server with rating data
    fetch('/CSCK543_EMA_Recipe_Application/recipe', {
        method: 'POST', // Specify the HTTP method
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Specify content type
        },
        // Include recipe ID and rating in the request body
        body: `action=giveRating&recipeId=${recipeId}&rating=${rating}&category_id=1`,
    })
        .then(response => {
            // Check if the response is OK and parse JSON response if available
            if (response.ok && response.headers.get('Content-Type').includes('application/json')) {
                return response.json();
            } else {
                throw new Error('Network response was not ok'); // Throw an error for non-OK responses
            }
        })
        .catch(error => {
            console.error('Fetch error:', error.message); // Log fetch errors
        });
}

// Function to remove star styling
function remove() {
    // Reset star styling for all stars
    let i = 0;
    while (i < 5) {
        stars[i].className = "star";
        i++;
    }
}

// Function to handle saving a recipe to favorites
function saveBtn(recipeId) {
    // Send a POST request to save the recipe to favorites
    fetch('/CSCK543_EMA_Recipe_Application/recipe', {
        method: 'POST', // Specify the HTTP method
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Specify content type
        },
        body: `action=saveFavorite&recipeId=${recipeId}`, // Include recipe ID in request body
    })
        .then(response => {
            // Reload the page if operation is successful
            if (response.ok) {
                window.location.reload();
            } else {
                throw new Error('Network response was not ok'); // Throw an error for non-OK responses
            }
        })
        .catch(error => {
            console.error('Fetch error:', error.message); // Log fetch errors
        });
}

// Function to handle deleting a recipe from favorites
function deleteBtn(recipeId) {
    // Send a DELETE request to delete the recipe from favorites
    fetch(`/CSCK543_EMA_Recipe_Application/recipe/${recipeId}`, {
        method: 'DELETE', // Specify the HTTP method
        headers: {
            'Content-Type': 'application/json', // Specify content type
        },
    })
        .then(response => {
            // Parse JSON response if available
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Network response was not ok'); // Throw an error for non-OK responses
            }
        })
        .then(data => {
            // Reload the page if operation is successful
            if (data && data.success) {
                console.log('Success:', data.message);
                window.location.reload();
            } else if (data && data.error) {
                console.error('Error:', data.error); // Log error message
            }
        })
        .catch(error => {
            console.error('Fetch error:', error); // Log fetch errors
        });
}

// Render the initial rating on page load
window.onload = function () {
    renderRating(rating);
}
