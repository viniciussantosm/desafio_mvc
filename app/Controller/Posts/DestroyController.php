<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;
use App\Router\Router;

class DestroyController extends ControllerAbstract {


    public function execute() {
        $data = $this->getParams();
        $postsRepo = new PostsRepository();

        if(!$postsRepo->delete($data["id"])) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao excluir post"); 
            };

            return $this->view("posts.edit", $data);
        };

        Session::setMessage("success", "Post excluído com sucesso");
        Router::redirect(sprintf("%s", "/users/index"));

    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}