<?php

namespace App\Controller\Users;
use App\Controller\ControllerAbstract;

class IndexController extends ControllerAbstract {
    
    public function execute()
    {
        return $this->view("users.index");
    }
}