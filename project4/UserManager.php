<?php

class UserManager implements IUserManager
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->db_connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function create($username, $password): false|string|null
    {
        $return_value= NULL;
        try {
            $stmt = $this->pdo->prepare("INSERT INTO User (username, hashed_password, created, api_key) "
                . "VALUES (:username, :password, CURRENT_TIMESTAMP, :api_key)");
            $password_hash = $this->hash_password($password);
            $api_key = $this->generate_api_key();

            $stmt->execute(array(":username"=>$username, ":password"=>$password_hash, ":api_key"=>$api_key));
            $return_value = $this->pdo->lastInsertId();
        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>\n";
        }
        return $return_value;
    }

    public function read($id): false|string|null
    {
        $return_value= NULL;
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM User WHERE id = :id");
            $stmt->execute(array(":id"=>$id));
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $return_value = json_encode($results, JSON_PRETTY_PRINT);

        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br>\n";
        }
        return $return_value;
    }

    public function readAll(): false|array
    {
        $return_value= NULL;
        try {
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

    public function updatePassword($id, $newPassword): ?int
    {
        $return_value= NULL;
        try {
            $password_hash = $this->hash_password($newPassword);
            $stmt = $this->pdo->prepare("UPDATE User SET hashed_password = :password WHERE id = :id");
            $stmt->execute(array(":password"=>$password_hash));
            $return_value = $stmt->rowCount();
        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
    }

    public function updateApiKey($id): ?int
    {
        $return_value= NULL;
        try {
            $new_api_key = $this->generate_api_key();
            $stmt = $this->pdo->prepare("UPDATE User SET api_key = :api_key WHERE id = :id");
            $stmt->execute(array(":api_key"=>$new_api_key));
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
            $stmt = $this->pdo->prepare("DELETE FROM User WHERE id = :id");
            $stmt->execute(array(":id"=>$id));
            $return_value = $stmt->rowCount();

        } catch (Exception $e)
        {
            echo "{$e->getMessage()}<br/>\n";
        }
        return $return_value;
    }

    public function hash_password($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function generate_api_key(): string
    {
        $random_number = random_bytes(32);
        $base62 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $key = "";

        for ($i = 0; $i < 32; $i++)
        {
            $value = ord($random_number[$i]);
            $key .= $base62[$value % 62];
        }

        return $key;
    }

    public function db_connect(): PDO
    {
        $host = '127.0.0.1';
        $db_name = 'PROJECT4';
        $db_user = 'student';
        $db_password = 'student';
        $db = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        return new PDO($db, $db_user, $db_password, $options);
    }
}