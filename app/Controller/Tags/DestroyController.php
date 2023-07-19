<?php


namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;
use App\Router\Router;

class DestroyController extends ControllerAbstract {


    public function execute() {
        $data = $this->getParams();
        $tagsRepo = new TagsRepository();

        if(!$tagsRepo->delete($data["id"])) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao excluir tag"); 
            };

            return $this->view("dashboard.tags", $data);
        };

        Session::setMessage("success", "Tag excluída com sucesso");
        Router::redirect(sprintf("%s", "/dashboard/tags"));

    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}