<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
</head>
<body>
    <h1>Login or Register</h1>

    <div>
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="login_username_email">Username or Email:</label>
            <input type="text" id="login_username_email" name="username_email" required>

            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="password" required>

            <button type="submit" name="login_submit">Login</button>
        </form>
        <p><?php echo isset($data['login_error']) ? $data['login_error'] : ''; ?></p>
    </div>

    <div>
        <h2>Register</h2>
        <form action="" method="POST">
            <label for="register_username">Username:</label>
            <input type="text" id="register_username" name="register_username" required>

            <label for="register_email">Email:</label>
            <input type="email" id="register_email" name="register_email" required>

            <label for="register_password">Password:</label>
            <input type="password" id="register_password" name="register_password" required>

            <button type="submit" name="register_submit">Register</button>
        </form>
        <p><?php echo isset($data['register_error']) ? $data['register_error'] : ''; ?></p>
    </div>
</body>
</html>