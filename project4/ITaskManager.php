<?php

namespace project4;

class ITaskManager
{
    public function create($desc);
    public function read($id);
    public function readAll();
    public function update($id, $newDesc);
    public function delete($id);
}