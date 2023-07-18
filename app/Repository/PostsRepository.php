<?php

namespace App\Repository;

class PostsRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->selectQuery("posts");
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("posts", "*", "id = $id")[0];
    }

    public function create($data)
    {
    }

    public function update($data)
    {
    }

    public function delete($id)
    {
        return $this->queryBuilder->deleteQuery("posts", "id = {$id}");
    }

    public function save($data)
    {
        if($data["id"]) {
            return $this->queryBuilder->updateQuery("posts", ["title", "text"], [$data['title'], $data['text']], "id = {$data['id']}");
        }

        return $this->queryBuilder->insertQuery(
            "posts", 
            ["title", "text"],
            [$data['title'], $data['text']]
        );
    }
}