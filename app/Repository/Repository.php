<?php

namespace App\Repository;
use Library\Pdo\ConnectionAdapter;

abstract class Repository extends ConnectionAdapter {
    abstract function findAll();
    abstract function findById($id);
    abstract function delete($id);
    abstract function save($data);
}