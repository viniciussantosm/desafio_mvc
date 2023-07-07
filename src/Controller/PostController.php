<?php

declare(strict_types=1);

namespace src\Controller;

class PostController implements Controller {

    public function __construct()
    {
        
    }

    public function index()
    {
        echo 'index post';
    }

    public function create()
    {
        echo 'create post';
    }

    public function store()
    {
        echo 'store post';
    }

    public function edit()
    {
        echo 'edit post';
    }

    public function update()
    {
        echo 'update post';
    }

    public function destroy()
    {
        echo 'destroy post';
    }
}