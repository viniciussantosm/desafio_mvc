<?php

namespace Library\Pdo;

interface QueryMakerInterface {
    public function insertQuery($table, array $fields, array $values);
    public function updateQuery($table, array $fields, array $values, $where = null);
    public function deleteQuery($table, $where = null);
    public function selectQuery($table, $fields = "*", $where = null);
}