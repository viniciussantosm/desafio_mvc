<?php

namespace App\Controller\Auth;
use App\Controller\ControllerAbstract;

class RegisterController extends ControllerAbstract {

    public function execute()
    {
        return $this->view('auth.create');
    }
}