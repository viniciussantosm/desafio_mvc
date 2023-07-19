<?php

namespace App\Controller\Comments;
use App\Controller\ControllerAbstract;
use App\Model\Session;

class StoreController extends ControllerAbstract {

    public function execute()
    {
        $params = $this->getParams();
        $params["id_user"] = Session::getUserId();
        var_dump($params);
        // $post = $this->getPost($params['id']);
        // return $this->view('posts.show', $post);
    }
}