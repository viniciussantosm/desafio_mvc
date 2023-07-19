<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Router\Router;

class UpdateController extends ControllerAbstract {
    
    public function execute()
    {
        $categoriesRepo = new CategoriesRepository();
        if(!$categoriesRepo->save($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Ocorreu um erro, tente novamente");
            };
            return $this->view("dashboard.categories", $_POST);
        }
        Session::setMessage("success", "Categoria atualizada com sucesso");
        Router::redirect("/dashboard/categories");
    }
}