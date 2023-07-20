<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Router\Router;

class CreateController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Session::setMessage("error", "Você precisa estar logado para criar tags!");
            return Router::redirect('/auth/index');
        }
        return $this->view("tags.create");
    }
}