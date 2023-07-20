<?php


namespace App\Controller\Auth;
use App\Controller\ControllerAbstract;
use App\Model\Auth;
use App\Repository\UserRepository;

class LoginController extends ControllerAbstract {


    public function execute() {
        $auth = new Auth();
        if(!$auth->login($this->getParams()['email'], $this->getParams()['password'])) {
            return $this->view("auth.login");
        };
        $this->getRouter()->redirect("/posts/index");
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}