<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\TagsRepository;
use App\Router\Router;

class StoreController extends ControllerAbstract {
    
    public function execute()
    {
        $tagRepo = new TagsRepository();
        if(!$tagRepo->save($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Ocorreu um erro, tente novamente");
            };
            return $this->view("tags.create", $_POST);
        }
        Session::setMessage("success", "Tag criada com sucesso");
        Router::redirect("/tags/index");
    }
}