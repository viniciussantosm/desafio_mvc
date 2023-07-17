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

    public function update()
    {
        
    }

    public function destroy()
    {
        return $this->view("users.destroy");
    }
}