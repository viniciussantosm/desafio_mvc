<?php


namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Repository\UserRepository;
use App\Router\Router;

class DestroyController extends ControllerAbstract {


    public function execute() {
        $data = $this->getParams();
        $categoriesRepo = new CategoriesRepository();

        if(!$categoriesRepo->delete($data["id"])) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao excluir categoria"); 
            };

            return $this->view("dashboard.categories", $data);
        };

        Session::setMessage("success", "Categoria excluída com sucesso");
        Router::redirect(sprintf("%s", "/dashboard/categories"));

    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}