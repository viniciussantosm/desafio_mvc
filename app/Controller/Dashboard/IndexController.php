<?php

namespace App\Controller\Dashboard;
use App\Controller\ControllerAbstract;

class IndexController extends ControllerAbstract {

    public function execute()
    {
        return $this->view("dashboard.index");
    }
}