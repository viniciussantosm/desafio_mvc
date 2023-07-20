<?php

namespace App\Controller\Auth;
use App\Controller\ControllerAbstract;
use App\Model\Auth;
use App\Model\Session;
use App\Router\Router;

class StoreController extends ControllerAbstract {

    public function execute()
    {
        $auth = new Auth();
        if(!$auth->register($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao atualizar dados");
            };
            return $this->view("auth.create", $_POST);
        }
        Session::setMessage("success", "Conta criada com sucesso");
        Router::redirect("/users/index");
    }
}