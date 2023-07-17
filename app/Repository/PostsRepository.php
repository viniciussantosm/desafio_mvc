<?php

namespace App\Repository;

class PostsRepository extends Repository {

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        return $this->selectQuery("posts");
    }

    public function findById($id)
    {
        return $this->selectQuery("posts", "*", "id = $id")[0];
    }

    public function create($data)
    {
    }

    public function update($data)
    {
    }

    public function delete($id)
    {
        return $this->deleteQuery("posts", "id = {$id}");
    }

    public function save($data)
    {
        if($data["id"]) {
            return $this->updateQuery("posts", ["title", "text"], [$data['title'], $data['text']], "id = {$data['id']}");
        }

        return $this->insertQuery(
            "posts", 
            ["title", "text"],
            [$data['title'], $data['text']]
        );
    }
}