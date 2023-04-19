<?php

class UserManager implements IUserManager
{

    public function create($username, $password)
    {
        // TODO: Implement create() method.
    }

    public function read($id)
    {
        // TODO: Implement read() method.
    }

    public function readAll()
    {
        // TODO: Implement readAll() method.
    }

    public function update($id, $newPassword)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
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