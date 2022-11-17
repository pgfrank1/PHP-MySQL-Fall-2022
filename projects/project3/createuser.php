<?php
    require_once('authorize.php');
    require_once('pagetitles.php');
    $page_title = CREATE_USER;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title><?= $page_title ?></title>
</head>

<body class="container">
    <?php
    require_once('navmenu.php');
?>

    <h1 class="pt-3 text-center"><?= $page_title ?></h1>
    <?php
    if (!isset($_POST['create_user']))
    {
?>
    <form class="needs-validation bg-light d-flex flex-column align-self-center" novalidate method="POST"
        action="<?= $_SERVER['PHP_SELF']?>">
        <div class="form-group row">
            <label class="form-label" for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <div class="invalid-feedback">
                Please provide a title.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <div class="invalid-feedback">
                Please provide a title.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="verify_password">Verify Password</label>
            <input type="password" name="verify_password" id="verify_password" required>
            <div class="invalid-feedback">
                Please provide a title.
            </div>
        </div>
        <div class="pt-4 text-center">
            <button class="btn btn-primary" type="submit" name="create_user">Submit</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
    </form>
    <?php
    }
    if (isset($_POST['create_user']))
    {

        require_once("dbconnection.php");

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

        $query = "SELECT * FROM users ORDER BY id DESC";

        $result = mysqli_query($dbc, $query)
            or trigger_error("There was an issue while querying the database", E_USER_ERROR);

        if (mysqli_num_rows($result)) 
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row['username'] == $_POST['username']) 
                {
?>                  <h1>User already exists. Please try a new username</h1>
                <?php
                }
            }
        }
    }
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() == false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
</body>

</html>