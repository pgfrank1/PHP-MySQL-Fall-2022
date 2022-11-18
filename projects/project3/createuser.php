<?php
    //require_once('authorize.php');
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
    <hr>
    <?php
    $username = "";
    $first_name =  "";
    $last_name =  "";
    $gender =  "";
    $birthdate =  "";
    $weight = "";

    if (!isset($_POST['create_user']))
    {
?>
    <form class="needs-validation bg-light d-flex flex-column align-self-center" novalidate method="POST"
        action="<?= $_SERVER['PHP_SELF']?>">
        <div class="form-group row">
            <label class="form-label" for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $username ?>" required>
            <div class="invalid-feedback">
                Please provide a username.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name"  value="<?= $first_name ?>" required>
            <div class="invalid-feedback">
                Please provide a First Name.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="<?= $last_name ?>" required>
            <div class="invalid-feedback">
                Please provide a Last Name.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="gender">Gender</label>
            <select class="form-select" name="gender" id="gender" value="<?= $gender ?>" required>
                <option selected value="">Select a gender</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="nb">Non Binary</option>
            </select>
            <div class="invalid-feedback">
                Please provide a Gender.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate" value="<?= $birthdate ?>" required>
            <div class="invalid-feedback">
                Please provide a Birthdate.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="weight">Weight</label>
            <input type="text" name="weight" id="weight" value="<?= $weight ?>" required>
            <div class="invalid-feedback">
                Please provide a Weight.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <div class="invalid-feedback">
                Please provide a password.
            </div>
        </div>
        <div class="form-group row">
            <label class="form-label" for="verify_password">Verify Password</label>
            <input type="password" name="verify_password" id="verify_password" required>
            <div class="invalid-feedback">
                Please verify your password.
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
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $weight = (int) $_POST['weight'];

        require_once("dbconnection.php");
        require_once("queryutils.php");

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

        $query = "SELECT username FROM exercise_user WHERE username = ?";

        $result = parameterizedQuery($dbc, $query, 's', $username)
                or trigger_error(mysqli_error($dbc), E_USER_ERROR);

        if (mysqli_num_rows($result) == 0) 
        {
            if ($_POST['password'] == $_POST['verify_password'])
            {
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                $query = "INSERT INTO exercise_user ( `first_name`, `last_name`, `gender`, `birthdate`, `weight`, `username`, `hash_password`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
                $result = parameterizedQuery($dbc, $query, 'ssssiss', $first_name, $last_name, $gender, $birthdate, $weight, $username, $hashed_password)
                        or trigger_error(mysqli_error($dbc), E_USER_ERROR);

            }
            else
            {
?>
    <h1 class="text-danger">Passwords do not match, please try again. <a href="./createuser.php">Go Back</a></h1>
    <?php
            }
        }
        else
        {
?>
    <h1 class="text-danger">Username already exists, please try another username. <a href="./createuser.php">Go Back</a>
    </h1>
    <?php
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