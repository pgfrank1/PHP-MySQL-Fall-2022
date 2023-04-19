<?php
require_once ("Person.php");

class Ninja extends Person
{
    public function JumpingSpinKick() {
        echo $this->name . " and " . $this->email . " executing a jumping spin kick";
    }
}