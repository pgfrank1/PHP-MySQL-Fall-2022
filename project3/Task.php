<?php

class Task
{
    private $id;
    private $description;

    // Magic Get/Set
    public function __get($ivar)
    {
        return $this->$ivar;
    }

    public function __set($ivar, $value)
    {
        $this->$ivar = $value;
    }

    public function __toString()
    {
        $format = "<hr/>Id: %s<br>Description: %s";

        return sprintf($format, $this->__get('id'), $this->__get('description'));
    }
}