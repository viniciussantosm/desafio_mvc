<?php

namespace App\Repository;
use App\Model\Session;

class PostsRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->selectWithJoin(
                                "posts",
                                "bloggero.posts.id AS post_id,
                                bloggero.posts.title AS post_title,
                                bloggero.users.name AS post_user,
                                DATE_FORMAT(bloggero.posts.created_at, \"%d/%m/%Y\") AS post_created_at,
                                bloggero.posts_images.img_path AS img_path",
                                "INNER JOIN bloggero.posts_images ON bloggero.posts_images.id_post = bloggero.posts.id
                                INNER JOIN bloggero.users ON bloggero.users.id = bloggero.posts.id_user"
                            );
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("posts", "*", "id = $id")[0];
    }

    public function findByUserId($id)
    {
        $joins = "INNER JOIN bloggero.posts_images ON bloggero.posts_images.id_post = bloggero.posts.id
        INNER JOIN bloggero.users ON bloggero.users.id = bloggero.posts.id_user";

        return $this->queryBuilder->selectWithJoin(
                            "posts",
                            "bloggero.posts.id AS post_id,
                            bloggero.posts.title AS post_title,
                            bloggero.users.name AS post_user,
                            DATE_FORMAT(bloggero.posts.created_at, \"%d/%m/%Y\") AS post_created_at,
                            bloggero.posts_images.img_path AS img_path",
                            $joins,
                            "id_user = $id"
                        );
    }

    public function findLastInsertByUserId($id)
    {
        return $this->queryBuilder->selectQuery("posts", "*", "id_user = $id ORDER BY created_at DESC LIMIT 1");
    }

    public function findPostImages($id)
    {
        return $this->queryBuilder->selectQuery("posts_images", "*", "id_post = $id");
    }

    public function delete($id)
    {
        return $this->queryBuilder->deleteQuery("posts", "id = {$id}");
    }

    public function deletePostImages($id)
    {
        $images = $this->findPostImages($id);

        foreach($images as $image) {
            unlink(ROOT . $image["img_path"]);
            $this->queryBuilder->deleteQuery("posts_images", "id = {$image['id']}");
        }
    }

    public function deletePostTags($id)
    {
        $this->queryBuilder->deleteQuery("posts_tags", "id_post = {$id}");
    }

    public function deletePostCategories($id)
    { 
        $this->queryBuilder->deleteQuery("posts_categories", "id_post = {$id}");
    }

    public function save($data)
    {
        $ext = array("image/jpg", "image/jpeg", "image/png");
        if(!in_array($data["postImages"]["type"][0], $ext)) {
            return false;
        }
        
        $fileName = uniqid() . basename($data["postImages"]["full_path"][0]);
        $uploadPath = "/uploads/posts/" . $fileName;
        if(!move_uploaded_file($data["postImages"]["tmp_name"][0], ROOT . $uploadPath)) {
            return false;
        }

        if($data["id"]) {
            $this->queryBuilder->updateQuery("posts", ["title", "text"], [$data['title'], $data['text']], "id = {$data['id']}");
            
            $this->deletePostImages($data["id"]);
            $this->queryBuilder->insertQuery("posts_images", ["id_post", "img_path"], [$data["id"], $uploadPath]);

            $this->deletePostCategories($data["id"]);
            foreach($data["categories"] as $category) {
                $this->queryBuilder->insertQuery("posts_categories", ["id_post", "id_category"], [$data["id"], $category]);
            }

            $this->deletePostTags($data["id"]);
            foreach($data["tags"] as $tag) {
                $this->queryBuilder->insertQuery("posts_tags", ["id_post", "id_tag"], [$data["id"], $tag]);
            }

            return true;
        }

        $rowCount = $this->queryBuilder->insertQuery(
            "posts", 
            ["title", "text", "id_user"],
            [$data['title'], $data['description'], SESSION::getUserId()]
        );

        if(!$rowCount) {
            return;
        }

        $lastPost = $this->findLastInsertByUserId(Session::getUserId());
        $this->queryBuilder->insertQuery("posts_images", ["id_post", "img_path"], [$lastPost[0]["id"], $uploadPath]);
        foreach($data["tags"] as $tag) {
            $this->queryBuilder->insertQuery("posts_tags", ["id_post", "id_tag"], [$lastPost[0]["id"], $tag]);
        }
        foreach($data["categories"] as $category) {
            $this->queryBuilder->insertQuery("posts_categories", ["id_post", "id_category"], [$lastPost[0]["id"], $category]);
        }

        return true;
    }
}