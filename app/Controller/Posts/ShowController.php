<?php

namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\CategoriesRepository;
use App\Repository\CommentsRepository;
use App\Repository\PostsRepository;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;

class ShowController extends ControllerAbstract {


    public function execute() {
        $params = $this->getParams();
        $post = $this->getPost($params['id']);
        return $this->view('posts.show', $post);
    }

    public function getUser()
    {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

    public function getPosts()
    {
        $posts = new PostsRepository();
        return $posts->findAll();
    }

    public function getPost($id)
    {
        $postsRepo = new PostsRepository();
        $data["post"] = $postsRepo->findById($id);
        $data["tags"] = $this->prepareTags($this->getTags($id));
        $data["categories"] = $this->prepareCategories($this->getCategories($id));
        $data["comments"] = $this->getComments($id);
        
        return $data;
    }

    public function getTags($id)
    {
        $tagsRepo = new TagsRepository();
        return $tagsRepo->findByPostId($id);
    }

    public function getComments($id)
    {
        $commentsRepo = new CommentsRepository();
        return $commentsRepo->findByPostId($id);
    }

    public function getCategories($id)
    {
        $categoriesRepo = new CategoriesRepository();
        return $categoriesRepo->findByPostId($id);
    }

    public function prepareTags($tags)
    {
        $tagsText = "";
        foreach($tags as $tag) {
            $tagsText .= "<a href=\"http://{HTTP_HOST}/tags/show/?id={$tag["id"]}\" class=\"tag-show\">{$tag["name"]}</a>";
        }

        return $tagsText;
    }

    public function prepareCategories($categories)
    {
        $categoriesText = "";
        foreach($categories as $category) {
            $categoriesText .= "<a href=\"http://{HTTP_HOST}/categories/show/?id={$category["id"]}\" class=\"category-show\">{$category["name"]}</a>,";
        }

        return trim($categoriesText, ",");
    }
}