<header>
    <!-- Header container with logo, catchphrase, and search bar -->
    <section id="header_container" class="container">
        <!-- Logo and catchphrase -->
        <div id="logo_container" class="container">
            <a href="/CSCK543_EMA_Recipe_Application/home">
                <img id="image_logo" src="/image/yummy-chef.png" alt="The Yummy Chef logo">
            </a>
            <span id="header_catchphrase">The Best Recipes Around!</span>
        </div>
        <!-- Search bar -->
        <form class="container" id="search_bar" action="/CSCK543_EMA_Recipe_Application/search" method="GET">
            <input class="form_input" name="search" placeholder="Search recipes" required>
            <input id="search_form_button" type="submit" value>
        </form>
    </section>

    <!-- Display error message if any -->
    <div>
        <?php
        // Display error message if register_error or login_error session is set
        if (isset($_SESSION['register_error']) || isset($_SESSION['login_error'])) {
            $errorKey = isset($_SESSION['register_error']) ? 'register_error' : 'login_error';
            $errorMessage = $_SESSION[$errorKey];
            ?>
            <!-- Alert message -->
            <div class="alert">
                <!-- Close button -->
                <span class="close_btn" onclick="this.parentElement.style.display='none';">&times;</span>
                <!-- Error message -->
                <strong><?php echo htmlspecialchars($errorMessage); ?></strong>
            </div>
            <?php unset($_SESSION[$errorKey]); ?>
        <?php } ?>

        <!-- Navigation bar -->
        <nav class="container" id="navbar">
            <ul class="container">
                <!-- Home link -->
                <li>
                    <a class="<?php echo ($_SESSION['current_page'] == 'home' || $_SESSION['current_page'] == '')
                        ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/home">Home</a>
                </li>
                <!-- Search link -->
                <li>
                    <a class="<?php echo ($_SESSION['current_page'] == 'search') ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/search">Search</a>
                </li>
                <!-- Profile link if user is logged in -->
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']): ?>
                    <li>
                        <a class="<?php echo ($_SESSION['current_page'] == 'profile') ? 'current_page' : ''; ?>"
                           href="/CSCK543_EMA_Recipe_Application/profile">Profile</a>
                    </li>
                <?php endif; ?>
                <!-- Recipe link if current page is recipe -->
                <?php if ($_SESSION["current_page"] == "recipe"): ?>
                    <li>
                        <a class="current_page">Recipe</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- User login/logout section -->
            <section id="user_login" class="container">
                <p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Display username and logout button if user is logged in -->
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!

                <form id="logout_form" action="/CSCK543_EMA_Recipe_Application/logout" method="POST" class="container">
                    <input type="submit" value="logout">
                </form>

                <?php else: ?>
                    <!-- Display guest message and login button if user is not logged in -->
                    <p>Welcome, Guest!
                        <button id="login_button">login</button>

                    <!-- Login modal -->
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
