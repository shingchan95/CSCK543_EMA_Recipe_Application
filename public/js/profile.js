window.onload = function () {
    document.querySelectorAll('.remove_favorite_btn').forEach((button) => {
        const recipeId = button.getAttribute("data-recipe-id")
        button.addEventListener('click', (event) => {
            fetch(`recipe/${recipeId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => {
                    if (response.ok) {
                        return response.json(); // Parse JSON response
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(data => {
                    if (data && data.success) {
                        // Handle success message
                        console.log('Success:', data.message);
                        // Reload the page after successful operation
                        window.location.reload();
                    } else if (data && data.error) {
                        console.error('Error:', data.error);
                        // Handle error message
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error.message);
                    // Handle fetch error
                });
            // Prevent the click event from triggering events in other elements
            event.stopImmediatePropagation();
            // deleteFavorite(button.getAttribute("data-recipe-id"));
        });
    });
};