<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;

class IndexController extends ControllerAbstract {


    public function execute() {
        $posts = $this->getPosts();
        return $this->view('posts.index', $posts);
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

}