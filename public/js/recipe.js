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