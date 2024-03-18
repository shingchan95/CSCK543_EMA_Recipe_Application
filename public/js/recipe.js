const slider = document.getElementById("myRange");
const servingsOutput = document.getElementById("Value");
const stars = document.getElementsByClassName("star");
const ratingOutput = document.getElementById("output_rating");
servingsOutput.innerHTML = slider.value;

function scaleIngredients(servingsRatio) {
    const scaledIngredients = ingredients.map(function (ingredient) {
        if (ingredient.amount === null || ingredient.amount === "") {
            return { ...ingredient, amount: "" };
            // Check value is numerical before applying math
        } else if (!isNaN(parseFloat(ingredient.amount))) {
            let scaledAmount = ingredient.amount * servingsRatio;
            // Round to two decimal places
            scaledAmount = Math.round(scaledAmount * 100) / 100;
            return { ...ingredient, amount: scaledAmount };
        }
        return ingredient;
    });
    updateIngredientsList(scaledIngredients);
}

function updateIngredientsList(scaledIngredients) {
    document.querySelector('.ingredients').innerHTML = scaledIngredients.map(function (ingredient) {
        let displayAmount;
        if (ingredient.amount === "" || ingredient.unit === "") {
            displayAmount = ""; //Displays nothing
        } else if (!isNaN(parseFloat(ingredient.amount))) { // Numerical, include unit;
            displayAmount = ingredient.amount
            if (ingredient.unit != null) {
                displayAmount += ' ' + ingredient.unit;
            }
        } else {
            displayAmount = ingredient.amount; // Non-numerical value, display as text
        }
        return '<li>' + ingredient.ingredient + (displayAmount ? ': ' + displayAmount : '') + '</li>';
    }).join('');
}

// Update the slider and ingredients on input
slider.oninput = function () {
    servingsOutput.innerHTML = this.value; // Update servings display
    const servingsRatio = this.value / originalServings; // Calculate the ratio
    scaleIngredients(servingsRatio); // Scale ingredients based on the ratio
}

// Update the rating
function saveRating(n) {
    renderRating(n)
    sendRatingToServer(n);
}

function renderRating(rating) {
    remove();

    // Apply different CSS classes based on rating
    let cls = "";
    if (rating == 1) cls = "one";
    else if (rating == 2) cls = "two";
    else if (rating == 3) cls = "three";
    else if (rating == 4) cls = "four";
    else if (rating == 5) cls = "five";

    for (let i = 0; i < rating; i++) {
        stars[i].className = "star " + cls;
    }
    ratingOutput.innerText = "Rating is: " + rating + "/5";
}

function sendRatingToServer(rating) {
    fetch('/CSCK543_EMA_Recipe_Application/recipe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=giveRating&recipeId=${recipeId}&rating=${rating}&category_id=1`,
    })
        .then(response => {
            if (response.ok) {
                // We need to check if there's a response before trying to parse it
                if (response.headers.get('Content-Type').includes('application/json')) {
                    return response.json();
                }
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error.message);
        });
}

// Remove the pre-applied styling (i.e., make the stars black)
function remove() {
    let i = 0;
    while (i < 5) {
        stars[i].className = "star";
        i++;
    }
}


function saveBtn(recipeId) {
    fetch('/CSCK543_EMA_Recipe_Application/recipe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=saveFavorite&recipeId=${recipeId}`,
    })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error.message);
        });


}


function deleteBtn(recipeId) {
    fetch(`/CSCK543_EMA_Recipe_Application/recipe/${recipeId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => {
            if (response.ok) {
                // if (response.headers.get('Content-Type').includes('application/json')) {
                return response.json(); // Parse JSON response
                // }
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .then(data => {
            if (data && data.success) {
                console.log('Success:', data.message);
                // Reload the page after successful operation
                window.location.reload();
            } else if (data && data.error) {
                console.error('Error:', data.error);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}

window.onload = function () {
    renderRating(rating)
}
