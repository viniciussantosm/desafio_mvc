<?php

namespace App\Controller\Dashboard;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Router\Router;

class IndexController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Session::setMessage("error", "Você precisa estar logado para acessar a dashboard!");
            return Router::redirect('/auth/index');
        }
        return $this->view("dashboard.index");
    }
}