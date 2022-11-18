<?php
    //require_once('authorize.php');
    session_start();
    require_once('pagetitles.php');
    $page_title = LOG_EXERCISE;
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
    <?php
    if (isset($_POST['add_exercise']))
    {
        $date = $_POST['date'];
        $exercise_type = $_POST['exercise_type'];
        $time_in_minutes = $_POST['time_in_minutes'];
        $heartrate = $_POST['heartrate'];
        $userid = $_SESSION['user_id'];

        require_once("dbconnection.php");
        require_once("queryutils.php");

        $query = "SELECT * FROM exercise_user WHERE id = ?"; // Weight and Gender

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

        $result = parameterizedQuery($dbc, $query, 'i', $userid)
                        or trigger_error(mysqli_error($dbc), E_USER_ERROR);

        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_array($result);

            $gender = $row['gender'];
            $weight = $row['weight'];
            $birthdate = $row['birthdate'];

            $today = date("Y-m-d");
            // Age outputs correctly
            $age = date_diff(date_create($birthdate), date_create($today));

            switch($gender) {
                case "m": // ((-55.0969 + (0.6309 * HR) + (0.090174 * W) + (0.2017 * A)) / 4.184) * T
                    //$calories = ((-55.0969 +(0.6309 * $heartrate) + (0.090174 * $weight) + (0.2017 * )) / 4.184) * T
                    echo "m";
                    break;
                    // no break
                case "f": // ((-20.4022 + (0.4472 * HR) – (0.057288 * W) + (0.074 * A)) / 4.184) * T
                    echo "f";
                    break;
                    // no break
                case "nb": // ((-37.7495 + (0.5391 * HR) + (0.01644 * W) + (0.1379 * A)) / 4.184) * T
                    echo "nb";
                    break;
            }
        /*$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

        $query = "INSERT INTO exercise_log (`user_id`, `date`, exercise_type, time_in_minutes, heartrate, calories) VALUES (?, ?, ?, ?, ?, ?)";

        $result = parameterizedQuery($dbc, $query, 'issiii', $userid, $date, $exercise_type, $time_in_minutes, $heartrate, $calories)
                or trigger_error(mysqli_error($dbc), E_USER_ERROR);
*/  
        }
    }
    if (!isset($_POST['add_exercise']))
    {
?>
    <form class="needs-validation bg-light d-flex flex-column justify-content-center" novalidate method="POST"
        action="<?= $_SERVER['PHP_SELF']?>">
        <div class="form-group p-3 row">
            <label class="form-label" for="date">Date</label>
            <input type="date" name="date" id="date">
        </div>
        <div class="form-group p-3 row">
            <label class="form-label" for="exercise_type">Exercise Type</label>
            <input type="exercise_type" name="exercise_type" id="exercise_type">
        </div>
        <div class="form-group p-3 row">
            <label class="form-label" for="time_in_minutes">Time Exercised in Minutes</label>
            <input type="time_in_minutes" name="time_in_minutes" id="time_in_minutes">
        </div>
        <div class="form-group p-3 row">
            <label class="form-label" for="heartrate">Heart Rate</label>
            <input type="heartrate" name="heartrate" id="heartrate">
        </div>
        <!--<div class="form-group p-3 row">
            <label class="form-label" for="calories">Calories</label>
            <input type="calories" name="calories" id="calories">
        </div>-->
        <div class="pt-4 text-center">
            <button class="btn btn-primary" type="submit" name="add_exercise">Submit</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
    </form>
    <?php
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