<?php
    //require_once('authorize.php');
    session_start();
    require_once('pagetitles.php');
    $page_title = DELETE_POST;
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
<body>
    <div class="container">
    <?php

        require_once("dbconnection.php");
        require_once('queryutils.php');

        include('nav.php');

        $id = $_GET['id_to_delete'];

        if (isset($_POST['delete_post']))
        {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

            $query = "DELETE FROM exercise_log WHERE id = ?";

            $result = parameterizedQuery($dbc, $query, 'i', $id)
                    or trigger_error(mysqli_error($dbc), E_USER_ERROR);
            
            header('Location: viewprofile.php');
            exit;
        }
        else
        {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);

            $query = "SELECT * FROM exercise_log WHERE id = ?";

            $result = parameterizedQuery($dbc, $query, 'i', $id)
                    or trigger_error(mysqli_error($dbc), E_USER_ERROR);

            if (mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                ?>
                <h3 class="p-1 text-center">Delete this exercise post?</h3>
                <div class="card  m-1 p-0">
                    <div class="card-header row mx-0">
                        <h3 class="col">
                            <?= $row["exercise_type"] ?>
                        </h3>
                    </div>
                    <div class="card-body">
                    <p>
                        Date: <?=$row["date"]?>
                    </p>
                    <p>
                        Exercise Duration: <?=$row['time_in_minutes']?> min
                    </p>
                    <p>
                        Heart Rate: <?= $row['heartrate'] ?> bpm
                    </p>
                    <p>
                        Calories Used: <?= $row['calories']?>
                    </p>
                    </div>
                </div>
                <form class="needs-validation" novalidate method="POST"
                        action="">
                <div class="py-3 text-center">
                    <button class="btn btn-danger" name="delete_post" type="submit" method="POST"
                        action="">Delete Post</button>
                    <button class="btn btn-primary">Go Back</button>
                </div></form>
            </div> 
            <?php
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f90e67e55f.js" crossorigin="anonymous"></script>
</body>
</html>