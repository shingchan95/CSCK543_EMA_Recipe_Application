// Execute the following code when the window is fully loaded
window.onload = function () {
    // Select all elements with class 'remove_favorite_btn' and iterate over them
    document.querySelectorAll('.remove_favorite_btn').forEach((button) => {
        // Get the recipe ID from the button's data-attribute
        const recipeId = button.getAttribute("data-recipe-id");
        // Add a click event listener to each button
        button.addEventListener('click', (event) => {
            // Send a DELETE request to the server to remove the favorite recipe
            fetch(`recipe/${recipeId}`, {
                method: 'DELETE', // Specify the HTTP method
                headers: {
                    'Content-Type': 'application/json', // Specify the content type
                },
            })
                .then(response => {
                    // Check if the response is OK (status code 200)
                    if (response.ok) {
                        return response.json(); // Parse JSON response
                    } else {
                        throw new Error('Network response was not ok'); // Throw an error for non-OK responses
                    }
                })
                .then(data => {
                    // Handle the JSON response data
                    if (data && data.success) {
                        // If the operation was successful, display a success message
                        console.log('Success:', data.message);
                        // Reload the page after successful operation to reflect changes
                        window.location.reload();
                    } else if (data && data.error) {
                        // If there's an error message in the response, log it
                        console.error('Error:', data.error);
                        // Handle the error message
                    }
                })
                .catch(error => {
                    // Catch any fetch errors and log them
                    console.error('Fetch error:', error.message);
                    // Handle fetch errors
                });
            // Prevent the default behavior of the button click event
            event.stopImmediatePropagation();
        });
    });
};
