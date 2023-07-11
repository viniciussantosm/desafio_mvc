<?php


namespace src\Controller;

class TagController extends Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        return $this->view("tags.index");
    }

    public function create()
    {
        return $this->view("tags.create");
    }

    public function store()
    {
        return $this->view("tags.store");
    }

    public function edit()
    {
        return $this->view("tags.edit");
    }

    public function update()
    {
        return $this->view("tags.update");
    }

    public function destroy()
    {
        return $this->view("tags.destroy");
    }
}