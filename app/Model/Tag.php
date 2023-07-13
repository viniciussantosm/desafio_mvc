<?php

namespace App\Model;

class Tag {
    private $id;
    private $tagName;

    public function __construct($id, $tagName)
    {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTagName()
    {
        return $this->tagName;
    }

    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    }
}