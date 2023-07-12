<?php

namespace src\Controller;

use src\Repository\UserRepository;

class UserController extends Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        if(!$_SESSION["isLoggedIn"]) {
            header("Location: /posts/index");
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
        if(!$_SESSION["isLoggedIn"]) {
            header("Location: /posts/index");
        }

        $userRepo = new UserRepository();
        $userData = $userRepo->findById($_SESSION["userId"]);

        return $this->view("users.edit", $userData);
    }

    public function update()
    {
        $userRepo = new UserRepository();
        if(!$userRepo->update($_POST)) {
            if(!$_SESSION["message"]) {
                $_SESSION["message"]["type"] = "error";
                $_SESSION["message"]["value"] = "Erro ao atualizar dados";
            };
            return $this->view("users.edit", $_POST);
        };
        $_SESSION["message"]["type"] = "success";
        $_SESSION["message"]["value"] = "Dados atualizados com sucesso";
        $_SESSION["name"] = explode(" ", $_POST["name"])[0];
        header("Location: /users/edit/$_SESSION[userId]");
    }

    public function destroy()
    {
        return $this->view("users.destroy");
    }
}