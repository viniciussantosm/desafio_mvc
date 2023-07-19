<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Router\Router;

class EditController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Router::redirect("/posts/index");
        }
        
        $params = $this->getParams();
        $categoriesRepo = new CategoriesRepository();
        $categoryData = $categoriesRepo->findById($params["id"]);
        return $this->view("categories.edit", $categoryData);
    }
}