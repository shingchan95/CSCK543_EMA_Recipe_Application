function deleteFavorite(id) {
    fetch(`recipe/${id}`, {
        method: 'DELETE', headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
        .then(response => {
            if (response.status === 204) {
                location.reload()
            } else {
                alert("Couldn't delete favorite.")
                console.error(response.status)
                console.error(response.body)
            }
        })
        .catch(error => {
            console.error(error.message); // Logging the error from the server
        });
}

window.onload = function () {
    document.querySelectorAll('.remove_favorite_btn').forEach((button) => {
        button.addEventListener('click', (event) => {
            // Prevent the click event from triggering events in other elements
            event.stopImmediatePropagation();
            // Passing the custom data-recipe-id attribute
            deleteFavorite(button.getAttribute("data-recipe-id"));
        });
    });
};