<?php


namespace App\Controller;

class PostController extends Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        return $this->view("posts.index");
    }

    public function create()
    {
        return $this->view("posts.create");
    }

    public function store()
    {
        return $this->view("posts.store");
    }

    public function edit()
    {
        return $this->view("posts.edit");
    }

    public function update()
    {
        return $this->view("posts.update");
    }

    public function destroy()
    {
        return $this->view("posts.destroy");
    }
}