<?php

namespace App\Controller;

use App\Model\Messages\RouteMessages;
use App\Model\Session;
use App\Repository\UserRepository;
use App\Router\Router;

class UserController extends Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        if(!Session::isLoggedIn()) {
            Router::redirect(RouteMessages::getMessage("posts.index"));
        }
        return $this->view("users.index");
    }

    public function create()
    {
        return $this->view("users.create");
    }

    public function store()
    {
        return $this->view("users.store");
    }

    public function edit()
    {
        if(!Session::isLoggedIn()) {
            Router::redirect(RouteMessages::getMessage("posts.index"));
        }

        $userRepo = new UserRepository();
        $userData = $userRepo->findById(Session::getUserId());

        return $this->view("users.edit", $userData);
    }

    public function update()
    {
        $userRepo = new UserRepository();
        if(!$userRepo->update($_POST)) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao atualizar dados"); 
            };
            return $this->view("users.edit", $_POST);
        };
        Session::setMessage("success", "Dados atualizados com sucesso");
        Session::setName(explode(" ", $_POST["name"])[0]);
        Router::redirect(sprintf("%s%s",
                RouteMessages::getMessage("users.edit"),
                Session::getUserId())
            );
    }

    public function destroy()
    {
        return $this->view("users.destroy");
    }
}