<?php

namespace Library\Pdo\Database;

use Library\Pdo\DatabaseInterface;
use PDO;

class Mysql implements DatabaseInterface {

    private $host = DB_SERVER;
    private $name = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASSWORD;

    public function __construct(string $host, string $name = null, string $user = null, string $password = null)
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConn():PDO {
        return new PDO(sprintf("mysql:host=%s;dbname=%s", $this->host, $this->name), $this->user, $this->password, [PDO::ATTR_ERRMODE]);
    }
}