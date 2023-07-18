<?php

namespace Library\Pdo\Querys;

interface QueryInterface {
    public function insertQuery($table, array $fields, array $values);
    public function updateQuery($table, array $fields, array $values, $where = null);
    public function deleteQuery($table, $where = null);
    public function selectQuery($table, $fields = "*", $where = null);
}