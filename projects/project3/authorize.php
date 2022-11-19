<?php
    session_start();
    require_once('dbconnection.php');
    require_once('queryutils.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error(
            'Error connecting to MySQL server for' . DB_NAME,
            E_USER_ERROR );

    $query = "SELECT username, hash_password FROM exercise_user WHERE id = ?";

    $results = parameterizedQuery($dbc, $query, 'i', $_SESSION['user_id'])
            or trigger_error(mysqli_error($dbc), E_USER_ERROR);

// IF Password OR Username are empty
//  OR Password  OR Username don't match
// send HTTP authentication headers
    $row = mysqli_fetch_assoc($results);


if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
    || $_SERVER['PHP_AUTH_USER'] !== $row['username']
    || !password_verify($_SERVER['PHP_AUTH_PW'], $row['hash_password']))
{

    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Project 2 Blog"');
    $invalid_response = "<h4>You must enter a "
                        . "valid username and password to access this page.</h4>"
                        . "<a href='index.php'>Go back</a>";
    exit($invalid_response);
} 
//deletePost.php?id_to_delete=<?=$row["id"]
?>