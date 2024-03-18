<div id="register_form">
    <!-- Title for the registration form -->
    <h2>Create Account</h2>
    <!-- Registration form with input fields -->
    <form action="/CSCK543_EMA_Recipe_Application/login" method="POST">

        <!-- Input field for username -->
        <div class="form_div">
            <label>Username:</label>
            <input class="form_input" type="text" name="register_username" placeholder="📇 Insert username..."
                   required>
        </div>

        <!-- Input field for email -->
        <div class="form_div">
            <label>Email:</label>
            <input class="form_input" type="email" name="register_email" placeholder="✉️ Insert email..."
                   required>
        </div>

        <!-- Input field for password -->
        <div class="form_div">
            <label>Password:</label>
            <input class="form_input" type="password" name="register_password" placeholder="🔑 Insert password..."
                   required>
        </div>

        <!-- Submit button for registration -->
        <div class="form_div">
            <input type="submit" name="register_submit" value="Register">
        </div>

    </form>
    <!-- Display registration error message if exists -->
    <p>
        <?php
        if (isset($_SESSION['register_error'])):
            echo htmlspecialchars($_SESSION['register_error']);
        endif;
        ?>
    </p>
    <!-- Button to toggle to the login form -->
    Already have an account?
    <button onclick="toggleLoginForms()">Login</button>
</div>
