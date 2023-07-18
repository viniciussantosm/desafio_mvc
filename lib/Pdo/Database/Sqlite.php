<?php

namespace Library\Pdo\Database;

use Library\Pdo\DatabaseInterface;
use PDO;
use PDOException;

class Sqlite implements DatabaseInterface {

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
        return new PDO(sprintf("sqlite:%s", $this->host), null, null, [PDO::ATTR_ERRMODE]);
    }
}