const loginModal = document.getElementById("login_modal")
const loginButton = document.getElementById("login_button")

loginButton.onclick = function () {
    loginModal.style.display = "block";
}

window.onclick = function (event) {
    if (event.target === loginModal) {
        loginModal.style.display = "none";
    }
}

function toggleLoginForms() {
    const loginForm = document.getElementById('login_form');
    const registerForm = document.getElementById('register_form');

    if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
    } else {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    }
}