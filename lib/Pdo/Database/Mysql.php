<?php

namespace Library\Pdo\Database;

use Library\Pdo\DatabaseInterface;
use PDO;
use PDOException;

class Mysql implements DatabaseInterface {

    private $host = DB_SERVER;
    private $name = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASSWORD;

    public function __construct(string $host, string $name, string $user, string $password = null)
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConn():PDO {
        return new PDO(sprintf("mysql:host=%s;dbname=%s", $this->host, $this->name), $this->user, $this->password, [PDO::ATTR_ERRMODE]);
    }

    public function insert($table, array $fields, array $values):bool|string
    {
        $fields = implode(", ", $fields);
        $values = implode(", ", array_map([$this, 'addQuotes'], $values));
        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        
        return $this->executeQuery($this->getConn(), $query);
    }

    public function update($table, array $fields, array $values, $where = null):bool|string
    {
        $query = "UPDATE $table SET";
        for($x = 0;$x < count($fields);$x++) {
            $query .= sprintf(" %s = %s,", $fields[$x], $this->addQuotes($values[$x]));
        }
        $query = trim($query, ",");
        $query .= " WHERE $where";

        return $this->executeQuery($this->getConn(), $query);
    }

    public function delete($table, $where = null):bool|string
    {
        $query = "DELETE FROM $table";

        if($where) {
            $query .= " WHERE $where";
        }

        return $this->executeQuery($this->getConn(), $query);
    }

    public function select($table, $fields = "*", $where = null):array|string
    {
        $query = "SELECT $fields FROM $table";
        if($where) {
            $query .= " WHERE $where";
        }

        return $this->retrieveQuery($this->getConn(), $query);
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
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function retrieveQuery($pdo, $query)
    {
        try {
            $stmt = $pdo->query($query);
            if($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return [];
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}