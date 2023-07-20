<?php

namespace App\Controller\Comments;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CommentsRepository;
use App\Router\Router;

class StoreController extends ControllerAbstract {

    public function execute()
    {
        if(!Session::isLoggedIn()) {
            Session::setMessage("error", "Você precisa estar logado para postar comentários!");
            return Router::redirect('/auth/index');
        }
        $params = $this->getParams();
        $params["id_user"] = Session::getUserId();
        $commentsRepo = new CommentsRepository();
        if(!$commentsRepo->save($params)) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Ocorreu um erro, tente novamente");
            };
            return $this->view("posts.index");
        }
        Session::setMessage("success", "Comentário criado com sucesso");
        Router::redirect("/posts/show/?id={$params['id_post']}");
    }
}