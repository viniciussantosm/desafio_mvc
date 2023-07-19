<?php

namespace App\Repository;

class CategoriesRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->selectQuery("categories");
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("categories", "*", "id = $id")[0];
    }

    public function findByPostId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "posts_categories", 
                                    "*", 
                                    "INNER JOIN bloggero.categories ON bloggero.posts_categories.id_category = bloggero.categories.id",
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
        return $this->queryBuilder->deleteQuery("categories", "id = {$id}");
    }

    public function save($data)
    {
        if(array_key_exists("id", $data)) {
            return $this->queryBuilder->updateQuery("categories", ["name"], [$data['name']], "id = {$data['id']}");
        }
        
        return $this->queryBuilder->insertQuery(
            "categories", 
            ["name"], 
            [$data['name']]
        );
    }
}