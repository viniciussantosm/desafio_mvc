<?php

namespace App\Repository;

class TagsRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->selectQuery("tags");
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("tags", "*", "id = $id")[0];
    }

    public function create($data)
    {
    }

    public function update($data)
    {
    }

    public function delete($id)
    {
        return $this->queryBuilder->deleteQuery("tags", "id = {$id}");
    }

    public function save($data)
    {
        if($data["id"]) {
            return $this->queryBuilder->updateQuery("tags", ["name"], [$data['name']], "id = {$data['id']}");
        }

        return $this->queryBuilder->insertQuery(
            "tags", 
            ["name"], 
            [$data['name']]
        );
    }
}