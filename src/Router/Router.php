<?php

namespace src\Router;

use src\Controller\{
    PostController,
    UserController,
};

class Router {

    private $routes = [];
    private $validControllerMethods = ["index", "create", "store", "edit", "update", "destroy"];

    public function __construct() {
        
    }

    function init() {
        
        $this->routes = [
            "posts" => PostController::class,
            "users" => UserController::class
        ];
    }

    public function dispatch() {
    
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

        if($explodedUri[2]) {
            if($explodedUri[1] == "edit") {
                $value = filter_var($explodedUri[2], FILTER_SANITIZE_NUMBER_INT);
                if(!$value) {
                    header("Location: /posts/index");
                }
            } else {
                header("Location: /posts/index");
            }
        }
    }
}