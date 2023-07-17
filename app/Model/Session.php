<?php

namespace App\Model;

class Session {
    private static $message;
    private static $name;
    private static $userId;
    private static $isLoggedIn;
    private static $instance = null;

    private function __construct($message = null, $name = null, $userId = null)
    {
        self::$message = $_SESSION["message"] ?? null;
        self::$name = $_SESSION["name"] ?? null;
        self::$userId = $_SESSION["userId"] ?? null;
        self::$isLoggedIn = $_SESSION["isLoggedIn"] ?? null;
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public static function getMessage()
    {
        // return self::$message;
        return $_SESSION["message"] ?? null;
    }

    public static function getName()
    {
        // return self::$name;
        return $_SESSION["name"] ?? null;
    }

    public static function getUserId()
    {
        // return self::$userId;
        return $_SESSION["userId"] ?? null;
    }

    public static function isLoggedIn()
    {
        // return self::$isLoggedIn;
        return $_SESSION["isLoggedIn"] ?? null;
    }

    public static function setMessage($type, $message)
    {
        $_SESSION["message"]["type"] = $type;
        $_SESSION["message"]["content"] = $message;
        self::$message = $_SESSION["message"];
    }

    public static function setName($name)
    {
        $_SESSION["name"] = $name;
        self::$name = $_SESSION["name"];
    }

    public static function setUserId($userId)
    {
        $_SESSION["userId"] = $userId;
        self::$userId = $_SESSION["userId"];
    }

    public static function setLoggedIn($isLoggedIn)
    {
        $_SESSION["isLoggedIn"] = $isLoggedIn;
        self::$isLoggedIn = $_SESSION["isLoggedIn"];
    }

    public static function unsetMessage()
    {
        unset($_SESSION["message"]);
        self::$message = null;
    }
}