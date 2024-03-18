// Get references to HTML elements
const loginModal = document.getElementById("login_modal"); // Login modal element
const loginButton = document.getElementById("login_button"); // Login button element

// Add event listener to open login modal when login button is clicked
if (loginButton) { // Check if loginButton exists
    loginButton.onclick = function () {
        loginModal.style.display = "block"; // Display login modal
    }
}

// Close login modal when user clicks outside of it
window.onclick = function (event) {
    if (event.target === loginModal) { // Check if clicked element is the login modal
        closeModal(); // Close the modal
    }
}

// Function to close the login modal
function closeModal() {
    loginModal.style.display = "none"; // Hide the login modal
}

// Function to toggle between login and register forms
function toggleLoginForms() {
    const loginForm = document.getElementById('login_form'); // Login form element
    const registerForm = document.getElementById('register_form'); // Register form element

    // Toggle the display of login and register forms
    if (loginForm.style.display === "none") {
        loginForm.style.display = "block"; // Display login form
        registerForm.style.display = "none"; // Hide register form
    } else {
        loginForm.style.display = "none"; // Hide login form
        registerForm.style.display = "block"; // Display register form
    }
}

// Function to navigate to a specified path with an optional ID
function goTo(path, id) {
    window.location.href = `${path}/${id}`; // Redirect to the specified path
}
