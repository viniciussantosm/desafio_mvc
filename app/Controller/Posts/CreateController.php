<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\CategoriesRepository;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;

class CreateController extends ControllerAbstract {


    public function execute() {
        $data = [
            "tags" => $this->getTags(),
            "categories" => $this->getCategories(),
        ];
        return $this->view('posts.create', $data);
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

    public function getTags() {
        $tags = new TagsRepository();
        return $tags->findAll();
    }

    public function getCategories() {
        $categories = new CategoriesRepository();
        return $categories->findAll();
    }
}