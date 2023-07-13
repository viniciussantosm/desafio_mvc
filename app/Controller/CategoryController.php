<?php


namespace App\Controller;

class CategoryController extends Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        return $this->view("categories.index");
    }

    public function create()
    {
        return $this->view("categories.create");
    }

    public function store()
    {
        return $this->view("categories.store");
    }

    public function edit()
    {
        return $this->view("categories.edit");
    }

    public function update()
    {
        return $this->view("categories.update");
    }

    public function destroy()
    {
        return $this->view("categories.destroy");
    }
}