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
        return $this->queryBuilder->selectQuery("tags", "id, name, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at");
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

    public function findPostsByTagId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "posts_tags", 
                                    "posts.id, posts.title, posts.text, DATE_FORMAT(posts.created_at, \"%d/%m/%Y\") AS created_at, users.name AS user, tags.name AS tag, posts_images.img_path", 
                                    "INNER JOIN posts ON posts.id = posts_tags.id_post LEFT JOIN posts_images ON posts_images.id_post = posts.id LEFT JOIN users ON users.id = posts.id_user LEFT JOIN tags ON tags.id = posts_tags.id_tag",
                                    "id_tag = $id ORDER BY posts.created_at DESC"
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
            $data[0] = trim($data[0], "#");
            $data = sprintf("#%s", $data[0]);
            return $data;
        }

        $data = trim($data[0], "#");
        $data = sprintf("#%s", $data);

        return $data;
    }
}