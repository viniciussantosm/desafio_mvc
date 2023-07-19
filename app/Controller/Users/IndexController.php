<?php

namespace App\Controller\Users;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\PostsRepository;

class IndexController extends ControllerAbstract {
    
    public function execute()
    {
        $posts = $this->getPosts();
        return $this->view("users.index", $posts);
    }

    public function getPosts()
    {
        $posts = new PostsRepository();
        return $posts->findByUserId(Session::getUserId());
    }
}