<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Repository\TagsRepository;

class ShowController extends ControllerAbstract {

    public function execute()
    {
        $params = $this->getParams();
        $categoriesRepo = new TagsRepository();
        $data['tag'] = $categoriesRepo->findById($params['id']);
        $data['posts'] = $categoriesRepo->findPostsByTagId($params['id']);
        return $this->view("tags/show", $data);
    }
}