<div id="login_form">
    <h2>Login</h2>
    <form action="/CSCK543_EMA_Recipe_Application/login" method="POST">

        <div class="form_div">
            <label>Username or Email:</label>
            <input class="form_input" type="text" name="username_email" placeholder="✉️ Insert username or email..."
                   required>
        </div>

        <div class="form_div">
            <label>Password:</label>
            <input class="form_input" type="password" name="password" placeholder="🔑 Insert password..." required>
        </div>

        <div class="form_div">
            <input type="submit" name="login_submit" value="Submit">
        </div>
        <p>
            <?php
            if (isset($_SESSION['login_error'])):
                echo htmlspecialchars($_SESSION['login_error']);
            endif;
            ?>
        </p>
    </form>
    <p>
        You do not have an account?
        <button onclick="toggleLoginForms()">Create Account</button>
    </p>
</div>
