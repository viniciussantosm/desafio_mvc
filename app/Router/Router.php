<?php

namespace App\Router;

use App\Controller\{
    AuthController,
    CategoryController,
    Controller,
    PostController,
    UserController,
    TagController,
};
use App\Model\Command\Route;

class Router {

    private array $routes = [];
    
    protected $uri;


    public function addRoute(string $route, string $controller) {
        $route = new Route($route, $controller, $this);
        if (sizeof($this->routes) > 0) {
            $route->setNext(
                array_pop($this->routes)
            );
        }
        $this->routes[] = $route;
    }

    public function handle() {
        /**
         * @var Route $firstRoute
         */
        $firstRoute = array_shift($this->routes);

        return $firstRoute->handle($_SERVER["REQUEST_URI"] ?: '/');
    }

    public function dispatch(Controller $controller, $action) {

        $controller->$action();
    }

    public function validateUri($uri)
    {
        if(!is_string($uri) || strlen($uri) <= 1) {
            Router::redirect("posts/index");
        }

        $explodedUri = explode("/", trim($uri, "/"));

        if(array_key_exists(1 ,$explodedUri) && $explodedUri[1] == "edit") {
            $this->validateEditUri($explodedUri);
        }

        return true;
    }

    public function validateEditUri(array $explodedUri)
    {
        $value = filter_var($explodedUri[2], FILTER_SANITIZE_NUMBER_INT);
        if(!$value) {
            Router::redirect("/posts/index");
        }
    }

    public static function redirect($route) {
        return header(sprintf("Location: %s", $route));
    }
}