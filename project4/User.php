<?php
require_once "./UserManager.php";

$http_verb = $_SERVER['REQUEST_METHOD'];
$user_manager = new UserManager();

switch($http_verb)
{
    case "GET":
        if (isset($_GET['id']))
        {
            $result = $user_manager->read($_GET['id']);
        }
        else
        {
            $result = $user_manager->readAll();
        }
        break;
    case "POST":
        break;
    case "PUT":
        break;
    case "DELETE":
        break;
    default:
        break;
}