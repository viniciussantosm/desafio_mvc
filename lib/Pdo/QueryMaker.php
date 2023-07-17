<?php

namespace Library\Pdo;
use Library\Pdo\Database\Mysql;

class QueryMaker implements QueryMakerInterface {

    private $conn;
    
    public function __construct()
    {
        $this->conn = new Mysql(DB_SERVER, DB_NAME, DB_USER, DB_PASSWORD);
    }

    public function insertQuery($table, array $fields, array $values):bool|string
    {
        $fields = implode(", ", $fields);
        $values = implode(", ", array_map([$this, 'addQuotes'], $values));
        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        
        return $this->executeQuery($this->conn->getConn(), $query);
    }

    public function updateQuery($table, array $fields, array $values, $where = null):bool|string
    {
        $query = "UPDATE $table SET";
        for($x = 0;$x < count($fields);$x++) {
            $query .= sprintf(" %s = %s,", $fields[$x], $this->addQuotes($values[$x]));
        }
        $query = trim($query, ",");
        $query .= " WHERE $where";

        return $this->executeQuery($this->conn->getConn(), $query);
    }

    public function deleteQuery($table, $where = null):bool|string
    {
        $query = "DELETE FROM $table";

        if($where) {
            $query .= " WHERE $where";
        }

        return $this->executeQuery($this->conn->getConn(), $query);
    }

    public function selectQuery($table, $fields = "*", $where = null):array|string
    {
        $query = "SELECT $fields FROM $table";
        if($where) {
            $query .= " WHERE $where";
        }
        return $this->retrieveQuery($this->conn->getConn(), $query);
    }

    function addQuotes($str)
    {
        return sprintf("'%s'", $str);
    }

    public function executeQuery($pdo, $query)
    {
        $stmt = $pdo->prepare($query);
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function retrieveQuery($pdo, $query)
    {
        try {
            $stmt = $pdo->query($query);
            if($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            return [];
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}