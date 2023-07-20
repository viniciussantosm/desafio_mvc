<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Router\Router;

class CreateController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Session::setMessage("error", "Você precisa estar logado para criar categorias!");
            return Router::redirect('/auth/index');
        }
        return $this->view("categories.create");
    }
}