<html lang="en">
    <head>
        <title>Project 4</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
<!--    <body>
        <form action="./Task.php" method="POST">
            <label>
                <input type="text" name="task_description" >
            </label>
            <input type="submit" value="Send data via POST">
        </form>
    </body>-->

    <body class="container">

<?php
    session_start();
    if (!isset($_SESSION['username']))
    {
?>
        <h1>Log In</h1>
        <hr>
        <form action="./User.php">
            <div class="mb-3">
                <label class="form-label">
                    Username:
                    <input type="text" name="username" class="form-control" >
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Password:
                    <input type="password" name="password" class="form-control" >
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
        <p><a href="./createUser.php">Create new user</a></p>
<?php
    }
    else
    {
?>

<?php
    }
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>