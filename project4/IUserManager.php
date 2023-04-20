<?php

interface IUserManager
{
    public function create($username, $password);
    public function read($id);
    public function readAll();
    public function updatePassword($id, $newPassword);
    public function updateApiKey($id);
    public function delete($id);

}