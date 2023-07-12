<?php

namespace src\Repository;

abstract class Repository {
    abstract function findAll();
    abstract function findById($id);
    abstract function create($data);
    abstract function update($data);
    abstract function delete($id);
    abstract function save();
}