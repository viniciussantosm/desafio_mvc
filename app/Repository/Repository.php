<?php

namespace App\Repository;
use Library\Pdo\QueryMaker;

abstract class Repository extends QueryMaker {
    abstract function findAll();
    abstract function findById($id);
    abstract function create($data);
    abstract function update($data);
    abstract function delete($id);
    abstract function save($data);
}