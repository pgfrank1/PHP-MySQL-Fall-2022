<?php
    //require_once('authorize.php');
    session_start();
    require_once('pagetitles.php');
    $page_title = EDIT_PROFILE;
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
    }
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
        if (!isset($_POST['submit_profile_edit']))
        {
            require_once("dbconnection.php");
            require_once("queryutils.php");
        
            $query_user_info = "SELECT * FROM exercise_user WHERE id = ?";
        
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);
        
            $result_user_info = parameterizedQuery($dbc, $query_user_info, 'i', $_SESSION['user_id'])
                    or trigger_error(mysqli_error($dbc), E_USER_ERROR);
            
            if (mysqli_num_rows($result_user_info) == 1)
            {
                $row = mysqli_fetch_assoc($result_user_info);

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $gender = $row['gender'];
                $birthdate = $row['birthdate'];
                $weight = $row['weight'];
            ?>
    <form class="needs-validation bg-light d-flex flex-column align-self-center" novalidate method="POST"
        action="<?= $_SERVER['PHP_SELF']?>">
        <div class="form-group row">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="<?= $first_name ?>" required>
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
            <select class="form-select" name="gender" id="gender" required>
                <option value="m"<?php if($gender == 'm'): ?> selected="selected" <?php endif;?>>Male</option>
                <option value="f"<?php if($gender == 'f'): ?> selected="selected" <?php endif;?>>Female</option>
                <option value="nb"<?php if($gender == 'nb'): ?> selected="selected" <?php endif;?>>Non Binary</option>
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
        <div class="pt-4 text-center">
            <button class="btn btn-primary" type="submit" name="submit_profile_edit">Save</button>
        </div>
    </form>
    <?php
            }
            else
            {
    ?>
    <h1>There was an error trying to find the user</h1>
    <?php    
            }
        }
        if (isset($_POST['submit_profile_edit']))
        {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $birthdate = $_POST['birthdate'];
            $weight = $_POST['weight'];
            
            //echo $first_name;

            require_once("dbconnection.php");
            require_once("queryutils.php");
    
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);
    
            $query = "UPDATE exercise_user SET first_name = ?, last_name = ?, gender = ?, birthdate = ?, `weight` = ? WHERE id = ?";
    
            $result = parameterizedQuery($dbc, $query, 'ssssi', $first_name, $last_name, $gender, $birthdate, $weight, $_SESSION('user_id'))
                    or trigger_error(mysqli_error($dbc), E_USER_ERROR);
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