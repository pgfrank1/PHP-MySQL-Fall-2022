<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Movies I Like</title>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h1>Movies I Like</h1>
            <p>If you have a movie you would like to add, please <a href="addmovie.php">add it here!</a></p>
        </div>
    </div>
    <?php
        require_once('dbconnection.php');

        // Create the database connection
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error(
                    'Error connecting to MySQL server for ' . DB_NAME,
                    E_USER_ERROR
                );
    
        // Create the database query to select the user made Mad Libs
        $retrieve_movies = "SELECT (title, release_year) FROM movieListing";
    
        // Attempt to retrieve the user Mad Libs
        $return_movies = mysqli_query($dbc, $retrieve_movies)
            or trigger_error("Error querying database for user stories.",
            E_USER_WARNING);
        ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Movie</th>
                    <th scope="col">Release Year</th>
                </tr>
                <?php
                while($row = mysqli_fetch_assoc($return_movies))
                { ?>
                    <tr>
                        <td><?=$row["completedStory"];?></td>
                        <td><?=$row["completedStory"];?></td>
                    </tr>
                <?php
                }
                ?>
            </thead>
        </table>
        <?php
        while($row = mysqli_fetch_assoc($return_movies))
        {
            ?>
            <div>
            <?php
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>