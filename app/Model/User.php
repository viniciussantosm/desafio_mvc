<?php

namespace App\Model;

use Exception;
use App\Model\UserLevels\Creator;
use App\Model\UserLevels\Admin;

abstract class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $acl = 0;

    public const ADMIN = 1;
    public const CREATOR = 2;

    abstract public function getType();

    public static function create($type)
    {
        switch($type) {
            case self::ADMIN:
                return new Admin();
            break;
            case self::CREATOR:
                return new Creator();
            break;
            default:
                throw new Exception("Invalid user type");
            break;
        }
    }

    public function setId($id):void
    {
        $this->id = $id;
    }

    public function getId():string
    {
        return $this->id;
    }

    public function setName($name):void
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setEmail($email):void
    {
        $this->email = $email;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setPassword($password):void
    {
        $this->password = $password;
    }

    public function getPassword():string
    {
        return $this->password;
    }
}