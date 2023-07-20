<?php

namespace App\Controller\Users;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\UserRepository;
use App\Router\Router;

class UpdateController extends ControllerAbstract {

    public function execute()
    {
        $userRepo = new UserRepository();
        if(!$userRepo->save($_POST)) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao atualizar dados"); 
            };
            return $this->view("users.edit", $_POST);
        };
        Session::setMessage("success", "Dados atualizados com sucesso");
        Session::setName(explode(" ", $_POST["name"])[0]);
        Router::redirect(sprintf("%s",
                "/users/edit")
            );
    }
}