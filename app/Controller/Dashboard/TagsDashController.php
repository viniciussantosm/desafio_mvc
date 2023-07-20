<?php

namespace App\Controller\Dashboard;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\TagsRepository;
use App\Router\Router;

class TagsDashController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Session::setMessage("error", "Você precisa estar logado para acessar a dashboard!");
            return Router::redirect('/auth/index');
        }
        $tagsRepo = new TagsRepository();
        $tags = $tagsRepo->findAll();
        return $this->view("dashboard.tags", $tags);
    }
}