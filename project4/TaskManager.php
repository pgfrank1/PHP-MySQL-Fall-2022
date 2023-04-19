<?php

require_once ".\ITaskManager.php";

class TaskManager implements ITaskManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->db_connect();
    }

    public function create($desc): false|string
    {
        $stmt = $this->pdo->prepare("INSERT INTO Task (description) VALUES (:desc)");
        $stmt->bindParam(":desc", $desc);

        if ($stmt->execute())
        {
            return $this->pdo->lastInsertId();
        }
        else
        {
            throw new Exception("Failed to create the task");
        }
    }

    public function read($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Task WHERE id = :id");
        $stmt->bindParam(":id", $id);
        if ($stmt->execute())
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result)
            {
                return $result;
            }
            else
            {
                throw new Exception("No task found with the ID: $id");
            }
        }
        else
        {
            throw new Exception("Failed to read the task");
        }
    }

    public function readAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Task");
        if ($stmt->execute())
        {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            throw new Exception("Failed to read all the tasks");
        }
    }

    public function update($id, $newDesc)
    {
        $stmt = $this->pdo->prepare("UPDATE Task SET description = :newDesc WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":newDesc", $newDesc);

        if ($stmt->execute()) {
            return $stmt->rowCount();
        } else {
            throw new Exception("Failed to update the task");
        }
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Task WHERE id = :id");
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return $stmt->rowCount();
        } else {
            throw new Exception("Failed to delete the task");
        }
    }
    public function db_connect(): PDO {
        $host = '127.0.0.1';
        $db_name = 'PROJECT4';
        $db_user = 'student';
        $db_password = 'student';
        $db = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        return new PDO($db, $db_user, $db_password, $options);
    }
}