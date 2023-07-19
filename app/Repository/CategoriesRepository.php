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
        return $this->queryBuilder->selectQuery("categories", "id, name, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at");
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

    public function findPostsByCategoryId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "posts_categories", 
                                    "posts.id, posts.title, posts.text, DATE_FORMAT(posts.created_at, \"%d/%m/%Y\") AS created_at, users.name AS user, categories.name AS category, posts_images.img_path", 
                                    "INNER JOIN posts ON posts.id = posts_categories.id_post LEFT JOIN posts_images ON posts_images.id_post = posts.id LEFT JOIN users ON users.id = posts.id_user LEFT JOIN categories ON categories.id = posts_categories.id_category",
                                    "id_category = $id ORDER BY posts.created_at DESC"
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