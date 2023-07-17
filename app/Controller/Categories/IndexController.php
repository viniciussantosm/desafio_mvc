<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Repository\CategoriesRepository;

class IndexController extends ControllerAbstract {

    public function execute()
    {
        $categoriesRepo = new CategoriesRepository();
        $categoriesData = $categoriesRepo->findAll();
        return $this->view("categories.index", $categoriesData);
    }
}