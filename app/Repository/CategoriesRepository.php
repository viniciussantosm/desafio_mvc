<?php

namespace App\Repository;

class CategoriesRepository extends Repository {

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        return $this->selectQuery("categories");
    }

    public function findById($id)
    {
        return $this->selectQuery("categories", "*", "id = $id")[0];
    }

    public function create($data)
    {
    }

    public function update($data)
    {
    }

    public function delete($id)
    {
        return $this->deleteQuery("categories", "id = {$id}");
    }

    public function save($data)
    {
        if(array_key_exists("id", $data)) {
            return $this->updateQuery("categories", ["name"], [$data['name']], "id = {$data['id']}");
        }
        
        return $this->insertQuery(
            "categories", 
            ["name"], 
            [$data['name']]
        );
    }
}