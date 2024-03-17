const slider = document.getElementById("myRange");
const output = document.getElementById("Value")
output.innerHTML = slider.value;

function scaleIngredients(servingsRatio) {
    const scaledIngredients = ingredients.map(function (ingredient) {
        if (ingredient.amount === null || ingredient.amount === "") {
            return {...ingredient, amount: ""};
            // Check value is numerical before applying MATH
        } else if (!isNaN(parseFloat(ingredient.amount))) {
            let scaledAmount = ingredient.amount * servingsRatio;
            // Round to two decimal places
            scaledAmount = Math.round(scaledAmount * 100) / 100;
            return {...ingredient, amount: scaledAmount};
        } else {
            // If ingredient isn't a numerical value
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
    output.innerHTML = this.value; // Update servings display
    const servingsRatio = this.value / originalServings; // Calculate the ratio
    scaleIngredients(servingsRatio); // Scale ingredients based on the ratio
}


// Star rating on the recipe
let stars = 
    document.getElementsByClassName("star");
let ratingOutput = 
    document.getElementById("output_rating");
 
// Update the rating
function gfg(n) {
    remove();
    for (let i = 0; i < n; i++) {
        if (n == 1) cls = "one";
        else if (n == 2) cls = "two";
        else if (n == 3) cls = "three";
        else if (n == 4) cls = "four";
        else if (n == 5) cls = "five";
        stars[i].className = "star " + cls;
    }
    output_rating.innerText = "Rating is: " + n + "/5";
}
 
// Remove the pre-applied styling
function remove() {
    let i = 0;
    while (i < 5) {
        stars[i].className = "star";
        i++;
    }
}

// Adding event listeners for interative features
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('save-recipe-btn').addEventListener('click', function() {
        saveFavorite(recipeId, userId);
    });
});


function saveFavorite(recipeId) {
    fetch('recipe', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=saveFavorite&recipeId=${recipeId}`,
    })

    .then(response => {
        if(response.status === 200){
            console.log(response)
            //success
        }
        else {
            //error
            console.error(response.status)
        }
    })
    .catch(error => {
        console.error(error.message); // Logging the error from the server
    });
}

function deleteFavorite(recipeId) {
    console.log('delete',recipeId )
    fetch('recipe', {
        method: 'DELETE',
        headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=recipeId=${recipeId}`,
    })

    .then(response => {
        if(response.status === 200){
            console.log(response)
            // success
        }
        else {
            console.error(response.status)
                 //error
        }
    })
    .catch(error => {
        console.error(error.message); // Logging the error from the server
    });
}


// function saveFavorite(recipeId, userId) {
//     console.log(userId)

//     if (!userId) {
//         document.getElementById("login-prompt").style.display = "block";
//         document.getElementById("output_err_message").innerText = "Please log in to save the recipe.";
//         return;
//     }

//     fetch('recipe', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: `action=saveFavorite&recipeId=${recipeId}&userId=${userId}`,
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.isFavourite) {
//             document.getElementById("output_fav_message").innerText = "Recipe saved to favourites.";
//         } else {
//             throw new Error('Recipe could not be saved to favourites.');
//         }
//     })
//     .catch(error => {
//         document.getElementById("output_fav_message").innerText = error.message;
//     });
// }
        

function rateRecipe(rating) {
    removeStarStyles();
    for (let i = 0; i < rating; i++) {
        stars[i].className = "star " + ["one", "two", "three", "four", "five"][i];
    }
    document.getElementById("output_rating").innerText = "Rating: " + rating + "/5";
    giveRating(recipeId, userId, rating, 1); 
}

function removeStarStyles() {
    for (let i = 0; i < stars.length; i++) {
        stars[i].className = "star";
    }
}

function giveRating(recipeId, userId, rating, category_id) {
    fetch('recipe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=giveRating&recipeId=${recipeId}&userId=${userId}&rating=${rating}&category_id=${category_id}`,
    })
    .then(response => response.json())
    .then(data => {
        if (data.Rated) {
            document.getElementById("output_rating").innerText = `Rating ${rating} out of 5 saved.`;
        } else {
            throw new Error('Recipe rating could not be saved.');
        }
    })
    .catch(error => {
        document.getElementById("output_rating").innerText = error.message;
    });
}