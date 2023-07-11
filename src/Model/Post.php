<?php

namespace src\Model;

use src\Model\Tag;

class Post {
    private $id;
    private $title;
    private $text;
    private $tags = [];
    private $categories = [];

    public function __construct($id, $title, $text, $tags)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->tags = $tags;
    }
    
    public function getId():string
    {
        return $this->id;
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function setTitle($title):void
    {
        $this->title = $title;
    }

    public function getText():string
    {
        return $this->text;
    }

    public function setText($text):void
    {
        $this->text = $text;
    }

    public function getTags():array
    {
        return $this->tags;
    }

    public function setTags($tags):void
    {
        $this->tags = $tags;
    }

    public function getCategories():array
    {
        return $this->categories;
    }

    public function setCategories($categories):void
    {
        $this->categories = $categories;
    }
}

