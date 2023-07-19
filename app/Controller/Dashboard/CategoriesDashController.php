<?php

namespace App\Controller\Dashboard;
use App\Controller\ControllerAbstract;
use App\Repository\CategoriesRepository;

class CategoriesDashController extends ControllerAbstract {

    public function execute()
    {
        $categoriesRepo = new CategoriesRepository();
        $categories = $categoriesRepo->findAll();
        return $this->view("dashboard.categories", $categories);
    }
}