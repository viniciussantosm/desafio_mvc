<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Router\Router;

class StoreController extends ControllerAbstract {

    public function execute()
    {
        $categoryRepo = new CategoriesRepository();
        if(!$categoryRepo->save($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Ocorreu um erro, tente novamente");
            };
            return $this->view("categories.create", $_POST);
        }
        Session::setMessage("success", "Categoria criada com sucesso");
        Router::redirect("/dashboard/categories");
    }
}