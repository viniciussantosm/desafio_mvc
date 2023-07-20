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
            $categories = $this->getCategories();
            return $this->view("dashboard.categories", $categories);
        }
        Session::setMessage("success", "Categoria atualizada com sucesso");
        Router::redirect("/dashboard/categories");
    }

    public function getCategories()
    {
        $categoriesRepo = new CategoriesRepository();
        return $categoriesRepo->findAll();
    }
}