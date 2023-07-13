<?php

namespace App\Router;

use App\Controller\{
    AuthController,
    CategoryController,
    PostController,
    UserController,
    TagController,
};
use App\Model\Messages\Messages;
use App\Model\Session;

class Router {

    private $routes = [];
    private $validControllerMethods = ["index", "create", "store", "edit", "update", "destroy", "login", "register"];
    private Messages $routerMessager;
    private Messages $userMessager;
    private Session $session;

    public function __construct(Messages $messager, Messages $userMessager, Session $session) {
        $this->routerMessager = $messager;
        $this->userMessager = $userMessager;
        $this->session = $session;
    }

    function init() {
        
        $this->routes = [
            "posts" => PostController::class,
            "users" => UserController::class,
            "categories" => CategoryController::class,
            "tags" => TagController::class,
            "auth" => AuthController::class,
        ];
    }

    public function dispatch() {

        if(!$this->validateUri($_SERVER["REQUEST_URI"], $this->routerMessager)) return false;
        
        $action = trim($_SERVER["REQUEST_URI"], '/');
        $action = explode("/", $action);
        
        $className = (string)$this->routes[$action[0]];

        if(!$className) {
            exit();
        }

        $controller = new $className(
                            $this->routerMessager,
                            $this->userMessager,
                            $this->session
                        );
        $controller->{$action[1]}();
    }

    public function validateUri($uri, Messages $message)
    {
        if(!is_string($uri) || strlen($uri) <= 1) {
            $this->redirect($message->getMessage("posts.index"));
        }
        
        if($this->checkForStaticFile(ROOT . $uri)) return false;

        $explodedUri = explode("/", trim($uri, "/"));

        if(!array_key_exists($explodedUri[0], $this->routes)) {
            $this->redirect($message->getMessage("posts.index"));
        }

        if(array_key_exists(1 ,$explodedUri) && !in_array($explodedUri[1], $this->validControllerMethods)) {
            $this->redirect($message->getMessage("posts.index"));
        }

        if(array_key_exists(1 ,$explodedUri) && $explodedUri[1] == "edit") {
            $this->validateEditUri($explodedUri);
        }

        return true;
    }

    public function checkForStaticFile($filePath)
    {
        if (file_exists($filePath)) {
            $this->setContentType($filePath);
            $this->showFileContent($filePath);
            
            return true;
        }
    }

    public function showFileContent($filePath)
    {
        $fh = fopen($filePath, 'r');
        fpassthru($fh);
        fclose($fh);
    }

    public function setContentType($filePath)
    {
        if(strpos($filePath, ".css")) {
            header('Content-Type: text/css');
            return true;
        }

        header('Content-Type: '.mime_content_type($filePath));
        return true;
    }

    public function validateEditUri(array $explodedUri)
    {
        $value = filter_var($explodedUri[2], FILTER_SANITIZE_NUMBER_INT);
        if(!$value) {
            self::redirect("/posts/index");
        }
    }

    public static function redirect($route) {
        return header(sprintf("Location: %s", $route));
    }
}