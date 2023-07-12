<?php

namespace src\Controller;

use src\Controller\Controller;
use src\Model\Auth;
use src\Model\User;
use src\Repository\UserRepository;

class AuthController extends Controller {

    public function __construct() {
    }

    public function index()
    {
        return $this->view("auth.login");
    }

    public function register()
    {
        return $this->view("auth.create");
    }

    public function store()
    {
        $auth = new Auth();
        if(!$auth->register()) {
            if(!$_SESSION["message"]) {
                $_SESSION["message"]["type"] = "error";
                $_SESSION["message"]["value"] = "Erro ao atualizar dados";
            };
            return $this->view("auth.create", $_POST);
        }
        $_SESSION["message"]["type"] = "success";
        $_SESSION["message"]["value"] = "Conta criada com sucesso!";
        header("Location: /posts/index");
    }

    public function edit()
    {
        return $this->view("auth.edit");
    }

    public function update()
    {
        return $this->view("auth.update");
    }

    public function login()
    {
        $auth = new Auth();
        if(!$auth->login($_POST['email'])){
            return $this->view("auth.login");
        };
        header("Location: /posts/index");
    }

    public function logout()
    {
        $auth = new Auth();
        $auth->logout();
        header("Location: /posts/index");
    }
}