<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;

class CreateController extends ControllerAbstract {

    public function execute()
    {
        return $this->view("tags.create");
    }
}