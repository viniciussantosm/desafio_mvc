<?php

namespace src\Router;

use src\Controller\{
    CategoryController,
    PostController,
    UserController,
    TagController
};

class Router {

    private $routes = [];
    private $validControllerMethods = ["index", "create", "store", "edit", "update", "destroy"];

    public function __construct() {
        
    }

    function init() {
        
        $this->routes = [
            "posts" => PostController::class,
            "users" => UserController::class,
            "categories" => CategoryController::class,
            "tags" => TagController::class,
        ];
    }

    public function dispatch() {
        if (file_exists(ROOT . $_SERVER["REQUEST_URI"])) {
            header('Content-Type: image/*');
            readfile(ROOT . $_SERVER["REQUEST_URI"]);
        }
        
        $this->validateUri($_SERVER["REQUEST_URI"]);

        $action = trim($_SERVER["REQUEST_URI"], '/');
        $action = explode("/", $action);
        
        $className = (string)$this->routes[$action[0]];

        if(!$className) {
            exit();
        }

        $controller = new $className();
        $controller->{$action[1]}();
    }

    public function validateUri($uri)
    {
        if(!is_string($uri)) {
            header("Location: /");
        }

        $explodedUri = explode("/", trim($uri, "/"));

        if(!array_key_exists($explodedUri[0], $this->routes)) {
            header("Location: /posts/index");
        }

        if(!in_array($explodedUri[1], $this->validControllerMethods)) {
            header("Location: /posts/index");
        }

        if($explodedUri[1] == "edit") {
            if(!$explodedUri[2]) {
                header("Location: /posts/index");
            } else {
                $value = filter_var($explodedUri[2], FILTER_SANITIZE_NUMBER_INT);
                if(!$value) {
                    echo "Aqui";
                    header("Location: /posts/index");
                }
            }
        }
    }
}