<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\UserRepository;

class StoreController extends ControllerAbstract {


    public function execute() {
        return $this->view('posts.store');
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}