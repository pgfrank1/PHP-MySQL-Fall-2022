<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="./">Project 3</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item m-1">
                    <a href="viewprofile.php">
                        <input class="btn bg-primary text-light" type="button" value="View Profile">
                    </a>
                </li>
                <li class="nav-item m-1">
                    <a href="logexercise.php">
                        <input class="btn bg-primary text-light" type="button" value="Log Exercise">
                    </a>
                </li>
                <li class="nav-item m-1">
                    <a href="createuser.php">
                        <input class="btn bg-primary text-light" type="button" value="Create User">
                    </a>
                </li>
                <li class="nav-item m-1">
                <?php
                if (empty($_SESSION['user_name']))
                {
?>
                    <a href="login.php">
                        <input class="btn bg-primary text-light" type="button" value="Login">
                    </a>
                    <?php
                        }
                        else
                        {
                            ?>
                    <a href="logout.php">
                        <input class="btn bg-primary text-light" type="button" value="Logout">
                    </a>
                    <?php
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>