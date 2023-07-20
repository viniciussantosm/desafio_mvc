<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\TagsRepository;
use App\Router\Router;

class UpdateController extends ControllerAbstract {
    
    public function execute()
    {
        $tagRepo = new TagsRepository();
        if(!$tagRepo->save($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Ocorreu um erro, tente novamente");
            };
            $tags = $this->getTags();
            return $this->view("dashboard.tags", $tags);
        }
        Session::setMessage("success", "Tag atualizada com sucesso");
        Router::redirect("/dashboard/tags");
    }

    public function getTags()
    {
        $tagRepo = new TagsRepository();
        return $tagRepo->findAll();
    }
}