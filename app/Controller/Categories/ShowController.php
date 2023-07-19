<?php

namespace App\Controller\Categories;
use App\Controller\ControllerAbstract;
use App\Repository\CategoriesRepository;

class ShowController extends ControllerAbstract {

    public function execute()
    {
        $params = $this->getParams();
        $categoriesRepo = new CategoriesRepository();
        $data['category'] = $categoriesRepo->findById($params['id']);
        $data['posts'] = $categoriesRepo->findPostsByCategoryId($params['id']);
        return $this->view("categories/show", $data);
    }
}