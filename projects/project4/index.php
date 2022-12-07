<?php
session_start();
require_once('page-titles.php');
require_once('the-game-functions.php');
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
    if (isset($_POST['player_start']))
    {
        $_SESSION['player_name'] = $_POST['player_name'];
        $_SESSION['player_class'] = $_POST['player_class'];

        header('Location: the-game.php');
    }
    if(empty($_SESSION['player_name']))
    {
    ?>
    <div class="container">
        <h1 class="text-center">Welcome to The Game!</h1>
        <div class="text-center py-4">
            <a class="btn btn-primary" href="admin-login.php">Admin Login</a>
        </div>
        <form class="needs-validation bg-light w-50 p-4 m-auto" novalidate method="POST" action="<?= $_SERVER['PHP_SELF']?>">
            <div class="form-group text-center">
                <label class="form-label" for="player_name">Player Name:</label>
                <input class="form-control" type="text" name="player_name" id="player_name" placeholder="Player Name" required>
                <div class="invalid-feedback">
                    Please provide the Item Name.
                </div>
            </div>
            <div class="form-group text-center">
                <label class="form-label text-light" for="player_class">Choose your Class:</label>
                <select class="form-select text-center" id="player_class" name="player_class" required>
                    <option selected value="">Select a class</option>
                <?php
                echo getAllClassesForPlayer()
                ?>
                </select>
                <div class="invalid-feedback">
                    Please provide a class for your character.
                </div>
            </div>
            <div class="pt-4 text-center">
                <button class="btn btn-primary" type="submit" name="player_start">Submit</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
    <?php
    }
    else
    {
        header('Location: the-game.php');
    }
    ?>
</main>
<!-- Input Validation Script -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            let forms = document.getElementsByClassName('needs-validation');
            let validation = Array.prototype.filter.call(forms, function(form) {
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
</body>
</html>
