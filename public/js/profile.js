function deleteFavorite($id) {
    console.log("Hello!")
}

window.onload = function () {
    document.querySelectorAll('.remove_favorite_btn').forEach((button) => {
        button.addEventListener('click', (event) => {
            // Prevent the click event from triggering events in other elements
            event.stopImmediatePropagation();
            deleteFavorite(button.getAttribute("data-recipe-id"));
        });
    });
};