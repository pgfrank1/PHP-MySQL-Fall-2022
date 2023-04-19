<?php
require_once("ITaskManager.php");

class TaskManager implements ITaskManager
{
    public function create($desc): bool|string
    {
        $db = $this->db_connect();

        $sanitizedString = htmlspecialchars($desc);

        try
        {
            $query = $db->prepare("INSERT INTO Task(`description`) VALUES (:description)");
            $query->bindParam(':description', $desc);
            $query->execute();
        }
        catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>";
        }
        return $db->lastInsertId();
    }

    public function read($id)
    {
        $db = $this->db_connect();
        $sql = "SELECT `id`, `description` FROM Task WHERE `id` = $id";
        try
        {
            $query = $db->prepare($sql);
            $query->execute();

            $results = $query-> fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>";
        }
        return $results;
    }

    public function readAll()
    {
        $db = $this->db_connect();

        $sql = "SELECT * FROM Task";

        try
        {
            $query = $db->prepare($sql);
            $query->execute();

            $results = $query->fetchAll(PDO::FETCH_CLASS, 'Task');
        }
        catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>";
        }
        return $results;

    }

    public function update($id, $newDesc)
    {
        $db = $this->db_connect();

        $sql = "UPDATE Task SET `description`=:description WHERE `id`=:id";
        try
        {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':description', $newDesc);
            $query->execute();
            $rows_affected = $query-> rowCount();
        }
        catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>";
        }
        return $rows_affected;
    }

    public function delete($id)
    {
        $db = $this->db_connect();

        $sql = "DELETE FROM Task WHERE `id` = (:id - 4)";

        try
        {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
        }
        catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>";
        }
    }

    public function db_connect(): PDO
    {
        $host = '127.0.0.1';
        $db_name = 'ADVPROJECT3';
        $db_user = 'student';
        $db_password = 'student';
        $db = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        return new PDO($db, $db_user, $db_password, $options);
    }
}