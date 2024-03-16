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