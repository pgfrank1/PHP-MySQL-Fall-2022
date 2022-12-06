<?php
session_start();
require_once('page-titles.php');
$page_title = ADMIN_LOGIN;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<main>
    <div class="container">
    <?php
    if (!isset($_POST['admin_login']))
    {
        ?>
        <h1 class="text-center">Admin Login</h1>
        <div class="d-flex justify-content-center flex-nowrap mt-4">
            <form class="needs-validation bg-light w-75 p-4" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
                <div class="form-group text-center">
                    <label class="form-label" for="user_name">Username:</label>
                    <input class="form-control" type="text" name="user_name" id="user_name" placeholder="Username" required>
                    <div class="invalid-feedback">
                        Please provide your Username.
                    </div>
                </div>
                <div class="form-group text-center">
                    <label class="form-label" for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                    <div class="invalid-feedback">
                        Please provide your Password
                    </div>
                </div>
                <div class="pt-4 text-center">
                    <button class="btn btn-primary" type="submit" name="admin_login">Submit</button>
                    <button class="btn btn-danger" type="reset">Reset</button>
                </div>
            </form>
        </div>
    <?php
    } else
    {
        require_once('dbconnection.php');
        require_once('query-utils.php');

        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM Administrators WHERE UserName = ?';

        $result = parameterizedQuery(DBC, $query, 's', $user_name)
            or trigger_error(mysqli_error(DBC), E_USER_ERROR);

        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_array($result);

            if (password_verify($password, $row['HashPassword']))
            {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['username'];

                header("Location: admin-page.php");
            }
            else
            {
                echo "<h4><p class='text-danger'>An incorrect username or password was entered.</p></h4><hr/>";
            }
        }
        ?>
    <?php
    }
        ?>
    </div>
</main>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
