<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;
use App\Router\Router;

class CreateController extends ControllerAbstract {


    public function execute() {
        if(!Session::isLoggedIn()) {
            Session::setMessage("error", "Você precisa estar logado para criar posts!");
            return Router::redirect('/auth/index');
        }
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