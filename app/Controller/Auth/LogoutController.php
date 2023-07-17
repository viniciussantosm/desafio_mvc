<?php

namespace App\Controller\Auth;
use App\Controller\ControllerAbstract;
use App\Model\Auth;
use App\Router\Router;

class LogoutController extends ControllerAbstract {

    public function execute()
    {
        $auth = new Auth();
        $auth->logout();
        Router::redirect("/posts/index");
    }
}