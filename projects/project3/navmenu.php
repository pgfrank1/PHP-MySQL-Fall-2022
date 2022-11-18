<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="./">Project 3</a>
        <div>
            <a href="viewprofile.php">
                <input class="btn bg-primary text-light" type="button" value="View Profile">
            </a>
            <a href="logexercise.php">
                <input class="btn bg-primary text-light" type="button" value="Log Exercise">
            </a>
            <a href="createuser.php">
                <input class="btn bg-primary text-light" type="button" value="Create User">
            </a>
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
        </div>
    </div>
</nav>