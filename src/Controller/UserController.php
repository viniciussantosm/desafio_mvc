<?php

namespace src\Controller;

class UserController implements Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        echo 'index user';
    }

    public function processRequest()
    {
        require_once __DIR__ . '/../../views/users/index.php';
    }
}