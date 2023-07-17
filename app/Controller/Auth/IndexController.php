<?php


namespace App\Controller\Auth;
use App\Controller\ControllerAbstract;
use App\Repository\UserRepository;

class IndexController extends ControllerAbstract {


    public function execute() {
        return $this->view('auth.login');
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}