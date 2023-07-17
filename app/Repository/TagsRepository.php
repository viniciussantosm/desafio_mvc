<?php

namespace App\Repository;

class TagsRepository extends Repository {

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        return $this->selectQuery("tags");
    }

    public function findById($id)
    {
        return $this->selectQuery("tags", "*", "id = $id")[0];
    }

    public function create($data)
    {
    }

    public function update($data)
    {
    }

    public function delete($id)
    {
        return $this->deleteQuery("tags", "id = {$id}");
    }

    public function save($data)
    {
        if($data["id"]) {
            return $this->updateQuery("tags", ["name"], [$data['name']], "id = {$data['id']}");
        }

        return $this->insertQuery(
            "tags", 
            ["name"], 
            [$data['name']]
        );
    }
}