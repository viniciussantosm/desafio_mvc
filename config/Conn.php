<?php

namespace config;

class Database {
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = new \mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConn()
    {
        return $this->conn;
    }
}