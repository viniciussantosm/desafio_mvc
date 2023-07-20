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
            Session::setMessage("error", "Você precisa estar logado para editar tags!");
            return Router::redirect('/auth/index');
        }
        
        $params = $this->getParams();
        $tagsRepo = new TagsRepository();
        $tagData = $tagsRepo->findById($params["id"]);
        if(!$tagData) {
            Session::setMessage("error", "Tag não encontrada");
            $tagData = [];
        }
        return $this->view("tags.edit", $tagData);
    }
}