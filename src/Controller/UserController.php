<?php

namespace src\Controller;

class UserController extends Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        return $this->view("users.index");
    }

    public function create()
    {
        return $this->view("users.create");
    }

    public function store()
    {
        return $this->view("users.store");
    }

    public function edit()
    {
        return $this->view("users.edit");
    }

    public function update()
    {
        return $this->view("users.update");
    }

    public function destroy()
    {
        return $this->view("users.destroy");
    }
}