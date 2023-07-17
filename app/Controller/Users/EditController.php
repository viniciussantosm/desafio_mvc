<?php

namespace App\Controller\Users;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\UserRepository;
use App\Router\Router;

class EditController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Router::redirect("/posts/index");
        }
        
        $userRepo = new UserRepository();
        $userData = $userRepo->findById(Session::getUserId());
        // var_dump($userData);
        return $this->view("users.edit", $userData);
        // return $this->view("users.edit");
    }
}