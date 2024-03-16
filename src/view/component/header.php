<header>
    <section id="header_container" class="container">
        <div id="logo_container" class="container">
            <a href="/CSCK543_EMA_Recipe_Application/home">
                <img id="image_logo" src="/image/temporary _logo.jpg"
                     alt="Image logo">
            </a>
            <span id="header_catchphrase">The Best Recipes Around!</span>
        </div>
        <form class="container" id="search_bar" action="/CSCK543_EMA_Recipe_Application/search" method="GET">
            <input class="form_input" name="search" placeholder="Search recipes" required>
            <input id="search_form_button" type="submit" value>
        </form>

    </section>

    <div>
        <?php
        if (isset($_SESSION['register_error']) || isset($_SESSION['login_error'])) {
            $errorKey = isset($_SESSION['register_error']) ? 'register_error' : 'login_error';
            $errorMessage = $_SESSION[$errorKey];
            ?>
            <div class="alert">
                <span class="close_btn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong><?php echo htmlspecialchars($errorMessage); ?></strong>
            </div>
            <?php unset($_SESSION[$errorKey]); ?>
        <?php } ?>

        <nav class="container" id="navbar">
            <ul class="container">
                <li>
                    <a class="<?php echo ($_SESSION['current_page'] == 'home' || $_SESSION['current_page'] == '')
                        ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/home">Home</a>
                </li>
                <li>
                    <a class="<?php echo ($_SESSION['current_page'] == 'Search') ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/search">Search</a>
                </li>
                <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']): ?>
                <li> 
                    <a class="<?php echo ($_SESSION['current_page'] == 'profile') ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/profile">Profile</a>
                </li>
                <?php endif; ?>
            </ul>

            <section id="user_login" class="container">
                <p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!

                <form id="logout_form" action="/CSCK543_EMA_Recipe_Application/logout" method="POST" class="container">
                    <input type="submit" value="logout">
                </form>

                <?php else: ?>
                    <p>Welcome, Guest!
                        <button id="login_button">login</button>

                    <div id="login_modal" class="modal">
                        <div class="modal_content">
                            <?php
                            include __DIR__ . '/login.php';
                            include __DIR__ . '/register.php';
                            ?>
                        </div>
                    </div>
                    </p>
                <?php endif; ?>
                </p>
            </section>
        </nav>
    </div>
</header>
