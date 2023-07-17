<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\UserRepository;

class UpdateController extends ControllerAbstract {


    public function execute() {
        return $this->view('posts.destroy');
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}