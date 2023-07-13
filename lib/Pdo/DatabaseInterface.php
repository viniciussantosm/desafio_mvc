<?php

namespace Library\Pdo;

use PDO;

interface DatabaseInterface {
    public function getConn():PDO;
    public function insert($table, array $fields, array $values);
    public function update($table, array $fields, array $values, $where = null);
    public function delete($table, $where = null);
    public function select($table, $fields = "*", $where = null);
}

