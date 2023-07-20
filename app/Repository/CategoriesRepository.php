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
        return $this->queryBuilder->selectQuery("category", "id, name, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at");
    }

    public function findById($id)
    {
        $category = $this->queryBuilder->selectQuery("category", "*", "id = $id");

        if(!is_array($category)) {
            return false;
        }

        if(array_key_exists(0, $category)) {
            return $category[0];
        }

        return false;
    }

    public function findByPostId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "post_category", 
                                    "*", 
                                    "INNER JOIN category ON post_category.id_category = category.id",
                                    "id_post = $id"
                                );
    }

    public function findPostsByCategoryId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "post_category", 
                                    "post.id, post.title, post.text, DATE_FORMAT(post.created_at, \"%d/%m/%Y\") AS created_at, user.name AS user, category.name AS category, post_image.img_path", 
                                    "INNER JOIN post ON post.id = post_category.id_post LEFT JOIN post_image ON post_image.id_post = post.id LEFT JOIN user ON user.id = post.id_user LEFT JOIN category ON category.id = post_category.id_category",
                                    "id_category = $id ORDER BY post.created_at DESC"
                                );
    }

    public function delete($id)
    {
        return $this->queryBuilder->deleteQuery("category", "id = {$id}");
    }

    public function save($data)
    {
        if(array_key_exists("id", $data)) {
            $this->queryBuilder->updateQuery("category", ["name"], [$data['name']], "id = {$data['id']}");
            return true;
        }
        
        return $this->queryBuilder->insertQuery(
            "category", 
            ["name"], 
            [$data['name']]
        );
    }
}