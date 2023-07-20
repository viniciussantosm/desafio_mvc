<?php

namespace Library\Pdo;

use PDO;

interface DatabaseInterface {

    public function __construct(string $host, string $name = null, string $user = null, string $password = null);
    public function getConn():PDO;
}

