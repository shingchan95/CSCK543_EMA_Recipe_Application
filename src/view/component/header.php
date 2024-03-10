<header>
    <section id="header_container" class="container">
        <div id="logo_container" class="container">
            <a href="/CSCK543_EMA_Recipe_Application/home">
                <img id="image_logo" src="/image/temporary _logo.jpg"
                     alt="Image logo">
            </a>
            <span id="header_catchphrase">The Best Recipes Around!</span>
        </div>
        <form class="container" id="search_bar" action="/recipe/search" method="GET">
            <input class="form_input" value placeholder="Search recipes">
            <input id="search_form_button" type="submit" value>
        </form>

    </section>

    <div>
        <nav class="container" id="navbar">
            <ul class="container">
                <li>
                    <a class="<?php echo ($currentPage == 'home') ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/home">Home</a>
                </li>
                <li>
                    <a class="<?php echo ($currentPage == 'recipe') ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/recipe">Recipe</a>
                </li>
                <li>
                    <a class="<?php echo ($currentPage == 'profile') ? 'current_page' : ''; ?>"
                       href="/CSCK543_EMA_Recipe_Application/profile">Profile</a>
                </li>
            </ul>

            <section id="user_login" class="container">
                <p>
                    <?php if ($loggedUser): ?>
                    Welcome, <?php echo htmlspecialchars($loggedUser); ?>!

                <form id="logout_form" action="/CSCK543_EMA_Recipe_Application/logout" method="POST" class="container">
                    <input class="logout_form_button" type="submit" value="logout">
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
