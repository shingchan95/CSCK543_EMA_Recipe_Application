<div id="login_form">
    <h2>Login</h2>
    <form action="/CSCK543_EMA_Recipe_Application/login" method="POST">

        <div class="form_div">
            <label>Username:</label>
            <input class="form_input" type="text" name="username" placeholder="✉️ Insert username...">
        </div>

        <div class="form_div">
            <label>Password:</label>
            <input class="form_input" type="password" name="password" placeholder="🔑 Insert password...">
        </div>

        <div class="form_div">
            <input type="submit" value="Submit">
        </div>
    </form>
    <p>
        You do not have an account?
        <button onclick="toggleLoginForms()">Create Account</button>
    </p>
</div>
