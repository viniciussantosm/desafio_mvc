<?php

namespace Library\Pdo;
use Library\Pdo\Database\Mysql;
use Library\Pdo\Database\Sqlite;
use Library\Pdo\Querys\SqlQuery;

class ConnectionAdapter {

    private $driver = DB_DRIVER;

    public function getQuery() {
        switch ($this->driver) {
            case 'mysql':
                $sql = new Mysql(DB_SERVER, DB_NAME, DB_USER, DB_PASSWORD);
                $sqlQuery = new SqlQuery($sql->getConn());
                return $sqlQuery;
            break;
            case 'sqlite':
                $sqlite = new Sqlite("database.db", null, null, null);
                $sqlQuery = new SqlQuery($sqlite->getConn());
                return $sqlQuery;
            break;
        }
    }
}