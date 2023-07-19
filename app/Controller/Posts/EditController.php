<?php


namespace App\Controller\Posts;
use App\Controller\ControllerAbstract;
use App\Repository\CategoriesRepository;
use App\Repository\PostsRepository;
use App\Repository\TagsRepository;
use App\Repository\UserRepository;

class EditController extends ControllerAbstract {


    public function execute() {
        $data = $this->getParams();
        $post = $this->getPost($data["id"]);
        $tagSelect["tags"] = $this->createSelect($this->getTags(), $this->getTagsByPostId($data["id"]));
        $categorySelect["categories"] = $this->createSelect($this->getCategories(), $this->getCategoriesByPostId($data["id"]));
        $data = array_merge($post, $tagSelect, $categorySelect);
        return $this->view('posts.edit', $data);
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
        $selectedIds = array_column($selectedData, "id");
        $select = "";
        foreach ($data as $value) {
            $checkForSelected = "";
            if(in_array($value["id"], $selectedIds)) {
                $checkForSelected = "selected = 'selected'";
            }
            $select .= '<option value="' . $value["id"] . '"' . $checkForSelected . '">' . $value["name"] . '</option>';
        }
        return $select;
    }
}