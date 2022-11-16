<?php
$username = 'student';
$password = 'student';

// IF Password OR Username are empty
//  OR Password  OR Username don't match
// send HTTP authentication headers
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
    || $_SERVER['PHP_AUTH_USER'] !== $username
    || $_SERVER['PHP_AUTH_PW'] !== $password)
{

    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Project 3 Exercise Log"');
    $invalid_response = "<h4>You must enter a "
                        . "valid username and password to access this page.</h4>"
                        . "<a href='index.php'>Go back</a>";
    exit($invalid_response);
} 
//deletePost.php?id_to_delete=<?=$row["id"]
?>