<?php

namespace config;

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "bloggero";

    public $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->host=$host;
        $this->username=$username;
        $this->password=$password;
        $this->database=$database;
    }

    public function connect() {
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database);
        if(mysqli_connect_error()) {
            echo mysqli_connect_error();
            exit();
        } else {
            return $this->conn;
        }
    }
}