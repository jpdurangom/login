<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Consuelo's Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <?php if (isset($_SESSION['name'])) : ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="new.php">Nuevo Insulto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Borradores</a>
                </li>
            </ul>
        <?php endif; ?>
        <!-- Login/Logout Options -->
        <ul class="navbar-nav ml-auto">
            <!-- Search Form -->
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" action="index.php" method="get">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="¿Esto es para qué?" aria-label="Recipient's username" aria-describedby="button-addon2"  name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </li>
            <?php

            // Check if a session is active
            if (isset($_SESSION['name'])) {
                // If session is active, show Logout and user's name
                echo '<li class="nav-item">';
                echo '<span class="nav-link">Bien pueda, ' . $_SESSION['name'] . '</span>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="logout.php">Abrirse</a>';
                echo '</li>';
            } else {
                // If no session, show Login and Register
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="login.php">Éche pa entro</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="register.php">Meterse</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</nav>
