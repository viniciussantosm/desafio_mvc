<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\TagsRepository;
use App\Router\Router;

class EditController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Router::redirect("/posts/index");
        }
        
        $params = $this->getParams();
        $tagsRepo = new TagsRepository();
        $tagData = $tagsRepo->findById($params["id"]);
        // var_dump($userData);
        return $this->view("tags.edit", $tagData);
        // return $this->view("users.edit");
    }
}