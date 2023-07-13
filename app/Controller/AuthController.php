<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Auth;
use App\Model\Messages\RouteMessages;
use App\Model\Session;
use App\Router\Router;

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
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao atualizar dados");
            };
            return $this->view("auth.create", $_POST);
        }
        Session::setMessage("success", "Conta criada com sucesso");
        Router::redirect(RouteMessages::getMessage("users.index"));
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
        Router::redirect(RouteMessages::getMessage("posts.index"));
    }

    public function logout()
    {
        $auth = new Auth();
        $auth->logout();
        Router::redirect(RouteMessages::getMessage("posts.index"));
    }
}