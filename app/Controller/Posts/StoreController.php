<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;
use App\Router\Router;

class StoreController extends ControllerAbstract {


    public function execute() {
        $postsRepo = new PostsRepository();
        if(!$postsRepo->save($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Ocorreu um erro, tente novamente");
            };
            return $this->view("posts.create", $_POST);
        }
        Session::setMessage("success", "Post criado com sucesso");
        Router::redirect("/users/index");
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

}