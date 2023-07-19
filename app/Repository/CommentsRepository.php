<?php

namespace App\Repository;

class CommentsRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    // public function findAll()
    // {
    //     return $this->queryBuilder->selectWithJoin(
    //                                     "posts_comments",
    //                                     "id, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at",
    //                                     "INNER JOIN users ON users.id = posts_comments",
    //                                     "id_post = $id"
    //                                 );
    // }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("posts_comments", "*", "id = $id")[0];
    }

    public function findByPostId($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                    "posts_comments", 
                                    "id, text, DATE_FORMAT(created_at, \"%d/%m/%Y\") AS created_at, id_user, users.name",
                                    "LEFT JOIN users ON users.id = posts_comments.id_user",
                                    "id_post = $id"
                                );
    }

    // public function findPostsByCommentId($id)
    // {
    //     return $this->queryBuilder->selectWithJoin(
    //                                 "posts_comments", 
    //                                 "posts.id, posts.title, posts.text, DATE_FORMAT(posts.created_at, \"%d/%m/%Y\") AS created_at, users.name AS user, comments.name AS comment, posts_images.img_path", 
    //                                 "INNER JOIN posts ON posts.id = posts_comments.id_post LEFT JOIN posts_images ON posts_images.id_post = posts.id LEFT JOIN users ON users.id = posts.id_user LEFT JOIN comments ON comments.id = posts_comments.comment",
    //                                 "id_comment = $id ORDER BY posts.created_at DESC"
    //                             );
    // }

    public function create($data)
    {
    }

    public function update($data)
    {
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
            "comments", 
            ["name"], 
            [$data['name']]
        );
    }
}