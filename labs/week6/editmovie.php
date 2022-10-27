<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Edit a Movie</title>

</head>
<body>
<div class="card">
    <div class="card-body">
        <h1>Edit a Movie</h1>
        <nav class="nav">
            <a class="nav-link" href="index.php">Movies I Like</a>
        </nav>
        <hr>
        <?php
        echo $_GET['id_to_edit'];
        require_once("dbconnection.php");

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or trigger_error(
                    'Error connecting to MySQL server for ' . DB_NAME,
                    E_USER_ERROR
                );
        
        
        $genres = [
            'Action', 'Adventure', 'Comedy', 'Documentary', 'Drama',
            'Fantasy', 'Horror', 'Medival', 'Romance', 'Science Fiction'
        ];        
        
        if(isset($_GET['id_to_edit']))
        {
            echo 'test';
            $id_to_edit = $_GET('id_to_edit');

            $query = "SELECT * FROM movieListing WHERE id = $id_to_edit";

            $result = mysqli_query($dbc, $query)
                or trigger_error('Error querying database movieListing', E_USER_ERROR);
        }
        ?>
    </div>
</div>
</body>
</html>