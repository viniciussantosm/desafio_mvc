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
        return $this->queryBuilder->selectQuery("tag", "id, name, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at");
    }

    public function findById($id)
    {
        $tag = $this->queryBuilder->selectQuery("tag", "*", "id = $id");
        
        if(!is_array($tag)) {
            return false;
        }

        if(array_key_exists(0, $tag)) {
            return $tag[0];
        }

        return false;
    }

    public function findByPostId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                "post_tag", 
                                "*", 
                                "INNER JOIN tag ON post_tag.id_tag = tag.id",
                                "id_post = $id"
                            );
    }

    public function findPostsByTagId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "post_tag", 
                                    "post.id, post.title, post.text, DATE_FORMAT(post.created_at, \"%d/%m/%Y\") AS created_at, user.name AS user, tag.name AS tag, post_image.img_path", 
                                    "INNER JOIN post ON post.id = post_tag.id_post LEFT JOIN post_image ON post_image.id_post = post.id LEFT JOIN user ON user.id = post.id_user LEFT JOIN tag ON tag.id = post_tag.id_tag",
                                    "id_tag = $id ORDER BY post.created_at DESC"
                                );
    }

    public function delete($id)
    {
        return $this->queryBuilder->deleteQuery("tag", "id = {$id}");
    }

    public function save($data)
    {
        $data["name"] = $this->sanitizeTag($data["name"]);
        
        if(array_key_exists("id", $data)) {
            $this->queryBuilder->updateQuery("tag", ["name"], [$data['name']], "id = {$data['id']}");
            return true;
        }

        return $this->queryBuilder->insertQuery(
            "tag", 
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