<?php

namespace App\Controller\Dashboard;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Router\Router;

class CategoriesDashController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
        Session::setMessage("error", "Você precisa estar logado para acessar a dashboard!");
        return Router::redirect('/auth/index');
        }
        $categoriesRepo = new CategoriesRepository();
        $categories = $categoriesRepo->findAll();
        return $this->view("dashboard.categories", $categories);
    }
}