<?php

interface IUserManager
{
    public function create($username, $password);
    public function read($id);
    public function readAll();
    public function update($id, $newPassword);
    public function delete($id);

}