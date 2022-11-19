<?php
    //require_once('authorize.php');
    session_start();
    require_once('pagetitles.php');
    $page_title = VIEW_PROFILE;
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
    require_once("dbconnection.php");
    require_once("queryutils.php");

    $query_user_info = "SELECT * FROM exercise_user WHERE id = ?";

    $query_exercises = "SELECT exercise_log.id, first_name, last_name, gender, birthdate, `weight`, `date`, exercise_type,"
            . " time_in_minutes, heartrate, calories FROM exercise_user JOIN exercise_log"
            . " WHERE exercise_user.id = exercise_log.user_id && exercise_user.id = ? ORDER BY exercise_log.id DESC";

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

    $result_user_info = parameterizedQuery($dbc, $query_user_info, 'i', $_SESSION['user_id'])
            or trigger_error(mysqli_error($dbc), E_USER_ERROR);

    $result_exercises = parameterizedQuery($dbc, $query_exercises, 'i', $_SESSION['user_id'])
            or trigger_error(mysqli_error($dbc), E_USER_ERROR);

    if (mysqli_num_rows($result_user_info) == 1)
    {
        $row = mysqli_fetch_assoc($result_user_info);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $birthdate = $row['birthdate'];
        $weight = $row['weight'];

        require_once('calculateAge.php');
        $age = calculateAge($birthdate);
?>
    <div class="row">
        <div class="card col-3 px-0 h-50">
            <h3 class="card-header"><?= $first_name ?> <?= $last_name ?></h3>
            <div class="card-body px-3">
                <p>Age: <?= $age ?></p>
                <p>Gender:
                    <?php
                    switch ($gender) {
                        case 'm':
                            echo 'Male';
                            break;
                        case 'f':
                            echo 'Female';
                            break;
                        case 'nb':
                            echo 'Non Binary';
                            break;
                    }    
?>
                </p>
                <p>Birthdate: <?= $birthdate ?></p>
                <p>Weight: <?= $weight ?> lbs</p>
                <a href="editprofile.php">Edit Profile</a>
            </div>
        </div>
        <span class="col-1"></span>
        <div class="col-8">
            <table class="table">
                <thead>
                    <th scope="col">Exercise Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Exercised</th>
                    <th scope="col">Heartrate</th>
                    <th scope="col">Calories Burned</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    <?php
                        if (mysqli_num_rows($result_exercises) >= 1)
                        {
                            $rowCounter = 0;
                            while ($row = mysqli_fetch_assoc($result_exercises))
                            {
                                $rowCounter++;
                                
                                if ($rowCounter >= 15)
                                {
                                    break;
                                }

                                $date = $row['date'];
                                $exercise_type = $row['exercise_type'];
                                $time_in_minutes = $row['time_in_minutes'];
                                $heartrate = $row['heartrate'];
                                $calories = $row['calories'];
                                $id = $row['id'];
?> <tr>

                        <td><?= $exercise_type?></td>
                        <td><?= $date?></td>
                        <td><?= $time_in_minutes?></td>
                        <td><?= $heartrate?></td>
                        <td><?= $calories?></td>
                        <td><a class="col-1" href="deletepost.php?id_to_delete=<?=$id?>"><i
                                    class="fa-sharp fa-solid fa-trash"></i></a></td>
                    </tr>
                    <?php
                            }   
                        }
?>
                </tbody>
            </table>
        </div>
        <?php
    }
    /*if (mysqli_num_rows($result_exercises) >= 1)
    {
        while ($row = mysqli_fetch_assoc($result_exercises))
        {
            $date = $row['date'];
            $exercise_type = $row['exercise_type'];
            $time_in_minutes = $row['time_in_minutes'];
            $heartrate = $row['heartrate'];
            $calories = $row['calories'];
            $id = $row['id'];
?>
        <div class="card col-8 float-end">
            <div class="row card-header">
                <h3 class="col-11"><?= $exercise_type ?></h3>
                <a class="col-1" href="delete.php?id_to_delete=<?=$id?>"><i class="fa-sharp fa-solid fa-trash"></i></a>
            </div>
            <div class="card-body row">
                <div class="">
                    <p>Date: <?= $date ?></p>
                    <p>Time Exercised: <?= $time_in_minutes ?> minutes</p>
                    <p>Heartrate: <?= $heartrate?> bpm</p>
                    <p>Calories Burned: <?= $calories ?></p>
                </div>
            </div>
        </div>
        <?php
        }
    }*/
?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/f90e67e55f.js" crossorigin="anonymous"></script>
</body>

</html>