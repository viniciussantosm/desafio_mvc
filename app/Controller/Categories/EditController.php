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
            Session::setMessage("error", "Você precisa estar logado para editar categorias!");
            return Router::redirect('/auth/index');
        }
        
        $params = $this->getParams();
        $categoriesRepo = new CategoriesRepository();
        $categoryData = $categoriesRepo->findById($params["id"]);
        if(!$categoryData) {
            Session::setMessage("error", "Categoria não encontrada");
            $categoryData = [];
        }
        return $this->view("categories.edit", $categoryData);
    }
}