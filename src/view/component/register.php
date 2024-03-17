<div id="register_form">
    <h2>Create Account</h2>
    <form action="/CSCK543_EMA_Recipe_Application/login" method="POST">

        <div class="form_div">
            <label>Username:</label>
            <input class="form_input" type="text" name="register_username" placeholder="📇 Insert username..."
                   required>
        </div>

        <div class="form_div">
            <label>Email:</label>
            <input class="form_input" type="email" name="register_email" placeholder="✉️ Insert email..."
                   required>
        </div>

        <div class="form_div">
            <label>Password:</label>
            <input class="form_input" type="password" name="register_password" placeholder="🔑 Insert password..."
                   required>
        </div>

        <div class="form_div">
            <input type="submit" name="register_submit" value="Register">
        </div>

    </form>
    <p>
        <?php
        if (isset($_SESSION['register_error'])):
            echo htmlspecialchars($_SESSION['register_error']);
        endif;
        ?>
    </p>
    Already have an account?
    <button onclick="toggleLoginForms()">Login</button>
</div>
