<?php

namespace App\Model;

class Comment {
    private $id;
    private $text;
    private $id_user;
    private $created_at;

    public function __construct($id, $text, $id_user, $created_at)
    {
        $this->id = $id;
        $this->text = $text;
        $this->created_at = $created_at;
        $this->id_user = $id_user;
    }

    public function getId():string
    {
        return $this->id;
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    public function getText():string
    {
        return $this->text;
    }

    public function setText($text):void
    {
        $this->text = $text;
    }

    public function getCreatedAt():string
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at):void
    {
        $this->created_at = $created_at;
    }

    public function getIdUser():string
    {
        return $this->id_user;
    }

    public function setIdUser($id_user):void
    {
        $this->id_user = $id_user;
    }
}