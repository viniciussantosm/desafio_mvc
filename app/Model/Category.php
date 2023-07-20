<?php

namespace App\Model;

class Category
{
    private $id;
    private $name;

    public function getId():string
    {
        return $this->id;
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName($name):void
    {
        $this->name = $name;
    }
}