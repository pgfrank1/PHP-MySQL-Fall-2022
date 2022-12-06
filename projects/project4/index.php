<?php
session_start();
require_once('page-titles.php');
$page_title = INDEX_PAGE;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./css/normalize.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?= $page_title ?></title>
</head>
<body>
<main>
    <?php
    if(empty($_SESSION['player_name']))
    {
        require_once('dbconnection.php');
        require_once("query-utils.php");

        $dbc = mysqli_connect(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME)
                or trigger_error("There was an error attempting to connect to the database.", E_USER_ERROR);


    ?>
    <div class="container">
        <h1 class="text-center">Welcome to The Game!</h1>
        <div class="text-center py-4">
            <a class="btn btn-primary" href="admin-login.php">Admin Login</a>
        </div>
        <form class="bg-secondary p-4">
            <div class="form-group">
                <label class="form-label text-light" for="playerName">Enter your name:</label>
                <input type="text" class="form-control" id="playerName">
                <div class="invalid-feedback">
                    Please provide a Birthdate.
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="form-label text-light">Choose your Class:</label>
                <br>
                <select>

                </select>
            </div>
            <div class="pt-4 text-center">
                <button class="btn btn-primary" type="submit" name="create_user">Submit</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
    <?php
    }
    ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>
</html>
