<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\UserRepository;

class CreateController extends ControllerAbstract {


    public function execute() {
        return $this->view('posts.create');
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}