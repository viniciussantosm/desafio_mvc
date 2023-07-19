<?php

namespace App\Controller\Dashboard;
use App\Controller\ControllerAbstract;
use App\Repository\TagsRepository;

class TagsDashController extends ControllerAbstract {

    public function execute()
    {
        $tagsRepo = new TagsRepository();
        $tags = $tagsRepo->findAll();
        return $this->view("dashboard.tags", $tags);
    }
}