<?php

require_once "./ITaskManager.php";

class TaskManager implements ITaskManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->db_connect();
    }

    public function create($desc): false|string|null
    {
        $return_value= NULL;
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Task (description) VALUES (:desc)");
            $stmt->execute(array(":desc"=>$desc));
            $return_value = $this->pdo->lastInsertId();
        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
    }

    public function read($id): false|string|null
    {
        $return_value= NULL;
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Task WHERE id = :id");
            $stmt->execute(array(":id"=>$id));
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $return_value = json_encode($results, JSON_PRETTY_PRINT);
        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
    }

    public function readAll(): false|array
    {
        $return_value= NULL;
        try
        {
            $stmt = $this->pdo->prepare("SELECT * FROM User");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $return_value = json_encode($results);

        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
    }

    public function update($id, $newDesc): ?int
    {
        $return_value= NULL;
        try {
            $stmt = $this->pdo->prepare("UPDATE Task SET description = :newDesc WHERE id = :id");
            $stmt->execute(array(":id"=>$id, ":newDesc"=>$newDesc));
            $return_value = $stmt->rowCount();
        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
    }

    public function delete($id): ?int
    {
        $return_value= NULL;
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Task WHERE id = :id");
            $stmt->execute(array(":id"=>$id));
            $return_value = $stmt->rowCount();
        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
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