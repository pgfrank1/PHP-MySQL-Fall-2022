<?php

require_once ('./TaskManager.php');

$http_verb = $_SERVER['REQUEST_METHOD'];
$task_manager = new TaskManager();

switch ($http_verb)
{
    case "POST":
        if(isset($_POST['task_description']))
        {
            $task_manager->create($_POST['task_description']);
        }
        else
        {
            throw new Exception("Invalid HTTP POST request parameters.");
        }
        break;

    case "GET":
        if (isset($_GET['task_id']))
        {
            $task_manager->read($_GET['task_id']);
        }
        else
        {
            $task_manager->readAll();
        }
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"), $update_tasks);

        if (isset($update_tasks['id']) && isset($update_tasks['description']))
        {
            $task_manager->update($update_tasks['id'], $update_tasks['description']);
        }
        else
        {
            throw new Exception("Invalid HTTP UPDATE request parameters");
        }
        break;
    case "DELETE":
        parse_str(file_get_contents("php://input"), $delete_vars);

        if (isset($delete_vars['id']))
        {
            $task_manager->delete($delete_vars['id']);
        }
        else
        {
            throw new Exception("Invalid HTTP DELETE request parameters");
        }
        break;
    default:
        throw new Exception("Unsupported HTTP request");
}