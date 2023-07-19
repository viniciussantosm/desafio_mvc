<?php

namespace App\Controller\Tags;
use App\Controller\ControllerAbstract;
use App\Repository\TagsRepository;

class IndexController extends ControllerAbstract {

    public function execute()
    {
        $tagRepo = new TagsRepository();
        $tagsData = $tagRepo->findAll();
        return $this->view('tags.index', $tagsData);
    }
}