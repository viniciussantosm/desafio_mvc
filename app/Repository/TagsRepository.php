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

    public function findByPostId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                "posts_tags", 
                                "*", 
                                "INNER JOIN bloggero.tags ON bloggero.posts_tags.id_tag = bloggero.tags.id",
                                "id_post = $id"
                            );
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
        $data["name"] = $this->sanitizeTag($data["name"]);
        if(array_key_exists("id", $data)) {
            return $this->queryBuilder->updateQuery("tags", ["name"], [$data['name']], "id = {$data['id']}");
        }

        return $this->queryBuilder->insertQuery(
            "tags", 
            ["name"], 
            [$data['name']]
        );
    }

    public function sanitizeTag ($data)
    {
        $data = explode(" ", $data);
        
        if(count($data) == 1) {
            trim($data[0], "#");
            $data = sprintf("#%s", $data[0]);
            return $data;
        }

        $data = trim($data[0], "#");
        $data = sprintf("#%s", $data);

        return $data;
    }
}