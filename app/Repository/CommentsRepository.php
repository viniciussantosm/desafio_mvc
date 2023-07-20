<?php

namespace App\Repository;

class CommentsRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->selectWithJoin(
                                        "post_comment",
                                        "id, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at",
                                        "INNER JOIN user ON user.id = post_comment",
                                        "id_post = "
                                    );
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("post_comment", "*", "id = $id")[0];
    }

    public function findByPostId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "post_comment", 
                                    "post_comment.id AS id_comment, text, DATE_FORMAT(post_comment.created_at, \"%d/%m/%Y às %H:%i\") AS created_at, id_user, user.name",
                                    "LEFT JOIN user ON user.id = post_comment.id_user",
                                    "id_post = $id"
                                );
    }

    public function delete($id)
    {
        return $this->queryBuilder->deleteQuery("comments", "id = {$id}");
    }

    public function save($data)
    {
        
        if(array_key_exists("id", $data)) {
            return $this->queryBuilder->updateQuery("comments", ["name"], [$data['name']], "id = {$data['id']}");
        }
        
        return $this->queryBuilder->insertQuery(
            "post_comment", 
            ["text, id_user, id_post"], 
            [$data['comment'], $data["id_user"], $data["id_post"]]
        );
    }
}