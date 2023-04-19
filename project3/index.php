<?php
    require_once('TaskManager.php');
    require_once('Task.php');

    echo "Adding a task to the database<br>";

    $task_manager = new TaskManager();

    $new_id = $task_manager->create("'DROP TABLE Task;--");

    echo "The new task ID is: $new_id";

    $task = new Task();

    $task = $task_manager->read($new_id - 1);

    echo "<br><br>The previous task is: <br>" . implode("<br>", $task);

    echo "<br><br>Getting all database entries: ";
    $get_all = $task_manager->readAll();
    foreach ($get_all as $task)
    {
        echo $task;
    }
    echo "<br><br>Modifying database entry";
    $task = $task_manager->update(($new_id-2), "A new description");

    echo "<br><br>Deleting database entry";
    $task = $task_manager->delete($new_id);