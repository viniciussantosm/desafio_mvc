<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;

class CreateController extends ControllerAbstract {

    public function execute()
    {
        return $this->view("categories.create");
    }
}