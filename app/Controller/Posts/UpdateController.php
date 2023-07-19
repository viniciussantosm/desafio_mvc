<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Model\Session;
use App\Repository\CategoriesRepository;
use App\Repository\PostsRepository;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;
use App\Router\Router;

class UpdateController extends ControllerAbstract {


    public function execute() {
        $postRepo = new PostsRepository();
        if(!$postRepo->save($this->getParams())) {
            if(!Session::getMessage()) {
                Session::setMessage("error", "Erro ao atualizar dados"); 
            };
            $data = $this->getParams();
            $post = $this->getPost($data["id"]);
            $tagSelect["tags"] = $this->createSelect($this->getTags(), $data["tags"]);
            $categorySelect["categories"] = $this->createSelect($this->getCategories(), $data["categories"]);
            $data = array_merge($post, $tagSelect, $categorySelect);

            return $this->view("posts.edit", $data);
        };

        Session::setMessage("success", "Post atualizado com sucesso");
        Router::redirect(sprintf("%s", "/users/index"));
    }

    public function getUser() {
        $user = new UserRepository();
        $user = $user->findById($this->getParam('id'));

        return $user;
    }

    public function getPost($id)
    {
        $post = new PostsRepository();
        return $post->findById($id);
    }

    public function getTagsByPostId($id)
    {
        $tags = new TagsRepository();
        return $tags->findByPostId($id);
    }

    public function getTags()
    {
        $tags = new TagsRepository();
        return $tags->findAll();
    }

    public function getCategoriesByPostId($id)
    {
        $tags = new CategoriesRepository();
        return $tags->findByPostId($id);
    }

    public function getCategories()
    {
        $tags = new CategoriesRepository();
        return $tags->findAll();
    }

    public function createSelect($data, $selectedData)
    {
        $selectedIds = array_key_exists("id", $selectedData) ? array_column($selectedData, "id") : $selectedData;
        $select = "";
        foreach ($data as $value) {
            $checkForSelected = in_array($value["id"], $selectedIds) ? "selected = 'selected'" : "";
            $select .= "<option value=\"{$value["id"]}\" {$checkForSelected} \"> {$value["name"]} </option>";
        }
        return $select;
    }
}