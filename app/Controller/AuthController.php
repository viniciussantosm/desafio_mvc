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

    public function edit()
    {
        return $this->view("auth.edit");
    }

    public function update()
    {
        return $this->view("auth.update");
    }
}