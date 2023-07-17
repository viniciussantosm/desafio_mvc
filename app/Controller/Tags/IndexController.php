<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;

class IndexController extends ControllerAbstract {

    public function execute()
    {
        return $this->view('tags.index');
    }
}