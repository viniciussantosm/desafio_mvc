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
                                "post",
                                "post.id AS post_id,
                                post.title AS post_title,
                                user.name AS post_user,
                                DATE_FORMAT(post.created_at, \"%d/%m/%Y\") AS post_created_at,
                                post_image.img_path AS img_path",
                                "INNER JOIN post_image ON post_image.id_post = post.id
                                INNER JOIN user ON user.id = post.id_user"
                            );
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectWithJoin(
                                "post",
                                "post.id, post.title, post.text, DATE_FORMAT(post.created_at, \"%d/%m/%Y\") AS created_at, id_user, user.name, post_image.img_path",
                                "LEFT JOIN user ON user.id = post.id_user LEFT JOIN post_image ON post_image.id_post = post.id",
                                "post.id = $id")[0];
    }

    public function findByUserId($id)
    {
        $joins = "INNER JOIN post_image ON post_image.id_post = post.id
        INNER JOIN user ON user.id = post.id_user";

        return $this->queryBuilder->selectWithJoin(
                            "post",
                            "post.id AS post_id,
                            post.title AS post_title,
                            user.name AS post_user,
                            DATE_FORMAT(post.created_at, \"%d/%m/%Y\") AS post_created_at,
                            post_image.img_path AS img_path",
                            $joins,
                            "id_user = $id"
                        );
    }

    public function findLastInsertByUserId($id)
    {
        return $this->queryBuilder->selectQuery("post", "*", "id_user = $id ORDER BY created_at DESC LIMIT 1");
    }

    public function findPostImages($id)
    {
        return $this->queryBuilder->selectQuery("post_image", "*", "id_post = $id");
    }

    public function delete($id)
    {
        $this->deletePostImages($id);
        return $this->queryBuilder->deleteQuery("post", "id = {$id}");
    }

    public function deletePostImages($id)
    {
        $images = $this->findPostImages($id);

        foreach($images as $image) {
            unlink(ROOT . $image["img_path"]);
            $this->queryBuilder->deleteQuery("post_image", "id = {$image['id']}");
        }
    }

    public function deletePostTags($id)
    {
        $this->queryBuilder->deleteQuery("post_tag", "id_post = {$id}");
    }

    public function deletePostCategories($id)
    { 
        $this->queryBuilder->deleteQuery("post_category", "id_post = {$id}");
    }

    public function save($data)
    {
        $ext = array("image/jpg", "image/jpeg", "image/png");
        if(!in_array($data["postImages"]["type"][0], $ext)) {
            return false;
        }
        
        $fileName = uniqid() . basename($data["postImages"]["full_path"][0]);
        $uploadPath = "/uploads/post/" . $fileName;
        if(!move_uploaded_file($data["postImages"]["tmp_name"][0], ROOT . $uploadPath)) {
            return false;
        }

        if(array_key_exists("id", $data)) {
            $this->queryBuilder->updateQuery("post", ["title", "text"], [$data['title'], $data['text']], "id = {$data['id']}");
            
            $this->deletePostImages($data["id"]);
            $this->queryBuilder->insertQuery("post_image", ["id_post", "img_path"], [$data["id"], $uploadPath]);

            $this->deletePostCategories($data["id"]);
            foreach($data["categories"] as $category) {
                $this->queryBuilder->insertQuery("post_category", ["id_post", "id_category"], [$data["id"], $category]);
            }

            $this->deletePostTags($data["id"]);
            foreach($data["tags"] as $tag) {
                $this->queryBuilder->insertQuery("post_tag", ["id_post", "id_tag"], [$data["id"], $tag]);
            }

            return true;
        }

        $rowCount = $this->queryBuilder->insertQuery(
            "post", 
            ["title", "text", "id_user"],
            [$data['title'], $data['description'], SESSION::getUserId()]
        );

        if(!$rowCount) {
            return;
        }

        $lastPost = $this->findLastInsertByUserId(Session::getUserId());
        $this->queryBuilder->insertQuery("post_image", ["id_post", "img_path"], [$lastPost[0]["id"], $uploadPath]);
        foreach($data["tags"] as $tag) {
            $this->queryBuilder->insertQuery("post_tag", ["id_post", "id_tag"], [$lastPost[0]["id"], $tag]);
        }
        foreach($data["categories"] as $category) {
            $this->queryBuilder->insertQuery("post_category", ["id_post", "id_category"], [$lastPost[0]["id"], $category]);
        }

        return true;
    }
}